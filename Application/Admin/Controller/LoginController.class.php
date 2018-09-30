<?php
namespace Admin\Controller;

use Think\Controller;
class LoginController extends Controller
{
    public function index()
    {
		$adminid = session('admin_auth.adminid');
		if (empty($adminid)){
			$this->display();
		} else {
			$this->redirect('index/index');
		}
    }
    public function doLogin()
    {
        if (IS_POST) {
            $code = I('post.code');
            $verify = new \Think\Verify();
            if (!$verify->check($code)) {
                $this->error(L('code'));
            }
            $username = I('post.username');
            $password = I('post.password');
            $r = M('Admin')->where(array('username' => $username, 'status' => array('eq', 1)))->find();
            if (!$r) {
                $this->error(L('user_error'));
            }
            $password = md5(md5(trim($password)) . $r['encrypt']);
            if ($r['password'] != $password) {
                $this->error(L('pass_error'));
            }
			
            M('Admin')->where(array('username' => $username))->save(array('lasttime' => NOW_TIME, 'lastip' => ip2long(get_client_ip())));
            $auth = array('adminid' => $r['adminid'], 'username' => $username, 'email' => $r['email'], 'logintime' => NOW_TIME, 'lasttime' => $r['lasttime']);
            session('admin_auth', $auth);
			//行为记录
			action_log('user_login', 'Admin', session('admin_auth.adminid'), session('admin_auth.adminid'));
            $this->success(L('login'), U('Index/index'));
        }	
    }
    public function verify()
    {
        ob_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length = 4;
        $Verify->useNoise = true;
        $Verify->entry();
    }
}
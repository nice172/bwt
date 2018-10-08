<?php
namespace Home\Controller;
use Think\Controller;
use Org\ThinkSDK\ThinkOauth;

class IndexController extends PublicController
{
	public function index()
    {
		/**首页访问统计
		*
		if(1 == getWebSetting('ip')){
			$id="index";
			$record=IpLookup("",1,$id); 
		}
		*
		**/
		
$menuIdArr =  M('Article')->where('status = 1')->getField('gallery',true);
if($menuIdArr){
	$menuIdStr = implode(',', $menuIdArr);
	$menuIdArr = explode(',', $menuIdStr);
	$menuIdArr = array_unique($menuIdArr);
	
}
$this->assign('menuIdArr', $menuIdArr);		$childs = M('category')->where(['pid' => 21])->field('catid')->select();		$temp = array();		foreach ($childs as $v){			$temp[] = $v['catid'];		}
		$this->assign('lists', $lists);		$Article_lists = M('Article')->where(['status' => 1,'catid' => ['in',$temp]])->order('sort asc')->limit(5)->select();		$data = [];		foreach ($Article_lists as $val){			$data[] = [				'src' => $val['thumb'],				'content' => $val['pdescription'],				'title' => $val['title'],					'url' => U('Case/show',array('id'=>$val['id']))
			];		}		$this->assign('Article_lists', json_encode($data));		
		$this->display($this->template . 'index/index');
    }
	public function bind() {
        $assignArr = array(
            "title" => "绑定已有账号",
            "nickname" => getSessionCookie('nickname')
        );
        $this->assign($assignArr);
        $this->display($this->template . 'index/bind');
    }
	
	 public function login($type = null) {
        empty($type) && $this->error('参数错误');
        import('Org.ThinkSDK.ThinkOauth');

		//加载ThinkOauth类并实例化一个对
        $sns = ThinkOauth::getInstance($type);
        //跳转到授权页面
        redirect($sns->getRequestCodeURL());
    }
	public function test(){		$menuIdArr =  M('Article')->where('status = 1')->getField('gallery',true);		if($menuIdArr){				$menuIdStr = implode(',', $menuIdArr);				$menuIdArr = explode(',', $menuIdStr);				$menuIdArr = array_unique($menuIdArr);							}		$this->assign('menuIdArr', $menuIdArr);				$this->assign('lists', $lists);		//$this->display($this->template . 'index/test');}
	
	public function callback($type = null, $code = null) {
		header("Content-type: text/html; charset=utf-8");
		(empty($type) || empty($code)) && $this->error('参数错误');
		import('Org.ThinkSDK.ThinkOauth');
		$sns = ThinkOauth::getInstance($type);
	
		//腾讯微博需传递的额外参数
		$extend = null;
		if ($type == 'tencent') {
			$extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
		}
		$tokenArr = $sns->getAccessToken($code, $extend);
		$openid = $tokenArr['openid'];
		$token = $tokenArr['access_token'];
		setSessionCookie("openid", $openid);
		setSessionCookie("access_token", $token);
		// $con = "openid:".$openid."\n"."token:".$token;
		// file_put_contents("1.txt", $con);
		//  获取当前登录用户信息
		if ($openid) {
			$field = strtolower($type);
			setSessionCookie("field", $field);
			$userinfo = M("User")->field('userid,username,email')->where("" . $field . "= '" . $openid . "'")->find();
			if ($userinfo) { //若是有该账号就登录
				$user = array('userid' => $userinfo['userid'], 'username' => $userinfo['username'], 'email' => $userinfo['email'], 'logintime' => NOW_TIME);
				setSessionCookie("admin_user", $user);
				$this->success("登录成功！", '/');
			} else { //没有的话绑定
				$userid = getSessionCookie('admin_user.userid');
				$username = getSessionCookie('admin_user.username');
				if ($userid != '' && $username != '') { //用户已登录，自动绑定
					//绑定账号
					M('user')->where("userid = " . $userid . "")->save(array($field => $openid));
					emptySessionCookie('type');
					emptySessionCookie('openid');
					$this->success("绑定成功！", "/");
				} else { //用户未登录，跳转到绑定页面
					if ($filed == 'qq') { //针对新版qq互联在绑定页，要显示昵称，否则不通过***
						$data = $sns->call('user/get_user_info');
						$nickname = $data['nickname'];
					} else {
						$userinfo = A('Type', 'Event')->$type($tokenArr);
						$nickname = $userinfo['name'];
					}
					setSessionCookie('nickname', $nickname);
					$this->redirect("Index/bind");
				}
			}
		} else {
			echo "<script>alert('系统出错;请稍后再试！');document.location.href='" . __APP__ . "';</script>";
		}
	}
}
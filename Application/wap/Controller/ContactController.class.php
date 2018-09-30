<?php
namespace wap\Controller;
use Think\Controller;
class ContactController extends PublicController
{
	public function index()
    {
		$sortid = 7;
		$model = get_catname($sortid,'ismodel');
		$sortid_all = catid_str($sortid,$model);
		$catid = I('get.catid', 0, 'intval');
        if (!$catid && countnum($sortid) != 0) {
            $catid = get_minid($sortid,$model);
        } elseif (countnum($sortid) == 0) {
			$catid = $sortid;
		}
		$model = get_catname($catid,'ismodel');
        $cate_db = M('Category');
		if (countnum($sortid) != 0) {
			$r = $cate_db->where('catid = '.$catid.' and pid in ('.$sortid_all.') and ismodel = '.$model.' and ishidden = 0')->find();
		} elseif (countnum($sortid) == 0) {
			$r = $cate_db->where('catid = '.$catid.' and ismodel = '.$model.' and ishidden = 0')->find();
		}
        if (!$r) {
            $this->error('参数错误');
        }
		$innerlink=M("Innerlink")->where(array('status' => array('eq', 1)))->select();
		foreach($innerlink as $link){
             $r['content']=str_replace($link['title'],"<a href={$link['url']} title={$link['hint']}>{$link['title']}</a>",$r['content']);
		}
		$this->assign('config', $r);
		$this->assign('cate', new_html_entity_decode($r));
		$this->display($this->template . 'contact/index');
    }
	public  function insert(){
		if (IS_POST) {
			$data = I('post.');
			$verify = new \Think\Verify();
			if (!$verify->check($data['code'])) {
				$this->error('验证码错误');
			}
			if ($data['name'] == "") {
				$this->error('姓名不能为空');
			}
			if ($data['qq'] == "") {
				$this->error('微信不能为空');
			}
			$email = $_POST['email'];
			if ($email != "") {
				if (!preg_match("/^[\\w\\-\\.]+@[\\w\\-\\.]+(\\.\\w+)+\$/", $email)) {
					$this->error('邮箱格式不正确');
				}
			}
			if (!preg_match('/^1([0-9]{10})$/', $data['telephone'])) {
				$this->error('手机号码格式不正确');
			}
			if ($data['title'] == "") {
				$this->error('标题不能为空');
			}
			$data['action_ip'] = ip2long(get_client_ip());
			$data['city'] = taobaoIP(ip2long(get_client_ip()));
			$data['title'] = strip_tags($data['title']);
			$data['addtime'] = NOW_TIME;
			if ($data['content'] == "") {
				$this->error('内容不能为空');
			}
			$id = M('Guestbook')->add($data);
			if ($id > 0) {
				$this->success('留言成功');
			}
		} 
	}
	
	public  function feedb(){
		if (IS_POST) {
			$data = I('post.');
			if (time() - session("comment_time") < 60 && session("comment_time") > 0) {//2分钟以后发布
				$this->error('留言提交的速度太快了');
			}
			if ($data['name'] == "") {
				$this->error('姓名不能为空');
			}
			if ($data['qq'] == "") {
				$this->error('微信不能为空');
			}
			if (!preg_match('/^1([0-9]{10})$/', $data['telephone'])) {
				$this->error('手机号码格式不正确');
			}
			if ($data['title'] == "") {
				$this->error('标题不能为空');
			}
			$data['action_ip'] = ip2long(get_client_ip());
			$data['city'] = taobaoIP(long2ip($data['action_ip']));
			$data['title'] = strip_tags($data['title']);
			$data['addtime'] = NOW_TIME;
			if ($data['content'] == "") {
				$this->error('内容不能为空');
			}
			$id = M('Guestbook')->add($data);
			if ($id > 0) {
				session("comment_time", time());
				$this->success('留言成功');
			}
		} 
	}
}
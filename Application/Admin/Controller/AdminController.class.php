<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends PublicController
{
    public function index()
    {
		$Admin = M('admin');
		$count = $Admin->count();
        $p = getpage($count,20);
        $list = $Admin->order('adminid desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $p->show());
        $this->display();
    }
    public function add()
    {
		$Auth = M('Auth');
		$list = $Auth->where(array('id' => array('neq', 1),'status' => array('eq', 1)))->order('id asc')->select();
		$this->assign('list', $list);
        $this->display();
    }
    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$authority = I('post.authority', 0, 'intval');
			$username = I('post.username');
			$password = I('post.password');
			if (!$authority) {
				$this->error(L('auth_select'));
			}
			if (is_username($username) == false) {
				$this->error(L('is_username'));
			}	
			if (is_user($username) == false) {
				$this->error(L('is_user'));
			}		
			if (is_password($password) == false) {
				$this->error(L('pass_char'));
			}
			if($password != $data['password_n']){
				$this->error(L('pass_incon'));
			}
			$email = I('post.email');
            if (is_email($email) == false) {
                $this->error(L('email_error'));
            }
			$data['encrypt'] = create_randomstr();
			$data['password'] = md5(md5(trim($password)).$data['encrypt']);
			$data['inputtime'] = NOW_TIME;
			$id = M('Admin')->add($data);
			if ($id > 0) {
				$this->success(L('add_success'), U('Admin/index'));
			} else {
				$this->error(L('add_error'));
			}
        }
    }
    public function delete()
    {
        $adminid = I('get.adminid', 0, 'intval');
        if (!$adminid) {
            $this->error(L('para_error'));
        }
		if(get_admin_auth($adminid,'authority') == 1){
            $this->error(L('not_error'));
        }
        if (M('admin')->where(array('adminid' => $adminid))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	public function status()
    {
		$adminid = I('get.adminid', 0, 'intval');
		$status = intval(I('status'));
        $status = $status ? 0 : 1;
		if(get_admin_auth($adminid,'authority') == 1){
            $this->error(L('not_error'));
        }
       if (M('Admin')->where(array('adminid'=>$adminid))->save(array('status' => $status))) {
            $this->success(L('oper_success'));
        } else {
            $this->error(L('oper_error'));
        }
    }
	
    public function edit()
    {
        $adminid = I('get.adminid', 0, 'intval');
        if (!$adminid) {
            $this->error(L('para_error'));
        }
		if(get_admin_auth($adminid,'authority') == 1){
            $this->error(L('not_error'));
        }
        $detail = M('Admin')->where(array('adminid' => $adminid))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
		$Auth = M('Auth');
		$list = $Auth->where(array('id' => array('neq', 1),'status' => array('eq', 1)))->order('id asc')->select();
        $this->assign('detail', $detail);
        $this->assign('list', $list);
        $this->display();
    }
    public function update()
    {
        if (IS_POST) {
            $data = I('post.');
            if (!$data['adminid']) {
                return false;
            }
			$authority = I('post.authority', 0, 'intval');
			$nickname = I('post.nickname');
			$password = I('post.password');
			if (!$authority) {
				$this->error(L('auth_select'));
			}
			$email = I('post.email');
            if (is_email($email) == false) {
                $this->error(L('email_error'));
            }
			if($password != ''){
				if (is_password($password) == false) {
					$this->error(L('pass_char'));
				}
				if($password != $data['password_n']){
					$this->error(L('pass_incon'));
				}
				$data['encrypt'] = create_randomstr();
				$data['password'] = md5(md5(trim($password)).$data['encrypt']);
				$result = M('Admin')->where(array('adminid' => $data['adminid']))->save($data);
			}else{
				$result = M('Admin')->where(array('adminid' => $data['adminid']))->save(array('nickname' => $nickname ,'authority' => $authority,'email' => $email));
			}
            if ($result !== false) {
                $this->success(L('edit_success'), U('Admin/index'));
            } else {
                $this->error(L('edit_error'));
            }
        }
    }
	public function auth_list()
    {
		$Admin = M('Auth');
		$count = $Admin->count();
        $p = getpage($count,20);
        $list = $Admin->order('id asc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $p->show());
        $this->display();
    }
	public function auth_delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id || $id == 1) {
            $this->error(L('para_error'));
        }
        if (M('Auth')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	public function auth_add()
    {
		$menu_db = M("Menu");
        $menu = $menu_db->where("pid = 0 and status=1")->order('sort desc,id asc')->select();
        $this ->assign("menu",$menu);
        $this->display();
    }
	public function auth_insert()
    {
		if (IS_POST) {
			$data = I('post.');
			$menuIdArr = I('post.menuIdArr');
			$title = I('post.title');
			if (!$title) {
				$this->error(L('auth_enter'));
			}
			$data['inputtime'] = NOW_TIME;
            if($menuIdArr){
                $data['menu_id'] = implode(',',$menuIdArr);
            }
			$id = M('Auth')->add($data);
            if ($id > 0) {
                $this->success(L('add_success'), U('Admin/auth_list'));
            } else {
                $this->error(L('add_error'));
            }
		}
	}
	public function auth_edit()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id/*|| $id == 1*/) {
            $this->error(L('para_error'));
        }
        $detail = M('Auth')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
		$menu = M("Menu")->where("pid = 0 and status=1")->order('sort desc,id asc')->select();
		if($detail['menu_id']){
				//分割成数组
			$menuIdArr = explode(',',$detail['menu_id']);
		}
        $this->assign('detail', $detail);
		$this->assign('menuIdArr',$menuIdArr);
        $this ->assign("menu",$menu);
        $this->display();
    }
    public function auth_update()
    {
        if (IS_POST) {
            $data = I('post.');
			$menuIdArr = I('post.menuIdArr');
            if (!$data['id']/*|| $data['id'] == 1*/) {
                return false;
            }
			$title = I('post.title');
			if (!$title) {
				$this->error(L('auth_enter'));
			}
			if($menuIdArr){
                $data['menu_id'] = implode(',',$menuIdArr);
            }
			$data['inputtime'] = NOW_TIME;
			$result = M('Auth')->where(array('id' => $data['id']))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Admin/auth_list'));
            } else {
                $this->error(L('edit_error'));
            }
        }
    }
}
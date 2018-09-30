<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends PublicController
{
	public function index()
	{
		$q = I('get.q');
        if (!empty($q)) {
            $where['username'] = array('like', '%' . $q . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        $user = M('User');
        $count = $user->where($map)->count();
        $p = getpage($count, 12);
        $user_list = $user->where($map)->order('userid desc')->limit($p->firstRow, $p->listRows)->select();
        foreach ($user_list as $k => $v) {
            $user_list[$k]['username'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['username']);
        }
        $this->assign('q', $q);
        $this->assign('user_list', $user_list);
        // 赋值数据集
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
	}
	
	//会员锁定
	public function status()
    {
		$userid = I('get.userid', 0, 'intval');
		$islock = intval(I('islock'));
        $islock = $islock ? 0 : 1;
       if (M('User')->where(array('userid'=>$userid))->save(array('islock' => $islock))) {
            $this->success(L('oper_success'));
        } else {
            $this->error(L('oper_error'));
        }
    }
	//删除
	public function delete(){
		$userid = I('get.userid', 0, 'intval');
		if (!$userid) {
            $this->error(L('para_error'));
        }
		if (M('User')->where(array('userid'=>$userid))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
	}
	//修改
	public function edit(){
		$userid = I('get.userid', 0, 'intval');
		if (!$userid){
			$this->error(L('para_error'));
		}
		$detail = M('User')->where(array('userid' => $userid))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
		$this->assign('detail', $detail);
		$this->display();
	}
	public function update()
	{
		if (IS_POST){
			$data = I('post.');
			if (!$data['userid']){
                return false;
            }
			$data['point'] = intval($data['point']);
			$result = M('User')->where(array('userid' => $data['userid']))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('User/index'));
            } else {
                $this->error(L('edit_error'));
            }
		}
	}
}
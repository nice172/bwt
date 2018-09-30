<?php
namespace Admin\Controller;
use Think\Controller;
class HaviorController extends PublicController
{
    public function index()
    {
		$Havior = M('action');
		$count = $Havior->count();
        $p = getpage($count,20);
        $list = $Havior->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $p->show());
        $this->display();
    }
	public function status()
    {
		$id = I('get.id', 0, 'intval');
		$status = intval(I('status'));
        $status = $status ? 0 : 1;
       if (M('action')->where(array('id'=>$id))->save(array('status' => $status))) {
            $this->success(L('oper_success'));
        } else {
            $this->error(L('oper_error'));
        }
    }
	public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('action')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
    public function add()
	{
		$this->display();
	}
    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$name = I('post.name');
			if ($name == '') {
				$this->error('请输入行为标识');
			}
			$data['updatetime'] = NOW_TIME;
			$id = M('Action')->add($data);
			if ($id > 0) {
				if (isset($data['submit'])) {
					$this->success(L('add_success'), U('Havior/index'));
				}
				if (isset($data['submit_continue'])) {
					$this->success(L('add_success'));
				}
			} else {
				$this->error(L('add_error'));
			}
        }
    }
    public function edit()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $detail = M('action')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $this->assign('detail', $detail);
        $this->display();
    }
    public function update()
    {
        if (IS_POST) {
            $data = I('post.');
            if (!$data['id']) {
                return false;
            }
			$name = I('post.name');
			if ($name == '') {
				$this->error('请输入行为标识');
			}
            $data['updatetime'] = NOW_TIME;
            $result = M('Action')->where(array('id' => $data['id']))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Havior/index'));
            } else {
                $this->error(L('edit_error'));
            }
        }
    }
}
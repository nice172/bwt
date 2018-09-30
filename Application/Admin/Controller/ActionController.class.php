<?php
namespace Admin\Controller;
use Think\Controller;
class ActionController extends PublicController
{
    public function index()
    {
		$Action = M('action_log');
		$count = $Action->count();
        $p = getpage($count,20);
        $list = $Action->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $p->show());
        $this->display();
    }

	public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('action_log')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
	public function del()
    {
		$ids=M('action_log');
		$sql = 'TRUNCATE `xg_action_log`';
		$row=$ids->execute($sql);
		if ($row !== false) {
			$this->success(L('empty_success'));
		} else {
			$this->error(L('empty_error'));
		}
    }
    public function view()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $detail = M('action_log')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $this->assign('detail', $detail);
        $this->display();
    }
}
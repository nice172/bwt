<?php
namespace Admin\Controller;
use Think\Controller;
class SocialController extends PublicController
{
	public function index()
    {
		$Social = M('Social');
		$count = $Social->count();
        $p = getpage($count,20);
        $list = $Social->order('sort desc,id asc')->limit($p->firstRow, $p->listRows)->select();
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
        if (M('Social')->where(array('id' => $id))->delete()) {
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
			$title = I('post.title');
			if (!$title) {
				$this->error('请输入名称');
			}
			if (M('Social')->where(array('title' => $title))->find()){
				$this->error('该名称已存在');
			}
			$data['inputtime'] = NOW_TIME;
			$id = M('Social')->add($data);
            if ($id > 0) {
                $this->success(L('edit_success'), U('Social/index'));
            } else {
                $this->error(L('edit_error'));
            }
		}
	}
	public function edit()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $detail = M('Social')->where(array('id' => $id))->find();
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
			$title = I('post.title');
			if (!$title) {
				$this->error('请输入名称');
			}
			if (M('Social')->where(array('id' => array('neq', $data['id']), 'title' => $title))->find()){
				$this->error('该名称已存在');
			}
			$result = M('Social')->where(array('id' => $data['id']))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Social/index'));
            } else {
                $this->error(L('edit_error'));
            }
        }
    }
	public function sortBatch()
    {
        if (IS_POST) {
            $sort_order = I('post.sort');
            foreach ($sort_order as $key => $val) {
                M('Social')->where(array('id' => $key))->save(array('sort' => $val));
            }
            $this->success(L('sort_success'));
        }
    }
}
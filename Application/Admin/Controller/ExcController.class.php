<?php
namespace Admin\Controller;
use Think\Controller;
class ExcController extends PublicController
{
    public function index()
    {
        $link = M('Innerlink');
        $count = $link->count();
        $p = getpage($count,12);
        $list = $link->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list);
        // 赋值数据集
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
    }
    public function add()
    {
        $this->display();
    }
    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$data = $this->data_check($data, 'add');
            $id = M('Innerlink')->add($data);
            if ($id > 0) {
                $this->success(L('add_success'), U('Exc/index'));
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
        $detail = M('Innerlink')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $this->assign('detail', $detail);
        $this->display();
    }
    public function update()
    {
        if (IS_POST) {
            $id = I('post.id', 0, 'intval');
            if (!$id) {
                return false;
            }
            $data = I('post.');
			$data = $this->data_check($data, 'edit');
            $result = M('Innerlink')->where(array('id' => $id))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Exc/index'));
            } else {
                $this->erroe(L('edit_error'));
            }
        }
    }
	
    public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Innerlink')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'), U('Exc/index'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
	public function status()
    {
		$id = I('get.id', 0, 'intval');
		$status = intval(I('status'));
        $status = $status ? 0 : 1;
       if (M('Innerlink')->where(array('id'=>$id))->save(array('status' => $status))) {
            $this->success(L('oper_success'));
        } else {
            $this->error(L('oper_error'));
        }
    }
	
	public function data_check($data, $action = 'add')
	{
		$title = I('post.title');
		if ($title == '') {
			$this->error('请输入关键字标题');	
		}
		$url = I('post.url');
		$reg = '/\\b((?#protocol)https?|ftp):\\/\\/((?#domain)[-A-Z0-9.]+)((?#file)\\/[-A-Z0-9+&@#\\/%=~_|!:,.;]*)?((?#parameters)\\?[A-Z0-9+&@#\\/%=~_|!:,.;]*)?/i';
		if (!preg_match($reg, $url)) {
			$this->error(L('url_error'));
		}
		if ($action == 'add') {
			$data['inputtime'] = NOW_TIME;
		}
		return $data;
	}
}
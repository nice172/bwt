<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends PublicController
{
    public function index()
    {
        $link = M('Banner');
        $count = $link->count();
        $p = getpage($count,12);
        $list = $link->order('sort desc,id desc')->limit($p->firstRow, $p->listRows)->select();
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
            $id = M('Banner')->add($data);
            if ($id > 0) {
                $this->success(L('add_success'), U('Banner/index'));
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
        $detail = M('Banner')->where(array('id' => $id))->find();
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
            $result = M('Banner')->where(array('id' => $id))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Banner/index'));
            } else {
                $this->erroe(L('edit_error'));
            }
        }
    }
    public function listorder()
    {
        if (IS_POST) {
            $sort = I('post.sort');
            foreach ($sort as $key => $val) {
                M('Banner')->where(array('id' => $key))->save(array('sort' => intval($val)));
            }
            $this->success(L('sort_success'));
        }
    }
	
    public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Banner')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'), U('Banner/index'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
	public function data_check($data, $action = 'add')
	{
		$name = I('post.name');
		if ($name == '') {
			$this->error('请输入幻灯片名称');	
		}
		$url = I('post.url');
		$reg = '/\\b((?#protocol)https?|ftp):\\/\\/((?#domain)[-A-Z0-9.]+)((?#file)\\/[-A-Z0-9+&@#\\/%=~_|!:,.;]*)?((?#parameters)\\?[A-Z0-9+&@#\\/%=~_|!:,.;]*)?/i';
		if (!preg_match($reg, $url)) {
			$this->error(L('url_error'));
		}
		$data['info'] = htmlspecialchars_decode(safe_replace($data['info']));
		if ($action == 'add') {
			$data['inputtime'] = NOW_TIME;
		}
		return $data;
	}
}
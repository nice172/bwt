<?php
namespace Admin\Controller;
use Think\Controller;
class FlinkController extends PublicController
{
    public function index()
    {
        $link = M('Flink');
        $count = $link->count();
        $p = getpage($count,12);
        $list = $link->order('sort desc,linkid desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list);
        // 赋值数据集
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
    }
    public function add()
    {
		$cate = M('category');
		$cate_list = $cate->where(array('ismodel' => 6, 'ispart' => array('neq', 1)))->order('sort desc')->select();
		$this->assign('cate_list', $cate_list);
        $this->display();
    }
    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$data = $this->data_check($data, 'add');
            $linkid = M('Flink')->add($data);
            if ($linkid > 0) {
                $this->success(L('add_success'), U('Flink/index'));
            } else {
                $this->error(L('add_error'));
            }
        }
    }
    public function edit()
    {
        $linkid = I('get.linkid', 0, 'intval');
        if (!$linkid) {
            $this->error(L('para_error'));
        }
        $detail = M('Flink')->where(array('linkid' => $linkid))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
		$cate = M('category');
		$cate_list = $cate->where(array('ismodel' => 6, 'ispart' => array('neq', 1)))->order('sort desc')->select();
		$this->assign('cate_list', $cate_list);
        $this->assign('detail', $detail);
        $this->display();
    }
    public function update()
    {
        if (IS_POST) {
            $linkid = I('post.linkid', 0, 'intval');
            if (!$linkid) {
                return false;
            }
            $data = I('post.');
			$data = $this->data_check($data, 'edit');
            $result = M('Flink')->where(array('linkid' => $linkid))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Flink/index'));
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
                M('Flink')->where(array('linkid' => $key))->save(array('sort' => intval($val)));
            }
            $this->success(L('sort_success'));
        }
    }
    public function delete()
    {
        $linkid = I('get.linkid', 0, 'intval');
        if (!$linkid) {
            $this->error(L('para_error'));
        }
        if (M('Flink')->where(array('linkid' => $linkid))->delete()) {
            $this->success(L('delete_success'), U('Flink/index'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
	public function data_check($data, $action = 'add')
	{
		$name = I('post.name');
		if ($name == '') {
			$this->error('请输入链接名称');	
		}
		$url = I('post.url');
		$reg = '/\\b((?#protocol)https?|ftp):\\/\\/((?#domain)[-A-Z0-9.]+)((?#file)\\/[-A-Z0-9+&@#\\/%=~_|!:,.;]*)?((?#parameters)\\?[A-Z0-9+&@#\\/%=~_|!:,.;]*)?/i';
		if (!preg_match($reg, $url)) {
			$this->error(L('url_error'));
		}
		return $data;
	}
}
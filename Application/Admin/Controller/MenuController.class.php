<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends PublicController
{

	protected function _tree($arr, $pid = 0, $level = 0)
    {
        static $tree = array();
        foreach ($arr as $v) {
            if ($v['pid'] == $pid) {
                //$v['level'] = str_repeat('├', $level);
                $v['level'] = $level;
                $tree[] = $v;
                $this->_tree($arr, $v['id'], $level + 1);
            }
        }
        return $tree;
    }
    public function index()
    {
        $list = $this->listMenu();
        $this->assign('list', $list);
        $this->display();
    }
    public function add()
    {
        $cate = M('Menu');
        $list = $cate->where(array('pid' => 0, 'status' => array('eq' , 1)))->order('sort desc,id asc')->select();
        $this->assign('list', $list);
        $this->display();
    }


    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$data = $this->data_check($data, 'add');
            $cate = M('Menu');
            $id = $cate->add($data);
            if ($id > 0) {
				action_log('add_menu', 'Menu', $id, $adminid);
                $this->success(L('add_success'), U('Menu/index'));
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
        $cate = M('Menu');
        $list = $cate->where(array('pid' => 0, 'status' => array('eq' , 1)))->order('sort desc,id asc')->select();
        $detail = M('Menu')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $this->assign('list', $list);
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
            $sub_cates = $this->listMenu($id);
            $sub_ids = array();
            foreach ($sub_cates as $v) {
                $sub_ids[] = $v['id'];
            }
            $pid = I('post.pid', 0, 'intval');
            if ($pid == $id || in_array($pid, $sub_ids)) {
                $this->error('不能放置到当前栏目或其子栏目');
            }
            $data = I('post.');
			$data = $this->data_check($data, 'edit');
            $result = M('Menu')->where(array('id' => $id))->save($data);
            if ($result !== false) {
				action_log('update_menu', 'Menu', $id, $adminid);
                $this->success(L('edit_success'), U('Menu/index'));
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
                M('Menu')->where(array('id' => $key))->save(array('sort' => intval($val)));
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
        $sub_cates = $this->listCate($id);
        if (empty($sub_cates)) {
            $cate = M('Menu');
            if ($cate->where(array('id' => $id))->delete()) {
                $this->success(L('delete_success'), U('Menu/index'));
            } else {
                $this->error(L('delete_error'));
            }
        } else {
            $this->error('该栏目下面还包含其他栏目');
        }
    }
	
	/*添加信息,修改信息共用*/
	private function data_check($data, $action = 'add')
	{
		$name = I('post.name');
		if ($name == '') {
			$this->error(L('column_enter'));	
		}
		return $data;
	}
}
<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends PublicController
{
    public function index()
    {
        $list = $this->listCate();
        $this->assign('list', $list);
        $this->display();
    }
    public function add()
    {
        $list = $this->listCate();
        $this->assign('list', $list);
        $this->display();
    }
    public function addBatch()
    {
        $list = $this->listCate();
        $this->assign('list', $list);
        $this->display();
    }
    public function checkCatnameUnique()
    {
        $catname = $_POST['param'];
        if (!is_username($catname)) {
            $this->ajaxReturn(array('info' => '格式不正确', 'status' => 'n'));
        }
        if (M('Category')->where(array('catname' => $catname))->find()) {
            $this->ajaxReturn(array('info' => '栏目已存在', 'status' => 'n'));
        }
        $this->ajaxReturn(array('info' => '输入正确', 'status' => 'y'));
    }
    public function checkHtml()
    {
        $html = $_POST['param'];
        if (preg_match('/^(.+).html$/', $html)) {
            $this->ajaxReturn(array('info' => '输入正确', 'status' => 'y'));
        } else {
            $this->ajaxReturn(array('info' => '格式不正确', 'status' => 'n'));
        }
    }
    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$data = $this->data_check($data, 'add');
            $cate = M('category');
            $catid = $cate->add($data);
            if ($catid > 0) {
				action_log('add_menu', 'category', $catid, $adminid);
                $this->success(L('add_success'), U('Category/index'));
            } else {
                $this->error(L('add_error'));
            }
        }
    }
    public function insertBatch()
    {
        if (IS_POST) {
            $data = I('post.');
            $cate = M("category");
			$catname = I('post.catname');
			if ($catname == '') {
				$this->error(L('column_enter'));	
			}
			$data['content'] = htmlspecialchars_decode($data['editorValue']);
            if (strpos($data['catname'], "\n") === false) {
                $catid = $cate->add($data);
				action_log('add_menu', 'category', $catid, $adminid);
                $this->success(L('add_success'), U('Category/index'));
            } else {
                $cat_arr = explode("\n", $data['catname']);
                foreach ($cat_arr as $key => $val) {
                    $val = trim($val);
                    if (!$val) {
                        continue;
                    }
                    $data['catname'] = $val;
                    $catid = $cate->add($data);
                }
				action_log('add_menu', 'category', $catid, $adminid);
                $this->success(L('add_success'), U('Category/index'));
            }
        }
    }
    public function edit()
    {
        $catid = I('get.catid', 0, 'intval');
        if (!$catid) {
            $this->error(L('para_error'));
        }
        $list = $this->listCate();
        $detail = M('Category')->where(array('catid' => $catid))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
		$gallery = string2array($detail['gallery']);
        $this->assign('list', $list);
		$this->assign('gallery', $gallery);
        $this->assign('detail', $detail);
        $this->display();
    }
    public function update()
    {
        if (IS_POST) {
            $catid = I('post.catid', 0, 'intval');
            if (!$catid) {
                return false;
            }
            $sub_cates = $this->listCate($catid);
            $sub_ids = array();
            foreach ($sub_cates as $v) {
                $sub_ids[] = $v['catid'];
            }
            $pid = I('post.pid', 0, 'intval');
            if ($pid == $catid || in_array($pid, $sub_ids)) {
                $this->error('不能放置到当前栏目或其子栏目');
            }
            $data = I('post.');
			$data = $this->data_check($data, 'edit');
            $result = M('Category')->where(array('catid' => $catid))->save($data);
            if ($result !== false) {
				action_log('update_menu', 'category', $catid, $adminid);
                $this->success(L('edit_success'), U('Category/index'));
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
                M('Category')->where(array('catid' => $key))->save(array('sort' => intval($val)));
            }
            $this->success(L('sort_success'));
        }
    }
    public function delete()
    {
        $catid = I('get.catid', 0, 'intval');
        if (!$catid) {
            $this->error(L('para_error'));
        }
        $sub_cates = $this->listCate($catid);
        if (empty($sub_cates)) {
            $cate = M('Category');
            if ($cate->where(array('catid' => $catid))->delete()) {
                $this->success(L('delete_success'), U('Category/index'));
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
		$catname = I('post.catname');
		if ($catname == '') {
			$this->error(L('column_enter'));	
		}
		if (!empty($_POST['editorValue'])) {
			$data['content'] = auto_save_image($_POST['editorValue']);
		}
		$data['info'] = htmlspecialchars_decode(safe_replace($data['info']));
		$data['content'] = htmlspecialchars_decode($data['editorValue']);
		if ($_POST['pdescription'] == '' && !empty($_POST['editorValue'])) {
			$data['pdescription'] = str_cut(str_replace(array('\\r\\n', '\\t'), '', strip_tags($data['content'])), 300);
		}
		$data['gallery'] = array2string($data['gallery']);
		return $data;
	}
}
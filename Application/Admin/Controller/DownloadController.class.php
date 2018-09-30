<?php
namespace Admin\Controller;
use Think\Controller;
class DownloadController extends PublicController
{
    public function index()
    {
        $q = I('get.q');
        $catid = I('get.catid');
        if (!empty($q)) {
            $where['title'] = array('like', '%' . $q . '%');
            $where['info'] = array('like', '%' . $q . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        if ($catid && is_numeric($catid)) {
            $map['catid'] = $catid;
        }
        $map['status'] = 1;
        $article = M('Download');
        $count = $article->where($map)->count();
        $p = getpage($count, 12);
        $Download_list = $article->where($map)->order('sort desc,id desc')->limit($p->firstRow, $p->listRows)->select();
        foreach ($Download_list as $k => $v) {
            $Download_list[$k]['title'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['title']);
            $Download_list[$k]['info'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['field']);
        }
        $cate_list = $this->listCate();
        $this->assign('q', $q);
        $this->assign('cate_list', $cate_list);
        $this->assign('Download_list', $Download_list);
        // 赋值数据集
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
    }
    public function add()
    {
		$cate_list = $this->listCate();
		$this->assign('cate_list', $cate_list);
        $this->display();
    }
    public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$data = $this->data_check($data, 'add');
			$id = M('Download')->add($data);
			if ($id > 0) {
				if (isset($data['submit'])) {
					$this->success(L('add_success'), U('Download/index'));
				}
				if (isset($data['submit_continue'])) {
					$this->success(L('add_success'));
				}
			} else {
				$this->error(L('add_error'));
			}
        }
    }
    public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Download')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
    public function edit()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $detail = M('Download')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $cate_list = $this->listCate();
        $this->assign('detail', $detail);
        $this->assign('cate_list', $cate_list);
        $this->display();
    }
    public function update()
    {
        if (IS_POST) {
            $data = I('post.');
            if (!$data['id']) {
                return false;
            }
			$data = $this->data_check($data, 'edit');
            $result = M('Download')->where(array('id' => $data['id']))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Download/index'));
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
                M('Download')->where(array('id' => $key))->save(array('sort' => $val));
            }
            $this->success(L('sort_success'));
        }
    }
	
	public function status()
    {
		$id = I('get.id', 0, 'intval');
		$status = intval(I('status'));
        $status = $status ? 0 : 1;
       if (M('Download')->where(array('id'=>$id))->save(array('status' => $status, 'updatetime' => NOW_TIME))) {
            $this->success(L('oper_success'));
        } else {
            $this->error(L('oper_error'));
        }
    }
	
	public function recycle(){
        $article = M('Download');
        $count = $article->where(array('status' => array('eq' , 0)))->count();
        $p = getpage($count, 12);
        $article_list = $article->where(array('status' => array('eq' , 0)))->order('sort desc, id desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('article_list', $article_list);
        // 赋值数据集
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
    }
	
	public function clear(){
        $res = M('Download')->where(array('status' => array('eq' , 0)))->delete();
        if($res !== false){
            $this->success(L('empty_success'));
        }else{
            $this->error(L('empty_error'));
        }
    }
	
    /*添加信息,修改信息共用*/
	private function data_check($data, $action = 'add')
    {
        $catid = I('post.catid', 0, 'intval');
		if (!$catid) {
			$this->error(L('column_error'));
		}
		$title = I('post.title');
		if ($title == '') {
			$this->error(L('article_title'));
		}
		if (!empty($_POST['editorValue'])) {
			$data['content'] = auto_save_image($_POST['editorValue']);
		}
		$data['content'] = htmlspecialchars_decode($_POST['editorValue']);
		if ($action == 'add') {
			if (empty($data['thumb']) && !empty($_POST['editorValue'])) {
				if (preg_match_all("/(src)=([\"|']?)([^ \"'>]+\\.(gif|jpg|jpeg|bmp|png))\\2/i", $data['content'], $matches)) {
					$data['thumb'] = $matches[3][0];
				}
			}  //判断是否上传图片，如果没有上传，则从内容抓取图片
		}
		if ($_POST['pdescription'] == '' && !empty($_POST['editorValue'])) {
			$data['pdescription'] = str_cut(str_replace(array('\\r\\n', '\\t'), '', strip_tags($data['content'])), 300);
		}
		if ($_POST['info'] == '' && !empty($_POST['editorValue'])) {
			$data['info'] = str_cut(str_replace(array('\\r\\n', '\\t'), '', strip_tags($data['content'])), 200);
		} //判断是否资料，如果没有上传，则从详情内容抓取字符
		$data['info'] = htmlspecialchars_decode(safe_replace($data['info']));
		$data['username'] = session('admin_auth.username');
		/*添加信息时间，修改信息时间*/
		if ($action == 'add') {
			if ($_POST['inputtime'] == '') {
				$data['inputtime'] = $data['updatetime'] = NOW_TIME;
			} else {
				$data['inputtime'] = $data['updatetime'] = strtotime($_POST['inputtime']);
			}
		} else {
			$data['updatetime'] = NOW_TIME;
			if ($_POST['inputtime'] == '') {
				$data['inputtime'] = NOW_TIME;
			} else {
				$data['inputtime'] = strtotime($_POST['inputtime']);
			}
		}
        return $data;
    }
}
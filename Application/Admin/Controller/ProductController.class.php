<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends PublicController
{
    public function index(){
        $q = I('get.q');
        $catid = I('get.catid');
        $status = I('get.status');
        if (!empty($q)) {
            $where['title'] = array('like', '%' . $q . '%');
            $where['info'] = array('like', '%' . $q . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        if ($catid && is_int($catid)) {
            $map['catid'] = $catid;
        }
        if (is_int($status)) {
            $map['status'] = $status;
        }
        $article = M('Product');
        $count = $article->where($map)->count();
        $p = getpage($count, 12);
        $article_list = $article->where($map)->order('sort desc,id desc')->limit($p->firstRow, $p->listRows)->select();
        foreach ($article_list as $k => $v) {
            $article_list[$k]['title'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['title']);
            $article_list[$k]['info'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['field']);
        }
        $cate_list = $this->listCate();
        $this->assign('q', $q);
        $this->assign('cate_list', $cate_list);
        $this->assign('article_list', $article_list);
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
			$id = M('Product')->add($data);
			if ($id > 0) {
				if (isset($data['submit'])) {
					$this->success(L('add_success'), U('Product/index'));
				}
				if (isset($data['submit_continue'])) {
					$this->success(L('add_success'));
				}
			} else {
				$this->error(L('add_error'));
			}
        }
    }
    public function delete_case(){    	    	$id = I('get.id', 0, 'intval');    	    	if (!$id) {    		    		$this->error(L('para_error'));    		    	}    	    	if (M('Product_case')->where(array('id' => $id))->delete()) {    		    		$this->success(L('delete_success'));    		    	} else {    		    		$this->error(L('delete_error'));    		    	}    	    }
	//删除产品
	public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Product')->where(array('id' => $id))->delete()) {
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
        $detail = M('Product')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $gallery = string2array($detail['gallery']);        $gallery2 = string2array($detail['gallery2']);
        $cate_list = $this->listCate();
        $this->assign('detail', $detail);
        $this->assign('gallery', $gallery);        $this->assign('gallery2', $gallery2);
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
            $result = M('Product')->where(array('id' => $data['id']))->save($data);
            if ($result !== false) {
                $this->success(L('edit_success'), U('Product/index'));
            } else {
                $this->error(L('edit_error'));
            }
        }
    }
    public function apply(){    	$id = I('get.id',0,'intval');    	$q = I('get.q');    	    	$catid = I('get.catid');    	    	$status = I('get.status');    	    	if (!empty($q)) {    		    		$where['title'] = array('like', '%' . $q . '%');    		    		$where['info'] = array('like', '%' . $q . '%');    		    		$where['_logic'] = 'or';    		    		$map['_complex'] = $where;    		    	}    	    	if ($catid && is_int($catid)) {    		    		$map['catid'] = $catid;    		    	}    	    	if (is_int($status)) {    		    		$map['status'] = $status;    		    	}    	    	if ($id > 0){    		$map['goodsid'] = $id;    	}    	    	$article = M('product_case');    	    	$count = $article->where($map)->count();    	    	$p = getpage($count, 12);    	    	$article_list = $article->where($map)->order('sort desc,id desc')->limit($p->firstRow, $p->listRows)->select();    	    	foreach ($article_list as $k => $v) {    		$article_list[$k]['title'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['title']);    		$article_list[$k]['info'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['field']);    		$article_list[$k]['goods_name'] = M('product')->where(['id' => $v['goodsid']])->getField('title');    	}    	$this->assign('q', $q);    	$this->assign('lists', $article_list);    	$this->display();    }        public function add_case(){		if (IS_POST){			$data = [				'goodsid' => I('post.catid',0,'intval'),				'title' => I('post.title'),				'thumb' => I('post.thumb'),				'info' => I('post.info'),				'status' => I('post.status'),				'ptitle' => I('post.ptitle'),				'pkeywords' => I('post.pkeywords'),				'pdescription' => I('post.pdescription'),				'content' => I('post.editorValue'),				'inputtime' => NOW_TIME,				'updatetime' => NOW_TIME
			];			if ($data['goodsid'] <= 0) {			    $this->error('请选择所属产品');			}			if (M('product_case')->add($data)){				$this->success('添加成功',U('apply'));			}else{				$this->error('添加失败');			}		}else{			$goods_list = M('product')->field(['id','title'])->select();			$this->assign('goods_list',$goods_list);			$this->display();		}    }        public function edit_case(){    	if (IS_POST){    		$data = [    				'id' => I('post.id'),    		    'goodsid' => I('post.catid',0,'intval'),    				'title' => I('post.title'),    				'thumb' => I('post.thumb'),    				'info' => I('post.info'),    				'status' => I('post.status'),    				'ptitle' => I('post.ptitle'),    				'pkeywords' => I('post.pkeywords'),    				'pdescription' => I('post.pdescription'),    				'content' => I('post.editorValue'),    				'updatetime' => NOW_TIME    		];    		if ($data['goodsid'] <= 0) {    		    $this->error('请选择所属产品');    		}    		if (M('product_case')->save($data)){    			$this->success('编辑成功',U('apply'));    		}else{    			$this->error('编辑失败');    		}    	}else{    		$goods_list = M('product')->field(['id','title'])->select();    		$this->assign('goods_list',$goods_list);    		$detail = M('product_case')->where(['id' => $_GET['id']])->find();    		$detail['content'] = htmlspecialchars_decode(htmlspecialchars_decode($detail['content']));    		$this->assign('detail',$detail);    		$this->display();    	}    }
	//修改排序
	public function sortBatch()
    {
        if (IS_POST) {
            $sort_order = I('post.sort');
            foreach ($sort_order as $key => $val) {
                M('Product')->where(array('id' => $key))->save(array('sort' => $val));
            }
            $this->success(L('sort_success'));
        }
    }    public function sortBatchs(){    	    	if (IS_POST) {    		    		$sort_order = I('post.sort');    		    		foreach ($sort_order as $key => $val) {    			    			M('Product_case')->where(array('id' => $key))->save(array('sort' => $val));    			    		}    		    		$this->success(L('sort_success'));    		    	}    	    }
	
    /*添加信息,修改信息共用*/
	private function data_check($data, $action = 'add')
    {
        $catid = I('post.catid', 0, 'intval');
		if (!$catid) {
			$this->error(L('column_error'));
		}
		$title = I('post.title');
		if ($title == '') {
			$this->error('请输入产品名称');
		}
		if (!empty($_POST['info'])) {
			$data['info'] = auto_save_image($_POST['info']);
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
		if ($_POST['description'] == '' && !empty($_POST['editorValue'])) {
			$data['description'] = str_cut(str_replace(array('\\r\\n', '\\t'), '', strip_tags($data['content'])), 300);
		}
		if ($_POST['info'] == '' && !empty($_POST['editorValue'])) {
			$data['info'] = str_cut(str_replace(array('\\r\\n', '\\t'), '', strip_tags($data['content'])), 200);
		}
		$data['info'] = htmlspecialchars_decode(safe_replace($data['info']));
		//$data['order'] = htmlspecialchars_decode(safe_replace($data['order']));
   		if ($data['hotpro'] == '') {
			$data['hotpro'] = 0;
		} else {
			$data['hotpro'] = $_POST['hotpro'];
		}
		if ($data['compro'] == '') {
			$data['compro'] = 0;
		} else {
			$data['compro'] = $_POST['compro'];
		}
		$data['gallery'] = array2string($data['gallery']);		$data['gallery2'] = array2string($data['gallery2']);
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
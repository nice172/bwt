<?php
namespace Admin\Controller;
use Think\Controller;
class JobsController extends PublicController
{
	 public function index(){
		$q = I('get.q');
        $catid = I('get.catid');
        if (!empty($q)) {
            $where['title'] = array('like', '%' . $q . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        if ($catid && is_numeric($catid)) {
            $map['catid'] = $catid;
        }
        $map['status'] = 1;
        $article = M('Jobs');
        $count = $article->where($map)->count();
        $p = getpage($count, 12);
        $jobs_list = $article->where($map)->order('sort desc,id desc')->limit($p->firstRow, $p->listRows)->select();
        foreach ($jobs_list as $k => $v) {
            $jobs_list[$k]['title'] = str_replace($q, '<font color=red>' . $q . '</font>', $v['title']);
        }
        $cate_list = $this->listCate();
        $this->assign('q', $q);
        $this->assign('cate_list', $cate_list);
        $this->assign('jobs_list', $jobs_list);
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
			$id = M('Jobs')->add($data);
			if ($id > 0) {
				if (isset($data['submit'])) {
					action_log('add_Jobs', 'Jobs', $id, $adminid);
					$this->success(L('add_success'), U('Jobs/index'));
				}
				if (isset($data['submit_continue'])) {
					action_log('add_Jobs', 'Jobs', $id, $adminid);
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
        $detail = M('Jobs')->where(array('id' => $id))->find();
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
			$id = I('post.id', 0, 'intval');
            if (!$id) {
                return false;
            }
            $data = I('post.');
			$data = $this->data_check($data, 'edit');
            $result = M('Jobs')->where(array('id' => $id))->save($data);
            if ($result !== false) {
				action_log('update_jobs', 'Jobs', $id, $adminid);
                $this->success(L('edit_success'), U('Jobs/index'));
            } else {
                $this->error(L('edit_error'));
            }
        }
    }
	public function status()
    {
		$id = I('get.id', 0, 'intval');
		$status = intval(I('status'));
        $status = $status ? 0 : 1;
       if (M('Jobs')->where(array('id'=>$id))->save(array('status' => $status, 'updatetime' => NOW_TIME))) {
            $this->success(L('oper_success'));
        } else {
            $this->error(L('oper_error'));
        }
    }
	public function recycle(){
        $article = M('Jobs');
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
        $res = M('Jobs')->where(array('status' => array('eq' , 0)))->delete();
        if($res !== false){
            $this->success(L('empty_success'));
        }else{
            $this->error(L('empty_error'));
        }
    }
	public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Jobs')->where(array('id' => $id, 'status' => array('eq' , 0)))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	public function sortBatch()
    {
        if (IS_POST) {
            $sort_order = I('post.sort');
            foreach ($sort_order as $key => $val) {
                M('Jobs')->where(array('id' => $key))->save(array('sort' => $val));
            }
            $this->success(L('sort_success'));
        }
    }
	//简历
	public function jobjoin_index(){
		$jobsid = I('get.jobsid');
		$status = I('get.status');
		$jobs = M('jobjoin');
		if (($jobsid != "" && is_numeric($jobsid)) && ($status != "" && is_numeric($status))) {
			$map = 'jobsid = '.$jobsid.' and status = '.$status.'';
		} elseif ($jobsid != "" && is_numeric($jobsid)) {
			$map = 'jobsid = '.$jobsid.'';
			
		} elseif ($status != "" && is_numeric($status)) {
			$map = 'status = '.$status.'';
		}
        $count = $jobs->where($map)->count();
        $p = getpage($count, 12);
        $jobs_list = $jobs->where($map)->order('jobsid desc,id desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('jobs_list', $jobs_list);
        // 赋值数据集
		
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
	}
	public function jobjoin_delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('jobjoin')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
	public function jobjoin_status()
    {
		$id = I('get.id', 0, 'intval');
		$status = I('get.status', 0, 'intval');
       if (M('jobjoin')->where(array('id'=>$id))->save(array('status' => $status))) {
            $this->success(L('edit_success'));
        } else {
            $this->error(L('edit_error'));
        }
    }
	
	public function Comment()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $detail = M('jobjoin')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
        $this->assign('detail', $detail);
        $this->display();
    }
	public function down(){ 
        $id = I('post.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $User = M("jobjoin"); 
        $list = $User->where(array('id' => $id))->find(); 
        $result = $list['file']; 
        if(!$list && $result=='') //如果查询不到文件信息 
        { 
            $this->error('下载失败'); 
        } else {
			$Http = new \Org\Net\Http();
            $showname = $list['filetitle'];
			$filename = '.'.$result; 
		   	$showname = safe_replace($showname);
            $Http->download($filename,$showname); 
        } 
    }
	
	public function data_check($data, $action = 'add')
	{
		$catid = I('post.catid', 0, 'intval');
		$company = I('post.company', 0, 'intval');
		$location = I('post.location', 0, 'intval');
		$title = I('post.title');
		$content = I('post.content');
		$info = I('post.info');
		$profe = I('post.profe');
		if ($title == '') {
			$this->error('请输入职位名称');
		}
		if (!$catid) {
			$this->error(L('column_error'));
		}
		if (!$company) {
			$this->error('请选择职业类型');
		}
		if (!$location) {
			$this->error('请选择工作地点');
		}
		$data['content'] = htmlspecialchars_decode(safe_replace($content));
		$data['info'] = htmlspecialchars_decode(safe_replace($info));
		$data['profe'] = htmlspecialchars_decode(safe_replace($profe));
		if ($action == 'add') {
			$data['inputtime'] = $data['updatetime'] = NOW_TIME;
		} else {
			$data['updatetime'] = NOW_TIME;
		}
		return $data;
	}
	public function updated(){
		$res = M('Jobs')->where(array('status' => array('eq' , 1)))->save(array('inputtime' => NOW_TIME));
        if($res !== false){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
	}
	
	public function updating()
    {
		$id = I('get.id', 0, 'intval');
		if (M('Jobs')->where(array('id'=>$id, 'status' => array('eq' , 1)))->save(array('inputtime' => NOW_TIME))) {
			$this->success('更新成功');
		} else {
			$this->error('更新失败');
		}
    }
}
<?php
namespace wap\Controller;
use Think\Controller;
class VocsController extends PublicController
{
	public function index()
    {
		$sortid = 41;
        $cate_db = M('Category');
		/*栏目详情start*/
		$r = $cate_db->where(array('catid' => $sortid, 'ishidden' => array('eq', 0)))->find();
        if (!$r) {
            $this->error('参数错误');
        }
		$this->assign('config', $r);
		$this->assign('cate', new_html_entity_decode($r));
		/*栏目详情end*/
		$catelist = $cate_db->where(array('pid' => $sortid, 'ishidden' => array('eq', 0)))->order('sort desc, catid asc')->select();
		$this->assign("catelist",$catelist);
		
		$this->display($this->template . 'Vocs/index');
    }

}
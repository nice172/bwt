<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends PublicController
{
	public function index()
    {
		$sortid = 2;
		$model = get_catname($sortid,'ismodel');
		$sortid_all = catid_str($sortid,$model);
		$catid = I('get.catid', 0, 'intval');
        if (!$catid && countnum($sortid) != 0) {
            $catid = get_minid($sortid,$model);
        } elseif (countnum($sortid) == 0) {
			$catid = $sortid;
		}
		$model = get_catname($catid,'ismodel');
        $cate_db = M('Category');
		/*栏目详情start*/
		if (countnum($sortid) != 0) {
			$r = $cate_db->where('catid = '.$catid.' and pid in ('.$sortid_all.') and ismodel = '.$model.' and ishidden = 0')->find();
		} elseif (countnum($sortid) == 0) {
			$r = $cate_db->where('catid = '.$catid.' and ismodel = '.$model.' and ishidden = 0')->find();
		}
        if (!$r) {
            $this->error('参数错误');
        }
		$innerlink=M("Innerlink")->where(array('status' => array('eq', 1)))->select();
		foreach($innerlink as $link){
             $r['content']=str_replace($link['title'],"<a href={$link['url']} title={$link['hint']}>{$link['title']}</a>",$r['content']);
		}
		$this->assign('config', $r);
		$this->assign('cate', new_html_entity_decode($r));
		/*栏目详情end*/
       
		$catelist = $cate_db->where(array('pid' => $sortid, 'ishidden' => array('eq', 0)))->order('sort desc, catid asc')->select();
		$this->assign("catelist",$catelist);
		
		if ($model != 0) {
			/*文章列表start*/
			if ($r['page'] == 0) {
				$r['page'] = 12;
			}
			if ($r['ismodel'] == 1) {
				$article_db = M('Article');
			} elseif ($r['ismodel'] == 2) {
				$article_db = M('Product');
			} elseif ($r['ismodel'] == 3) {
				$article_db = M('Video');
			} elseif ($r['ismodel'] == 4) {
				$article_db = M('Download');
			} elseif ($r['ismodel'] == 5) {
				$article_db = M('Jobs');
			}
			$catid_all = catid_str($catid,$model);
			$where = 'catid in (' . $catid_all . ')  and status = 1';
			$count = $article_db->where($where)->count();
			$p = getpage($count, $r['page']);
			$lists = $article_db->where($where)->order('sort desc,id desc')->limit($p->firstRow, $p->listRows)->select();
			$this->assign('lists', $lists);
			$this->assign('pages', $p->show());
			/*文章列表end*/
		}
		$this->display($this->template . 'About/index');
    }
	public function show()
    {
		$sortid = 2;
		$model = get_catname($sortid,'ismodel');
		$sortid_all = catid_str($sortid,$model);
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error('参数错误');
        }
		$article_db = M('Article');
        /*文章详情start*/
         $article_info = $article_db->where('id = '.$id.' and catid in (' . $sortid_all . ') and status = 1')->find();
        if (empty($article_info)) {
            $this->error('文章不存在');
        }
		$innerlink=M("Innerlink")->where(array('status' => array('eq', 1)))->select();
		foreach($innerlink as $link){
             $article_info['content']=str_replace($link['title'],"<a href={$link['url']} title={$link['hint']}>{$link['title']}</a>",$article_info['content']);
		}
        $this->assign('cate', new_html_entity_decode($article_info));
        /*文章详情end*/
        /*SEO start*/
        $this->assign('config', $article_info);
        /*SEO end*/
        /*点击数start*/
        $views = $article_info['views'] + 1;
        $sql = array('views' => $views, 'viewtime' => NOW_TIME);
        $article_db->where(array('id' => $id, 'status' => 1))->save($sql);
        /*点击数end*/
        /*上一篇start*/
        $where_pre['id'] = array('lt', $id);
		$where_pre['catid'] = array('eq', $article_info['catid']);
        $where_pre['status'] = 1;
        $previous_page = $article_db->where($where_pre)->order('id desc')->limit('1')->find();
        if (empty($previous_page)) {
            $previous_page = array('title' => '没有了', 'thumb' => '', 'url' => 'javascript:alert(\'没有了\');');
        } else {
			$previous_page['url'] = U('About/show',array('id' => $previous_page['id']));
            $previous_page['thumb'] = $previous_page['thumb'];
        }
        $this->assign('previous_page', $previous_page);
        /*上一篇end*/
        /*下一篇start*/
        $where_next['id'] = array('gt', $id);
		$where_next['catid'] = array('eq', $article_info['catid']);
        $where_next['status'] = 1;
        $next_page = $article_db->where($where_next)->order('id asc')->limit('1')->find();
        if (empty($next_page)) {
            $next_page = array('title' => '没有了', 'thumb' => '', 'url' => 'javascript:alert(\'没有了\');');
        } else {
			$next_page['url'] = U('About/show',array('id' => $next_page['id']));
            $next_page['thumb'] = $next_page['thumb'];
        }
        $this->assign('next_page', $next_page);
        /*下一篇end*/
        /*模板start*/
        $this->display($this->template . 'About/show');
        /*模板end*/
    }
}
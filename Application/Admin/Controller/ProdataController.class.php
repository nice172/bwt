<?php
namespace Admin\Controller;
use Think\Controller;
class ProdataController extends PublicController
{
	//评论列表
    public function index()
    {
        $articleid = I('get.articleid');
        if ($articleid && is_int($articleid)) {
            $map['articleid'] = $articleid;
        } elseif (!$articleid){
			$this->error('参数错误');
		}//根据文章的ID列出该文章的评论
		
        $article = M('Prodata');
        $count = $article->where($map)->count();
        $p = getpage($count, 12);
        $article_list = $article->where($map)->order('articleid desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('article_list', $article_list);
        // 赋值数据集
        $this->assign('page', $p->show());
		$this->assign('articleid', $articleid);
        // 赋值分页输出
        $this->display();
	}
	
	//删除
	public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Prodata')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'));
        } else {
            $this->error(L('delete_error'));
        }
    }
	
	public function add()
    {
		$articleid = I('get.articleid');
		$this->assign('articleid', $articleid);
		if (!$articleid){
			$this->error('参数错误');
		}
        $this->display();
    }
	
	public function insert()
    {
        if (IS_POST) {
            $data = I('post.');
			$commenttitle = I('post.commenttitle');
			if ($commenttitle == '') {
				$this->error('请输入标题');
			}
			if (!empty($_POST['editorValue'])) {
				$data['content'] = auto_save_image($_POST['editorValue']);
			}
			$data['content'] = htmlspecialchars_decode($_POST['editorValue']);
			$data['inputtime'] = NOW_TIME;
			$id = M('Prodata')->add($data);
			if ($id > 0) {
					$this->success(L('add_success'));
				
			} else {
				$this->error(L('add_error'));
			}
        }
    }
	public function comment()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        $detail = M('Prodata')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error('此详情不存在');
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
			$commenttitle = I('post.commenttitle');
			if ($commenttitle == '') {
				$this->error('请输入标题');
			}
			if (!empty($_POST['editorValue'])) {
				$data['content'] = auto_save_image($_POST['editorValue']);
			}
			$data['content'] = htmlspecialchars_decode($_POST['editorValue']);
            $result = M('Prodata')->where(array('id' => $id))->save($data);
            if ($result !== false) {
                $this->success('修改成功');
            } else {
                $this->erroe('修改失败');
            }
        }
    }
}
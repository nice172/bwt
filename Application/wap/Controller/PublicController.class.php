<?php
namespace wap\Controller;
use Think\Controller;
class PublicController extends Controller
{
	public $template;
	protected function _initialize()
    {
		$cate = M("category");
        $cateone = $cate->where("pid = 0 and ishidden = 0")->order('sort desc,catid asc')->select();
		$cateth = $cate->where("pid = 0 and ishidden = 0")->order('sort desc,catid asc')->select();
        $this ->assign("cateone",$cateone);
		$this->assign("cateth",$cateth);
		
		$config=M('Site')->where(array('siteid' => 1))->find();
		$this->assign('config', $config);
		$this->template = $config['template_wap'] . '/';
    }
	public function verify()
    {
        ob_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length = 4;
        $Verify->useNoise = true;
        $Verify->entry();
    }
}
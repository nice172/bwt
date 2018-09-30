<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller
{
	public $adminid;
    protected function _initialize()
    {
		$adminid = session('admin_auth.adminid');
		$username = session('admin_auth.username');
		$email = session('admin_auth.email');
		$logintime = session('admin_auth.logintime');
        if (empty($adminid) || empty($username) || empty($email)) {
            $this->redirect('/Login/index');
        }
		$this->adminid = session('admin_auth.adminid');
        $this->config = M('Site')->where(array('siteid' => 1))->find();
        $this->assign('config', $this->config);
		
		// 初始化数据表
		$SystemManager = M('Admin');	//管理员表
		$SystemRole = M('Auth');			//角色表
		$SystemMenu = M('Menu');			//菜单表
		// 初始化数组
		$menuList = array();	//菜单列表
		// 获取当前登录用户的角色ID
		$roleIdInfo = $SystemManager->where(array('adminid' => $adminid))->getField('authority');
		if($roleIdInfo){
			$roleIdArr = explode(',', $roleIdInfo);
			if($roleIdArr){
				$roleMap = array('id'=>array('in',$roleIdArr));
				// 获取当前登录用户的角色数据
				//$this->roleInfo = $SystemRole->where($roleMap)->select();
				$this->roleInfo = $SystemRole->where(array('authority' => $roleIdInfo))->find();
				// 获取当前登录用户的菜单ID
				$menuIdArr = $SystemRole->where($roleMap)->getField('menu_id',true);
				if($menuIdArr){
					$menuIdStr = implode(',', $menuIdArr);
					$menuIdArr = explode(',', $menuIdStr);
					$menuIdArr = array_unique($menuIdArr);
					if($menuIdArr){
	                    //查询条件
	                    $menuMap = array(
	                        'id' => array('in', $menuIdArr),
	                        'status' => 1
	                    );
	                    // 查询当前登录用户的菜单权限列表
						$menuListInfo = $SystemMenu->where($menuMap)->order('sort desc,id asc')->select();
						$menuList = menuTree($menuListInfo);
					}
				}
			}
		}
		$this->assign('menuList', $menuList);
		$this->assign('adminauth', $this->roleInfo);
    }
	
	/*清理缓存*/
    public function cache()
    {
        $path_cache = RUNTIME_PATH . 'Cache/';
        $path_logs = RUNTIME_PATH . 'Logs/';
        delDirAndFile($path_cache);
        delDirAndFile($path_logs);
        $this->success(L('cache'), U('index/summarize'));
    }
	
	/*退出登录*/
    public function logout()
    {
        session('admin_auth', null);
        $this->success(L('logout'), U('Login/index'));
    }
	/*栏目级别*/
    protected function _tree($arr, $pid = 0, $level = 0)
    {
        static $tree = array();
        foreach ($arr as $v) {
            if ($v['pid'] == $pid) {
                //$v['level'] = str_repeat('├', $level);
                $v['level'] = $level;
                $tree[] = $v;
                $this->_tree($arr, $v['catid'], $level + 1);
            }
        }
        return $tree;
    }
	/*栏目列表*/
    protected function listCate($pid = 0)
    {
        $cate = M('category');
        $list = $cate->order('sort desc,catid asc')->select();
        return $this->_tree($list, $pid);
    }
	
	/*菜单列表*/
    protected function listMenu($pid = 0)
    {
        $cate = M('Menu');
        $list = $cate->order('sort desc,id asc')->select();
        return $this->_tree($list, $pid);
    }

    /*
	public function uploadEditor()
    {
        $upload = new \Think\Upload();
        $upload->maxSize = 209715200;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->savePath = './Editor/';
        $upload->autoSub = true;
        $info = $upload->upload();
        if ($info) {
            foreach ($info as &$v) {
                $file = $v['savepath'] . $v['savename'];
            }
            echo json_encode(array('url' => $file, 'state' => 'SUCCESS'));
        } else {
            echo json_encode(array('state' => $upload->getError()));
        }
    }
	*/
	//上传文件
    public function uploadAttach()
    {
        $site = M('Site');
		$size = $site->where('siteid = 1')->getField('file_size');
		$size = intval($size)*1048576;
		$exts = I('get.type');
		switch ($exts) {
			case 1: //图片
				$exts_arr = array('jpg', 'gif', 'png', 'jpeg');
				$path = './Images/';
				break;
			case 2: //音频
				$exts_arr = array('mp3', 'wam', 'wma', 'aac','mod','cd');
				$path = './Music/';
				break;
			case 3: //附件
				$exts_arr = array('rar', 'zip', 'doc', 'pdf', 'docx');
				$path = './File/';
				break;
			case 4: //视频
				$exts_arr = array('mp4', 'avi', 'wmv', 'mov','flv','3gp','navi','mkv');
				$path = './Video/';
				break;
		}
        $upload = new \Think\Upload();
        $upload->maxSize = $size;
        $upload->exts = $exts_arr;
        $upload->savePath = $path;
        $upload->autoSub = true;
        $info = $upload->upload();
        if (!$info) {
            // 上传错误提示错误信息
            $this->ajaxReturn(array('status' => 0));
        } else {
            // 上传成功 获取上传文件信息
            foreach ($info as $v) {
                $file = $v['savepath'] . $v['savename'];
				$name = $v['name'];
				$size = $v['size'];
            }
			$image = new \Think\Image();  
            $image->open('./Uploads/'.$file);  
            $image->save('./Uploads/'.$file);//直接把缩略图覆盖原图
			
            $file = str_replace('./', __ROOT__ . '/Uploads/', $file);
            $this->ajaxReturn(array('status' => 1, 'file' => $file, 'name' => $name, 'size' => $size));
        }
		return $picture_url;
    }

}
<?php
namespace Common\Tag;
use Think\Template\TagLib;
class My extends TagLib {

    // 标签定义
		protected $tags   =  array(
			// 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
			'arclist'   => array('attr' => 'key,item,limit,catid,order','close' =>1),
			'video'     => array('attr' => 'key,item,limit,catid,order','close' =>1),
			'download'  => array('attr' => 'key,item,limit,catid,order','close' =>1),
			'category'  => array('attr' => 'key,item,limit,pid,order,catid','close' =>1),
			'menu'      => array('attr' => 'key,item,limit,pid,order','close' =>1), //后台菜单
			'flink'     => array('attr' => 'key,item,limit,order,cid','close' =>1),
			'banner'    => array('attr' => 'key,item,limit,order,cid','close' =>1),
			'product'   => array('attr' => 'key,item,limit,catid,order,hotpro,compro','close' =>1),
			'social'    => array('attr' => 'key,item,limit,order,types','close' =>1),
			'jobs'      => array('attr' => 'key,item,limit,catid,order','close' =>1),
			'feedback'  => array('attr' => 'key,item,limit,order','close' =>1),
		);
    
		public function _arclist ($tag,$content){
			
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['catid'])?'catid in ('.catid_str($tag['catid'],1).') and status=1':'status=1';
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Article")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		}
		
		public function _video ($tag,$content){
			
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['catid'])?'catid in ('.catid_str($tag['catid'],3).') and status=1':'status=1';
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Video")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		}
		
		
		public function _download ($tag,$content){
			
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['catid'])?'catid in ('.catid_str($tag['catid'],4).') and status=1':'status=1';
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Download")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		}
		
		public function _product ($tag,$content){
			
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['catid'])?'catid in ('.catid_str($tag['catid'],2).') and status=1':'status=1';
			if ($tag['hotpro'] != ""){
				$where=!empty($tag['hotpro'])?'catid in ('.catid_str($tag['catid'],2).') and hotpro='.$tag['hotpro'].' and status=1':'status=1';
			}
			if ($tag['compro'] != ""){
				$where=!empty($tag['compro'])?'catid in ('.catid_str($tag['catid'],2).') and compro='.$tag['compro'].' and status=1':'status=1';
			}
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Product")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
			
		}
	   
		public function _category ($tag,$content){
		
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['pid'])?'pid='.$tag['pid'].' and ishidden=0':'pid=0 and ishidden=0';
			if ($tag['catid'] != ""){
				$where=!empty($tag['catid'])?'catid='.$tag['catid'].' and ishidden=0':'pid=0 and ishidden=0';
			}
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'catid desc';
			$str='<?php ';
			$str .= '$list=M("Category")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		
		}
		
		
		public function _menu ($tag,$content){
		
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['pid'])?'pid='.$tag['pid'].' and status=1':'pid=0 and status=1';
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'id asc';
			$str='<?php ';
			$str .= '$list=M("Menu")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		
		}
		
		
		public function _social ($tag,$content){
		
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['types'])?'types='.$tag['types'].' and status=1':'types=1 and status=1';
			$limit=!empty($tag['limit'])?$tag['limit']:12;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Social")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		
		}
		
		public function _flink ($tag,$content){
		
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['cid'])?'cid='.$tag['cid'].' and ishidden=0':'cid=0 and ishidden=0';
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'tagid desc';
			$str='<?php ';
			$str .= '$list=M("Flink")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		
		}
		
		public function _banner ($tag,$content){
		
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['cid'])?'cid='.$tag['cid'].' and ishidden=0':'cid=0 and ishidden=0';
			$limit=!empty($tag['limit'])?$tag['limit']:12;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("banner")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		
		}
		
		public function _jobs ($tag,$content){
			
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where=!empty($tag['catid'])?'catid in ('.catid_str($tag['catid'],5).') and status=1':'status=1';
			$limit=!empty($tag['limit'])?$tag['limit']:12;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Jobs")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
			
		}
		
		
		public function _feedback ($tag,$content){
			
			$item=$tag['item'];
			$key=!empty($tag['key'])?$tag['key']:'key';
			$where='status = 1';
			$limit=!empty($tag['limit'])?$tag['limit']:0;
			$order=!empty($tag['order'])?$tag['order']:'id desc';
			$str='<?php ';
			$str .= '$list=M("Guestbook")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';//查询语句
			$str .= 'foreach ($list as $'.$key.'=>$'.$item.'):?>';
			$str .= $content;
			$str .='<?php endforeach; ?>';
			return $str;
		}
}
<?php
namespace Admin\Controller;
use Think\Controller;
class GuestbookController extends PublicController
{
	public function index()
	{
		$status = I('get.status');
		if ($status != "" && is_numeric($status)) {
			$map['status'] = array('eq', $status);
		}
       	$guest = M('Guestbook');
        $count = $guest->where($map)->count();
        $p = getpage($count,12);
        $book = $guest->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('book', $book);
        // 赋值数据集
        $this->assign('page', $p->show());
        // 赋值分页输出
        $this->display();
	}
	public function delete()
    {
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error(L('para_error'));
        }
        if (M('Guestbook')->where(array('id' => $id))->delete()) {
            $this->success(L('delete_success'), U('Guestbook/index'));
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
        $detail = M('Guestbook')->where(array('id' => $id))->find();
		if (!$detail) {
            $this->error(L('not_exist'));
        }
		$thumb = string2array($detail['thumb']);
        $this->assign('detail', $detail);
		$this->assign('thumb', $thumb);
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
			$data['replytime'] = NOW_TIME;
            $data['status'] = 1;
			//$replycontent = I('post.replycontent');
			/*if ($replycontent == '') {
				$this->error('回复内容不能为空');	
			}*/
			//$mailaddr= I('post.email');
			//$title=I('post.title');
            $result = M('Guestbook')->where(array('id' => $id))->save($data);
            if ($result !== false) {
				//send_email($mailaddr,$title,$replycontent);
                $this->success('已查看', U('Guestbook/index'));
            } else {
                $this->erroe('回复失败');
            }
        }
    }
	
	/*
	public function expUser(){
		$m = M ('Guestbook');
		$data = $m->field('id,name,qq,email,telephone,title,content,addtime')->select();
		foreach ($data as $k => $v)
		{
			$data[$k]['addtime'] = $v['addtime'] = date('Y-m-d',$v['addtime']);
		}
		//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		//import("Org.Util.PHPExcel");
		//import("Org.Util.PHPExcel.Writer.Excel5");
		//import("Org.Util.PHPExcel.IOFactory.php");
		$filename="test_excel";
		$headArr=array("编号","姓名","QQ","邮箱","手机","留言主题","留言内容","日期");
		$this->getExcel($filename,$headArr,$data);
	}
	private  function getExcel($fileName,$headArr,$data){
	//对数据进行检验
		if(empty($data) || !is_array($data)){
			die("无数据");
		}
		//检查文件名
		if(empty($fileName)){
			exit;
		}
		$date = date("Y_m_d",time());
		$fileName .= "_{$date}.xls";
		vendor("PHPExcel.PHPExcel");
		$objPHPExcel = new \PHPExcel();
		$objProps = $objPHPExcel->getProperties();

	
		$key = ord("A");
		foreach($headArr as $v){
			$colum = chr($key);
			$objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
			$key += 1;
		}
		$column = 2;
		$objActSheet = $objPHPExcel->getActiveSheet();
		$objPHPExcel->getActiveSheet()->getStyle()->getFont()->setName('微软雅黑');//设置字体
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);//设置默认高度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('5');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('10');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('20');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('40');//设置列宽
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('40');//设置列宽
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth('40');//设置列宽
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth('40');//设置列宽
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth('40');//设置列宽
		$sharedStyle1=new \PHPExcel_Style();
		$objPHPExcel->getActiveSheet()->getStyle("A{$column}:H{$column}")->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
		
		foreach($data as $key => $rows){ //行写入
			$span = ord("A");
			foreach($rows as $keyName=>$value){// 列写入
				$j = chr($span);
					$objActSheet->setCellValue($j.$column, $value);
					$span++;
				}
			$column++;
		}
		$fileName = iconv("utf-8", "gb2312", $fileName);
		//重命名表
		// $objPHPExcel->getActiveSheet()->setTitle('test');
		//设置活动单指数到第一个表,所以Excel打开这是第一个表
		$objPHPExcel->setActiveSheetIndex(0);
		ob_end_clean();
		ob_start();
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=\"$fileName\"");
		header('Cache-Control: max-age=0');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output'); //文件通过浏览器下载
		exit;
	}
	*/
}

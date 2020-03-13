<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
Class test_excel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
	}

	public function index()
	{
		// echo 'test excel'; exit();
		$query="SELECT * 
					FROM user
					INNER JOIN department ON user.department_ID = department.department_ID 
				WHERE user.department_ID = 1 
				AND user.user_status = 0 
				ORDER BY user.user_ID";
		$result=$this->all_model->call_all($query);
		// echo '<pre>',print_r($result),'</pre>'; exit();
		$this->load->library('excel');


		$font1 = array(
					'font'  => array(
						// 'color' => array('rgb' => 'FF0000'),
						// 'bold'  => true,
						// 'underline' => true,
						// 'italic' => true,
						'size'  => 14,
						'name'  => 'AngsanaUPC'
					));
		$center_middle = array(
							'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						));
		$center = array(
					'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				));
		$allb = array(
					'borders' => array(
						'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
					));
		$hb = array(
				'borders' => array(
					'horizontal' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
				));
		$ob = array(
				'borders' => array(
					'outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
				));

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Test Excel');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setwidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setwidth(25);

		$this->excel->getActiveSheet()->setCellValue('A1','NO.');
		$this->excel->getActiveSheet()->setCellValue('B1','DEPT');
		$this->excel->getActiveSheet()->setCellValue('C1','Code');
		$this->excel->getActiveSheet()->setCellValue('D1','Name');
		$this->excel->getActiveSheet()->setCellValue('E1','Surname');

		$i=2;
		$no=1;

		foreach($result as $idx => $val){
			$this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
			$this->excel->getActiveSheet()->setCellValue('B'.$i,$val->department_Name);
			$this->excel->getActiveSheet()->setCellValue('C'.$i,$val->user_ID);
			$this->excel->getActiveSheet()->setCellValue('D'.$i,$val->name_en);
			$this->excel->getActiveSheet()->setCellValue('E'.$i,$val->surname_en);

			$no++; $i++;
		}

		$i--;
		$this->excel->getActiveSheet()->getStyle('A1:E'.$i)->applyFromArray($font1);
		$this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($center_middle);
		$this->excel->getActiveSheet()->getStyle('A2:C'.$i)->applyFromArray($center);
		$this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($allb);
		$this->excel->getActiveSheet()->getStyle('A2:C'.$i)->applyFromArray($allb);
		$this->excel->getActiveSheet()->getStyle('D2:E'.$i)->applyFromArray($hb);
		$this->excel->getActiveSheet()->getStyle('A1:E'.$i)->applyFromArray($ob);
		// $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setTextRotation(90);
		// $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

		$filename='Test Excel '.date('ymdHis').'.xls';
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');
	}
}
?>
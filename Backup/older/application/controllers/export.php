<?php
/**
* 
*/
class Export extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login'))
		{
			redirect('login','refresh');
			exit();
		}
		else
		{
			$this->load->library('grocery_CRUD');
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('calendar_model');
			$this->load->model('acceptation_model');
			$this->load->model('report_model');
		}
	}
	function report_user_excel()
	{
		$data['user']=$this->session->userdata('login');
		$data['search_start_date']=$this->input->post('search_start_date2');
		$data['search_end_date']=$this->input->post('search_end_date2');
		$data['report_user']=$this->report_model->report_user($data);

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle("รายงานการลา");
		$this->excel->getActiveSheet()->setCellValue('a1', "รายงานการลา ตั้งแต่วันที่ ".$data['search_start_date']." ถึง ".$data['search_end_date']."");
		$this->excel->getActiveSheet()->setCellValue('a3','รหัส');
		$this->excel->getActiveSheet()->setCellValue('b3','แผนก');
		$this->excel->getActiveSheet()->setCellValue('c3','ชื่อ');
		$this->excel->getActiveSheet()->setCellValue('d3','นามสกุล');
		$this->excel->getActiveSheet()->setCellValue('e3','วันทำงาน');
		$this->excel->getActiveSheet()->setCellValue('f3','วันที่มาทำงาน');
		$this->excel->getActiveSheet()->setCellValue('g3','การลา');
		$this->excel->getActiveSheet()->setCellValue('g4','ลาพักร้อน');
		$this->excel->getActiveSheet()->setCellValue('h4','ลากิจ');
		$this->excel->getActiveSheet()->setCellValue('j4','ลาป่วย');
		$this->excel->getActiveSheet()->setCellValue('h5','จ่าย');
		$this->excel->getActiveSheet()->setCellValue('i5','ไม่จ่าย');
		$this->excel->getActiveSheet()->setCellValue('j5','จ่าย');
		$this->excel->getActiveSheet()->setCellValue('k5','ไม่จ่าย');
		$this->excel->getActiveSheet()->setCellValue('L3','รวมการลา');
		$this->excel->getActiveSheet()->mergeCells('a1:l1');
		$this->excel->getActiveSheet()->mergeCells('a3:a5');
		$this->excel->getActiveSheet()->mergeCells('b3:b5');
		$this->excel->getActiveSheet()->mergeCells('c3:c5');
		$this->excel->getActiveSheet()->mergeCells('d3:d5');
		$this->excel->getActiveSheet()->mergeCells('e3:e5');
		$this->excel->getActiveSheet()->mergeCells('f3:f5');
		$this->excel->getActiveSheet()->mergeCells('g3:k3');
		$this->excel->getActiveSheet()->mergeCells('g4:g5');
		$this->excel->getActiveSheet()->mergeCells('h4:i4');
		$this->excel->getActiveSheet()->mergeCells('j4:k4');
		$this->excel->getActiveSheet()->mergeCells('l3:l5');
		$this->excel->getActiveSheet()->getStyle('a1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('a1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('a1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('a3:l3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$styleArray=array(
			'borders'=>array(
				'allborders'=>array(
					'style'=>PHPExcel_Style_Border::BORDER_MEDIUM
					)
				)
			);
		$this->excel->getActiveSheet()->getStyle('A3:l3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A4:l4')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A5:l5')->applyFromArray($styleArray);
		foreach($data['report_user'] as $num=>$result)
			{
				$num+=1;
				$i=5;
				$i=$i+$num;

				$this->excel->getActiveSheet()->setCellValue("a".$i,$result->ID);
				$this->excel->getActiveSheet()->setCellValue("b".$i,$result->Dep);
				$this->excel->getActiveSheet()->setCellValue("c".$i,$result->Nname);
				$this->excel->getActiveSheet()->setCellValue("d".$i,$result->Lname);
				$this->excel->getActiveSheet()->setCellValue("e".$i,$result->daywork);
				$this->excel->getActiveSheet()->setCellValue("f".$i,$result->sumdaywork);
				$this->excel->getActiveSheet()->setCellValue("g".$i,$result->leavesummer);
				$this->excel->getActiveSheet()->setCellValue("h".$i,$result->leave1);
				$this->excel->getActiveSheet()->setCellValue("i".$i,$result->leave2);
				$this->excel->getActiveSheet()->setCellValue("j".$i,$result->leave3);
				$this->excel->getActiveSheet()->setCellValue("k".$i,$result->leave4);
				$this->excel->getActiveSheet()->setCellValue("l".$i,$result->lostdaywork);
				
			}
			$this->excel->getActiveSheet()->getStyle("a5".":"."l".$i)->applyFromArray($styleArray);
			
		$filename="report_user";
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');		
	}
	function report_alluser_excel()
	{
		$data['user']=$this->session->userdata('login');
		$data['search_start_date']=$this->input->post('search_start_date2');
		$data['search_end_date']=$this->input->post('search_end_date2');
		$data['report_user']=$this->report_model->report_alluser($data);

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle("รายงานการลา");
		$this->excel->getActiveSheet()->setCellValue('a1', "รายงานการลา ตั้งแต่วันที่ ".$data['search_start_date']." ถึง ".$data['search_end_date']."");
		$this->excel->getActiveSheet()->setCellValue('a3','รหัส');
		$this->excel->getActiveSheet()->setCellValue('b3','แผนก');
		$this->excel->getActiveSheet()->setCellValue('c3','ชื่อ');
		$this->excel->getActiveSheet()->setCellValue('d3','นามสกุล');
		$this->excel->getActiveSheet()->setCellValue('e3','วันทำงาน');
		$this->excel->getActiveSheet()->setCellValue('f3','วันที่มาทำงาน');
		$this->excel->getActiveSheet()->setCellValue('g3','การลา');
		$this->excel->getActiveSheet()->setCellValue('g4','ลาพักร้อน');
		$this->excel->getActiveSheet()->setCellValue('h4','ลากิจ');
		$this->excel->getActiveSheet()->setCellValue('j4','ลาป่วย');
		$this->excel->getActiveSheet()->setCellValue('h5','จ่าย');
		$this->excel->getActiveSheet()->setCellValue('i5','ไม่จ่าย');
		$this->excel->getActiveSheet()->setCellValue('j5','จ่าย');
		$this->excel->getActiveSheet()->setCellValue('k5','ไม่จ่าย');
		$this->excel->getActiveSheet()->setCellValue('L3','รวมการลา');
		$this->excel->getActiveSheet()->mergeCells('a1:l1');
		$this->excel->getActiveSheet()->mergeCells('a3:a5');
		$this->excel->getActiveSheet()->mergeCells('b3:b5');
		$this->excel->getActiveSheet()->mergeCells('c3:c5');
		$this->excel->getActiveSheet()->mergeCells('d3:d5');
		$this->excel->getActiveSheet()->mergeCells('e3:e5');
		$this->excel->getActiveSheet()->mergeCells('f3:f5');
		$this->excel->getActiveSheet()->mergeCells('g3:k3');
		$this->excel->getActiveSheet()->mergeCells('g4:g5');
		$this->excel->getActiveSheet()->mergeCells('h4:i4');
		$this->excel->getActiveSheet()->mergeCells('j4:k4');
		$this->excel->getActiveSheet()->mergeCells('l3:l5');
		$this->excel->getActiveSheet()->getStyle('a1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('a1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('a1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('a3:l3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$styleArray=array(
			'borders'=>array(
				'allborders'=>array(
					'style'=>PHPExcel_Style_Border::BORDER_MEDIUM
					)
				)
			);
		$this->excel->getActiveSheet()->getStyle('A3:l3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A4:l4')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A5:l5')->applyFromArray($styleArray);

		foreach($data['report_user'] as $num=>$result)
			{
				$num+=1;
				$i=5;
				$i=$i+$num;

				$this->excel->getActiveSheet()->setCellValue("a".$i,$result->ID);
				$this->excel->getActiveSheet()->setCellValue("b".$i,$result->Dep);
				$this->excel->getActiveSheet()->setCellValue("c".$i,$result->Nname);
				$this->excel->getActiveSheet()->setCellValue("d".$i,$result->Lname);
				$this->excel->getActiveSheet()->setCellValue("e".$i,$result->daywork);
				$this->excel->getActiveSheet()->setCellValue("f".$i,$result->sumdaywork);
				$this->excel->getActiveSheet()->setCellValue("g".$i,$result->leavesummer);
				$this->excel->getActiveSheet()->setCellValue("h".$i,$result->leave1);
				$this->excel->getActiveSheet()->setCellValue("i".$i,$result->leave2);
				$this->excel->getActiveSheet()->setCellValue("j".$i,$result->leave3);
				$this->excel->getActiveSheet()->setCellValue("k".$i,$result->leave4);
				$this->excel->getActiveSheet()->setCellValue("l".$i,$result->lostdaywork);
				
			}
			$this->excel->getActiveSheet()->getStyle("a5".":"."l".$i)->applyFromArray($styleArray);
		$filename="report_user";
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');	
	}
}
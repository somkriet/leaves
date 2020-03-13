<?php 
/**
* Home
*/
class Daily_report extends CI_Controller
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
			//$this->load->helper(array('form', 'url'));
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('calendar_model');
			$this->load->model('acceptation_model');
			$this->load->model('annual_model');
			$this->load->model('office_model');
			$this->load->model('daily_report_model');
		}
	}
	function index($status=null)
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['user_by_department']=$this->user_model->get_user_by_department($data);
		$data['user_by_session']=$this->user_model->get_user_by_session($data);

		$data['department_all']=$this->office_model->department_all();
		
	//print_r($data['user_by_session']);
	//print_r($data['user_by_department']);
	//exit();
		$this->load->view('header',$data);
		$this->load->view('v_search_daily',$data);
		$this->load->view('footer2');
	}
	function gen_excel()
	{
		 echo phpinfo();
		 exit();
		$data['start_date']=$this->input->post('search_start_date');
		$data['end_date']=$this->input->post('search_end_date');

		$data['Department_ID']=$this->input->post('Department_ID');
		$data['select_user_leave_detail']=$this->input->post('select_user_leave_detail');

		//$this->daily_report_model->daily_report($data);
 	
 		echo "string";
		exit();

		// echo $data['start_date'];
		// echo "<br>";
		// echo $data['end_date'];
		// echo "<br>";
		// echo $data['Department_ID'];
		// echo "<br>";
		// echo $data['select_user_leave_detail'];

		$date_now=date('d-m-Y');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle("Daily report");

		$this->excel->getActiveSheet()->setCellValue('m1', " print date ".$date_now);
		$this->excel->getActiveSheet()->setCellValue('e2', " ATTENDANCE 'S  HEAD OFFICE REPORT ");
		$this->excel->getActiveSheet()->setCellValue('i3', " State date : ".$data['start_date']." End date : ".$data['end_date']);
		$this->excel->getActiveSheet()->getStyle('e2')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('i3')->getFont()->setSize(16);

		$this->excel->getActiveSheet()->setCellValue('a5','No.');
		$this->excel->getActiveSheet()->setCellValue('b5','Dept');
		$this->excel->getActiveSheet()->setCellValue('c5','Word ID ');
		$this->excel->getActiveSheet()->setCellValue('d5','Name');
		$this->excel->getActiveSheet()->setCellValue('e5','LATE');
		$this->excel->getActiveSheet()->setCellValue('f5','Time IN');
		$this->excel->getActiveSheet()->setCellValue('g5','Time OUT');
		$this->excel->getActiveSheet()->setCellValue('h5','Total Time');
		$this->excel->getActiveSheet()->setCellValue('i5','LEAVE');
		$this->excel->getActiveSheet()->setCellValue('j5','PAYMENT');
		$this->excel->getActiveSheet()->setCellValue('k5','Remark');

		$this->excel->getActiveSheet()->getStyle('a5:k5')->getFont()->setSize(16);

		$filename="daily_report";
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');
	

	}
	

	
}
?>

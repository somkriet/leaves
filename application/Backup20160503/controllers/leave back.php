<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('login');
			exit();
		}else{
			$this->load->model('all_model');
		}
	}

	public function index()
	{
		$data['user']=$this->session->userdata('login');
		$data['nav']='add_leave';
		$data['user_leave']=$this->input->post('txt_user_leave');
		$data['userid'] = $data['user']['user_ID'];
		// echo $data['userid']; exit();
		// print_r($data['user']); exit();
		$data['employee'] = $this->all_model->call_all("SELECT * FROM USER Where department_ID = '".$data['user']['department_ID']."' and user_status = '0'");
		$data['leave_group'] = $this->all_model->call_all("SELECT leave_group_ID, leave_group_Name FROM leave_group WHERE delete_flag = 0");
		
		// print_r($data['employee']); exit();
		$this->load->view('template/v_header',$data);
		$this->load->view('v_add_leave',$data);
		$this->load->view('template/v_footer');
	}

	function add_leave()
	{
		$data['user']=$this->session->userdata('login');

		// print_r($data['user']); 
		$data['user_leave']=$this->input->post('txt_user_leave');
		$data['req_type']=$this->input->post('txt_req_type');
		$data['leave_type']=$this->input->post('txt_leave_type');
		$data['date_from']=$this->input->post('txt_date_from');
		$data['date_to']=$this->input->post('txt_date_to');
		$data['time_from']=$this->input->post('txt_time_from');
		$data['time_to']=$this->input->post('txt_time_to');
		$data['topic']=$this->input->post('txt_topic');
		$data['desc']=$this->input->post('txt_desc');

		if($data['date_from'] != $data['date_to']){
			$start_date=$data['date_from'];
			$end_date=$data['date_to'];

			$data['total_date']=0;
			while(strtotime($start_date) <= strtotime($end_date)){
				$data['leave_date'][]=$start_date;
				$data['dates'][]=date('D', strtotime($start_date));
				if(date('D', strtotime($start_date)) != 'Sat' AND date('D', strtotime($start_date)) != 'Sun'){
					$data['total_date']++;
				}
				$start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
			}

		}else{
			$data['total_date']=1;
		}
		if($data['time_from']=='13.00'){
			$data['total_date']-=0.5;
		}
		if($data['time_to']=='12.00'){
			$data['total_date']-=0.5;
		}

		// if()

		echo '<pre>',print_r($data),'</pre>'; exit();
	}
	

	public function set_flash()
	{
		$type=$this->input->post('type');

		$this->session->set_flashdata('type',$type);

		echo json_encode($type);
	}

	public function leave_type(){
		$group_id = $this->input->post('group_id');
		$data = $this->all_model->call_all("SELECT * FROM leave_type Where leave_group_ID = '$group_id'");
		echo json_encode($data);
	}
	public function leave_type_casual(){
		$data = $this->all_model->call_all("SELECT * FROM leave_type Where leave_group_ID = '1'");
		echo json_encode($data);
	}
	public function leave_d(){
		// date_default_timezone_set('UTC');
		$datefrom = $this->input->post('datefrom');
		$dateto = $this->input->post('dateto');
		$type_leave = $this->input->post('type');
		$data['chk_cal'] = $this->all_model->call_all("SELECT cal_holiday FROM leave_type Where leave_type_id = '$type_leave'");
 		if($data['chk_cal'][0]->cal_holiday == 0){

			for ($date = strtotime($datefrom); $date <= strtotime($dateto); $date = strtotime("+1 day", $date)) {

						$chk_holiday = $this->all_model->call_all("SELECT * FROM non_working_time Where non_working_time = '$date'");
			 			if(date('w', $date) != 6 AND date('w', $date) != 0 OR $chk_holiday == "") {
							$date_detail[] = date("d-m-Y", $date);
						}
					}
 		}else{
 			for ($date = strtotime($datefrom); $date <= strtotime($dateto); $date = strtotime("+1 day", $date)) {
			 			$date_detail[] = date("d-m-Y", $date);
					}
 		}
		$data = $date_detail;
 		echo json_encode($data);
	}
}
?>
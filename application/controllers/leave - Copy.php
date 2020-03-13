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
		// print_r($data['user']); exit();
		// echo date('w/**/', strtotime('2016-01-03')); exit();
		// $start_date='2016-01-04';
		// $start_time='08.30';
		// $end_date='2016-01-08';
		// $end_time='17.30';
		// $day=0;
		// while (strtotime($start_date) <= strtotime($end_date)) {
		// 	echo "$start_date<br>";
		// 	$start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
		// 	$day++;
		// }
		// echo $day;
		// exit();
		// echo '<pre>',print_r($data),'</pre>';
		if($this->session->flashdata('type')){
			$this->add_leave();
		}

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
}
?>
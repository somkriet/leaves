<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave_approve_mj extends CI_Controller
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
		$data['nav']='leave_approve';

		// echo '<pre>',print_r($data),'</pre>';

		$data['store_name']="call mleave25_rev1()";
		$data['data_leave_approve']=$this->all_model->call_store($data);

		


		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_approve_mj',$data);
		$this->load->view('template/v_footer');
	}



	public function leave_approve_detail(){

		// $data['leave_date']=$this->input->post('');

		$data['store_name']="call mleave26_rev1('".$leave_ID."')";

		$data['leave_approve_detail']=$this->all_model->call_store($data);









	}

	public function leave_approve_result(){

		// $data['leave_date']=$this->input->post('');

		$data['store_name']="call mleave26_rev1('".$leave_ID."')";

		$data['leave_approve_detail']=$this->all_model->call_store($data);









	}




}
?>
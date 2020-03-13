<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* Home
*/
class Report extends CI_Controller
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
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('calendar_model');
			$this->load->model('acceptation_model');
			$this->load->model('report_model');
		}
	}
	function index($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['search_start_date']=$this->input->post('search_start_date');
		$data['search_end_date']=$this->input->post('search_end_date');
		$data['search_start_date2']=$this->input->post('search_start_date');
		$data['search_end_date2']=$this->input->post('search_end_date');
		$data['report_user']=$this->report_model->report_user($data);
		$data['report_user_time']=$this->report_model->report_user_time($data);

		$this->load->view('header',$data);
		$this->load->view('search_report_user',$data);
		$this->load->view('report/report_user',$data);
		$this->load->view('footer');
	}
	function report_user_print($type_report=null)
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['report_user_print']=$this->report_model->report_user_print($data);

		//print_r ($data['report_user_print']);
		
		$this->load->view('report/v_report_print',$data);
		


	}
	function report_alluser($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');

		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['search_start_date']=$this->input->post('search_start_date');
		$data['search_end_date']=$this->input->post('search_end_date');
		$data['search_start_date2']=$this->input->post('search_start_date');
		$data['search_end_date2']=$this->input->post('search_end_date');
		$data['report_user']=$this->report_model->report_alluser($data);
		$data['report_user_time']=$this->report_model->report_alluser_time($data);
		$data['report_detail']=$this->report_model->report_alluser_getdetail($data);
		
		$this->load->view('header',$data);
		$this->load->view('search_report_alluser',$data);
		$this->load->view('report/report_alluser',$data);
		$this->load->view('footer');
	}	
	function report_alluser_print($type_report=null)
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['year_select']=$this->input->post('year_select');
		$data['report_user_print']=$this->report_model->report_alluser_print($data);
		$data['report_user_time']=$this->report_model->report_alluser_time($data);
		$data['alluser_search']=$this->user_model->alluser_search($data);
		//print_r($data);exit();
		$this->load->view('report/report_alluser_print',$data);
	}
	function report_leave_annual_year($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');

		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['search_start_date']=$this->input->post('search_start_date');
		$data['search_end_date']=$this->input->post('search_end_date');
		$data['search_start_date2']=$this->input->post('search_start_date');
		$data['search_end_date2']=$this->input->post('search_end_date');
		$data['report_user']=$this->report_model->report_alluser($data);
		$data['report_user_time']=$this->report_model->report_alluser_time($data);
		$data['report_detail']=$this->report_model->report_alluser_getdetail($data);
		
		$this->load->view('header',$data);
		$this->load->view('search_report_alluser',$data);
		$this->load->view('report/leave_annual_year',$data);
		$this->load->view('footer');
	}	

	
}
?>

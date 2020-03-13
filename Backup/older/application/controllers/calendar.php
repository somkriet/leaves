<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* calendar
*/
class Calendar extends CI_Controller
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
			$this->load->model('calendar_model');
		}
	}
	function index()
	{
		$data['user']=$this->session->userdata('login');
		$data['non_working_time']=$this->calendar_model->get_non_working_time_all();
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$this->load->view('header',$data);
		$this->load->view('non_working_time',$data);
		$this->load->view('footer');
	}
	function calendar_next_year($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['get_non_working_time_all']=$this->calendar_model->get_non_working_time_all();
		$data['check_non_working_time_next_year']=$this->calendar_model->check_non_working_time_next_year();
		$this->load->view('header',$data);
		$this->load->view('hr/non_working_time_next_year',$data);
		$this->load->view('footer');
	}
	function add_calendar()
	{
		$data['user']=$this->session->userdata('login');
		$non_working_time=$this->input->post('non_working_time');
		$data['non_working_time']=date('Y-m-d',strtotime($non_working_time));
		$data['detail']=$this->input->post('detail');
		$data['add_date']=date('Y-m-d H:i:S');
		$this->calendar_model->add_calendar($data);
		redirect('calendar/calendar_next_year/1','refresh');
	}
	function del_calendar($calendar_ID)
	{
		$data['calendar_ID']=$calendar_ID;
		$this->calendar_model->del_calendar($data);
		redirect('calendar/calendar_next_year/2','refresh');
	}
	function edit_calendar()
	{
		$data['user']=$this->session->userdata('login');
		$data['calendar_ID']=$this->input->post('calendar_ID');
		$data['non_working_time']=$this->input->post('non_working_time');
		$data['detail']=$this->input->post('detail');
		$data['add_date']=date('Y-m-d H:i:S');
		$this->calendar_model->edit_calendar($data);
		redirect('calendar/calendar_next_year/3','refresh');
	}
}
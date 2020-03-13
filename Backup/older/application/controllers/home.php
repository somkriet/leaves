<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* Home
*/
class Home extends CI_Controller
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
		// $data['a']=1;
		// $data['b']=0.5;
		// $data['c']=$data['a']+$data['b'];
		// echo $data['c'];
		// exit();
		$data['user']=$this->session->userdata('login');
		//leave
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);

		//non working time
		$data['non_working_time']=$this->calendar_model->get_non_working_time();
		$data['check_non_working_time_next_year']=$this->calendar_model->check_non_working_time_next_year();

		$data['check_non_working_time_next_year']=$this->calendar_model->check_non_working_time_next_year();
		

		$this->load->view('header',$data);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	function logout()
	{
		$this->session->unset_userdata('login');
		session_destroy();
		redirect('login/index', 'refresh');
		exit();
	}
	function test()
	{
		$this->load->view('test');
		$this->load->view('footer');
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* user
*/
class User extends CI_Controller
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
			$this->load->library("pagination");
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('office_model');
			$this->load->model('acceptation_model');
			$this->load->model('position_model');
		}
	}
	function index()
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);

		$data['user_type_all']=$this->user_model->get_user_type_all();

		$data['office_all']=$this->office_model->office_all();
		$data['department_all']=$this->office_model->department_all();

		$data['acceptation']=$this->acceptation_model->acceptation_all();

		$data['progression_all']=$this->progression_model->progression_all();

		$data['position_all']=$this->position_model->position_all();

		$data['get_user_all']=$this->user_model->get_user_all();
		$data['get_user_type_all']=$this->user_model->get_user_type_all();

		$data['userdata']=$this->user_model->get_user_by_session($data);

		

		$this->load->view('header',$data);
		$this->load->view('user');
		$this->load->view('footer');
	}
	function search_user()
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
	    $data['search_user']=$this->input->post('search_user');
		// $search_start_date=$this->input->post('search_start_date');
		// $search_end_date=$this->input->post('search_end_date');
		$data['user_type_all']=$this->user_model->get_user_type_all();

		$data['office_all']=$this->office_model->office_all();
		$data['department_all']=$this->office_model->department_all();

		$data['acceptation']=$this->acceptation_model->acceptation_all();

		$data['progression_all']=$this->progression_model->progression_all();

		$data['position_all']=$this->position_model->position_all();

		$data['get_user_all']=$this->user_model->get_user_all();
		$data['get_user_type_all']=$this->user_model->get_user_type_all();

		$data['result']=$this->user_model->get_user_search($data);


		$this->load->view('header',$data);
		$this->load->view('search_user',$data);
		$this->load->view('footer');
	}
}
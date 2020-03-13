<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class regulation extends CI_Controller
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
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_regulation',$data);
		$this->load->view('template/v_footer');
	}
}
?>
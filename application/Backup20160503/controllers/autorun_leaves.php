<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class autorun_leaves  extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('login')){
		// 	redirect('login');
		// 	exit();
		// }else{
			$this->load->model('all_model');
		// }
	}

	public function index()
	{
		$data['user']=$this->session->userdata('login');
		$this->all_model->call_all("call mleave32_rev1(null)");
	}
	
}
?>

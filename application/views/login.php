<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function authen()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password=md5($password);

		$result=$this->all_model->get_userdata($username,$password);

		if(!empty($result)){
			$session_arr=array();
			foreach($result as $rs){
				foreach($rs as $idx => $vals){
					if($idx!="password"){
						$session_arr[$idx]=$vals;
					}
				}
			}
			$this->session->set_userdata('login',$session_arr);
			$res=array('return'=>'success');
		}else{
			$res=array('return'=>'error');
		}

		echo json_encode($res);
	}

	public function logout()
	{
		$this->session->unset_userdata('login');

		redirect('login');
	}
}
?>
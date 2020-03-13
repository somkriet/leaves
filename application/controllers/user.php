<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class user extends CI_Controller
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
	function index()
	{//เรียกข้อมูลผู้ใช้มาแสดง
		$data['user']=$this->session->userdata('login');

		$data['nav']='user';
		
		$data['store_name']="call mleave14_rev1(
							'".$data['user']['user_ID']."'
							)";
		$data['data_user']=$this->all_model->call_store($data);
		
		// print_r($data['data_user']); exit();


		$this->load->view('template/v_header',$data);
		$this->load->view('v_user',$data);
		$this->load->view('template/v_footer');
	}


	public function edit_user_profile(){//แก้ไขเบอร์โทรผู้ใช้งาน
		// echo 'xxxx'; exit();
		$data['user_ID']=$this->input->post('user_ID');
		$data['department_ID']=$this->input->post('department_ID');
		$data['office_ID']=$this->input->post('office_ID');
		$data['name_en']=$this->input->post('name_en');
		$data['surname_en']=$this->input->post('surname_en');
		$data['name_th']=$this->input->post('name_th');
		$data['surname_th']=$this->input->post('surname_th');
		$data['birth_date']=$this->input->post('birth_date');
		$data['start_date_work']=$this->input->post('start_date_work');
		$data['email']=$this->input->post('email');
		$data['phone']=$this->input->post('phone');
		$data['user_type_ID']=$this->input->post('user_type_ID');
		$data['password']=$this->input->post('password');
		$data['position_ID']=$this->input->post('position_ID');
		$data['send_email_to']=$this->input->post('send_email_to');
		$data['annual_new']=$this->input->post('annual_new');
		$data['annual_old']=$this->input->post('annual_old');
		$data['annual_old_use']=$this->input->post('annual_old_use');
		$data['annual_new_use']=$this->input->post('annual_new_use');

		$result = $this->db->query("SELECT password FROM user WHERE user_ID = '".$data['user_ID']."'")->result();
		$password_result = $result[0]->password;

		if($password_result == $data['password']){
			$password = $data['password'];
		}else{
			$password = md5($data['password']);
		}

		$data['store_name']="call mleave13_rev1(
								'".$data['user_ID']."',
								'".$data['department_ID']."',
								'".$data['name_en']."',
								'".$data['surname_en']."',
								'".$data['name_th']."',
								'".$data['surname_th']."',
								'".$data['birth_date']."',
								'".$data['start_date_work']."',
								'".$data['email']."',
								'".$data['phone']."',
								'".$data['user_type_ID']."',
								'".$password."',
								'".$data['position_ID']."',
								'".$data['send_email_to']."',
								'".$data['annual_new']."',
								'".$data['annual_old']."',
								'".$data['annual_old_use']."',
								'".$data['annual_new_use']."'

							)";
		$this->all_model->call_not($data['store_name']);


		redirect('user/index/','refresh');

	}





	
}
<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class user_setup extends CI_Controller
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
		$data['nav']="";

		$data['department']=$this->all_model->call_all("SELECT department_ID, department_Name FROM department WHERE delete_flag = 0 ORDER BY department_Name");
		$data['position']=$this->all_model->call_all("SELECT position_ID, position_Name FROM position WHERE delete_flag = 0 ORDER BY position_Name");
		$data['office']=$this->all_model->call_all("SELECT office_ID, office_Name FROM office WHERE delete_flag = 0 ORDER BY office_Name");
		$data['user_type']=$this->all_model->call_all("SELECT user_type_ID, user_type_Name FROM user_type WHERE delete_flag = 0 ORDER BY user_type_Name");

		if($this->session->userdata('search_name') != ""){
			$data['search_name']=$this->session->userdata('search_name');
			$data['dept_search']=$data['user']['department_ID'];

			$data['user_list']=$this->all_model->call_all("CALL mleave08_rev1('".$data['search_name']."')");
		}else{
			if($this->session->userdata('dept_search') != ""){
				$data['dept_search']=$this->session->userdata('dept_search');
			}else{
				$data['dept_search']=$data['user']['department_ID'];
			}

			$data['user_list']=$this->all_model->call_all("CALL mleave07_rev1(".$data['dept_search'].")");
		}
		
		$this->load->view('template/v_header',$data);
		$this->load->view('v_user_setup',$data);
		$this->load->view('template/v_footer');
	}

	public function manage_user()
	{
		$start_date_work=$this->input->post('start_date_work');
		$user_ID=$this->input->post('user_ID');
		$birth_day=$this->input->post('birth_day');
		$name_th=$this->input->post('name_th');
		$surname_th=$this->input->post('surname_th');
		$name_en=$this->input->post('name_en');
		$surname_en=$this->input->post('surname_en');
		$department=$this->input->post('department');
		$office=$this->input->post('office');
		$position=$this->input->post('position');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$user_type=$this->input->post('user_type');
		$send_email_to=$this->input->post('send_email_to');

		$new_annual=$this->input->post('new_annual');
		$old_annual=$this->input->post('old_annual');
		$old_annual_use=$this->input->post('old_annual_use');
		$new_annual_use=$this->input->post('new_annual_use');

		$query="SELECT password FROM user WHERE user_ID = $user_ID";
		$password_result=$this->all_model->call_all($query);
		
		if(!empty($password_result)){
			if($password_result[0]->password!=$password){
				$password=md5($password);	
			}
		}else{
			$password=md5($password);
		}

		$query="CALL mleave13_rev1($user_ID,
									$department,
									'$name_en',
									'$surname_en',
									'$name_th',
									'$surname_th',
									'$birth_day',
									'$start_date_work',
									'$email',
									'$phone',
									$user_type,
									'$password',
									$position,
									'$send_email_to',
									$new_annual,
									$old_annual,
									$old_annual_use,
									$new_annual_use
									)";
		$this->all_model->call_not($query);

		echo json_encode('success');
	}

	public function del_user()
	{
		$user_ID=$this->input->post('user_ID');

		$query="UPDATE user SET user_status = 1 WHERE user_ID = $user_ID";
		$this->all_model->call_not($query);

		echo json_encode('success');
	}

	public function get_user_data()
	{
		$user_ID=$this->input->post('user_ID');

		$res=$this->all_model->call_all("CALL mleave44_rev1($user_ID)");

		if(empty($res)){
			$res='error';
		}

		echo json_encode($res);
	}

	public function add_user(){

		 $data['user_ID']=$this->input->post('userID');
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
								'".md5($data['password'])."',
								'".$data['position_ID']."',
								'".$data['send_email_to']."',
								'0',
								'0',
								'0',
								'0'
							)";
		$this->all_model->call_not($data['store_name']);
		

		// echo('<pre>');   print_r($data['data_user_type_return']); exit();

		redirect('user_setup/index/','refresh');
	}

	public function edit_user(){
		// echo 'sss'; exit();
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
		

		redirect('user_setup/index/','refresh');

		
	}

	public function check_user(){
		$data['user']=$this->session->userdata('login');
		$data['nav']='user_setup';


		 $q=$this->db->query("SELECT department_ID,department_Name FROM `department` where delete_flag = 0");
         $data['result_department']=$q->result();

         $q=$this->db->query("SELECT position_ID,position_Name FROM `position` where delete_flag = 0");
         $data['result_position']=$q->result();


		 $q=$this->db->query("SELECT office_ID,office_Name FROM `office` where delete_flag = 0");
         $data['result_office']=$q->result();

         $q=$this->db->query("SELECT user_type_ID,user_type_Name FROM `user_type` where delete_flag = 0");
         $data['result_user_type']=$q->result();

		 $data['department_ID']=$this->input->post('txt_user_setup');

         $data['store_name']="call mleave07_rev1(
							'".$data['department_ID']."'
							)";
		$data['data_user_setup']=$this->all_model->call_store($data);

		// redirect('user_setup/','refresh');
		$this->load->view('template/v_header',$data);
		$this->load->view('v_user_setup',$data);
		$this->load->view('template/v_footer');
	}

	public function chk_user_ID(){
		$user_ID=$this->input->post('user_ID');

		$query="SELECT user_ID FROM user WHERE user_ID = $user_ID";
		$chk_user_ID=$this->all_model->call_all($query);

		if(!empty($chk_user_ID)){
			$res="error";
		}else{
			$res="success";
		}

		echo json_encode($res);
	}

	public function cal_user()
	{
		$user_ID=$this->input->post('user_ID');

		if(empty($user_ID)){
			$res='error';
		}else{
			$this->all_model->call_not("CALL mleave32_rev1($user_ID)");

			$res='success';
		}

		echo json_encode($res);
	}

	public function search_dept()
	{
		$department_ID=$this->input->post('department_ID');

		if(empty($department_ID)){
			$res='error';
		}else{
			$this->session->set_userdata('dept_search',$department_ID);
			$this->session->set_userdata('search_name',"");

			$res=$this->all_model->call_all("CALL mleave07_rev1($department_ID);");
		}

		echo json_encode($res);
	}

	public function search_user()
	{
		$name=$this->input->post('name');

		if(empty($name)){
			$res='error';
		}else{
			$this->session->set_userdata('search_name',$name);
			$this->session->set_userdata('dept_search',"");

			$res=$this->all_model->call_all("CALL mleave08_rev1('$name');");
		}

		echo json_encode($res);
	}
}
?>
<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class user_setup_bck extends CI_Controller
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
		$data['nav']='user_setup';

		 $q=$this->db->query("SELECT department_ID,department_Name FROM `department` where delete_flag = 0");
         $data['result_department']=$q->result();


		 $q=$this->db->query("SELECT position_ID,position_Name FROM `position` where delete_flag = 0");
         $data['result_position']=$q->result();


		 $q=$this->db->query("SELECT office_ID,office_Name FROM `office` where delete_flag = 0");
         $data['result_office']=$q->result();

         $q=$this->db->query("SELECT user_type_ID,user_type_Name FROM `user_type` where delete_flag = 0");
         $data['result_user_type']=$q->result();


        $data['user_set']=$this->input->post('txt_user_setup');
        $data['search']=$this->input->post('search');

        if(empty($data['search'])){

         $data['store_name']="call mleave07_rev1(
							'". $data['user']['department_ID']."'
							)";
		$data['data_user_setup']=$this->all_model->call_store($data);
		}else{
			$data['store_name']="call mleave08_rev1(
							'". $data['search']."'
							)";
			$data['data_user_setup']=$this->all_model->call_store($data);
		}


		 // var_dump($data['data_user_setup']); exit();
		 // echo '<pre>',print_r($result),'</pre>';
		
		$this->load->view('template/v_header',$data);
		$this->load->view('v_user_setup_bck',$data);
		$this->load->view('template/v_footer');
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


	public function del_user($user_ID){

		$data_del_user=$this->db->query(" UPDATE user SET user_status = 1	
												WHERE user_ID = '".$user_ID."'	
										 ");
        
         redirect('user_setup/','refresh');


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
		$this->load->view('v_user_setup_bck',$data);
		$this->load->view('template/v_footer');
	}


	public function search_user(){

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



		$data['search']=$this->input->post('search');

		$data['store_name']="call mleave08_rev1(
								'".$data['search']."'
							)";
		// $this->all_model->call_not($data['store_name']);
		$data['data_user_setup']=$this->all_model->call_store($data);

		// redirect('user_setup/index/','refresh');


		$this->load->view('template/v_header',$data);
		$this->load->view('v_user_setup_bck',$data);
		$this->load->view('template/v_footer');
	}

	public function chk_user_ID(){
		$user_ID=$this->input->post('user_ID');

		$query="SELECT user_ID FROM user WHERE user_ID = $user_ID";
		$chk_user_ID=$this->all_model->call_all($query);

		if(!empty($chk_user_ID)){
			$res="ERROR";
		}else{
			$res="SUCCESS";
		}

		echo json_encode($res);
	}

	public function cal_user($user_ID){

		// $data['search']=$this->input->post('search');

		$data['store_name']="call mleave32_rev1(
								'".$user_ID."'
							)";
		$this->all_model->call_not($data['store_name']);
		// $data['data_cal_user']=$this->all_model->call_store($data);

		 redirect('user_setup_bck/index/','refresh');

	}





}
?>
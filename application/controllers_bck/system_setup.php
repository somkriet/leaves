<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class system_setup extends CI_Controller
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
		$data['nav']='system_setup';

		// echo '<pre>',print_r($data),'</pre>';
		$data_user_type=$this->db->query("SELECT user_type_ID,user_type_Name FROM `user_type` where delete_flag = 0");
        $data['user_type_all']=$data_user_type->result();


        $data_office=$this->db->query("SELECT office_ID,office_Name FROM `office` where delete_flag = 0 order by office_name");
        $data['office_all']=$data_office->result();


        $data_department=$this->db->query("SELECT d.department_ID, d.department_Name,o.office_ID, o.office_Name
											FROM department d
											INNER JOIN office o ON d.office_ID = o.office_ID
											WHERE d.delete_flag = 0
											ORDER BY d.department_Name
										 ");
         $data['department_all']=$data_department->result();

        // echo('<pre>');   print_r($data['department_all']); exit();

		 $data_leave_status=$this->db->query(" SELECT acceptation_ID, acceptation_Name
											FROM acceptation
											WHERE delete_flag = 0
											ORDER BY acceptation_Name
										 ");
         $data['acceptation']=$data_leave_status->result();

         $data_progression=$this->db->query(" SELECT progression_ID, progression_Name
											FROM progression
											WHERE delete_flag = 0
											ORDER BY progression_Name
										 ");
         $data['progression_all']=$data_progression->result();


         $data_position=$this->db->query(" SELECT position_ID, position_Name
												FROM position
												WHERE delete_flag = 0
												ORDER BY position_Name
										 ");
         $data['position_all']=$data_position->result();


         // $data_leave_type=$this->db->query(" SELECT leave_type_ID, leave_type_Name
									// 			FROM leave_type
									// 			WHERE delete_flag = 0
									// 			ORDER BY leave_type_Name
									// 	 ");
         // $data['leave_type_all']=$data_leave_type->result();
       

		 $data_position=$this->db->query(" SELECT leave_group_ID, leave_group_Name
												FROM leave_group
												WHERE delete_flag = 0
												ORDER BY leave_group_Name
										 ");
         $data['leave_group_all']=$data_position->result();

  $data['store_name']="call mleave21_rev1()";
		$data['leave_type_all']=$this->all_model->call_store($data);

		$this->load->view('template/v_header',$data);
		$this->load->view('v_system_setup',$data);
		$this->load->view('template/v_footer');
	}

	public function add_user_type(){

		$data['user_type_ID']=$this->input->post('user_type_ID');
		$data['user_type_Name']=$this->input->post('user_type_Name');
	

		$data['store_name']="call mleave15_rev1(
								null,
								'".$data['user_type_Name']."'
							)";

		$this->all_model->call_not($data['store_name']);
		// echo('<pre>');   print_r($data['data_user_type_return']); exit();


		redirect('system_setup/index/','refresh');
	}

	public function edit_user_type(){
		$data['user_type_ID']=$this->input->post('user_type_ID');
		$data['user_type_Name']=$this->input->post('user_type_Name');

		$data['store_name']="call mleave15_rev1(
							'".$data['user_type_ID']."',
							'".$data['user_type_Name']."'
							)";
		$this->all_model->call_not($data['store_name']);
		redirect('system_setup/index/','refresh');
	}

	public function del_user_type($user_type_ID){

		 $data_del_user=$this->db->query(" UPDATE user_type SET delete_flag = 1	
												WHERE user_type_ID = '".$user_type_ID."'
												
										 ");
        
         redirect('system_setup/index/','refresh');

	}
	public function add_office(){

		$data['office_ID']=$this->input->post('office_ID');
		$data['office_Name']=$this->input->post('office');
	

		$data['store_name']="call mleave16_rev1(
								null,
								'".$data['office_Name']."'
							)";
		$this->all_model->call_not($data['store_name']);
		// $data['data_user_type_return']=$this->all_model->call_store($data);

		redirect('system_setup/index/','refresh');
	}

	public function edit_office(){

		$data['office_ID']=$this->input->post('office_ID');
		$data['office_Name']=$this->input->post('office');
	

		$data['store_name']="call mleave16_rev1(
								'".$data['office_ID']."',
								'".$data['office_Name']."'
							)";

		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}
	public function del_office($office_ID){

		 $data_del_user=$this->db->query(" UPDATE office SET delete_flag = 1	
												WHERE office_ID = '".$office_ID."'
												
										 ");
        
         redirect('system_setup/index/','refresh');

	}
	public function add_department(){

		$data['department_ID']=$this->input->post('department_ID');
		$data['department_name']=$this->input->post('department_name');
		$data['office']=$this->input->post('office');

		$data['store_name']="call mleave17_rev1(
								null,
								'".$data['department_name']."',
								'".$data['office']."'
							)";
		$this->all_model->call_not($data['store_name']);
		// $data['data_user_type_return']=$this->all_model->call_store($data);

		redirect('system_setup/index/','refresh');
	}

	public function edit_department(){

		$data['department_ID']=$this->input->post('department_ID');
		$data['department_name']=$this->input->post('department_name');
		$data['office']=$this->input->post('office');
	

		$data['store_name']="call mleave17_rev1(
								'".$data['department_ID']."',
								'".$data['department_name']."',
								'".$data['office']."'
							)";

		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}
	public function del_department($department_ID){

		 $data_del_user=$this->db->query(" UPDATE department SET delete_flag = 1	
												WHERE department_ID = '".$department_ID."'
												
										 ");
        
         redirect('system_setup/index/','refresh');

	}
	public function add_acception(){

		$data['acception_ID']=$this->input->post('acception__ID');
		$data['acception_Name']=$this->input->post('acceptation');
		
		$data['store_name']="call mleave18_rev1(
								null,
								'".$data['acception_Name']."'
							)";
		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}

	public function edit_acception(){

		$data['acception_ID']=$this->input->post('acception_ID');
		$data['acception_Name']=$this->input->post('acception_Name');
	

		$data['store_name']="call mleave18_rev1(
								'".$data['acception_ID']."',
								'".$data['acception_Name']."'
							)";

		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}
	public function del_acception($acceptation_ID){

		 $data_del_user=$this->db->query(" UPDATE acceptation SET delete_flag = 1	
												WHERE acceptation_ID = '".$acceptation_ID."'
												
										 ");
        
         redirect('system_setup/index/','refresh');

	}
	public function add_progression(){

		$data['acception_ID']=$this->input->post('acception__ID');
		$data['progression_Name']=$this->input->post('progression_Name');
		
		$data['store_name']="call mleave19_rev1(
								null,
								'".$data['progression_Name']."'
							)";
		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}

	public function edit_progression(){

		$data['progression_ID']=$this->input->post('progression_ID');
		$data['progression_Name']=$this->input->post('progression_Name');
	

		$data['store_name']="call mleave19_rev1(
								'".$data['progression_ID']."',
								'".$data['progression_Name']."'
							)";

		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}
	public function del_progression($progression_ID){

		 $data_del_user=$this->db->query(" UPDATE progression SET delete_flag = 1	
												WHERE progression_ID = '".$progression_ID."'										
										 ");
        
         redirect('system_setup/index/','refresh');

	}

	public function add_position(){

		$data['position_Name']=$this->input->post('position_Name');
		
		$data['store_name']="call mleave20_rev1(
								null,
								'".$data['position_Name']."'
							)";
		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}

	public function edit_position(){

		$data['position_ID']=$this->input->post('position_ID');
		$data['position_Name']=$this->input->post('position_Name');
	
		$data['store_name']="call mleave20_rev1(
								'".$data['position_ID']."',
								'".$data['position_Name']."'
							)";

		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}
	public function del_position($position_ID){

		 $data_del_user=$this->db->query(" UPDATE position SET delete_flag = 1	
												WHERE position_ID = '".$position_ID."'										
										 ");
        
         redirect('system_setup/index/','refresh');

	}

	public function add_leave_type(){

		$data['leave_type_Name']=$this->input->post('leave_type_Name');
		$data['title_name']=$this->input->post('title_name');
		$data['name_en']=$this->input->post('name_en');
		$data['leave_group_ID']=$this->input->post('leave_group_ID');
		$data['show_flag']=$this->input->post('show_flag');
		$data['limit_leave']=$this->input->post('limit_leave');
		$data['cal_holiday']=$this->input->post('cal_holiday');
		
		

		$data['store_name']="call mleave22_rev1(
								null,
								'".$data['leave_type_Name']."',
								'".$data['title_name']."',
								'".$data['name_en']."',
								'".$data['leave_group_ID']."',
								'".$data['show_flag']."',
								'".$data['limit_leave']."',
								'".$data['cal_holiday']."'

							)";
		$this->all_model->call_not($data['store_name']);

		redirect('system_setup/index/','refresh');
	}

	public function edit_leave_type(){

		$data['leave_type_ID']=$this->input->post('leave_type_ID');
		$data['leave_type_Name']=$this->input->post('leave_type_Name');
		$data['title_name']=$this->input->post('title_name');
		$data['name_en']=$this->input->post('name_en');
		$data['leave_group_ID']=$this->input->post('leave_group_ID');
		$data['show_flag']=$this->input->post('show_flag');
		$data['limit_leave']=$this->input->post('limit_leave');
		$data['cal_holiday']=$this->input->post('cal_holiday');
		
	
		$data['store_name']="call mleave22_rev1(
								'".$data['leave_type_ID']."',
								'".$data['leave_type_Name']."',
								'".$data['title_name']."',
								'".$data['name_en']."',
								'".$data['leave_group_ID']."',
								'".$data['show_flag']."',
								'".$data['limit_leave']."',
								'".$data['cal_holiday']."'
							)";

		$this->all_model->call_not($data['store_name']);



		redirect('system_setup/index/','refresh');
	}
	public function del_leave_type($leave_type_ID){

		 $data_del_user=$this->db->query(" UPDATE leave_type SET delete_flag = 1	
												WHERE leave_type_ID = '".$leave_type_ID."'										
										 ");
        
         redirect('system_setup/index/','refresh');

	}






}
?>
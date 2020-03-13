<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class holiday_setup extends CI_Controller
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
		$data['nav']='holiday_setup';


  		$q=$this->db->query("SELECT calendar_ID,non_working_time,detail
                          FROM `non_working_time`  
                          where delete_flag = 0 and non_working_time like '".date('Y')."%'") ;
        $data['result']=$q->result();

        $q=$this->db->query("SELECT calendar_ID,non_working_time,detail
                          FROM `non_working_time`  
                          where  delete_flag = 0  and non_working_time like '".(date('Y')+1)."%'");
        $data['result_data']=$q->result();



		$this->load->view('template/v_header',$data);
		$this->load->view('v_holiday_setup',$data);
		$this->load->view('template/v_footer');
	}

	public function add_holiday_data(){
		$data['user']=$this->session->userdata('login');
		$data['nav']='holiday_setup';

		$data['date_holiday']=$this->input->post('add_date');
		$data['holiday']=$this->input->post('add_holiday');
		

		$data['store_name']="call mleave09_rev1(
								'".$data['date_holiday']."',
								'".$data['holiday']."',
								'".$data['user']['user_ID']."',
								null
							)";
		$this->all_model->call_not($data['store_name']);
		

		redirect('holiday_setup/index/','refresh');

		
	}

	public function edit_holiday_data($calendar_ID){
		$data['user']=$this->session->userdata('login');
		$data['nav']='holiday_setup';

		$data['date_holiday']=$this->input->post('add_date');
		$data['holiday']=$this->input->post('add_holiday');
		$data['calendar_ID']=$calendar_ID;

		$data['store_name']="call mleave09_rev1(

								'".$data['date_holiday']."',
								'".$data['holiday']."',
								'".$data['user']['user_ID']."',
								'".$data['calendar_ID']."'
							)";
		$this->all_model->call_not($data['store_name']);
		

		redirect('holiday_setup/','refresh');

		
	}

	public function del_holiday_data($calendar_ID){

		 $data_del_holiday=$this->db->query(" UPDATE non_working_time SET delete_flag = 1	
											WHERE calendar_ID = '".$calendar_ID."'			
										 ");
         redirect('holiday_setup/index/','refresh');
		
	}







}
?>
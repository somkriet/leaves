<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class edit_time_att extends CI_Controller
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
		// print_r($data['user']['user_ID']); exit();
		$data['nav']='';
		$data['starttime']=$this->input->post('search_start_date');
		$data['endtime']=$this->input->post('search_end_date');
		$data['user_id']=$this->input->post('txt_employee');
		$data['depart_id']=$this->input->post('txt_depart');
		$data['department'] = $this->all_model->call_all("SELECT department_ID,department_Name FROM department WHERE delete_flag = 0");
		if(isset($_POST['search_time'])){
			$data['search_time_att'] = $this->all_model->call_all("CALL mleave41_rev1(
																			".($data['user_id']==""?"NULL":"".$data['user_id']."").",
																			".($data['depart_id']==""?"NULL":"".$data['depart_id']."").",
																			'".$data['starttime']."',
																			'".$data['endtime']."')"); 
		// echo "<pre>"; print_r($data['search_time_att']); echo "</pre>"; exit();
		}
		$this->load->view('template/v_header',$data);
		$this->load->view('v_edit_time_att',$data);
		$this->load->view('template/v_footer');
	}
	public function run_employee(){
		$depart_id = $this->input->post("depart_id");
		$data = $this->all_model->call_all("SELECT * FROM user where department_ID = '$depart_id' AND user_status = 0");
		echo json_encode($data);
	}
	public function save_newtime(){
		$data['user']=$this->session->userdata('login');
		$datenow=date("Y-m-d H:i:s");
		$workid = $this->input->post("workid");
		$dates = $this->input->post("dates");
		$timein = $this->input->post("timein");
		$timeout = $this->input->post("timeout");
		$this->all_model->call_not("INSERT INTO temp_edit_time (temp_work_id,temp_rec_date,temp_time_in,temp_time_out,active_by,active_date)
									VALUES ('$workid','$dates','$timein','$timeout',".$data['user']['user_ID'].",'$datenow')");
		$data = 'success';
		echo json_encode($data);
	}
}
?>
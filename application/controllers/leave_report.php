<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave_report extends CI_Controller
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
		$data['leave_group'] = $this->all_model->call_all("SELECT leave_group_ID, leave_group_Name FROM leave_group WHERE delete_flag = 0");
		$data['user']=$this->session->userdata('login');
		$data['depart'] = $data['user']['department_ID'];
		$data['datefrom'] = $this->input->post('datefrom');
		$data['dateto'] = $this->input->post('dateto');
		$data['typeleave'] = $this->input->post('txt_req_type');
		$data['type'] = '1';
		if($data['datefrom'] == ""){
			$data['datefrom'] = date('Y-m-01');
		}
		if($data['dateto'] == ""){
			$data['dateto'] = date('Y-m-t');
		}
		// echo date('Y-m-01').'=='.date('Y-m-t'); exit();
		// echo "<pre>"; print_r($data['user']); echo "</pre>"; exit();
		$data['nav']='leave_report';
		$data['store_name']="call mleave28_rev1(
							".$data['type'].",
							'".$data['depart']."',
							'".$data['datefrom']."',
							'".$data['dateto']."',
							'".$data['typeleave']."'
							)";
		$data['report']=$this->all_model->call_store($data);

		if(isset($_POST['search'])){
			// echo $data['store_name']; exit();
			$data['type'] = $this->input->post('type_user');
			$data['typeleave'] = $this->input->post('txt_req_type');
			// echo $data['type']; exit();
			$data['store_name']="call mleave28_rev1(
							'".$data['type']."',
							'".$data['depart']."',
							'".$data['datefrom']."',
							'".$data['dateto']."',
							'".$data['typeleave']."'
							)";
			$data['report']=$this->all_model->call_store($data);
			// echo $data['store_name']; exit();
			// echo "<pre>"; print_r($data['store_name']); echo "</pre>"; exit();
		}
		// echo $data['store_name']; exit();
		// echo "<pre>"; print_r($data['report']); echo "</pre>"; exit();
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_report',$data);
		$this->load->view('template/v_footer');
	}
	public function report_manager(){
		$data['user']=$this->session->userdata('login');
		$data['depart'] = $data['user']['department_ID'];
		$data['datefrom'] = $this->input->post('datefrom');
		$data['dateto'] = $this->input->post('dateto');
		$data['typeleave'] = $this->input->post('txt_req_type');
		if($data['user']['user_type_ID'] == 1){
			$data['type'] = 2;
		}elseif($data['user']['user_type_ID'] == 2){
			$data['type'] = 3;
		}elseif($data['user']['user_type_ID'] == 3){
			$data['type'] = 4;
		}else{
			$data['type'] = 1;
		}
		if($data['datefrom'] == ""){
			$data['datefrom'] = date('Y-m-01');
		}
		if($data['dateto'] == ""){
			$data['dateto'] = date('Y-m-t');
		}
		// echo "<pre>"; print_r($data['user']); echo "</pre>"; exit();
		$data['nav']='leave_report';
		$data['store_name']="call mleave28_rev1(
							".$data['type'].",
							'".$data['depart']."',
							'".$data['datefrom']."',
							'".$data['dateto']."',
							'".$data['typeleave']."'
							)";
		$data['report']=$this->all_model->call_store($data);

		if(isset($_POST['search'])){
			$data['type'] = $this->input->post('type_user');
			// echo $data['type']; exit();
			$data['store_name']="call mleave28_rev1(
							'".$data['type']."',
							'".$data['depart']."',
							'".$data['datefrom']."',
							'".$data['dateto']."',
							'".$data['typeleave']."'
							)";
			$data['report']=$this->all_model->call_store($data);
			
		}
		// echo $data['store_name']; exit();
		// echo "<pre>"; print_r($data['report']); echo "</pre>"; exit();
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_report',$data);
		$this->load->view('template/v_footer');
	}
	public function showdetail(){
		$userid = $this->input->post("user_id");
		$depart = $this->input->post("depart");
		$datefrom = $this->input->post("datefrom");
		$dateto = $this->input->post("dateto");
		$usertype = $this->input->post("usertype");

		$query = "SELECT leaves.subject, leaves.detail, leaves.total_date, leaves.start_date, leaves.end_date, user.name_en, user.surname_en,
				user.name_th,user.surname_th
					FROM leaves
					INNER JOIN user ON user.user_ID = leaves.user_leave
				WHERE acceptation_ID NOT IN (0, 3)
				AND ((start_date BETWEEN '$datefrom' AND '$dateto') OR (end_date BETWEEN '$datefrom' AND '$dateto'))
				AND user_leave = $userid
				AND delete_flag = 0";
		$data = $this->all_model->call_all($query);
		// $data = $this->all_model->call_all("CALL mleave31_rev1(".$usertype.",".$userid.",".$depart.",'$datefrom','$dateto')");
		echo json_encode($data);
	}
}
?>

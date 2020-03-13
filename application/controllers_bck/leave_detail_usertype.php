<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave_detail_usertype extends CI_Controller
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
		$data['user'] = $this->session->userdata('login');
		$data['type'] = 1;
		$data['department'] = $data['user']['department_ID'];
		// echo "<pre>"; print_r($data['user']); echo "</pre>"; exit();
		$data['nav']="";
		// $data['datefrom'] = $this->input->post("search_start_date");
		// $data['dateto'] = $this->input->post("search_end_date");
		$yearnow = date("Y");
		$data['date_from']=date('Y-m-01');
		$data['date_to']=date('Y-m-t');
		$data['depart']=$this->all_model->call_all("SELECT department_ID,department_Name FROM department");
		$data['employee'] = $this->all_model->call_all("SELECT * FROM user where department_ID = '".$data['department']."' AND user_status = 0");
		$data['store_name']="call mleave30_rev1(".$data['type'].",".$data['department'].")";
		$data['data_dealer']=$this->all_model->call_store($data);
		// echo "<pre>"; print_r($data['data_dealer']); echo "</pre>"; exit();
				
		if(isset($_POST['leave_data_search'])){
			$data['user'] = $this->session->userdata('login');
			$data['department'] = $data['user']['department_ID'];
		    $data['date_from']=$this->input->post('search_start_date');
			$data['date_to']=$this->input->post('search_end_date');
			$data['type']=$this->input->post('typeuser');
			$data['s_department']=$this->input->post('txt_depart');
			$data['user_leave_1']=$this->input->post("txt_employee_1");
			$data['user_leave_2']=$this->input->post("txt_employee_2");
			if(!empty($data['user_leave_1'])){
				$data['user_leave']=$data['user_leave_1'];
			}elseif(!empty($data['user_leave_2'])){
				$data['user_leave']=$data['user_leave_2'];
			}else{
				$data['user_leave']='null';
			}
			// IN user_ID int(7), IN department_ID int(2), IN start_date date, IN end_date date

			$data['store_name']="call mleave31_rev1(".$data['type'].",
								".$data['user_leave'].",
								".($data['s_department']==""?"null":"".$data['s_department']."").",
								'".$data['date_from']."',
								'".$data['date_to']."'
								)";
			// echo $data['store_name']; exit();
			$data['data_dealer']=$this->all_model->call_store($data);
        }

		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_detail_usertype',$data);
		$this->load->view('template/v_footer');
	}
	public function detail_chktype()
	{
		$data['user']=$this->session->userdata('login');
		if($data['user']['user_type_ID'] == 1){
			$data['type'] = 2;
		}elseif($data['user']['user_type_ID'] == 2){
			$data['type'] = 3;
		}elseif($data['user']['user_type_ID'] == 3){
			$data['type'] = 4;
		}else{
			$data['type'] = 1;
		}
		$data['department'] = $data['user']['department_ID'];
		// echo "<pre>"; print_r($data['user']); echo "</pre>"; exit();
		$yearnow = date("Y");
		$data['date_from']=date_format(date_create($yearnow."-01-01"),"Y-m-d");
		$data['date_to']=date_format(date_create($yearnow."-01-31"),"Y-m-d");
		$data['nav']="";
		$data['depart']=$this->all_model->call_all("SELECT department_ID,department_Name FROM department");
		$data['employee'] = $this->all_model->call_all("SELECT * FROM user where department_ID = '".$data['department']."' AND user_status = 0");
		$data['store_name']="call mleave30_rev1(".$data['type'].",".$data['department'].")";
		$data['data_dealer']=$this->all_model->call_store($data);

		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_detail_usertype',$data);
		$this->load->view('template/v_footer');
	}
	public function showdetail(){
		$leave_id = $this->input->post("leave_id");
		$data = $this->all_model->call_all("SELECT leave_detail.leave_date,leave_detail.start_time,leave_detail.end_time,leaves.detail,leaves.subject 
											FROM leave_detail 
											INNER JOIN leaves ON leaves.leave_ID = leave_detail.leave_id 
											WHERE leave_detail.leave_id = '$leave_id'");
		echo json_encode($data);
	}
	public function run_employee(){
		$depart_id = $this->input->post("depart_id");
		$data = $this->all_model->call_all("SELECT * FROM user where department_ID = '$depart_id' AND user_status = 0");
		echo json_encode($data);
	}
	public function del_leave_id(){
		$leave_id = $this->input->post("l_id");
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$data['updel'] = $this->all_model->call_all("call mleave37_rev1('$leave_id')"); 
		$this->load->library('email');	
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการยกเลิกการลา";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('jatupon@meikoasia.com,nared@meikoasia.com'); 
			// $this->email->to('pornpimon@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			// $this->email->to('hr_alert@meikoasia.com'); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			// $this->email->message($msg.$show_pay."</br></br><a href='".base_url('index.php/leave_approve')."'>".base_url('index.php/leave_approve')."</a>");	
			$this->email->send();
		$data = $data['updel']->SUCCESS;
		echo json_encode($data);
	}
}
?>

<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave_approve extends CI_Controller
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
		$data['nav']='leave_approve';
		$data['type']='1';
		// echo '<pre>',print_r($data['user']),'</pre>';
		$data['store_name']="call mleave24_rev1('".$data['user']['email']."')";
		$data['leave_approve_detail']=$this->all_model->call_store($data);

		foreach($data['leave_approve_detail'] as $key => $value){
			$query="call mleave40_rev1('".$value->leave_ID."')";
			$data['leave_approve_detail'][$key]->search=$this->all_model->call_all($query);
		}
		// echo "<pre>"; print_r($data['leave_approve_detail']); echo "</pre>"; exit();
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_approve',$data);
		$this->load->view('template/v_footer');
	}
	public function approve_hr()
	{
		$data['user']=$this->session->userdata('login');
		$data['nav']='leave_approve';
		$data['type']='2';
		// echo '<pre>',print_r($data),'</pre>';
		$data['store_name']="call mleave25_rev1()";
		$data['leave_approve_detail']=$this->all_model->call_store($data);
		// echo '<pre>',print_r($data['leave_approve_detail']),'</pre>'; exit();
		// $data['store_name']="call mleave25_rev1('".$data['user']['send_email_to']."')";
		// $data['data_leave_approve']=$this->all_model->call_store($data);
		foreach($data['leave_approve_detail'] as $key => $value){
			$query="call mleave40_rev1('".$value->leave_ID."')";
			$data['leave_approve_detail'][$key]->search=$this->all_model->call_all($query);
		}
		// echo "<pre>"; print_r($data['leave_approve_detail']); echo "</pre>"; exit();
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_approve',$data);
		$this->load->view('template/v_footer');
	}

	public function showdetail(){
		$userid = $this->input->post("userid");
		$leave_id = $this->input->post("leave_id");
		
		// $data['store_name']="call mleave26_rev1('$leave_id')";
		$data['store_name'] = "call mleave03_rev1('$userid')";
		$data['detail1'] = $this->all_model->call_store($data);
		$data['detail2'] = $this->all_model->call_all("SELECT leave_date,start_time,end_time FROM leave_detail where leave_id = '$leave_id'");
		// $data="call mleave26_rev1('".$leave_ID."')";

		// $data=$this->all_model->call_store("call mleave26_rev1('".$leave_ID."')");
		// $data = $this->all_model->call_all("SELECT leave_date,start_time,end_time FROM leave_detail where leave_id = '$leave_id'");
		echo json_encode($data);
	}

	public function approve_pay(){
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$data['user']=$this->session->userdata('login');
		// $data['store_name']="call mleave27_rev1($type,'$leave_id',1,".$data['user']['user_ID'].")";
		// $data = 
		// $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',1,".$data['user']['user_ID'].")");
		// echo json_encode($data);
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE (user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2))) and user_status = 0");
		//$data['send_hr'] = $this->all_model->call_all("SELECT email FROm user WHERE user_type_id = 5 or (department_id = 7 and user_type_ID <> 3) and user_status = 0");
		// $data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE user_ID in (2204, 2242)");
		// $countemail = count($data['send_hr']);
		$arr_emailhr = "";
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		// echo json_encode($emailhr);
		// exit();
		$this->load->library('email');	
		if($type == '1'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',1,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nManager ได้ทำการ อนุมัติ(จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('pornpimon@meikoasia.com'); 
			$this->email->to($emailhr); 
			$this->email->subject('Leave requrest from');
			// $this->email->message($msg);
			$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			$this->email->send();
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',4,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('hr_alert@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			// $this->email->to('jatupon@meikoasia.com,nared@meikoasia.com'); 
			// $sendemail = $this->all_model->call_all("SELECT send_email_to FROM user where user_ID = $userid");
			// $this->email->to($sendemail[0]->send_email_to); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			// $this->email->message($msg.$show_pay."</br></br><a href='".base_url('index.php/leave_approve')."'>".base_url('index.php/leave_approve')."</a>");	
			$this->email->send();
		}

		echo json_encode($data);
	}
	public function approve_unpay(){
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$data['user']=$this->session->userdata('login');
		// $data['store_name']="call mleave27_rev1($type,'$leave_id',2,".$data['user']['user_ID'].")";
		// $data = $this->all_model->call_store($data);
		
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2)) and user_status = 0");
		$arr_emailhr = "";
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		$this->load->library('email');	
		if($type == '1'){
			// $data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',2,".$data['user']['user_ID'].")");
			// $msg = "MleaveOnline";
			// $msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			// $msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			// $msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			// $nsg .= "\r\nManager ได้ทำการ อนุมัติ(ไม่จ่าย)";
			// $this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// // // $this->email->to('jatupon@meikoasia.com,nared@meikoasia.com'); 
			// // // $this->email->to($emailhr); 
			// $this->email->to('pornpimon@meikoasia.com'); 
			// $this->email->subject('Leave requrest from');
			// // $this->email->message($msg);
			// $this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			// // // $this->email->message($msg.$show_pay."</br></br><a href='".base_url('index.php/leave_approve')."'>".base_url('index.php/leave_approve')."</a>");	
			// $this->email->send();
			// echo json_encode($data);
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',1,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nManager ได้ทำการ อนุมัติ(ไม่จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$this->email->to('pornpimon@meikoasia.com'); 
			// $this->email->to($emailhr); 
			$this->email->subject('Leave requrest from');
			// $this->email->message($msg);
			$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			$this->email->send();
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',5,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(ไม่จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('jatupon@meikoasia.com,nared@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			// $this->email->to('hr_alert@meikoasia.com'); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			// $this->email->message($msg.$show_pay."</br></br><a href='".base_url('index.php/leave_approve')."'>".base_url('index.php/leave_approve')."</a>");	
			$this->email->send();
		}
		echo json_encode($data);
	}
	public function no_approve(){
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$data['user']=$this->session->userdata('login');
		// $data['store_name']="call mleave27_rev1($type,'$leave_id',3,".$data['user']['user_ID'].")";
		// $data = $this->all_model->call_store($data);
		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',3,".$data['user']['user_ID'].")");
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$this->load->library('email');	
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nManager ได้ทำการไม่อนุมัติการลา";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('jatupon@meikoasia.com,nared@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			// $this->email->to('hr_alert@meikoasia.com'); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			// $this->email->message($msg.$show_pay."</br></br><a href='".base_url('index.php/leave_approve')."'>".base_url('index.php/leave_approve')."</a>");	
			$this->email->send();
		echo json_encode($data);
	}

	function get_leave_dupp()
	{
		$leave_ID=$this->input->post('leave_ID');

		if(!empty($leave_ID)){
			$query="CALL mleave40_rev1('$leave_ID')";
			$res=$this->all_model->call_all($query);
		}else{
			$res="";
		}

		echo json_encode($res);
	}
}
?>
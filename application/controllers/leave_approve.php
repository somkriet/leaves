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
		// $data['type_mgr'] = "";
		$data['store_name']="call mleave25_rev1()";
		$data['leave_approve_detail']=$this->all_model->call_store($data);
		foreach($data['leave_approve_detail'] as $key => $value){
			$query="call mleave40_rev1('".$value->leave_ID."')";
			$data['leave_approve_detail'][$key]->search=$this->all_model->call_all($query);
		}
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_approve',$data);
		$this->load->view('template/v_footer');
	}

	public function showdetail(){
		$userid = $this->input->post("userid");
		$leave_id = $this->input->post("leave_id");
		$data['store_name'] = "call mleave03_rev1('$userid')";
		$data['detail1'] = $this->all_model->call_store($data);
		$data['detail2'] = $this->all_model->call_all("SELECT leave_detail.leave_date,leave_detail.start_time,leave_detail.end_time,leaves.detail FROM leave_detail
			INNER JOIN leaves ON leaves.leave_ID = leave_detail.leave_ID where leave_detail.leave_ID = '$leave_id'");
		echo json_encode($data);
	}

	public function approve_pay(){
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		$approve_type = $this->input->post("approve_type");
		$data['user']=$this->session->userdata('login');
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$email_sr = $data['sendemail'][0]->send_email_to;
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE (user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2))) and user_status = 0");
		$arr_emailhr = "";
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		$this->load->library('email');	
		// echo "call mleave27_rev1($type,'$leave_id','$approve_type',".$data['user']['user_ID'].")";
		if($type == '1'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id','$approve_type',".$data['user']['user_ID'].")");
			
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการ อนุมัติ(จ่าย)";
				$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
				if(!empty($email_sr)){
					$this->email->to($email_sr); 
				}else{
					// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
					$this->email->to($emailhr); 
				}
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
			}else if($type_mgr == 2){
				$msg .= "\r\nผู้อนุมัติครั้งที่2 ได้ทำการ อนุมัติ(จ่าย)";
				$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
				// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
				$this->email->to($emailhr); 
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			}
			
			$this->email->send();
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',4,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('pornpimon@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
		}
		$num = "success";
		echo json_encode($num);
	}
	public function approve_unpay(){
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		$approve_type = $this->input->post("approve_type");
		$data['user']=$this->session->userdata('login');
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2)) and user_status = 0");
		$arr_emailhr = "";
		$email_sr = $data['sendemail'][0]->send_email_to;
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		$this->load->library('email');	
		if($type == '1'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id','$approve_type',".$data['user']['user_ID'].")");
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการ อนุมัติ(ไม่จ่าย)";
				if(!empty($email_sr)){
					$this->email->to($email_sr); 
				}else{
					// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
					$this->email->to($emailhr); 
				}
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");
			}else if($type_mgr == 2){
				$msg .= "\r\nผู้อนุมัติครั้งที่2 ได้ทำการ อนุมัติ(ไม่จ่าย)";
				// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
				$this->email->to($emailhr); 
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");
			}
			$this->email->send();	
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',5,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(ไม่จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			// $this->email->to($emailhr); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
		}
		$num = "success";
		echo json_encode($num);
	}
	public function no_approve(){
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		$data['user']=$this->session->userdata('login');
		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',3,".$data['user']['user_ID'].")");
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
		$email_sr = $data['sendemail'][0]->send_email_to;
		$this->load->library('email');
		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');	
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการไม่อนุมัติการลา";
				// $this->email->to('pornpimon@meikoasia.com');
				$this->email->to($data['sendemail'][0]->email); 
			}else if($type_mgr == 2){
				$msg .= "\r\nผู้อนุมัติครั้งที่2 ได้ทำการไม่อนุมัติการลา";
				// $this->email->to('pornpimon@meikoasia.com'); 
				$this->email->to($data['sendemail'][0]->email); 
			}
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
			$num = "success";
		echo json_encode($num);
	}
	// public function approve_pay_all(){
	// 	$num = $this->input->post("num");
	// 	$leave_id = $this->input->post("leave_id");
	// 	$type = $this->input->post("type");
	// 	$type_mgr = $this->input->post("type_mgr");
	// 	$approve_type = $this->input->post("approve_type");
	// 	$data['user']=$this->session->userdata('login');
	// 	$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
	// 	$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE (user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2))) and user_status = 0");
	// 	$email_sr = $data['sendemail'][0]->send_email_to;
	// 	$arr_emailhr = "";
	// 	foreach ($data['send_hr'] as $key => $value) {
	// 		$arr_emailhr .= $value->email.",";
	// 	}
	// 	$str = strlen($arr_emailhr);
	// 	$emailhr = substr($arr_emailhr, 0,$str-1);
	// 	$this->load->library('email');	
	// 	if($type == '1'){
	// 		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id','$approve_type',".$data['user']['user_ID'].")");
	// 		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
	// 		$msg = "MleaveOnline";
	// 		$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
	// 		$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
	// 		$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
	// 		if($type_mgr == 1){
	// 			$msg .= "\r\nManager ได้ทำการ อนุมัติ(จ่าย)";
	// 			if(!empty($email_sr)){
	// 				$this->email->to($email_sr); 
	// 			}else{
	// 				$this->email->to('nitivadee@meikoasia.com','pornpimon@meikoasia.com'); 
	// 				// $this->email->to($emailhr); 
	// 			}
	// 			$this->email->subject('Leave requrest from');
	// 			$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
	// 		}else if($type_mgr == 2){
	// 			$msg .= "\r\nSenior Manager ได้ทำการ อนุมัติ(จ่าย)";
	// 			$this->email->to('pornpimon@meikoasia.com'); 
	// 			// $this->email->to($emailhr); 
	// 			$this->email->subject('Leave requrest from');
	// 			$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
	// 		}
	// 		// $this->email->send();
	// 	}else if($type == '2'){
	// 		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',4,".$data['user']['user_ID'].")");
	// 		$msg = "MleaveOnline";
	// 		$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
	// 		$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
	// 		$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
	// 		$msg .= "\r\nHR ได้ทำการ อนุมัติ(จ่าย)";
	// 		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
	// 		// $this->email->to('pornpimon@meikoasia.com'); 
	// 		$this->email->to($data['sendemail'][0]->email); 
	// 		$this->email->subject('Leave requrest from');
	// 		$this->email->message($msg);
	// 		// $this->email->send();
	// 	}
	// 	echo json_encode($num);
	// }
	// public function approve_unpay_all(){
	// 	$num = $this->input->post("num");
	// 	$leave_id = $this->input->post("leave_id");
	// 	$type = $this->input->post("type");
	// 	$type_mgr = $this->input->post("type_mgr");
	// 	$approve_type = $this->input->post("approve_type");
	// 	$data['user']=$this->session->userdata('login');
	// 	$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
	// 	$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2)) and user_status = 0");
	// 	$arr_emailhr = "";
	// 	$email_sr = $data['sendemail'][0]->send_email_to;
	// 	foreach ($data['send_hr'] as $key => $value) {
	// 		$arr_emailhr .= $value->email.",";
	// 	}
	// 	$str = strlen($arr_emailhr);
	// 	$emailhr = substr($arr_emailhr, 0,$str-1);
	// 	$this->load->library('email');	
	// 	$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
	// 	// echo "call mleave27_rev1($type,'$leave_id',2,".$data['user']['user_ID'].")"; 
	// 	if($type == '1'){
	// 		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id','$approve_type',".$data['user']['user_ID'].")");
	// 		$msg = "MleaveOnline";
	// 		$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
	// 		$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
	// 		$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
	// 		if($type_mgr == 1){
	// 			$msg .= "\r\nManager ได้ทำการ อนุมัติ(ไม่จ่าย)";
	// 			if(!empty($email_sr)){
	// 				$this->email->to($email_sr); 
	// 			}else{
	// 				$this->email->to('nitivadee@meikoasia.com','pornpimon@meikoasia.com'); 
	// 				// $this->email->to($emailhr); 
	// 			}
	// 			$this->email->subject('Leave requrest from');
	// 			$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
	// 		}else if($type_mgr == 2){
	// 			$msg .= "\r\nSenior Manager ได้ทำการ อนุมัติ(ไม่จ่าย)";
	// 			$this->email->to('nitivadee@meikoasia.com','pornpimon@meikoasia.com'); 
	// 			// $this->email->to($emailhr); 
	// 			$this->email->subject('Leave requrest from');
	// 			$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
	// 		}
	// 		// $this->email->send();
	// 	}else if($type == '2'){
	// 		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',5,".$data['user']['user_ID'].")");
	// 		$msg = "MleaveOnline";
	// 		$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
	// 		$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
	// 		$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
	// 		$msg .= "\r\nHR ได้ทำการ อนุมัติ(ไม่จ่าย)";
	// 		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
	// 		$this->email->to($data['sendemail'][0]->email); 
	// 		// $this->email->to('pornpimon@meikoasia.com'); 
	// 		$this->email->subject('Leave requrest from');
	// 		$this->email->message($msg);
	// 		// $this->email->send();
	// 	}
	// 	echo json_encode($num);
	// }
	// public function no_approve_all(){
	// 	$num = $this->input->post("num");
	// 	$leave_id = $this->input->post("leave_id");
	// 	$type = $this->input->post("type");
	// 	$data['user']=$this->session->userdata('login');
	// 	$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leave_id',3,".$data['user']['user_ID'].")");
	// 	$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leave_id')");
	// 	$this->load->library('email');	
	// 		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
	// 		$msg = "MleaveOnline";
	// 		$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
	// 		$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
	// 		$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
	// 		if($type_mgr == 1){
	// 			$msg .= "\r\nManager ได้ทำการไม่อนุมัติการลา";
	// 			// $this->email->to('pornpimon@meikoasia.com');
	// 			$this->email->to($data['sendemail'][0]->email); 
	// 		}else if($type_mgr == 2){
	// 			$msg .= "\r\nSenior Manager ได้ทำการไม่อนุมัติการลา";
	// 			// $this->email->to('pornpimon@meikoasia.com'); 
	// 			$this->email->to($data['sendemail'][0]->email); 
	// 		}
	// 		$this->email->subject('Leave requrest from');
	// 		$this->email->message($msg);
	// 		// $this->email->send();
	// 	echo json_encode($num);
	// }
	public function approve_pay_all(){
		// $num = $this->input->post("num");
		$leave_id = $this->input->post('leave_id');
		$count = count($leave_id);
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		$approve_type = $this->input->post("approve_type");
		$data['user']=$this->session->userdata('login');
		for ($i=0; $i < $count; $i++) { 
		$leaves = $leave_id[$i];
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leaves')");
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE (user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2))) and user_status = 0");
		$email_sr = $data['sendemail'][0]->send_email_to;
		$arr_emailhr = "";
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		$this->load->library('email');	
		if($type == '1'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves','$approve_type',".$data['user']['user_ID'].")");
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				
				if(!empty($email_sr)){
					$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการ อนุมัติ(จ่าย)";
					$this->email->to($email_sr); 
				}else{
					$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการ อนุมัติ(จ่าย)";
					// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
					$this->email->to($emailhr); 
				}
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
			}else if($type_mgr == 2){
				$msg .= "\r\nผู้อนุมัติครั้งที่2 ได้ทำการ อนุมัติ(จ่าย)";
				// $this->email->to('pornpimon@meikoasia.com,jatupon@meikoasia.com'); 
				$this->email->to($emailhr); 
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			}
			$this->email->send();
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves',4,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('pornpimon@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
		}
	}
		$data = "success";
		echo json_encode($data);
	}
	public function approve_unpay_all(){
		$leave_id = $this->input->post('leave_id');
		$count = count($leave_id);
		$num = $this->input->post("num");
		$leave_id = $this->input->post("leave_id");
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		$approve_type = $this->input->post("approve_type");
		$data['user']=$this->session->userdata('login');
		for ($i=0; $i < $count; $i++) { 
		$leaves = $leave_id[$i];
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leaves')");
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2)) and user_status = 0");
		$arr_emailhr = "";
		$email_sr = $data['sendemail'][0]->send_email_to;
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		$this->load->library('email');	
		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
		// echo "call mleave27_rev1($type,'$leave_id',2,".$data['user']['user_ID'].")"; 
		if($type == '1'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves','$approve_type',".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				
				if(!empty($email_sr)){
					$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการ อนุมัติ(ไม่จ่าย)";
					$this->email->to($email_sr); 
				}else{
					$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการ อนุมัติ(ไม่จ่าย)";
					// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
					$this->email->to($emailhr); 
				}
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
			}else if($type_mgr == 2){
				$msg .= "\r\nผู้อนุมัติครั้งที่2 ได้ทำการ อนุมัติ(ไม่จ่าย)";
				// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 
				$this->email->to($emailhr); 
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			}
			$this->email->send();
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves',5,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(ไม่จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$this->email->to($data['sendemail'][0]->email); 
			// $this->email->to('pornpimon@meikoasia.com'); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
		}
	}
		$data = "success";
		echo json_encode($data);
	}
	public function no_approve_all(){
		$leave_id = $this->input->post('leave_id');
		$count = count($leave_id);
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		//$leave_id = $this->input->post("leave_id");
		// $num = $this->input->post("num");
		for ($i=0; $i < $count; $i++) { 
		$leaves = $leave_id[$i];
		$data['user']=$this->session->userdata('login');
		$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves',3,".$data['user']['user_ID'].")");
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leaves')");
		$this->load->library('email');	
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nตั้งแต่วันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				$msg .= "\r\nผู้อนุมัติครั้งที่1 ได้ทำการไม่อนุมัติการลา";
				// $this->email->to('pornpimon@meikoasia.com');
				$this->email->to($data['sendemail'][0]->email); 
			}else if($type_mgr == 2){
				$msg .= "\r\nผู้อนุมัติครั้งที่2 ได้ทำการไม่อนุมัติการลา";
				// $this->email->to('pornpimon@meikoasia.com'); 
				$this->email->to($data['sendemail'][0]->email); 
			}
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
		}
		$test = "success";
		echo json_encode($test);
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
	function test(){
		$leave_id = $this->input->post('leave_id');
		// $leaveid = array($leave_id );
		$count = count($leave_id);
		$type = $this->input->post("type");
		$type_mgr = $this->input->post("type_mgr");
		$approve_type = $this->input->post("approve_type");
		
		for ($i=0; $i < $count; $i++) { 
		$leaves = $leave_id[$i];
		$data['user']=$this->session->userdata('login');
		$data['sendemail'] = $this->all_model->call_all("call mleave34rev_1('$leaves')");
		$data['send_hr'] = $this->all_model->call_all("SELECT email FROM user WHERE user_type_id = 5 or (department_id = 7 and user_type_ID IN (1, 2)) and user_status = 0");
		$arr_emailhr = "";
		$email_sr = $data['sendemail'][0]->send_email_to;
		foreach ($data['send_hr'] as $key => $value) {
			$arr_emailhr .= $value->email.",";
		}
		$str = strlen($arr_emailhr);
		$emailhr = substr($arr_emailhr, 0,$str-1);
		$this->load->library('email');	
		if($type == '1'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves','$approve_type',".$data['user']['user_ID'].")");
			// echo json_encode(value)
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			if($type_mgr == 1){
				$msg .= "\r\nManager ได้ทำการ อนุมัติ(จ่าย)";
				if(!empty($email_sr)){
					$this->email->to($email_sr); 
					// $this->email->to('pornpimon@meikoasia.com'); 
				}else{
					$this->email->to('pornpimon@meikoasia.com'); 
					// $this->email->to($emailhr); 
				}
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
			}else if($type_mgr == 2){
				$msg .= "\r\nSenior Manager ได้ทำการ อนุมัติ(จ่าย)";
				$this->email->to('pornpimon@meikoasia.com'); 
				// $this->email->to($emailhr); 
				$this->email->subject('Leave requrest from');
				$this->email->message($msg."\r\n{unwrap}".base_url('index.php/leave_approve/approve_hr')."{/unwrap}");	
			}
			$this->email->send();
		}else if($type == '2'){
			$data['approve'] = $this->all_model->call_all("call mleave27_rev1($type,'$leaves',4,".$data['user']['user_ID'].")");
			$msg = "MleaveOnline";
			$msg .= "\r\n".$data['sendemail'][0]->leave_type_Name;
			$msg .= "\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($data['sendemail'][0]->start_date));
			$msg .= "\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($data['sendemail'][0]->end_date));
			$msg .= "\r\nHR ได้ทำการ อนุมัติ(จ่าย)";
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			// $this->email->to('pornpimon@meikoasia.com'); 
			$this->email->to($data['sendemail'][0]->email); 
			$this->email->subject('Leave requrest from');
			$this->email->message($msg);
			$this->email->send();
		}
	}
			$data = "success";
			echo json_encode($data);

	}
}
?>
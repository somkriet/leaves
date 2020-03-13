<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave extends CI_Controller
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
		$data['nav']='add_leave';
		$data['user_leave']=$this->input->post('txt_user_leave');
		$data['userid'] = $data['user']['user_ID'];
		// echo $data['userid']; exit();
		// print_r($data['user']); exit();
		// echo date('ymdHis'); exit();
		$data['employee'] = $this->all_model->call_all("SELECT * FROM USER Where user_status = '0'");
		$data['leave_group'] = $this->all_model->call_all("SELECT leave_group_ID, leave_group_Name FROM leave_group WHERE delete_flag = 0");
		if(isset($_POST['btnSubmit'])){
		$data['user']=$this->session->userdata('login');
		$data['nav']='add_leave';
		$data['leid'] = $this->input->post('leid');
		// $data['user_leave']=$this->input->post('user_l');
		// $data['userid'] = $data['user']['user_ID'];
		// $data['subject'] = $this->input->post('txt_topic');
		// $data['detail'] = $this->input->post('txt_desc');
		// // $data['user_leave'] = $this->input->post('txt_user_leave');
		// $data['type_leave'] = $this->input->post('type_l');
		// $data['datefrom'] = $this->input->post('txt_date_from');
		// $data['dateto'] = $this->input->post('txt_date_to');
		// $data['l_group'] = $this->input->post('group_l');
		// $data['l_progress'] = $this->input->post('progress_l');
		// $data['l_pay'] = $this->input->post('pay_l');
		// $data['cost'] =  $this->input->post('txt_cost');
		// echo $data['detail']; exit();
		// if(isset($_POST['btn_exe_search'])){
		$datetime = date('ymdHis');
		$filename  = $_FILES['file_upload']['name'];
		$typefile  = $_FILES['file_upload']['type']; 
		$sizefile  = $_FILES['file_upload']['size']; 
		$tmpname   = $_FILES['file_upload']['tmp_name'];
		$pos = strrpos($filename, ".");
		// echo $pos; exit();
		$totalfile = strlen($filename);
		$subpic = substr($filename, 0,$pos);
		$nametype = substr($filename, $pos,$totalfile);
		// echo $nametype; exit();

		// $strpic = strlen($filename); 
		// $subpic = substr($filename, 0,$strpic-4)
		$filename_new = $datetime.$nametype;
		// echo $data['leid']; exit();
		if($filename != ""){
			$this->all_model->call_not("UPDATE leaves set leave_attached = '$filename_new' where leave_ID = '".$data['leid']."'");
		}
		
		// echo "UPDATE leaves set leave_attached = '$filename_new' where leave_ID = '".$data['leid']."'"; exit();
		// echo $filename_new; exit();
		// echo $filename."-".$datetime;
		
		$storefile = "assets/upload/".$filename_new;
		if($filename != ""){
			copy($tmpname, $storefile);
			unlink($tmpname);
		}
		}
		$this->load->view('template/v_header',$data);
		$this->load->view('v_add_leave',$data);
		$this->load->view('template/v_footer');
	}
	public function set_flash()
	{
		$type=$this->input->post('type');
		$this->session->set_flashdata('type',$type);
		echo json_encode($type);
	}
	public function leave_onjob(){
		$group_id = $this->input->post('group_id');
		// $data = $this->all_model->call_all("SELECT * FROM leave_type Where leave_group_ID = '$group_id'");
		$data = $this->all_model->call_all("SELECT * FROM progression");
		echo json_encode($data);
	}
	public function leave_type(){
		$group_id = $this->input->post('group_id');
		$data = $this->all_model->call_all("SELECT * FROM leave_type Where leave_group_ID = '$group_id' AND delete_flag = 0 AND show_flag = 1");
		echo json_encode($data);
	}
	public function leave_type_casual(){
		$data = $this->all_model->call_all("SELECT * FROM leave_type Where show_flag = '2'");
		echo json_encode($data);
	}
	public function leave_d(){
		// date_default_timezone_set('UTC');
		$datefrom = $this->input->post('datefrom');
		$dateto = $this->input->post('dateto');
		$type_leave = $this->input->post('type');
		$yearnow = date("Y");
		$yearnext = date("Y")+1;
		$yearpre = date("Y")-1;
		$on_date_1 = date_format(date_create($yearnow."-01-01"),"Y-m-d");
		$on_date_2 = date_format(date_create($yearnow."-03-31"),"Y-m-d");
		$n_date_1 = date_format(date_create($yearnow."-04-01"),"Y-m-d");
		$n_date_2 = date_format(date_create($yearnext."-03-31"),"Y-m-d");
		$o_date_1 = date_format(date_create($yearpre."-01-01"),"Y-m-d");
		$o_date_2 = date_format(date_create($yearpre."-12-31"),"Y-m-d");
		$data['chk_cal'] = $this->all_model->call_all("SELECT cal_holiday FROM leave_type Where leave_type_id = '$type_leave'");
 		if($data['chk_cal'][0]->cal_holiday == 0){
			for ($date = strtotime($datefrom); $date <= strtotime($dateto); $date = strtotime("+1 day", $date)) {
						$chkdate = date("Y-m-d", $date);
						$chk_holiday = $this->all_model->call_all("SELECT non_working_time FROM non_working_time Where non_working_time = '$chkdate' AND delete_flag = 0");
			 			// $data = $chk_holiday;
			 			$on_date = date_create(date("Y")."-03-15");
			 			// if(date('w', $date) != 6 AND date('w', $date) != 0 AND empty($chk_holiday)) {
			 			if(date('w', $date) != 0 AND empty($chk_holiday)) {
							if($chkdate >= $on_date_1 AND $chkdate <= $on_date_2){
								$date_detail[] = array(date("Y-m-d", $date),"oldnew");
							}else if($chkdate >= $o_date_1 AND $chkdate <= $o_date_2){
								$date_detail[] = array(date("Y-m-d", $date),"old");
							}else if($chkdate >= $n_date_1 AND $chkdate <= $n_date_2){
								$date_detail[] = array(date("Y-m-d", $date),"new");
							}
							
						}
					}
 		}else{
 			for ($date = strtotime($datefrom); $date <= strtotime($dateto); $date = strtotime("+1 day", $date)) {
						$chkdate = date("Y-m-d", $date);
			 			if($chkdate >= $on_date_1 AND $chkdate <= $on_date_2){
								$date_detail[] = array(date("Y-m-d", $date),"oldnew");
							}else if($chkdate >= $o_date_1 AND $chkdate <= $o_date_2){
								$date_detail[] = array(date("Y-m-d", $date),"old");
							}else if($chkdate >= $n_date_1 AND $chkdate <= $n_date_2){
								$date_detail[] = array(date("Y-m-d", $date),"new");
							}
			 			// $date_detail[] = date("Y-m-d", $date);
					}
 		}
		$data = $date_detail;
 		echo json_encode($data);
	}
	public function save_leave(){
		$data['user']=$this->session->userdata('login');
		$userid = $data['user']['user_ID'];
		$user_leave = $this->input->post('user_leave');
		$req_type = $this->input->post('req_type');
		$type_leave =$this->input->post('type_leave'); 
		$type_leave_cas = $this->input->post('type_leave_cas');
		$remark = $this->input->post('remark');
		$datefrom = $this->input->post('datefrom');
		$dateto = $this->input->post('dateto');
		$description = $this->input->post('description');
		$reasons = $this->input->post('reasons');
		$filename = $this->input->post('filename');
		$progression = $this->input->post('progression');
		$payment = $this->input->post('payment');
		$cost = $this->input->post('cost');
		$totalday = $this->input->post('totalday');
		$chk_table = $this->input->post('chk_table');
		$numoldnew = $this->input->post('numoldnew');
		$numold = $this->input->post('numold');
		$numnew = $this->input->post('numnew');
		//////////////////////////////////////////////////////////
		$user_l=$this->input->post('user_l');
		// $data['userid'] = $data['user']['user_ID'];
		// $data['subject'] = $this->input->post('txt_topic');
		// $data['detail'] = $this->input->post('txt_desc');
		// $data['user_leave'] = $this->input->post('txt_user_leave');
		$type_l = $this->input->post('type_l');
		// $data['datefrom'] = $this->input->post('txt_date_from');
		// $data['dateto'] = $this->input->post('txt_date_to');
		$group_l = $this->input->post('group_l');
		$progress_l = $this->input->post('progress_l');
		$pay_l = $this->input->post('pay_l');
		// $data['cost'] =  $this->input->post('txt_cost');
		/////////////detail/////////////////////////
		$leaveid = $this->input->post('leaveid');
		$d_date = $this->input->post('d_date');
		$d_timefrom = $this->input->post('d_timefrom');
		$d_timeto = $this->input->post('d_timeto');

		if($type_leave == '3' OR $type_leave == '4'){
			$type_leave = $type_leave_cas;
		}
		// if($type_leave == '6'){
		// 	$data['chk_leave'] = $this->all_model->call_all("CALL mleave23_rev1('$user_leave')");
		// 	$chknew = $data['chk_leave'][0]->can_leave_new;
		// 	$chkold = $data['chk_leave'][0]->can_leave_old;
		// 	$chkoldnew = $chknew+$chkold;
		// 	if($numoldnew != 0 ){
		// 		if($numoldnew > $chkoldnew){
		// 			$data = 'no';
		// 			echo json_encode($data);
		// 		}
		// 	}
		// 	if($numold != 0 ){
		// 		if($numold > $chkold){
		// 			$data = 'no';
		// 			echo json_encode($data);
		// 		}
		// 	}
		// 	if($numnew != 0 ){
		// 		if($numnew > $chknew){
		// 			$data = 'no';
		// 			echo json_encode($data);
		// 		}
		// 	}
		// }
		$numold=$numoldnew;
		if($chk_table == 'h'){
					$data = $this->all_model->call_all("CALL mleave10_rev1('$userid','$user_leave','$description','$reasons','$datefrom','$dateto','$totalday','$type_leave',
												'$remark','$progression','$payment','$cost','$filename','$numnew','$numold')");
			$this->load->library('email');	

			// $config['protocol']='smtp';
			// $config['smtp_host']='192.168.10.5';
			// $config['smtp_port']='25';
			// $config['smtp_timeout']='30';
			// $config['smtp_user']='hr_alert@meiko.co.th';
			// $config['smtp_pass']='Mbh6f';
			// $config['charset']='utf-8';
			// $this->email->initialize($config);
			if($progress_l == ""){
				$msg = "ชื่อ-นามสกุล/Name-Surname : ".$user_l;
				$msg .=	"\r\nหัวเรื่อง/Title : ".$group_l;
				$msg .=	"\r\nประเภทลา/Type Leave : ".$type_l;
				$msg .=	"\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($datefrom));
				$msg .=	"\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($dateto));
				$msg .=	"\r\nเรื่อง/Subject : ".$description;
				$msg .=	"\r\nรายละเอียด/detail : ".$reasons;
			}else{
				$msg = "ชื่อ-นามสกุล/Name-Surname : ".$user_l;
				$msg .=	"\r\nหัวเรื่อง/Title : ".$group_l;
				$msg .=	"\r\nประเภทลา/Type Leave : ".$type_l;
				$msg .=	"\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($datefrom));
				$msg .=	"\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($dateto));
				$msg .=	"\r\nเรื่อง/Subject : ".$description;
				$msg .=	"\r\nรายละเอียด/detail : ".$reasons;
				$msg .=	"\r\nเดินทางโดย : ".$progress_l."    ".$pay_l;
			}			
			if($pay_l == "มีค่าใช้จ่าย"){
				$show_pay = $cost." บาท";
			}else{
				$show_pay = "";
			}

			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$sendemail = $this->all_model->call_all("SELECT send_email_to FROM user where user_ID = $userid");
			$this->email->to($sendemail[0]->send_email_to); 
			// $this->email->to('jatupon@meikoasia.com,pornpimon@meikoasia.com'); 

			$this->email->subject('Leave requrest from');
			$this->email->message($msg.$show_pay."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");	
			
			$this->email->send();
		}else if($chk_table == 'd'){
					$this->all_model->call_not("CALL mleave12_rev1('$leaveid','$d_date','$d_timefrom','$d_timeto')");
					$data="success";
		}
		echo json_encode($data);
	}
	public function chk_date(){
		$data['user']=$this->session->userdata('login');
		$userid = $data['user']['user_ID'];
		$c_date = $this->input->post('c_date');
		$c_timefrom = $this->input->post('c_timefrom');
		$c_timeto = $this->input->post('c_timeto');
		// $data = $this->all_model->call_all("CALL mleave39_rev1('$userid','$c_date','$c_timefrom','$c_timeto')");
		// if(!empty($data)){
		// 	$res = 'ERROR';
		// }else{
		// 	$res = 'SUCCESS';
		// 	// echo "<script>alert('666666');</script>";
		// 	// echo json_encode($data);
		// }
		$res='SUCCESS';
		for($i=0; $i<count($c_date); $i++){
			$data = $this->all_model->call_all("CALL mleave39_rev1('".$userid."','".$c_date[$i]."','".$c_timefrom[$i]."','".$c_timeto[$i]."')");
			if(!empty($data)){
				$res='ERROR';
				break;
			}
		}
		echo json_encode($res);
	}
	public function chk_haveleave(){
	$user_leave = $this->input->post('user_leave');
	$type_leave =$this->input->post('type_leave'); 
	$numoldnew = $this->input->post('numoldnew');
	$numold = $this->input->post('numold');
	$numnew = $this->input->post('numnew');
		if($type_leave == '6'){
			$data['chk_leave'] = $this->all_model->call_all("CALL mleave23_rev1('$user_leave')");
			$chknew = $data['chk_leave'][0]->can_leave_new;
			$chkold = $data['chk_leave'][0]->can_leave_old;
			$chkoldnew = $chknew+$chkold;
			if($numoldnew != 0 ){
				if($numoldnew > $chkoldnew){
					$data = 'no';
					echo json_encode($data);
				}
			}
			if($numold != 0 ){
				if($numold > $chkold){
					$data = 'no';
					echo json_encode($data);
				}
			}
			if($numnew != 0 ){
				if($numnew > $chknew){
					$data = 'no';
					echo json_encode($data);
				}
			}
		}
	}
}
?>
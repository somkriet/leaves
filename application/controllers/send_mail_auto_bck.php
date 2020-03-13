<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class send_mail_auto extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
		// ini_set('MAX_EXECUTION_TIME', -1);
		set_time_limit(0);
	}

	public function index()
	{
		$sql="SELECT *
					FROM leaves l
					INNER JOIN user u ON l.user_leave = u.user_ID
					INNER JOIN leave_type lt ON l.leave_type_ID = lt.leave_type_ID
					INNER JOIN leave_group lg ON lt.leave_group_ID = lg.leave_group_ID
					LEFT JOIN progression ps ON l.progression_ID = ps.progression_ID
				WHERE l.acceptation_ID = 0
				AND l.delete_flag = 0
				ORDER BY l.start_date";
		$result=$this->all_model->call_all($sql);



		// echo '<meta charset="utf-8"><pre>',print_r($result),'</pre>';

		foreach($result as $idx => $res){
			$this->load->library('email');

			if($res->progression_ID==0){
				$msg = "ชื่อ-นามสกุล/Name-Surname : ".$res->name_th." ".$res->surname_th."/".$res->name_en." ".$res->surname_en;
				$msg .=	"\r\nหัวเรื่อง/Title : ".$res->leave_group_Name;
				$msg .=	"\r\nประเภทลา/Type Leave : ".$res->leave_type_Name;
				$msg .=	"\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($res->start_date));
				$msg .=	"\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($res->end_date));
				$msg .=	"\r\nเรื่อง/Subject : ".$res->subject;
				$msg .=	"\r\nรายละเอียด/detail : ".$res->detail;
			}else{
				$msg = "ชื่อ-นามสกุล/Name-Surname : ".$res->name_th." ".$res->surname_th."/".$res->name_en." ".$res->surname_en;
				$msg .=	"\r\nหัวเรื่อง/Title : ".$res->leave_group_Name;
				$msg .=	"\r\nประเภทลา/Type Leave : ".$res->leave_type_Name;
				$msg .=	"\r\nจากวันที่/Datefrom : ".date('d/m/Y',strtotime($res->start_date));
				$msg .=	"\r\nถึงวันที่/Dateto : ".date('d/m/Y',strtotime($res->end_date));
				$msg .=	"\r\nเรื่อง/Subject : ".$res->subject;
				$msg .=	"\r\nรายละเอียด/detail : ".$res->detail;
				$msg .=	"\r\nเดินทางโดย : ".$res->progression_Name."    ".($res->payment==0)?'ไม่มีค่าใช้จ่าย':'มีค่าใช้จ่าย';
			}

			if($res->payment != 0 and $res->costs != ""){
				$show_pay = $res->costs." บาท";
			}else{
				$show_pay = "";
			}

			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
			$this->email->to($res->send_email_to);
			$this->email->subject('Leave requrest from');

			$this->email->message($msg.$show_pay."\r\n{unwrap}".base_url('index.php/leave_approve')."{/unwrap}");

			$this->email->send();
		}
	}
}
?>
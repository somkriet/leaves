<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_mail_auto extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('calendar_model');
			$this->load->model('acceptation_model');
			$this->load->model('annual_model');		
	}
	function index()
	{

		$q_acceptation_ID=$this->db->query("SELECT *
			FROM leaves l
			join user u on u.user_ID=l.user_leave
			join leave_detail ld on ld.leave_ID=l.leave_ID
			join leave_type lt on lt.leave_type_ID=l.leave_type_ID
			WHERE acceptation_ID = '0'");
		$result_q_acceptation_ID=$q_acceptation_ID->result();

		//print_r($result_q_acceptation_ID);
// exit();
	
		$user_leave="";
		foreach ($result_q_acceptation_ID as $key => $value) {
			if ($user_leave!=$value->user_leave) {
				//echo $value->user_leave;
		
				$user_leave=$value->user_leave;
				//echo $value->user_leave;
			
			
											$result_email=$value->send_email_to;
											$message=$value->name_th." ";
											$message.=$value->surname_th." ";
											$message.=$value->leave_type_Name." วันที่ ";
											$message.=date('Y-m-d',strtotime($value->leave_date))." เวลา ".$value->start_time." ถึง ".$value->end_time."\n";

											//echo $value->user_leave;


											//print_r($result_email);
											//exit();
											$this->load->library('email');
											$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
												
											@$send_email =implode(",",$email);
											@$this->email->to($result_email);
													
											$this->email->subject('mleave send email auto');
											
											
											$link_message="\nhttp://mleave.meiko.co.th/index.php/leave/leave_approv?link_email=1";
															$message.="คลิกที่ลิงค์เพื่อ รับทราบการลา\n";
											$message.=$link_message;

											$this->email->message($message); 
											$this->email->send();
											
			}
											}

		?>
		<script type="text/javascript">
			javascript:window.open('', '_self', ''); window.close();
		</script>
		<?php

		// $result_email=array_unique($result_email);

		//  //print_r($result_email);
		// // exit();
		// foreach ($result_email as $key => $value) {
			
		// 	@$email_send.=$value.',';
		// }

		//echo substr($email_send,0,-1);
	
	}
	function test_send_email_mleave()
	{
			$this->load->library('email');
			$this->email->from('test567asd@abc.co.th', 'MleaveOnline');			
			@$this->email->to('pureepon@meikoasia.com');
					
			$this->email->subject('mleave send email auto');			
			$message="This is automatically alert email for inform LCB shipment detail. So, you can see that detail in attached file.";


			$this->email->message($message); 
			$this->email->send();
	}

}
?>

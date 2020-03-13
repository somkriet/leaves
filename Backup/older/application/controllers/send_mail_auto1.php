<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_mail_auto1 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	
	}
	function index()
	{




			
			
			//$result_email=$value->send_email_to;
			$message="test";
			

			$this->load->library('email');
			$this->email->from('hr_alert@meiko.co.th', 'Test');
				

			$this->email->to('pureepon@gmail.com');
					
			$this->email->subject('test_email');
			
			

			$this->email->message($message); 
			$this->email->send();
											
			echo 'st';

	
	}

}
?>

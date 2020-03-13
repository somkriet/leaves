<?php
/**
* represent
*/
class Represent extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login'))
		{
			redirect('login','refresh');
			exit();
		}
		else
		{
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('calendar_model');
		}
	}
}
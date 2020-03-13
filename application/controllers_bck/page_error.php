<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class page_error extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('v_page_error');
	}
}
?>
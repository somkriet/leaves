<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class home extends CI_Controller
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
		// $ars=$this->db->query("CALL mleave32_rev1(null)")->result();

		// $ers='1'.$ars[0]->temp_ID;
		// $err=explode(', ', $ers);
		// echo '<pre>',print_r($err),'</pre>'; exit();

		$data['user']=$this->session->userdata('login');
		$data['nav']='home';

		/*เรียกข้อมูลการลา*/
		 $data['store_name']="call mleave03_rev1(
							'". $data['user']['user_ID']."'
							)";
		$data['data_user_leave']=$this->all_model->call_store($data);
		/*เรียกข้อมูลการลา*/

		/*เรียกข้อมูลวันหยุดประจำปี*/
		$data['store_name']="call mleave02_rev1()";
		$data['data_holiday']=$this->all_model->call_store($data);
		/*เรียกข้อมูลวันหยุดประจำปี*/

		$this->load->view('template/v_header',$data);
		$this->load->view('v_home',$data);
		$this->load->view('template/v_footer');
	}
}
?>
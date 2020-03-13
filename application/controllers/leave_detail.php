<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class leave_detail extends CI_Controller
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
		$data['nav']='leave_detail';
		$yearnow = date("Y");
		$data['date_from']=date('Y-m-01');
		$data['date_to']=date('Y-m-t');
		$data['store_name']="call mleave01_rev1(
									'".$data['user']['user_ID']."'
									)";
		$data['data_dealer']=$this->all_model->call_store($data);
		// echo "<pre>"; print_r($data['data_dealer']); echo "</pre>"; exit();
		if(isset($_POST['leave_data_search'])){
		    $data['date_from']=$this->input->post('search_start_date');
			$data['date_to']=$this->input->post('search_end_date');

			$data['store_name']="call mleave04_rev1(
									'".$data['user']['user_ID']."','".$data['date_from']."','".$data['date_to']."'
									)";
			$data['data_dealer']=$this->all_model->call_store($data);
			// echo "<pre>"; print_r($data['data_dealer']); echo "</pre>"; exit();
        }
        if(isset($_POST['btnSubmit'])){
		$data['user']=$this->session->userdata('login');
		$leavesid = $this->input->post('idleave');
		// $data['nav']='add_leave';
		// echo $leavesid; exit();
		$datetime = date("YmdHis");
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
		if($filename != ""){
			// echo $filename_new; exit();
			// echo "UPDATE leaves set leave_attached = '$filename_new' where leave_ID = '$leavesid'"; exit();
			$this->all_model->call_not("UPDATE leaves set leave_attached = '$filename_new' where leave_ID = '$leavesid'");
		}
		
		$storefile = "assets/upload/".$filename_new;
		if($filename != ""){
			copy($tmpname, $storefile);
			unlink($tmpname);
			}
			echo "<script>alert('บันทึกไฟล์แนบสำเร็จ!!');</script>";
		}

        // echo "<pre>"; print_r($data['data_dealer']); echo "</pre>"; exit();
		$this->load->view('template/v_header',$data);
		$this->load->view('v_leave_detail',$data);
		$this->load->view('template/v_footer');
	}
	public function showdetail(){
		$leave_id = $this->input->post("leave_id");
		$data = $this->all_model->call_all("SELECT leave_date,start_time,end_time FROM leave_detail where leave_id = '$leave_id'");
		echo json_encode($data);
	}
	public function del_leave_id(){
		$leave_id = $this->input->post("l_id");
		// $this->all_model->call_all("UPDATE leaves SET delete_flag = 1 where leave_id = '$leave_id'"); 
		$this->all_model->call_not("call mleave37_rev1('$leave_id')"); 
		$data = "success";
		echo json_encode($data);
	}
}
?>

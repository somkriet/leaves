<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); 

/**
* Home
*/
class Leave extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login'))
		{
			$link_email=$this->input->get('link_email');
			if ($link_email=="1") {
				redirect('login/authen/1','refresh');
				exit();
			}
			if ($link_email=="2") {
				redirect('login/authen/2','refresh');
				exit();
			}


			redirect('login','refresh');
			exit();
		}
		else
		{
			$this->load->helper(array('form', 'url'));
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('calendar_model');
			$this->load->model('acceptation_model');
			$this->load->model('annual_model');
			$this->load->model('office_model');
		}
	}
	function index()
	{
	
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['non_working_time']=$this->calendar_model->get_non_working_time();
		$this->load->view('header',$data);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	function leave_all()
	{
		$data['user']=$this->session->userdata('login');
		
	}
	function add_leave($status=null,$contact=null)
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['status']=$status;
		@$data['contact']=$contact;
		$data['time']=array('08:30','13:00');
		$data['time_end']=array('12:00','17:30');

		$data['progression_all']=$this->progression_model->progression_all();
		$data['user_by_department']=$this->user_model->get_user_by_department($data);
		$data['user_by_session']=$this->user_model->get_user_by_session($data);

		$this->load->view('header',$data);
		$this->load->view('leave',$data);
		$this->load->view('footer');
	}
	function add_leave_result()
	{	

		$chkfile=$this->input->post('chkfile');
		$namefile=0;
			if ($chkfile==1) {
				$config['upload_path'] = '../leaves/uploads/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']	= '1024';
				$namefile=date('ymdhms').'.pdf';
				$config['file_name'] = $namefile;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{
					redirect('leave/add_leave/12','refresh');
					exit();
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				}
				$config1['image_library'] = 'gd2';
		        $config1['source_image'] = '../leaves/uploads/'.$namefile;  
		        $config1['create_thumb'] = FALSE;
		        $config1['new_image'] = '../leaves/uploads/'.$namefile;
		        $config1['maintain_ratio'] = FALSE;
		        $this->load->library('image_lib', $config1); 
		        $this->image_lib->resize();
        	}
       	
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['today']=date('Y-m-d');

		$data['list']=$this->input->post('list');
		$data['leave_type']=$this->input->post('ddlLeave');
		$data['user_leave']=$this->input->post('user_leave');

		//loop
		$data['start_date']=$this->input->post('start_date');
		$data['start_time']=$this->input->post('start_time');
		$data['end_time']=$this->input->post('end_time');

		$data['progression']=$this->input->post('progression');
		$data['pay']=$this->input->post('pay');
		$data['costs']=$this->input->post('costs');
		$data['subject']=$this->input->post('subject');
		$data['detail']=$this->input->post('detail');

		$data['userfile']=$namefile;
		//$this->leave_model->do_upload($data);

		$data['user_ID_approv']=$data['user']['user_ID'];
		@$data['annual_detail']=$this->annual_model->annual_detail($data);

		@$total=($data['annual_detail'][0]->annual_have+$data['annual_detail'][0]->annual_old)-($data['annual_detail'][0]->annual_old_use+$data['annual_detail'][0]->annual_new_use);
		
		

		if(sizeof(@$data['annual_detail'])==0)
		{
			redirect('leave/add_leave/11','refresh');
			exit();
		}

///////////////////////////////////////////////////////////////


///////////////////////////////////check กรอก วันเวลาในการลา///////////////////////////////////////////////////////
		$date_chk_03=0; /////เช็คเดือน 3  ในการใช้สิทเก่าใหม่
		for($i=0;$i<count($data['start_date']);$i++)
		{
			for ($i1=1; $i1 <= $i; $i1++) { 
				
		
				if(@$data['start_date'][$i]==@$data['start_date'][$i-$i1])
				{
				

					if($data['start_time'][$i]==$data['start_time'][$i-$i1])
					{
						
						redirect('leave/add_leave/10','refresh');
						exit();
					}
					elseif($data['end_time'][$i]==$data['end_time'][$i-$i1])
					{

						redirect('leave/add_leave/10','refresh');
						exit();
					}
				}

				

				
				


			}

			$date_start_explode = explode("-",$data['start_date'][$i]);
			if ($date_chk_03==0) { /// เช็คล่าข้ามเดือน มีนาคม เพื่อ เช็ค สิทธิ์ เก่าใหม่
					if ($date_start_explode[1]<=03) {
						$date_chk_03=1;
					}else{
						$date_chk_03=2;	
					}
				}else{
					
					if ($date_chk_03==1 AND $date_start_explode[1]>03) {
						redirect('leave/add_leave/13','refresh');
						exit();
					}elseif($date_chk_03==2 AND $date_start_explode[1] <=03){
						redirect('leave/add_leave/13','refresh');
						exit();
					}
				}

			if ($date_start_explode[0] != date('Y')) { /// ลาได้เฉพาะปีปัจจุบันเท่านั้น
				redirect('leave/add_leave/14','refresh');
				exit();
			}
	
					
		}


//echo $date_chk_03;
	
//////////////////////////////////////////////////////////////////////////////////////////

		$qlist=$this->db->query("SELECT leave_group_Name as list
			FROM leave_group 
			WHERE leave_group_ID = '".$data['list']."'");
		$resul_tlist=$qlist->result();
		//$result_list[0]->list;

		$qleave_type=$this->db->query("SELECT leave_type_Name as leave_type
			FROM leave_type 
			WHERE leave_type_ID = '".$data['leave_type']."'");
		$result_leave_type=$qleave_type->result();
		//$result_leave_type[0]->leave_type;

		$qprogression=$this->db->query("SELECT progression_Name as progression
			FROM progression 
			WHERE progression_ID = '".$data['progression']."'");
		$result_progression=$qprogression->result();

		$q_send_email_to=$this->db->query("SELECT send_email_to
			FROM user 
			WHERE user_ID = '".$data['user_leave']."'");
		$result_q_send_email_to=$q_send_email_to->result();
//////////////////////////////////////////คำนวณวัน  เริ่มลา  หยุดลา////////////////////////////////////								

		$sddate=$this->db->query("SELECT start_time,end_time,leave_date
			FROM db_leave.leaves
			inner join db_leave.leave_detail on leaves.leave_ID=leave_detail.leave_ID
			WHERE user_leave = '".$data['user_leave']."'
			AND acceptation_ID != 3  ");
		$resul_stime=$sddate->result();


		//input start_date
		foreach ($data['start_date'] as $sstartdate) {
			//query start_date
			foreach ($resul_stime as $alldatetime) 
			{
				if ($sstartdate == substr($alldatetime->leave_date,0 ,-9))
				{
					//input start_time
					foreach ($data['start_time'] as $stimeinput)
					{
						foreach($data['end_time'] as $etimeinput)
						{
							if($stimeinput!=$alldatetime->start_time)
							{
								if($etimeinput==$alldatetime->end_time)
								{
								redirect('leave/add_leave/9','refresh');
								exit();
								}
							}else{
								redirect('leave/add_leave/9','refresh');
								exit();
							}
						}
					}
				}
			}
		}
//////////////////////////////////////////คำนวณวัน  เริ่มลา  หยุดลา////////////////////////////////////
		//count for Leave date
		for($i=0;$i<count($data['start_date']);$i++)
		{

			$check_num_date=$data['end_time'][$i]-$data['start_time'][$i];
			if ($check_num_date==9) {
				$num_date[]=$check_num_date-1;
			}
			else
			{
				$num_date[]=$check_num_date;
			}
			

			if(@$data['start_date'][$i]<@$data['start_date'][$i-1])
			{
				redirect('leave/add_leave/7','refresh');
				exit;
			}

			if($data['end_time'][$i]-$data['start_time'][$i]<=0)	
			{
				@$check_time='0';
			}		//$date_time.='วันที่'.$data['start_date'].'เวลา'.$data['start_time'][$i]."-".$data['end_time'][$i];
		}

		//echo $date_time;
		$data['start']=$data['start_date'][0];
		$data['end']=$data['start_date'][$i-1];
		$data['total_date']=array_sum($num_date)/8;


		$data['leave_type_title']=$this->leave_model->leave_type_title($data);
//////////////////////////////////////////ต้องลาล่วงหน้า/////////////////////////////////////////////////////
		if($data['leave_type']==6 or $data['leave_type']==8 or $data['leave_type']==7 or $data['leave_type']==3)
		{
				if ($data['leave_type']!=6) {
					$check_time_start=$data['start'].' '.$data['start_time'][0];
					if($check_time_start<=date("Y-m-d H:i") or @$check_time=='0')
							{
								redirect('leave/add_leave/4','refresh');
								//echo "string";	
								exit();
							}
				}

							if($data['start']<date("Y-m-d") or @$check_time=='0')
							{
								redirect('leave/add_leave/4','refresh');	
							}
							else
							{
								if($data['leave_type']==6)
								{
									if($total>0 AND $total>=$data['total_date'])
									{
										$this->leave_model->add_leave($data);

								//print_r  ($data['user']['user_type_ID']);
										
										$this->load->library('email');
										$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');

										if($data['user']['user_type_ID']=='3' or $data['user']['user_type_ID']=='0' or $data['user']['user_type_ID']=='5')
										{
											 $data['user_type_ID_email']='3';

										}
										if($data['user']['user_type_ID']=='2')
										{
											 $data['user_type_ID_email']='2';
											//$this->email->to('pureepon@meiko.co.th');
										}
										if($data['user']['user_type_ID']=='7')
										{
											$data['user_type_ID_email']='7';
											//$this->email->to('pureepon@meiko.co.th');
										}
										if($data['user']['user_type_ID']=='1')
										{
											$data['user_type_ID_email']='1';
											//$this->email->to('pureepon@meiko.co.th');
										}
								
										 $data['check_user_department_ID']=$this->leave_model->check_user_department_ID($data);

										 // print_r($data['check_user_department_ID']);
										 // exit();
										 foreach($data['check_user_department_ID'] as $num=>$check_email)
										 { 
										 	@$email[].=$check_email->email;
										 }
										 @$send_email =implode(",",$email);
									
										 @$this->email->to($result_q_send_email_to[0]->send_email_to);
								
										$this->email->subject('Leave requrest from ');
									
										$link_message='"http://mleave.meiko.co.th/index.php/leave/leave_approv?link_email=1"';
										$message='ชื่อ '.$data['user']['name_en'].
										' หัวเรื่อง '.$resul_tlist[0]->list.
										' ประเภท '.$result_leave_type[0]->leave_type.
										' วันเริ่ม '.$data['start'].
										' ถึงวันที่ '.$data['end'].
										' เรื่อง '.$data['subject'].
										' รายละเอียด '.$data['detail'];
										$message.=$link_message;

										if(@$result_progression[0]->progression!='')
										{
											$message.=' เดินทางโดย '.$result_progression[0]->progression;
											if($data['pay']==0)
											{
												$message.=' ไม่มีค่าใช้จ่ายในการเดินทาง ';
											}
											else
											{
												$message.=' ค่าใช้จ่ายในการเดินทาง '.$data['costs'].' บาท';
											}
										}

									}
									else
									{
										redirect('leave/add_leave/6','refresh');
									}

								}
								else
								{
									$this->leave_model->add_leave($data);

							//print_r  ($data['user']['user_type_ID']);
									
									$this->load->library('email');
									$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
							

									if($data['user']['user_type_ID']=='3' or $data['user']['user_type_ID']=='0' or $data['user']['user_type_ID']=='5')
									{
										 $data['user_type_ID_email']='3';

									}
									if($data['user']['user_type_ID']=='2')
									{
										 $data['user_type_ID_email']='2';
										//$this->email->to('pureepon@meiko.co.th');
									}
									if($data['user']['user_type_ID']=='7')
									{
										$data['user_type_ID_email']='7';
										//$this->email->to('pureepon@meiko.co.th');
									}
									if($data['user']['user_type_ID']=='1')
									{
										$data['user_type_ID_email']='1';
										//$this->email->to('pureepon@meiko.co.th');
									}
							
									 $data['check_user_department_ID']=$this->leave_model->check_user_department_ID($data);
									 foreach($data['check_user_department_ID'] as $num=>$check_email)
									 { 
									 	@$email[].=$check_email->email;
									 }
									 @$send_email =implode(",",$email);
									 @$this->email->to($result_q_send_email_to[0]->send_email_to);
								
									$this->email->subject('Leave requrest from ');
								
								
										$link_message='"http://mleave.meiko.co.th/index.php/leave/leave_approv?link_email=1"';
										$message='ชื่อ '.$data['user']['name_en'].
										' หัวเรื่อง '.$resul_tlist[0]->list.
										' ประเภท '.$result_leave_type[0]->leave_type.
										' วันเริ่ม '.$data['start'].
										' ถึงวันที่ '.$data['end'].
										' เรื่อง '.$data['subject'].
										' รายละเอียด '.$data['detail'];
									$message.=$link_message;
									if(@$result_progression[0]->progression!='')
									{
										$message.=' เดินทางโดย '.$result_progression[0]->progression;
										if($data['pay']==0)
										{
											$message.=' ไม่มีค่าใช้จ่ายในการเดินทาง ';
										}
										else
										{
											$message.=' ค่าใช้จ่ายในการเดินทาง '.$data['costs'].' บาท';
										}
									}
								}
								$this->email->message($message); 
								$this->email->send();
									
						
								redirect('leave/add_leave/1','refresh');
							}
		}
////////////////////////////////ต้องลาย้อนหลัง///////////////////////////////////////////////////////////////		
		elseif($data['leave_type']==4 or $data['leave_type']==5 )
		{
			if($data['start']>date("Y-m-d") or @$check_time=='0')
			{
				redirect('leave/add_leave/5','refresh');
			}
			else
			{
				$this->leave_model->add_leave($data);

		//print_r  ($data['user']['user_type_ID']);

		$this->load->library('email');
		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
		

		if($data['user']['user_type_ID']=='3' or $data['user']['user_type_ID']=='0' or $data['user']['user_type_ID']=='5')
		{
			 $data['user_type_ID_email']='3';

		}
		if($data['user']['user_type_ID']=='2')
		{
			 $data['user_type_ID_email']='2';
			//$this->email->to('pureepon@meiko.co.th');
		}
		if($data['user']['user_type_ID']=='7')
		{
			$data['user_type_ID_email']='7';
			//$this->email->to('pureepon@meiko.co.th');
		}
		if($data['user']['user_type_ID']=='1')
		{
			$data['user_type_ID_email']='1';
			//$this->email->to('pureepon@meiko.co.th');
		}
		
			 $data['check_user_department_ID']=$this->leave_model->check_user_department_ID($data);
			 foreach($data['check_user_department_ID'] as $num=>$check_email){ 
			 	@$email[].=$check_email->email;
			 }
			 @$send_email =implode(",",$email);
			 @$this->email->to($result_q_send_email_to[0]->send_email_to);
			
		$this->email->subject('Leave requrest from ');
		
		
						$link_message='"http://mleave.meiko.co.th/index.php/leave/leave_approv?link_email=1"';
						$message='ชื่อ '.$data['user']['name_en'].
						' หัวเรื่อง '.$resul_tlist[0]->list.
						' ประเภท '.$result_leave_type[0]->leave_type.
						' วันเริ่ม '.$data['start'].
						' ถึงวันที่ '.$data['end'].
						' เรื่อง '.$data['subject'].
						' รายละเอียด '.$data['detail'];
		$message.=$link_message;
		if(@$result_progression[0]->progression!='')
		{
			$message.=' เดินทางโดย '.$result_progression[0]->progression;
			if($data['pay']==0)
			{
				$message.=' ไม่มีค่าใช้จ่ายในการเดินทาง ';
			}
			else
			{
				$message.=' ค่าใช้จ่ายในการเดินทาง '.$data['costs'].' บาท';
			}
		}

		$this->email->message($message); 
		$this->email->send();
		
				redirect('leave/add_leave/1','refresh');
			}
		}
/////////////////////////////////ลาอื่นๆ////////////////////////////////////////////////////
		elseif(@$check_time=='0')
		{
			redirect('leave/add_leave/7','refresh');
		}
		else
		{
		$this->leave_model->add_leave($data);

		//print_r  ($data['user']['user_type_ID']);

		$this->load->library('email');
		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
		

		if($data['user']['user_type_ID']=='3' or $data['user']['user_type_ID']=='0' or $data['user']['user_type_ID']=='5')
		{
			 $data['user_type_ID_email']='3';

		}
		if($data['user']['user_type_ID']=='2')
		{
			 $data['user_type_ID_email']='2';
			//$this->email->to('pureepon@meiko.co.th');
		}
		if($data['user']['user_type_ID']=='7')
		{
			$data['user_type_ID_email']='7';
			//$this->email->to('pureepon@meiko.co.th');
		}
		if($data['user']['user_type_ID']=='1')
		{
			$data['user_type_ID_email']='1';
			//$this->email->to('pureepon@meiko.co.th');
		}
		
			 $data['check_user_department_ID']=$this->leave_model->check_user_department_ID($data);
			 foreach($data['check_user_department_ID'] as $num=>$check_email){ 
			 	@$email[].=$check_email->email;
			 }
			 @$send_email =implode(",",$email);
			  @$this->email->to($result_q_send_email_to[0]->send_email_to);

		$this->email->subject('Leave requrest from ');
		
		
						$link_message='"http://mleave.meiko.co.th/index.php/leave/leave_approv?link_email=1"';
						$message='ชื่อ '.$data['user']['name_en'].
						' หัวเรื่อง '.$resul_tlist[0]->list.
						' ประเภท '.$result_leave_type[0]->leave_type.
						' วันเริ่ม '.$data['start'].
						' ถึงวันที่ '.$data['end'].
						' เรื่อง '.$data['subject'].
						' รายละเอียด '.$data['detail'];
		$message.=$link_message;
		if(@$result_progression[0]->progression!='')
		{
			$message.=' เดินทางโดย '.$result_progression[0]->progression;
			if($data['pay']==0)
			{
				$message.=' ไม่มีค่าใช้จ่ายในการเดินทาง ';
			}
			else
			{
				$message.=' ค่าใช้จ่ายในการเดินทาง '.$data['costs'].' บาท';
			}
		}

		$this->email->message($message); 
		$this->email->send();
		
		
			
			redirect('leave/add_leave/1','refresh');
		}
	}
	function search_leave_detail()
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['user_by_department']=$this->user_model->get_user_by_department($data);
		$data['user_by_session']=$this->user_model->get_user_by_session($data);

		$data['department_all']=$this->office_model->department_all();
		
	//print_r($data['user_by_session']);
	//print_r($data['user_by_department']);
	//exit();
		$this->load->view('header',$data);
		$this->load->view('search_by_date',$data);
		$this->load->view('footer2');
	}

	function test_test()
	{
		$num_depart_id = $_POST["num_dep_id"];
		//$num_depart_id = '1';
		if($num_depart_id != '')
		{
			$select = $this->db->select('user_ID, name_th, surname_th')->where('department_ID', $num_depart_id)->order_by('user_ID','ASC')->get('user')->result_array();
		}else{
			$select = $this->db->select('user_ID, name_th, surname_th')->order_by('user_ID','ASC')->get('user')->result_array();
		}
		echo header('Content-type: application/json;charset=utf-8');
		echo json_encode($select);
	}

	function leave_detail($status=null,$start_date=null,$end_date=null,$user_ID=null)
	{
		//echo $user_ID;
		//echo $_POST['select_user_leave_detail'];

		$start_date=$start_date;
		$data['status']=$status;
		if($start_date!='')
		{
		$data['select_user_leave_detail']=$user_ID;
		$search_start_date=$start_date;
		$search_end_date=$end_date;
		}
		else
		{		
		$data['select_user_leave_detail']=$this->input->post('select_user_leave_detail');
		$search_start_date=$this->input->post('search_start_date');
		$search_end_date=$this->input->post('search_end_date');
		@$data['Department_ID']=$this->input->post('Department_ID');
		}
		//echo $data['select_user_leave_detail'];
		//exit();
		
		$data['start_date_check']=$search_start_date;
		$data['end_date_check']=$search_end_date;

		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		
		$data['search_start_date']=$search_start_date." 00:00:00";
		$data['search_end_date']=$search_end_date." 23:59:59";

	
		$data['user_by_select_search']=$this->user_model->get_user_by_select_search($data);
		$data['result_search_leave_detail']=$this->leave_model->search_leave_detail($data);
		
		$this->load->view('header',$data);
		$this->load->view('leave_detail',$data);
		$this->load->view('footer');
	}

	// Manager
	function leave_approv($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['leave_user_for_approv']=$this->leave_model->leave_user_for_approv($data);



		$this->load->view('header',$data);
		$this->load->view('leave_approv',$data);
		$this->load->view('footer');
	}
	function leave_approv_result($leave_ID,$status,$user_ID_approv=null,$leave_type_ID=null)
	{

		$data['user']=$this->session->userdata('login');
		$data['leave_ID']=$leave_ID;
		$data['status']=$status;
		$data['now']=date('Y-m-d H:i:s');


		////////////////////////////////ส่งเมลล์แจ้งผู้ลา////////////////////////////
		$q_user_leave=$this->db->query("select l.start_date,u.email,lt.leave_type_Name,ld.leave_date,ld.start_time,ld.end_time
					   from leaves l
					   join user u on u.user_ID=l.user_leave
					   join leave_type lt on lt.leave_type_ID=l.leave_type_ID
					   join leave_detail ld on ld.leave_ID=l.leave_ID
					   WHERE l.leave_ID='".$leave_ID."'"
					   );
		$result_q_user_leave=$q_user_leave->result();

		if (!empty($result_q_user_leave[0]->manager_approv)) {
			redirect("leave/leave_approv/".$data['status']."","refresh");
			exit();
		}

		//echo $leave_ID;

		//print_r($result_q_user_leave);
		//exit();

// echo $message_user;
// 				exit();	

		//exit();
/////////////////////////////////////////////////////////////////////////

		
		if($data['status']!=3)
		{
			$q_send_email_to=$this->db->query("SELECT email
				FROM user 
				WHERE user_type_ID = '5'");
			$result_q_send_email_to=$q_send_email_to->result();

			
			foreach ($result_q_send_email_to as $key => $value) {
				
				@$email_send.=$value->email.',';
			}

			$this->load->library('email');
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
				
			@$send_email =implode(",",$email);
			@$this->email->to(substr($email_send,0,-1));
					
			$this->email->subject('Leave requrest from ');
			
			
			$link_message='"http://mleave.meiko.co.th/index.php/leave/hr_approv?link_email=2"';
							$message='คลิกที่ลิงค์ เพื่อ รับทราบการลา';
			$message.=$link_message;

			$this->email->message($message); 
			$this->email->send();

		

				/////////////////////////////////////ตัดสิทธิ/////////////////////////////////////////////
				$data['user_ID_approv']=$user_ID_approv;

				$data['leave_type_ID']=$leave_type_ID;
				$data['get_leave_total_date']=$this->leave_model->get_leave_total_date($data);
				$data['annual_detail']=$this->annual_model->annual_detail_leave_appove($data);
		 
				//echo $data['user_ID_approv'];
				//echo $data['leave_type_ID'];
				//echo $data['get_leave_total_date'];
				$date_start_explode = explode("-", substr($result_q_user_leave[0]->start_date, 0,10));

				//echo $data['annual_detail'];
				if($data['leave_type_ID']==6)
				{
				$today_day =date($date_start_explode[2]);
			    $today_month = date($date_start_explode[1]);
			    $today_year = date($date_start_explode[0]);
			    $today = gregoriantojd($today_month,$today_day,$today_year);

			    $end_day =date('31');
			    $end_month = date('03');
			    $end_year = date('Y');
			    $end = gregoriantojd($end_month,$end_day,$end_year);
			    /////////////old////////////////////
					if($today<=$end)
					{			
						$o=$data['annual_detail'][0]->annual_old-$data['annual_detail'][0]->annual_old_use;
						$n=$data['annual_detail'][0]->annual_have-$data['annual_detail'][0]->annual_new_use;
						if($o>0 and $o>=$data['get_leave_total_date'][0]->total_date)
						{
						$data['update_status']=1;
						$data['annual_old_use']=$data['annual_detail'][0]->annual_old_use+$data['get_leave_total_date'][0]->total_date;

						//exit();
						$this->annual_model->annual_update($data);
						}
						elseif($n>0 and $n>=$data['get_leave_total_date'][0]->total_date)
						{
						$data['update_status']=2;
						$data['annual_new_use']=$data['annual_detail'][0]->annual_new_use+$data['get_leave_total_date'][0]->total_date;
						//exit();
						$this->annual_model->annual_update($data);
						}
						else
						{
							echo "no";
						}
					}
				/////////////////new///////////////////	
					else
					{
						$n=$data['annual_detail'][0]->annual_have-$data['annual_detail'][0]->annual_new_use;
						if($n>0 and $n>=$data['get_leave_total_date'][0]->total_date)
						{
						$data['update_status']=2;
						$data['annual_new_use']=$data['annual_detail'][0]->annual_new_use+$data['get_leave_total_date'][0]->total_date;
						$this->annual_model->annual_update($data);	
						}
						else
						{
							redirect("leave/hr_approv/".$data['status']."","refresh");
							exit();
						}

					}
				}
		}	


		if ($result_q_user_leave[0]->email!='-') {

			$this->load->library('email');
			$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
				
			@$send_email =implode(",",$email);
			@$this->email->to($result_q_user_leave[0]->email);
					

			$this->email->subject('Leave requrest from ');
			
			
			//$link_message='"http://mleave.meiko.co.th/index.php/leave/hr_approv?link_email=2"';
			$message_user="MleaveOnline";
			$message_user.=$result_q_user_leave[0]->leave_type_Name;

			foreach ($result_q_user_leave as $key => $value) {
				$message_user.=" วันที่ ".date('Y-m-d',strtotime($value->leave_date))." เวลา ".$value->start_time." ถึง ".$value->end_time."\n";
			}

			if($status==1){
				$message_user.="\nManager ได้ทำการ อนุมัติ(จ่าย)";
			}elseif($status==2){
				$message_user.="\nManager ได้ทำการ อนุมัติ(ไม่จ่าย)";
			}else{
				$message_user.="\nManager ได้ทำการ ไม่อนุมัติ";
			}
									
			//$message.=$link_message;

			$this->email->message($message_user); 
			$this->email->send();	

		}
				//////////////////////////////////////////////////end///////////////////////////////////
				//$data['leave_type_ID']=$leave_type_ID;

		$this->leave_model->update_leave($data);


		redirect("leave/leave_approv/".$data['status']."","refresh");
	}
	function hr_approv($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['leave_user_for_approv']=$this->leave_model->leave_hr_for_approv($data);

		$this->load->view('header',$data);
		$this->load->view('hr_approv',$data);
		$this->load->view('footer');
	}
	function hr_approv_result($leave_ID,$status,$user_ID_approv,$leave_type_ID)
	{

		$data['user']=$this->session->userdata('login');
		$data['leave_ID']=$leave_ID;
		$data['user_ID_approv']=$user_ID_approv;
		$data['leave_type_ID']=$leave_type_ID;
		

		$data['status']=$status;
		$data['now']=date('Y-m-d H:i:s');

		// $data['get_leave_total_date']=$this->leave_model->get_leave_total_date($data);
		// $data['annual_detail']=$this->annual_model->annual_detail($data);


	
		// if($data['leave_type_ID']==6)
		// {
		// $today_day =date('d');
	 //    $today_month = date('m');
	 //    $today_year = date('Y');
	 //    $today = gregoriantojd($today_month,$today_day,$today_year);

	 //    $end_day =date('01');
	 //    $end_month = date('03');
	 //    $end_year = date('Y');
	 //    $end = gregoriantojd($end_month,$end_day,$end_year);
	 //    /////////////old////////////////////
		// 	if($today<$end)
		// 	{			
		// 		$o=$data['annual_detail'][0]->annual_old-$data['annual_detail'][0]->annual_old_use;
		// 		$n=$data['annual_detail'][0]->annual_have-$data['annual_detail'][0]->annual_new_use;
		// 		if($o>0)
		// 		{
		// 		$data['update_status']=1;
		// 		$data['annual_old_use']=$data['annual_detail'][0]->annual_old_use+$data['get_leave_total_date'][0]->total_date;

		// 		//exit();
		// 		$this->annual_model->annual_update($data);
		// 		}
		// 		elseif($n>0)
		// 		{
		// 		$data['update_status']=2;
		// 		$data['annual_new_use']=$data['annual_detail'][0]->annual_new_use+$data['get_leave_total_date'][0]->total_date;
		// 		//exit();
		// 		$this->annual_model->annual_update($data);
		// 		}
		// 		else
		// 		{
		// 			echo "no";
		// 		}
		// 	}
		// /////////////////new///////////////////	
		// 	else
		// 	{
		// 		$n=$data['annual_detail'][0]->annual_have-$data['annual_detail'][0]->annual_new_use;
		// 		if($n>0)
		// 		{
		// 		$data['update_status']=2;
		// 		$data['annual_new_use']=$data['annual_detail'][0]->annual_new_use+$data['get_leave_total_date'][0]->total_date;
		// 		$this->annual_model->annual_update($data);	
		// 		}
		// 		else
		// 		{
		// 			redirect("leave/hr_approv/".$data['status']."","refresh");
		// 		}

		// 	}
		// }
	
		$this->leave_model->hr_update_leave($data);
		redirect("leave/hr_approv/".$data['status']."","refresh");
	}
	function leave_cancle($leave_ID=null,$start_date,$end_date,$user_ID=null)
	{


		$data['user']=$this->session->userdata('login');
		$data['leave_ID']=$leave_ID;
		$data['status']=9;
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);

		$this->leave_model->cancle_leave($data);


		redirect("leave/leave_detail/".$data['status']."/".$start_date."/".$end_date."/".$user_ID."","refresh");
	}
	function search_leave()
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['user_by_department']=$this->user_model->get_user_by_department($data);
		$data['user_by_session']=$this->user_model->get_user_by_session($data);

		$this->load->view('header',$data);
		$this->load->view('search_leave',$data);
		$this->load->view('footer');
	}
	function leave_regulation()
	{
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);
		$data['user_by_department']=$this->user_model->get_user_by_department($data);
		$data['user_by_session']=$this->user_model->get_user_by_session($data);

		$this->load->view('header',$data);
		$this->load->view('v_leave_regulation',$data);
		$this->load->view('footer');
	}
	public function test_send_email()
	{
		$this->load->library('email');
		$this->email->from('hr_alert@meikoasia.com', 'MleaveOnline');
		
		$this->email->to('porranai@meikoasia.com');
		$this->email->subject('Leave requrest from ');

		$message="test email send";

		$this->email->message($message); 
								$this->email->send();
	}
	public function __destruct() {
	    $this->db->close();
	}
}
?>

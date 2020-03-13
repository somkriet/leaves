<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* Home
*/
class Setting extends CI_Controller
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
			$this->load->library("pagination");
			$this->load->model('user_model');
			$this->load->model('leave_model');
			$this->load->model('progression_model');
			$this->load->model('office_model');
			$this->load->model('acceptation_model');
			$this->load->model('position_model');
			$this->load->model('annual_model');



		}
	}
	function index($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);

		$data['user_type_all']=$this->user_model->get_user_type_all();

		$data['office_all']=$this->office_model->office_all();
		$data['department_all']=$this->office_model->department_all();

		$data['acceptation']=$this->acceptation_model->acceptation_all();

		$data['progression_all']=$this->progression_model->progression_all();

		$data['position_all']=$this->position_model->position_all();
		

		$this->load->view('header',$data);
		$this->load->view('setting/main_setting',$data);
		$this->load->view('footer');
	}
	function page_error($status)
	{
		$data['user']=$this->session->userdata('login');
		$data['status']=$status;
		$this->load->view('header',$data);
		$this->load->view('page_error',$data);
		$this->load->view('footer');
	}
	function add_user_type()
	{
		$data['user_type_Name']=$this->input->post('user_type_Name');
		$this->user_model->add_user_type($data);
		redirect('setting/index/1','refresh');
	}
	function del_user_type($user_type_ID)
	{
		if($user_type_ID==0)
		{
			redirect('setting/page_error/1','refresh');
		}
		else
		{
			$data['user_type_ID']=$user_type_ID;
			$this->user_model->del_user_type($data);
			redirect('setting/index/2','refresh');
		}
	}
	function edit_user_type()
	{
		$data['user_type_Name']=$this->input->post('user_type_Name');
		$data['user_type_ID']=$this->input->post('user_type_ID');
		$this->user_model->edit_user_type($data);
		redirect('setting/index/3','refresh');
	}
	function add_office()
	{
		$data['office']=$this->input->post('office');
		$this->office_model->add_office($data);
		redirect('setting/index/1','refresh');
	}
	function add_department()
	{
		$data['department']=$this->input->post('department');
		$data['office']=$this->input->post('office');
		$this->office_model->add_department($data);
		redirect('setting/index/1','refresh');
	}
	function del_office($office_ID)
	{
		$data['office_ID']=$office_ID;
		$data['delete_flag']=1;
		$this->office_model->del_office($data);
		redirect('setting/index/2','refresh');
	}
	function del_department($department_ID)
	{
		$data['department_ID']=$department_ID;
		$data['delete_flag']=1;
		$this->office_model->del_department($data);
		redirect('setting/index/2','refreah');
	}
	function edit_office()
	{
		$data['office_Name']=$this->input->post('office');
		$data['office_ID']=$this->input->post('office_ID');
		$this->office_model->edit_office($data);
		redirect('setting/index/3','refresh');
	}
	function edit_department()
	{
		$data['department_ID']=$this->input->post('department_ID');
		$data['department_Name']=$this->input->post('department');
		$data['office_ID']=$this->input->post('office');
		$this->office_model->edit_department($data);
		redirect('setting/index/3','refresh');
	}
	function add_acception()
	{
		$data['acceptation']=$this->input->post('acceptation');
		$this->acceptation_model->add_acception($data);
		redirect('setting/index/1','refresh');
	}
	function del_acception($acceptation_ID)
	{
		$data['acceptation_ID']=$acceptation_ID;
		$this->acceptation_model->del_acception($data);
		redirect('setting/index/2','refresh');
	}
	function edit_acception()
	{
		$data['acceptation_ID']=$this->input->post('acception_ID');
		$data['acceptation_Name']=$this->input->post('acception_Name');
		$this->acceptation_model->edit_acception($data);
		redirect('setting/index/3','refresh');
	}
	function add_progression()
	{
		$data['progression_Name']=$this->input->post('progression_Name');
		$this->progression_model->add_progression($data);
		redirect('setting/index/1','refresh');
	}
	function del_progression($progression_ID)
	{
		$data['progression_ID']=$progression_ID;
		$this->progression_model->del_progression($data);
		redirect('setting/index/2','refresh');
	}
	function edit_progression()
	{
		$data['progression_Name']=$this->input->post('progression_Name');
		$data['progression_ID']=$this->input->post('progression_ID');
		$this->progression_model->edit_progression($data);
		redirect('setting/index/3','refresh');
	}


	function add_position()
	{
		$data['position_Name']=$this->input->post('position_Name');
		$this->position_model->add_position($data);
		redirect('setting/index/1','refresh');
	}
	function del_position($position_ID)
	{
		$data['position_ID']=$position_ID;
		$this->position_model->del_position($data);
		redirect('setting/index/2','refresh');
	}
	function edit_position()
	{
		$data['position_ID']=$this->input->post('position_ID');
		$data['position_Name']=$this->input->post('position_Name');
		$this->position_model->edit_position($data);
		redirect('setting/index/3','refresh');
	}


	function add_edit_delete_user($status=null)
	{
		$data['status']=$status;
		$data['user']=$this->session->userdata('login');
		$data['leave_count']=$this->leave_model->leave_count($data);
		$data['leave_count_ap_hr']=$this->leave_model->leave_count_ap_hr($data);

		$data['user_type_all']=$this->user_model->get_user_type_all();

		$data['office_all']=$this->office_model->office_all();
		$data['department_all']=$this->office_model->department_all();

		$data['acceptation']=$this->acceptation_model->acceptation_all();

		$data['progression_all']=$this->progression_model->progression_all();

		$data['position_all']=$this->position_model->position_all();

		$data['get_user_all']=$this->user_model->get_user_all();
		$data['get_user_type_all']=$this->user_model->get_user_type_all();
		

		$this->load->view('header',$data);
		$this->load->view('setting/user_setting',$data);
		$this->load->view('footer');
	}
	function add_user()
	{
		$data['user_ID']=$this->input->post('user_ID');
		$data['start_date_work']=$this->input->post('start_date_work');
		$data['name_en']=$this->input->post('name_en');
		$data['surname_en']=$this->input->post('surname_en');
		$data['name_th']=$this->input->post('name_th');
		$data['surname_th']=$this->input->post('surname_th');
		$data['email']=$this->input->post('email');
		$data['phone']=$this->input->post('phone');
		$data['department_ID']=$this->input->post('department_ID');
		$data['position_ID']=$this->input->post('position_ID');
		$data['user_type_ID']=$this->input->post('user_type_ID');
		$data['send_email_to']=$this->input->post('send_email_to');
		$data['username']=$this->input->post('user_ID');
		$data['password']=md5($this->input->post('password'));



		$data['get_user_all']=$this->user_model->get_user_all();
		foreach ($data['get_user_all'] as $num => $resultuser) {
			if($resultuser->user_ID==$data['user_ID'])
			{
				$check_user_ID=1;
			}


		}

		if(@$check_user_ID==0)
		{

			$this->user_model->add_user($data);
			redirect('setting/add_edit_delete_user/1','refresh');
		}
		else
		{
			redirect('setting/add_edit_delete_user/4','refresh');
		}
		
	}
	function edit_user($page)
	{
		$data['page']=$page;
		
		$data['start_date_work']=$this->input->post('start_date_work');
		$data['user_ID']=$this->input->post('user_ID');
		$data['name_en']=$this->input->post('name_en');
		$data['surname_en']=$this->input->post('surname_en');
		$data['name_th']=$this->input->post('name_th');
		$data['surname_th']=$this->input->post('surname_th');
		$data['email']=$this->input->post('email');
		$data['phone']=$this->input->post('phone');
		$data['department_ID']=$this->input->post('department_ID');
		$data['position_ID']=$this->input->post('position_ID');
		$data['send_email_to']=$this->input->post('send_email_to');
		$data['user_type_ID']=$this->input->post('user_type_ID');

		$data['ann_have']=$this->input->post('an_have');
		$data['ann_old']=$this->input->post('an_old');
		$data['ann_old_use']=$this->input->post('an_old_use');
		$data['ann_new_use']=$this->input->post('an_new_use');

		$this->user_model->edit_user($data);
		if($data['page']==1)
		{
			redirect('user/index/3','refresh');
		}
		else
		{
			redirect('setting/add_edit_delete_user/3','refresh');
		}
		
	}
	function del_user($user_ID)
	{
		$data['user_ID']=$user_ID;
		$data['user_status']=2;
		$this->user_model->del_user($data);
		redirect('setting/add_edit_delete_user/2','refresh');
	}
	function setting_date_user()
	{
			$data['get_user_all']=$this->user_model->get_user_all();
			foreach ($data['get_user_all'] as $num => $resultuser) {
				//echo date('Y-m-d',strtotime($resultuser->start_date_work));
				//echo "<br>";
				$year = date('Y-m-d')-date('Y-m-d',strtotime($resultuser->start_date_work));
				echo $resultuser->name_en;
				
				echo $year;
			
				if($year<1)
				{
					$data['user_ID']=$resultuser->user_ID;
					$data['annual_have']=0;
					$this->user_model->annual_have($data);
				}
				elseif($year<3)
				{
					$data['user_ID']=$resultuser->user_ID;
					$data['annual_have']=6;
					$this->user_model->annual_have($data);
				}
				elseif($year<4)
				{
					$data['user_ID']=$resultuser->user_ID;
					$data['annual_have']=8;
					$this->user_model->annual_have($data);
				}
				else
				{
					$data['user_ID']=$resultuser->user_ID;
					$data['annual_have']=10;
					$this->user_model->annual_have($data);
				}
					
			}
			exit;
	}
	function setting_annual($user_ID,$status_chk_all=null)
	{
		// $data['leave_ID']='MLA2015031906';
		// $q_user_leave=$this->db->query("select l.start_date,u.email,lt.leave_type_Name,ld.leave_date,ld.start_time,ld.end_time,l.manager_approv
		// 			   from leaves l
		// 			   join user u on u.user_ID=l.user_leave
		// 			   join leave_type lt on lt.leave_type_ID=l.leave_type_ID
		// 			   join leave_detail ld on ld.leave_ID=l.leave_ID
		// 			   WHERE l.leave_ID='MLA2015040206'"
		// 			   );
		// $result_q_user_leave=$q_user_leave->result();

		// print_r($result_q_user_leave[0]->manager_approv);
		// if (empty($result_q_user_leave[0]->manager_approv)) {
		// 	redirect("leave/leave_approv/","refresh");
		// }

		// $date_start_explode = explode("-", substr($result_q_user_leave[0]->start_date, 0,10));
		
		// 		$today_day = date($date_start_explode[2]);
		// 	    $today_month = date($date_start_explode[1]);
		// 	    $today_year = date($date_start_explode[0]);
		// 	    $today = gregoriantojd($today_month,$today_day,$today_year);

		// 	    $end_day =date('31');
		// 	    $end_month = date('03');
		// 	    $end_year = date('Y');
		// 	    $end = gregoriantojd($end_month,$end_day,$end_year);

		// 	    $data['user_ID_approv']='1826';
		// 	    $data['get_leave_total_date']=$this->leave_model->get_leave_total_date($data);
		// 	 	 $data['annual_detail']=$this->annual_model->annual_detail_leave_appove($data);
		// if($today<=$end)
		// 			{	
		// 				$o=$data['annual_detail'][0]->annual_old-$data['annual_detail'][0]->annual_old_use;
		// 				$n=$data['annual_detail'][0]->annual_have-$data['annual_detail'][0]->annual_new_use;

		// 				if($o>0 and $o>=$data['get_leave_total_date'][0]->total_date)
		// 				{
		// 				$data['update_status']=1;
		// 				$data['annual_old_use']=$data['annual_detail'][0]->annual_old_use+$data['get_leave_total_date'][0]->total_date;

		// 				//exit();
		// 				//$this->annual_model->annual_update($data);
		// 				echo "old";
		// 				}
		// 				elseif($n>0 and $n>=$data['get_leave_total_date'][0]->total_date)
		// 				{
		// 				$data['update_status']=2;
		// 				$data['annual_new_use']=$data['annual_detail'][0]->annual_new_use+$data['get_leave_total_date'][0]->total_date;
		// 				//exit();
		// 				//$this->annual_model->annual_update($data);
		// 					echo "new";
		// 				}
		// 				else
		// 				{
		// 					echo "no";
		// 				}		
		// 			}
		// 			else{
		// 				// echo "new";
		// 			}
		
		// if ($result_q_user_leave[0]->email!='-') {
		// 	echo $result_q_user_leave[0]->email;
		// }else{
		// 	echo "no";
		// }

		// exit();

	$data['user_ID']=$user_ID;
				//exit();

	$data['result']=$this->user_model->get_user_calculate_annual($data);

	$data['annual_all']=$this->annual_model->annual_all($data);
	// $data['annual_all']=array();

				if(sizeof($data['annual_all'])!="0")
				{

					$today_day =date('d');
			        $today_month = date('m');
			        $today_year = date('Y');
			        $today = gregoriantojd($today_month,$today_day,$today_year);
				////////////////////////////////////////////////////////////////////
					$rest = explode("/", $data['result'][0]->start_date_work); 

			        $start_year = $rest[2];
			        $start_month = $rest[1];
			        $start_day = $rest[0];
			        $start_date=gregoriantojd($start_month,$start_day,$start_year);

		       		$year=$today-$start_date;

					$year1 = date('Y',strtotime(date('Y')))-$start_year;


					if($year>=365)
					{

						if ($data['annual_all'][0]->annual_have==0) {

						$data['year_old']=date('Y')-1;
						$data['annual_old_me']=$this->annual_model->annual_old($data);
						@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
						$data['user_ID']=$user_ID;
						$data['annual_have']=6;
						$data['annual_ID']=$data['annual_all'][0]->annual_ID;
						$this->annual_model->update_annual_have($data);

						}

					}					

				}
				else
				{

		
					//$year = date('Y-m-d')-date('Y-m-d',strtotime($rows->start_date_work));

					$today_day =date('d');
			        $today_month = date('m');
			        $today_year = date('Y');
			        $today = gregoriantojd($today_month,$today_day,$today_year);
				////////////////////////////////////////////////////////////////////
					$rest = explode("/", $data['result'][0]->start_date_work); 

			        $start_year = $rest[2];
			        $start_month = $rest[1];
			        $start_day = $rest[0];
			        $start_date=gregoriantojd($start_month,$start_day,$start_year);

		       		$year=$today-$start_date;

					$year1 = date('Y',strtotime(date('Y')))-$start_year;


					// print_r($year1);
					// exit();
				
					if($year<365)
					{

						$data['annual_old']=0;
						$data['user_ID']=$user_ID;
						$data['annual_have']=0;
						$this->annual_model->insert_annual_have($data);
					}
					elseif($year1<3)
					{

						$data['year_old']=date('Y')-1;

					
						$data['annual_old_me']=$this->annual_model->annual_old($data);

						@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;

						$data['user_ID']=$user_ID;
				
						$data['annual_have']=6;
						$this->annual_model->insert_annual_have($data);
					}
					elseif($year1<4)
					{
						$data['year_old']=date('Y')-1;
						$data['annual_old_me']=$this->annual_model->annual_old($data);
						@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
						$data['user_ID']=$user_ID;
						$data['annual_have']=8;
						$this->annual_model->insert_annual_have($data);
					}
					else
					{
		
						$data['year_old']=date('Y')-1;
						$data['annual_old_me']=$this->annual_model->annual_old($data);
						@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
						$data['user_ID']=$user_ID;
						$data['annual_have']=10;
						// print_r($data['annual_old_me'][0]->annual_new_use);
						// exit();	
			
						$this->annual_model->insert_annual_have($data);
					}

				}
		
		if ($status_chk_all=='1') {
			redirect('setting/add_edit_delete_user/5','refresh');
		}
		

	}


	function setting_annual_all()
	{
	$data['get_user_all']=$this->user_model->get_user_all();	
		foreach ($data['get_user_all'] as $key => $value) {
		$data['user_ID']=$value->user_ID;
		$this->setting_annual($data['user_ID'],'2');
		}
		redirect('setting/add_edit_delete_user/5','refresh');
	}
	



}
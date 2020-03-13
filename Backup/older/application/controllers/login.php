<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('annual_model');
	}
	function index($status=null)
	{
		$data['status']=$status;

		function detect_mobile()
		{
		    if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
		        return true;

		    else
		        return false;
		}

		$mobile = detect_mobile();

		if($mobile === true){
		   $data['user_open_on']="mobile";
		}else{
		   $data['user_open_on']="com";
		}

		//echo $data['user_open_on'];
		//$data['redirect']="2";

		$this->load->view('login',$data);
	}
	function authen($link_email="")
	{

		// $usernameget=$this->input->get('username');
		// $passwordget=$this->input->get('password');
		if ($link_email=="1") {
			redirect('login/index/2','refresh');
		}
		elseif ($link_email=="2") {
			redirect('login/index/3','refresh');
		}
		else
		{
		$data['redirect']=$this->input->post('redirect');
		$data['username']=$this->input->post('username');
		$data['status_b']=$this->input->post('status_b');

		$password=$this->input->post('password');

		$data['password']=md5($password);	

		//echo $data['password'];
		//exit();
		}

		// echo $data['username'];
		// echo "<br>";
		// echo $data['password'];

		$data['result']=$this->user_model->get_user_login($data);
		

		if(empty($data['result']))
		{
			redirect('login/index/1','refresh');
		}
		else
		{
			$session_array=array();
			foreach($data['result'] as $rows)
			{
				$session_array=array(
					'user_ID'=>$rows->user_ID,
					'name_en'=>$rows->name_en,
					'surname_en'=>$rows->surname_en,
					'name_th'=>$rows->name_th,
					'surname_th'=>$rows->surname_th,
					'birth_date'=>date('Y-m-d',strtotime($rows->birth_date)),
					'start_date_work'=>date('Y-m-d',strtotime($rows->start_date_work)),
					'email'=>$rows->email,
					'phone'=>$rows->phone,
					'user_type_ID'=>$rows->user_type_ID,
					'department_ID'=>$rows->department_ID,
					'office_ID'=>$rows->office_ID,
					'user_type_Name'=>$rows->user_type_Name,
					'department_Name'=>$rows->department_Name,
					'office_Name'=>$rows->office_Name,
					'position_Name'=>$rows->position_Name,
					'position_ID'=>$rows->position_ID,
					'send_email_to'=>$rows->send_email_to,
					'this_year'=>date('Y'),
					'status_b'=>$data['status_b']
					);
				$this->session->set_userdata('login',$session_array);

				$data['user_ID']=$rows->user_ID;

				$this->setting_annual($data['user_ID']);
				// $data['annual_all']=$this->annual_model->annual_all($data);
				
				// if(sizeof($data['annual_all'])!="0")
				// {
				// 	$today_day =date('d');
			 //        $today_month = date('m');
			 //        $today_year = date('Y');
			 //        $today = gregoriantojd($today_month,$today_day,$today_year);
				// ////////////////////////////////////////////////////////////////////
				// 	$rest = explode("/", $rows->start_date_work); 

			 //        $start_year = $rest[2];
			 //        $start_month = $rest[1];
			 //        $start_day = $rest[0];
			 //        $start_date=gregoriantojd($start_month,$start_day,$start_year);

		  //      		$year=$today-$start_date;

				// 	$year1 = date('Y',strtotime(date('Y')))-$start_year;



				// 	if($year>=365)
				// 	{
				// 		if ($data['annual_all'][0]->annual_have==0) {

				// 		$data['year_old']=date('Y')-1;
				// 		$data['annual_old_me']=$this->annual_model->annual_old($data);
				// 		@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
				// 		$data['user_ID']=$rows->user_ID;
				// 		$data['annual_have']=6;
				// 		$data['annual_ID']=$data['annual_all'][0]->annual_ID;
				// 		$this->annual_model->update_annual_have($data);

				// 		}

				// 	}					

				// }
				// else
				// {
				// 	//$year = date('Y-m-d')-date('Y-m-d',strtotime($rows->start_date_work));


				// 	$today_day =date('d');
			 //        $today_month = date('m');
			 //        $today_year = date('Y');
			 //        $today = gregoriantojd($today_month,$today_day,$today_year);
				// ////////////////////////////////////////////////////////////////////
				// 	$rest = explode("/", $rows->start_date_work); 

			 //        $start_year = $rest[2];
			 //        $start_month = $rest[1];
			 //        $start_day = $rest[0];
			 //        $start_date=gregoriantojd($start_month,$start_day,$start_year);

		  //      		$year=$today-$start_date;

				// 	$year1 = date('Y',strtotime(date('Y')))-$start_year;


				// 	if($year<365)
				// 	{
				// 		$data['annual_old']=0;
				// 		$data['user_ID']=$rows->user_ID;
				// 		$data['annual_have']=0;
				// 		$this->annual_model->insert_annual_have($data);
				// 	}
				// 	elseif($year1<3)
				// 	{
				// 		$data['year_old']=date('Y')-1;
				// 		$data['annual_old_me']=$this->annual_model->annual_old($data);
				// 		@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
				// 		$data['user_ID']=$rows->user_ID;
				// 		$data['annual_have']=6;
				// 		$this->annual_model->insert_annual_have($data);
				// 	}
				// 	elseif($year1<=4)
				// 	{
				// 		$data['year_old']=date('Y')-1;
				// 		$data['annual_old_me']=$this->annual_model->annual_old($data);
				// 		@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
				// 		$data['user_ID']=$rows->user_ID;
				// 		$data['annual_have']=8;
				// 		$this->annual_model->insert_annual_have($data);
				// 	}
				// 	else
				// 	{
				// 		$data['year_old']=date('Y')-1;
				// 		$data['annual_old_me']=$this->annual_model->annual_old($data);
				// 		@$data['annual_old']=@$data['annual_old_me'][0]->annual_have-@$data['annual_old_me'][0]->annual_new_use;
				// 		$data['user_ID']=$rows->user_ID;
				// 		$data['annual_have']=10;
				// 		$this->annual_model->insert_annual_have($data);
				// 	}

				// }



				if(@$data['redirect']=="" or @$data['redirect']=="1")
					{
					redirect('home/index','refresh');
					}				
				elseif(@$data['redirect']=="2") 
					{
					redirect('leave/leave_approv','refresh');
					}
				elseif(@$data['redirect']=="3") 
					{
					redirect('leave/hr_approv','refresh');
					}					
			}
		}
	}

	function setting_annual($user_ID)
	{

	$data['user_ID']=$user_ID;
				//exit();

	$data['result']=$this->user_model->get_user_calculate_annual($data);

	$data['annual_all']=$this->annual_model->annual_all($data);


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
						$this->annual_model->insert_annual_have($data);
					}

				}
			
	}

}
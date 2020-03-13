<?php
/**
* Leave
*/
class Leave_model extends CI_Model
{
	function leave_type_title($data)
	{
		$this->db->select('title_name');
		$this->db->from('leave_type');
		$this->db->where('leave_type_ID',$data['leave_type']);
		$query=$this->db->get();
		foreach($query->result() as $row)
		{
			return $row;
		}
	}
	function add_leave($data)
	{
		$this->db->select('leave_ID');
		$this->db->from('leaves');
		$this->db->order_by('leave_ID','desc');
		$this->db->limit(1);
		$q=$this->db->get();
		$r=$q->result();
		if($r==null)
		{
			$new_id="ML".$data['leave_type_title']->title_name.date("Ymd").str_pad(1,2,"0",STR_PAD_LEFT);
		}
		else
		{
			$id="ML".$data['leave_type_title']->title_name.date("Ymd");
			$this->db->select_max('leave_ID');
			$this->db->from('leaves');
			$this->db->like('leave_ID',$id,'after');
			$query=$this->db->get();
			$check=$query->result();
			if($check==null)
			{
				$new_id="ML".$data['leave_type_title']->title_name.date("Ymd").str_pad(1,2,"0",STR_PAD_LEFT);
			}
			else
			{
				$id2=substr($check[0]->leave_ID,11,2);
				$new_id="ML".$data['leave_type_title']->title_name.date('Ymd').str_pad($id2+1,2,"0",STR_PAD_LEFT);
			}
		}
		$this->db->insert('leaves',array(
			'leave_ID'=>$new_id,
			'active_date'=>$data['today'],
			'active_by'=>$data['user']['user_ID'],
			'user_leave'=>$data['user_leave'],
			'subject'=>$data['subject'],
			'detail'=>$data['detail'],
			'start_date'=>$data['start'],
			'end_date'=>$data['end'],
			'total_date'=>$data['total_date'],
			'leave_type_ID'=>$data['leave_type'],
			'progression_ID'=>$data['progression'],
			'payment'=>$data['pay'],
			'costs'=>$data['costs'],
			'leave_attached'=>$data['userfile']			
			));
		$this->db->select('leave_ID');
		$this->db->from('leaves');
		$this->db->where('delete_flag',0);
		$this->db->order_by('leave_ID','desc');
		$this->db->limit(1);
		$query=$this->db->get();
		$result=$query->result();
		//$result[0]->leave_ID;
		for($i=0;$i<count($data['start_date']);$i++)
		{
			$this->db->insert('leave_detail',array(
				'leave_ID'=>$new_id,
				'leave_date'=>$data['start_date'][$i],
				'start_time'=>$data['start_time'][$i],
				'end_time'=>$data['end_time'][$i]
				));
		}
	}
	function search_leave_detail($data)
	{
		if($data['select_user_leave_detail']!=""){
			$q5="and leaves.user_leave='".$data['select_user_leave_detail']."'";
		}else{
			$q5="";
		};

		if(@$data['Department_ID']!="")
		{
			$q5.="and u2.department_ID='".@$data['Department_ID']."'";
		}

		// echo $q5;
		// exit();
		$q=$this->db->query("
			select *,u2.name_th as user_leave,u2.surname_th as user_leave_surname 
					,u2.name_en as user_leave_en,u2.surname_en as user_leave_surname_en 
			from `leaves`
			join `leave_type` on leaves.leave_type_ID=leave_type.leave_type_ID
			join `leave_group` on leave_type.leave_group_ID=leave_group.leave_group_ID
			join `acceptation` on leaves.ap_payment_ID=acceptation.acceptation_ID
			join  user u2 on leaves.user_leave=u2.user_ID
			join `user` on leaves.active_by=user.user_ID

			where leaves.delete_flag=0
			$q5
			and leaves.start_date between '".$data['search_start_date']."' and '".$data['search_end_date']."'
			order by leaves.start_date desc
			");

		return $q->result();
	}

	// Manager
	function leave_count($data)
	{
		// if($data['user']['user_type_ID']==1)
		// {
		// 	$condition="u.user_type_ID = 2";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else if($data['user']['user_type_ID']==2)
		// {
		// 	$condition="u.user_type_ID = 3 or u.user_type_ID = 7 or u.user_type_ID = 0 or u.user_type_ID = 5";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else if($data['user']['user_type_ID']==6)
		// {
		// 	$condition="u.user_type_ID = 1";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else if($data['user']['user_type_ID']==7)
		// {
		// 	$condition="u.user_type_ID = 3";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else
		// {
		// 	$condition="u.user_type_ID = 0 or u.user_type_ID = 1 or u.user_type_ID = 2 or u.user_type_ID = 3 or u.user_type_ID = 4 or u.user_type_ID = 5 or u.user_type_ID = 6 or u.user_type_ID = 7";
		// }
		// $query=$this->db->query("
		// 		select count(*) as count_user
		// 		from leaves l
		// 		join user u on l.user_leave=u.user_ID
		// 		where l.delete_flag = 0
		// 		".@$dep."
		// 		and l.acceptation_ID = 0
		// 		and (".$condition.")
		// 	");


		$query=$this->db->query("
				select count(*) as count_user
				from leaves l
				join user u on l.user_leave=u.user_ID
				where l.delete_flag = 0
				and u.send_email_to like '%".$data['user']['email']."%'
				and l.acceptation_ID = 0
				
			");

		return $query->result();
	}
	function leave_count_ap_hr($data)
	{
		if($data['user']['user_type_ID']==1)
		{
			$condition="u.user_type_ID = 2";
		}
		else if($data['user']['user_type_ID']==2)
		{
			$condition="u.user_type_ID = 3 or u.user_type_ID = 7 or u.user_type_ID = 0 or u.user_type_ID = 5";
		}
		else if($data['user']['user_type_ID']==6)
		{
			$condition="u.user_type_ID = 1";
		}
		else if($data['user']['user_type_ID']==7)
		{
			$condition="u.user_type_ID = 3";
		}
		else
		{
			$condition="u.user_type_ID = 0 or u.user_type_ID = 1 or u.user_type_ID = 2 or u.user_type_ID = 3 or u.user_type_ID = 4 or u.user_type_ID = 5 or u.user_type_ID = 6 or u.user_type_ID = 7";
		}
		// $query=$this->db->query("
		// 		select count(*) as count_user
		// 		from leaves l
		// 		join leave_type lt on l.leave_type_ID=lt.leave_type_ID
		// 		join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
		// 		join user u on l.user_leave=u.user_ID
		// 		join user u2 on l.active_by=u2.user_ID
		// 		join department d on u.department_ID=d.department_ID
		// 		join office o on d.office_ID=o.office_ID
		// 		where o.office_ID='".$data['user']['office_ID']."'
		// 		and (l.acceptation_ID=1 or l.acceptation_ID=2)
		// 		and l.delete_flag=0
		// 		and l.hr_approv=0
		// 		and (".$condition.")
		// 	");

		$query=$this->db->query("
				select count(*) as count_user
				from leaves l
				join leave_type lt on l.leave_type_ID=lt.leave_type_ID
				join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
				join user u on l.user_leave=u.user_ID
				join user u2 on l.active_by=u2.user_ID
				join department d on u.department_ID=d.department_ID
				join office o on d.office_ID=o.office_ID
				where 1=1
				and (l.acceptation_ID=1 or l.acceptation_ID=2)
				and l.delete_flag=0
				and l.hr_approv=0

			");
		return $query->result();
	}
	function leave_user_for_approv($data)
	{




		// if($data['user']['user_type_ID']==1)
		// {
		// 	$condition="u.user_type_ID = 2";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else if($data['user']['user_type_ID']==2)
		// {
		// 	$condition="u.user_type_ID = 3 or u.user_type_ID = 7 or u.user_type_ID = 0 or u.user_type_ID = 5";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';

		// }
		// else if($data['user']['user_type_ID']==6)
		// {
		// 	$condition="u.user_type_ID = 1";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else if($data['user']['user_type_ID']==7)
		// {
		// 	$condition="u.user_type_ID = 3";
		// 	$dep='and u.department_ID = "'.$data['user']['department_ID'].'"';
		// }
		// else
		// {
		// 	$condition="u.user_type_ID = 0 or u.user_type_ID = 1 or u.user_type_ID = 2 or u.user_type_ID = 3 or u.user_type_ID = 4 or u.user_type_ID = 5 or u.user_type_ID = 6 or u.user_type_ID = 7";
		
		// }
		// $query=$this->db->query("
		// 		select l.leave_ID,l.subject,l.detail,u.user_ID,u.name_th as user_leave,u.surname_th as user_leave_surname,lg.leave_group_Name,lt.leave_type_Name,
		// 		l.start_date,l.end_date,u2.name_th as active_leave,u2.surname_th as active_leave_surname,l.active_date,u.department_ID,l.leave_type_ID
		// 		from leaves l
		// 		join leave_type lt on l.leave_type_ID=lt.leave_type_ID
		// 		join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
		// 		join user u on l.user_leave=u.user_ID
		// 		join user u2 on l.active_by=u2.user_ID
		// 		where 1=1
		// 		".@$dep."
		// 		and l.acceptation_ID = 0
		// 		and (".$condition.")
		// 		order by l.leave_ID desc
		// 	");


			$query=$this->db->query("
				select l.leave_ID,l.subject,l.detail,u.user_ID,u.name_th as user_leave,u.surname_th as user_leave_surname,lg.leave_group_Name,lt.leave_type_Name,
				l.start_date,l.end_date,u2.name_th as active_leave,u2.surname_th as active_leave_surname,l.active_date,u.department_ID,l.leave_type_ID,l.leave_attached
				,u.name_en as user_leave_en,u.surname_en as user_leave_surname_en,u2.name_en as active_leave_en,u2.surname_en as active_leave_surname_en
				from leaves l
				join leave_type lt on l.leave_type_ID=lt.leave_type_ID
				join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
				join user u on l.user_leave=u.user_ID
				join user u2 on l.active_by=u2.user_ID
				where 1=1
				and u.send_email_to like '%".$data['user']['email']."%'
				and l.acceptation_ID = 0
			
				order by l.leave_ID desc
			");


		
		return $query->result();
	}
	function leave_hr_for_approv($data)
	{
		if($data['user']['user_type_ID']==1)
		{
			$condition="u.user_type_ID = 2";
		}
		else if($data['user']['user_type_ID']==2)
		{
			$condition="u.user_type_ID = 3 or u.user_type_ID = 7 or u.user_type_ID = 0 or u.user_type_ID = 5";
		}
		else if($data['user']['user_type_ID']==6)
		{
			$condition="u.user_type_ID = 1";
		}
		else if($data['user']['user_type_ID']==7)
		{
			$condition="u.user_type_ID = 3";
		}
		else
		{
			$condition="u.user_type_ID = 0 or u.user_type_ID = 1 or u.user_type_ID = 2 or u.user_type_ID = 3 or u.user_type_ID = 4 or u.user_type_ID = 5 or u.user_type_ID = 6 or u.user_type_ID = 7";
		}
		// $query=$this->db->query("
		// 		select l.leave_ID,l.subject,l.detail,u.user_ID,u.name_th as user_leave,u.surname_th as user_leave_surname,lg.leave_group_Name,lt.leave_type_Name,
		// 		l.start_date,l.end_date,u2.name_th as active_leave,u2.surname_th as active_leave_surname,l.active_date,l.leave_type_ID
		// 		from leaves l
		// 		join leave_type lt on l.leave_type_ID=lt.leave_type_ID
		// 		join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
		// 		join user u on l.user_leave=u.user_ID
		// 		join user u2 on l.active_by=u2.user_ID
		// 		join department d on u.department_ID=d.department_ID
		// 		join office o on d.office_ID=o.office_ID
		// 		where o.office_ID='".$data['user']['office_ID']."'
		// 		and (l.acceptation_ID=1 or l.acceptation_ID=2)
		// 		and l.delete_flag=0
		// 		and l.hr_approv=0
		// 		order by l.leave_ID desc
		// 	");

		$query=$this->db->query("
				select l.leave_ID,l.subject,l.detail,u.user_ID,u.name_th as user_leave,u.surname_th as user_leave_surname,lg.leave_group_Name,lt.leave_type_Name,
				l.start_date,l.end_date,u2.name_th as active_leave,u2.surname_th as active_leave_surname,l.active_date,l.leave_type_ID,l.leave_attached,
				u.name_en as user_leave_en,u.surname_en as user_leave_surname_en,u2.name_en as active_leave_en,u2.surname_en as active_leave_surname_en
				from leaves l
				join leave_type lt on l.leave_type_ID=lt.leave_type_ID
				join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
				join user u on l.user_leave=u.user_ID
				join user u2 on l.active_by=u2.user_ID
				join department d on u.department_ID=d.department_ID
				join office o on d.office_ID=o.office_ID
				where 1=1
				and (l.acceptation_ID=1 or l.acceptation_ID=2)
				and l.delete_flag=0
				and l.hr_approv=0
				order by l.leave_ID desc
			");

		return $query->result();
	}
	function leave_user_period($data)
	{
		if($data['user']['user_type_ID']==1)
		{
			$condition="u.user_type_ID = 2";
		}
		else if($data['user']['user_type_ID']==2)
		{
			$condition="u.user_type_ID = 3 or u.user_type_ID = 7 or u.user_type_ID = 0 or u.user_type_ID = 5";
		}
		else if($data['user']['user_type_ID']==6)
		{
			$condition="u.user_type_ID = 1";
		}
		else if($data['user']['user_type_ID']==7)
		{
			$condition="u.user_type_ID = 3";
		}
		else
		{
			$condition="u.user_type_ID = 0 or u.user_type_ID = 1 or u.user_type_ID = 2 or u.user_type_ID = 3 or u.user_type_ID = 4 or u.user_type_ID = 5 or u.user_type_ID = 6 or u.user_type_ID = 7";
		}
		$query=$this->db->query("
				select l.leave_ID,l.subject,l.detail,u.user_ID,u.name_en as user_leave,lg.leave_group_Name,lt.leave_type_Name,
				l.start_date,l.end_date,u2.name_en as active_leave,l.active_date
				from leaves l
				join leave_type lt on l.leave_type_ID=lt.leave_type_ID
				join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
				join user u on l.user_leave=u.user_ID
				join user u2 on l.active_by=u2.user_ID
				where u.department_ID = ".$data['user']['department_ID']."
				and l.acceptation_ID = 0
				and (".$condition.")
				order by l.leave_ID desc
			");
		return $query->result();
	}
	function update_leave($data)
	{
		$this->db->update('leaves',array(
					'manager_approv'=>$data['user']['user_ID'],
					'manager_approv_date'=>$data['now'],
					'acceptation_ID'=>$data['status'],
					'ap_payment_ID'=>$data['status'],
			),array('leave_ID'=>$data['leave_ID']));
	
	}
	function cancle_leave($data)
	{
		$this->db->delete('leaves',array(
						'leave_ID'=>$data['leave_ID']
				));
		$this->db->delete('leave_detail',array(
					'leave_ID'=>$data['leave_ID']
			));
	}
	function hr_update_leave($data)
	{
		
		$this->db->update('leaves',array(
					'hr_approv'=>$data['user']['user_ID'],
					'hr_approv_date'=>$data['now'],
					'ap_payment_ID'=>$data['status'],
			),array('leave_ID'=>$data['leave_ID']));
	
	}
	function check_user_department_ID($data)
	{

		if($data['user_type_ID_email']==3)
		{
			$q=$this->db->query("
			select email from `user`
			where (user.user_type_ID=2 or user.user_type_ID=7)
			and user.department_ID=".$data['user']['department_ID']."
			and user.email!='0'
			");
			return $q->result();
		}
		if($data['user_type_ID_email']==7)
		{
			$q=$this->db->query("
			select email from `user`
			where user.user_type_ID=2
			and user.department_ID=".$data['user']['department_ID']."
			and user.email!='0'
			");
			return $q->result();
		}
		if($data['user_type_ID_email']==2)
		{
			$q=$this->db->query("
			select email from `user`
			where user.user_type_ID=1
			and user.department_ID=".$data['user']['department_ID']."
			and user.email!='0'
			");
			return $q->result();
		}
		if($data['user_type_ID_email']==1)
		{
			$q=$this->db->query("
			select email from `user`
			where user.user_type_ID=6
			and user.department_ID=".$data['user']['department_ID']."
			and user.email!='0'
			");
			return $q->result();
		}
		
	}
	function get_leave_total_date($data)
	{

			$q=$this->db->query("SELECT total_date from `leaves`
								where leaves.leave_ID='".$data['leave_ID']."'
								");
			return $q->result();	
	}
	function do_upload($data)
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';

		$config['file_name'] = $data['userfile'];

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
		$error = array('error' => $this->upload->display_errors());
		 
		// $this->load->view('form_post_view', $error);
		echo $this->upload->display_errors();   // พอคลิก submit แล้วตรงนี้แสดง error You did not select a file to upload.ครับ ไม่ทราบว่าต้องแก้ยังไงครับ
		}
		else
		{
		$data = array('upload_data' => $this->upload->data());
		//$this->load->view('form_post_view', $data);
		}

	}
}
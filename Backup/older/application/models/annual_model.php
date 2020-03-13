<?php
/**
* User
*/
class Annual_model extends CI_Model
{
	function annual_all($data)
	{
		$query=$this->db->query("SELECT * 
							FROM `leave_annual` 
							join user u on u.user_ID=leave_annual.user_ID
							where leave_annual.user_ID='".$data['user_ID']."'
							AND leave_annual.year_ID='".date('Y')."'");
		//$result=$q->result();
		return $query->result();
	}
	function annual_old($data)
	{
		$query=$this->db->query("SELECT * 
							FROM `leave_annual` 
							join user u on u.user_ID=leave_annual.user_ID
							where leave_annual.user_ID='".$data['user_ID']."'
							AND leave_annual.year_ID='".$data['year_old']."'");
		//$result=$q->result();
		return $query->result();
	}
	function insert_annual_have($data)
	{
		$this->db->insert('leave_annual',array(
						'year_ID'=>date('Y'),
						'user_ID'=>$data['user_ID'],
						'annual_have'=>$data['annual_have'],
						'annual_old'=>$data['annual_old'],
			));
	}
	function update_annual_have($data)
	{
		$this->db->update('leave_annual',array(
					'annual_have'=>$data['annual_have'],
			),array('user_ID'=>$data['user_ID'],'annual_ID'=>$data['annual_ID']));
	}

	function annual_detail($data)
	{
		$query=$this->db->query("SELECT * 
							FROM `leave_annual` 
							join user u on u.user_ID=leave_annual.user_ID
							where leave_annual.user_ID='".$data['user_leave']
							."'
							AND leave_annual.year_ID='".date('Y')."'");
		//$result=$q->result();
		return $query->result();
	}
	function annual_detail_leave_appove($data)
	{
		$query=$this->db->query("SELECT * 
							FROM `leave_annual` 
							join user u on u.user_ID=leave_annual.user_ID
							where leave_annual.user_ID='".$data['user_ID_approv']."'
							AND leave_annual.year_ID='".date('Y')."'");
		//$result=$q->result();
		return $query->result();
	}
	function annual_update($data)
	{
		

		if($data['update_status']=='1')
		{
					$this->db->update('leave_annual',array(
					'annual_old_use'=>$data['annual_old_use'],
			),array('user_ID'=>$data['user_ID_approv'],'year_ID'=>date('Y')));
		}
		else
		{
					$this->db->update('leave_annual',array(
					'annual_new_use'=>$data['annual_new_use'],
			),array('user_ID'=>$data['user_ID_approv'],'year_ID'=>date('Y')));
		}

	}


}
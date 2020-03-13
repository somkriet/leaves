<?php
/**
* Calendar model
*/
class Calendar_Model extends CI_Model
{
	function get_non_working_time()
	{
		$now_date=date('Y-m-d');
		$now_year=date('Y');
		$this->db->select('*');
		$this->db->from('non_working_time');
		$this->db->where('non_working_time >',$now_date);
		$this->db->like('non_working_time',$now_year,'after');
		$this->db->order_by('non_working_time','asc');
		$query=$this->db->get();
		return $query->result();
	}	
	function get_non_working_time_all()
	{
		$now_date=date('Y');
		$this->db->select('*');
		$this->db->from('non_working_time');
		$this->db->like('non_working_time',$now_date,'after');
		$this->db->order_by('non_working_time','asc');
		$query=$this->db->get();
		return $query->result();
	}	
	function check_non_working_time_next_year()
	{
		$now_date=date('Y',strtotime('+1 year'));
		$this->db->select('*');
		$this->db->from('non_working_time');
		$this->db->like('non_working_time',$now_date,'after');
		$this->db->order_by('non_working_time','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_calendar($data)
	{
		$this->db->insert('non_working_time',array(
					'non_working_time'=>$data['non_working_time'],
					'detail'=>$data['detail'],
					'add_by'=>$data['user']['user_ID'],
					'add_date'=>$data['add_date']
			));
	}
	function del_calendar($data)
	{
		$this->db->delete('non_working_time',array('calendar_ID'=>$data['calendar_ID']));
	}
	function edit_calendar($data)
	{
		$this->db->update('non_working_time',array(
					'non_working_time'=>$data['non_working_time'],
					'detail'=>$data['detail'],
					'add_by'=>$data['user']['user_ID'],
					'add_date'=>$data['add_date']
			),array('calendar_ID'=>$data['calendar_ID']));
	}
}
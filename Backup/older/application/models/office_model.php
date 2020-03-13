<?php
/**
* Office
*/
class Office_model extends CI_Model
{
	function office_all()
	{
		$this->db->select('*');
		$this->db->from('office');
		$this->db->where('delete_flag',0);
		$this->db->order_by('office_ID','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function department_all()
	{
		$this->db->select('*');
		$this->db->from('department d');
		$this->db->join('office o','d.office_ID=o.office_ID');
		$this->db->where('d.delete_flag',0);
		$this->db->order_by('o.office_ID asc,d.department_ID asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_office($data)
	{
		$this->db->insert('office',array('office_Name'=>$data['office']));
	}
	function add_department($data)
	{
		$this->db->insert('department',array('department_Name'=>$data['department'],'office_ID'=>$data['office']));
	}
	function del_office($data)
	{
		$this->db->update('office',array('delete_flag'=>$data['delete_flag']),array('office_ID'=>$data['office_ID']));
	}
	function del_department($data)
	{
		$this->db->update('department',array('delete_flag'=>$data['delete_flag']),array('department_ID'=>$data['department_ID']));
	}
	function edit_office($data)
	{
		$this->db->update('office',array('office_Name'=>$data['office_Name']),array('office_ID'=>$data['office_ID']));
	}
	function edit_department($data)
	{
		$this->db->update('department',array('department_Name'=>$data['department_Name'],'office_ID'=>$data['office_ID']),array('department_ID'=>$data['department_ID']));
	}
}
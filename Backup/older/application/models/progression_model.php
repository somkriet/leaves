<?php
/**
* progression model
*/
class Progression_model extends CI_Model
{
	function progression_all()
	{
		$this->db->select('*');
		$this->db->from('progression');
		$this->db->order_by('progression_ID','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_progression($data)
	{
		$this->db->insert('progression',array('progression_Name'=>$data['progression_Name']));
	}
	function del_progression($data)
	{
		$this->db->delete('progression',array('progression_ID'=>$data['progression_ID']));
	}
	function edit_progression($data)
	{
		$this->db->update('progression',array(
						'progression_Name'=>$data['progression_Name']
			),array('progression_ID'=>$data['progression_ID']));
	}
}
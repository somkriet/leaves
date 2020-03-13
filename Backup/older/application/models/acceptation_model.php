<?php
/**
* Acceptation
*/
class Acceptation_model extends CI_Model
{
	function acceptation_all()
	{
		$this->db->select('*');
		$this->db->from('acceptation');
		$this->db->order_by('acceptation_ID','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_acception($data)
	{
		$this->db->insert('acceptation',array(
					'acceptation_Name'=>$data['acceptation']
			));
	}
	function del_acception($data)
	{
		$this->db->delete('acceptation',array(
					'acceptation_ID'=>$data['acceptation_ID']
			));
	}
	function edit_acception($data)
	{
		$this->db->update('acceptation',array(
					'acceptation_Name'=>$data['acceptation_Name']),
					array('acceptation_ID'=>$data['acceptation_ID']
			));
	}
}
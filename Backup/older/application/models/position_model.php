<?php
/**
* User
*/
class Position_model extends CI_Model
{

	function position_all()
	{
		$this->db->select('*');
		$this->db->from('position');
		$query=$this->db->get();
		return $query->result();
	}
		
		function add_position($data)
	{
		$this->db->insert('position',array('position_Name'=>$data['position_Name']));
	}
	function del_position($data)
	{
		$this->db->delete('position',array('position_ID'=>$data['position_ID']));
	}
	function edit_position($data)
	{
		$this->db->update('position',array(
						'position_Name'=>$data['position_Name']
			),array('position_ID'=>$data['position_ID']));
	}



}
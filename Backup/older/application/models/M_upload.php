<?php
/**
* Leave
*/
class M_upload extends CI_Model
{
	function update_upload($data)
	{
		$this->db->query("
			update leaves
			set leave_attached = '".$data['namefile']."'
			where leave_ID = '".$data['leave_ID']."'
			");
	}
}
?>
<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class all_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function call_one($query)
	{
		$this->db->reconnect();
		$q=$this->db->query($query);
		return $q->row();
	}

	public function call_all($query)
	{
		$this->db->reconnect();
		$q=$this->db->query($query);
		return $q->result();
	}

	public function call_not($query)
	{
		$this->db->reconnect();
		$q=$this->db->query($query);
	}

	public function get_userdata($username,$password)
	{
		$query="SELECT *
					FROM user
					INNER JOIN user_type ON user.user_type_ID = user_type.user_type_ID
				WHERE user_ID = '$username'
				AND password = '$password'
				AND user_status = 0";

		$this->db->reconnect();
		$q=$this->db->query($query);
		return $q->result();
	}

	function call_store($data)
	{
		$this->db->reconnect();
		$q=$this->db->query($data['store_name']);		
		return $q->result();
	}

}
?>
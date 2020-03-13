<?php
/**
* User
*/
class User_model extends CI_Model
{
	function get_user_login($data)
	{
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->join('department d','u.department_ID=d.department_ID');
		$this->db->join('office o','d.office_ID=o.office_ID');
		$this->db->join('user_type ut','u.user_type_ID=ut.user_type_ID');
		$this->db->join('position p','p.position_ID=u.position_ID');
		$this->db->where('u.user_ID',$data['username']);
		$this->db->where('u.password',$data['password']);
		$this->db->where('u.user_status',0);
		$query=$this->db->get();
		return $query->result();
	}
	function get_user_calculate_annual($data)
	{
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->join('department d','u.department_ID=d.department_ID');
		$this->db->join('office o','d.office_ID=o.office_ID');
		$this->db->join('user_type ut','u.user_type_ID=ut.user_type_ID');
		$this->db->join('position p','p.position_ID=u.position_ID');
		$this->db->where('u.user_ID',$data['user_ID']);
		$query=$this->db->get();
		return $query->result();
	}
	
	function get_user_type_all()
	{
		$this->db->select('*');
		$this->db->from('user_type');
		$this->db->order_by('user_type_ID','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_user_type($data)
	{
		$this->db->insert('user_type',array(
						'user_type_Name'=>$data['user_type_Name']
			));
	}
	function del_user_type($data)
	{
		$this->db->delete('user_type',array('user_type_ID'=>$data['user_type_ID']));
	}
	function edit_user_type($data)
	{
		$this->db->update('user_type',array(
						'user_type_Name'=>$data['user_type_Name']
			),array('user_type_ID'=>$data['user_type_ID']));
	}
	function add_user($data)
	{
		$this->db->insert('user',array(
						'user_ID'=>$data['user_ID'],
						'name_en'=>$data['name_en'],
						'surname_en'=>$data['surname_en'],
						'name_th'=>$data['name_th'],
						'surname_th'=>$data['surname_th'],
						'email'=>$data['email'],
						'phone'=>$data['phone'],
						'department_ID'=>$data['department_ID'],
						'user_type_ID'=>$data['user_type_ID'],
						'position_ID'=>$data['position_ID'],
						'send_email_to'=>$data['send_email_to'],
						'start_date_work'=>$data['start_date_work'],
						'username'=>$data['username'],
						'password'=>$data['password'],
			));
	}
	function edit_user($data)
	{
		$this->db->update('user',array(
						'user_ID'=>$data['user_ID'],
						'name_en'=>$data['name_en'],
						'surname_en'=>$data['surname_en'],
						'name_th'=>$data['name_th'],
						'surname_th'=>$data['surname_th'],
						'email'=>$data['email'],
						'phone'=>$data['phone'],
						'department_ID'=>$data['department_ID'],
						'user_type_ID'=>$data['user_type_ID'],
						'position_ID'=>$data['position_ID'],
						'send_email_to'=>$data['send_email_to'],
						'start_date_work'=>$data['start_date_work'],
					
			),array('user_ID'=>$data['user_ID']));


		$this->db->update('leave_annual',array(
						'annual_have'=>$data['ann_have'],
						'annual_old'=>$data['ann_old'],
						'annual_old_use'=>$data['ann_old_use'],
						'annual_new_use'=>$data['ann_new_use'],
					
			),array('user_ID'=>$data['user_ID'],'year_ID'=>date('Y')));
		
		//echo date('Y');
	}
	function del_user($data)
	{
		$this->db->update('user',array(
						'user_status'=>$data['user_status']
			),array('user_ID'=>$data['user_ID']));
	}
	function get_user_by_session($data)
	{
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->join('department d','u.department_ID=d.department_ID');
		$this->db->join('office o','d.office_ID=o.office_ID');
		$this->db->join('user_type t','u.user_type_ID=t.user_type_ID');
		$this->db->join('position p','p.position_ID=u.position_ID');
		$this->db->where('u.user_ID',$data['user']['user_ID']);
		$query=$this->db->get();
		return $query->result();
	}
	function get_user_by_department($data)
	{
		// $this->db->select('*','SubStr(name_en,InStr(name_en,'.')+1)AS lname' );
		// $this->db->from('user u');
		// $this->db->join('department d','u.department_ID=d.department_ID');
		// $this->db->join('office o','d.office_ID=o.office_ID');
		// $this->db->where('o.office_ID',$data['user']['office_ID']);
		// $this->db->order_by('u.user_ID asc');
		// $query=$this->db->get();
		// return $query->result();
				
		if($data['user']['user_type_ID']==5 or $data['user']['position_ID']==28 or $data['user']['position_ID']==29){

			$query=$this->db->query("SELECT *,SubStr(name_en,InStr(name_en,'.')+1) AS name_en_show
							FROM `user` 
							join department on user.department_ID=department.department_ID 
							join office on  department.office_ID=office.office_ID 
							where user.user_status = 0
							ORDER BY user_ID ASC");
			//							where office.office_ID='".$data['user']['office_ID']."'
		//$result=$q->result();
		return $query->result();
		}else{
			$query=$this->db->query("SELECT *,SubStr(name_en,InStr(name_en,'.')+1) AS name_en_show
							FROM `user` 
							join department on user.department_ID=department.department_ID 
							join office on  department.office_ID=office.office_ID 
							where office.office_ID='".$data['user']['office_ID']."'
							AND department.department_ID='".$data['user']['department_ID']."'
							AND user.user_status = 0
							ORDER BY user_ID ASC");
		return $query->result();
		}
	}


	function test_test_test($data,$a)
	{
		// $this->db->select('*','SubStr(name_en,InStr(name_en,'.')+1)AS lname' );
		// $this->db->from('user u');
		// $this->db->join('department d','u.department_ID=d.department_ID');
		// $this->db->join('office o','d.office_ID=o.office_ID');
		// $this->db->where('o.office_ID',$data['user']['office_ID']);
		// $this->db->order_by('u.user_ID asc');
		// $query=$this->db->get();
		// return $query->result();
				
		if($data['user']['user_type_ID']==5 or $data['user']['position_ID']==28 or $data['user']['position_ID']==29){

			$query=$this->db->query("SELECT *,SubStr(name_en,InStr(name_en,'.')+1) AS name_en_show
							FROM `user` 
							join department on user.department_ID=department.department_ID 
							join office on  department.office_ID=office.office_ID 

							ORDER BY user_ID ASC");
			//							where office.office_ID='".$data['user']['office_ID']."'
		//$result=$q->result();
		return $query->result();
		}else{
			$query=$this->db->query("SELECT *,SubStr(name_en,InStr(name_en,'.')+1) AS name_en_show
							FROM `user` 
							join department on user.department_ID=department.department_ID 
							join office on  department.office_ID=office.office_ID 
							where office.office_ID='".$data['user']['office_ID']."'
							AND department.department_ID='".$a."'
							ORDER BY user_ID ASC");
		return $query->result();
		}
	}


	function get_user_by_select_search($data)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_ID',$data['select_user_leave_detail']);
		$this->db->where('user_status',0);
		$query=$this->db->get();
		return $query->result();
	}

	function get_user_all()
	{
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->join('department d','u.department_ID=d.department_ID');
		$this->db->join('office o','d.office_ID=o.office_ID');
		$this->db->where('u.user_status',0);
		
		$this->db->order_by('u.user_ID asc');
		$query=$this->db->get();
		return $query->result();
	}

	function get_user_search($data)
	{

		$query=$this->db->query("SELECT * 
							FROM `user` 
							join user_type on user.user_type_ID=user_type.user_type_ID  
							join department on user.department_ID=department.department_ID 
							join office on  department.office_ID=office.office_ID 
							join position on  position.position_ID=user.position_ID 
							where user.name_en like '%".$data['search_user']."%'
							or user.name_th like '%".$data['search_user']."%'
							or user.user_ID like '%".$data['search_user']."%'
							AND user.user_status=0");
		//$result=$q->result();
		return $query->result();
	}

	function alluser_search($data)
	{
		$query=$this->db->query("Select YEAR(start_date) as start_date
						FROM  db_leave.leaves
						GROUP BY YEAR(start_date)");
		$result=$query->result();
		return $result;
	}
	function user_search($data)
	{
		$query=$this->db->query("Select YEAR(start_date) as start_date
						FROM  db_leave.leaves
						GROUP BY YEAR(start_date)");
		$result=$query->result();
		return $result;
	}
}
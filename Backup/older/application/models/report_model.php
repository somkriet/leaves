<?php
/**
* User
*/
class Report_model extends CI_Model
{
	function report_user($data)
	{
		if(empty($data['search_start_date'])){
			$m=date('Y-m-');
			$m2=date('Y-m-',strtotime("-1 month"));
			$data['search_start_date']=$m2."15";
			$data['search_end_date']=$m."16";
		}
		// echo $data['search_start_date'],$data['search_end_date'];

		// exit();
			$q=$this->db->query("
			SELECT

			T2.user_ID AS `ID`,
			db_leave.department.department_Name AS `Dep`,
			T2.name_en AS `Nname`,
			T2.surname_en AS `Lname`,
			FORMAT((DATEDIFF('".$data['search_end_date']."','".$data['search_start_date']."')+1),1) AS `daywork`,
			DATEDIFF('".$data['search_end_date']."','".$data['search_start_date']."')+1 - SUM(IF(((TIME_FORMAT(T9.end_time,'%H:%i') 
			- TIME_FORMAT(T9.start_time,'%H:%i'))/9) = 1,1,0.5)) AS `sumdaywork`,
			SUM(IF(((TIME_FORMAT(T9.end_time,'%H:%i') - TIME_FORMAT(T9.start_time,'%H:%i'))/9) = 1,1,0.5)) AS `lostdaywork`,
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T10.end_time,'%H:%i') - TIME_FORMAT(T10.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T4, db_leave.leave_detail T10
			WHERE
			T4.leave_ID = T1.leave_ID AND T10.leave_detail_ID = T9.leave_detail_ID  AND T4.leave_type_ID = 6),0)) AS `leavesummer`,
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T11.end_time,'%H:%i') - TIME_FORMAT(T11.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T5, db_leave.leave_detail T11
			WHERE
			T5.leave_ID = T1.leave_ID AND T11.leave_detail_ID = T9.leave_detail_ID AND T5.ap_payment_ID = 4 AND T5.leave_type_ID = 3),0)) +
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T12.end_time,'%H:%i') - TIME_FORMAT(T12.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T6, db_leave.leave_detail T12
			WHERE
			T6.leave_ID = T1.leave_ID AND T12.leave_detail_ID = T9.leave_detail_ID AND T6.ap_payment_ID = 4 AND T6.leave_type_ID = 4),0)) AS `leave1`,
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T13.end_time,'%H:%i') - TIME_FORMAT(T13.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T5, db_leave.leave_detail T13
			WHERE
			T5.leave_ID = T1.leave_ID AND T13.leave_detail_ID = T9.leave_detail_ID AND T5.ap_payment_ID = 5 AND T5.leave_type_ID = 3),0)) +
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T14.end_time,'%H:%i') - TIME_FORMAT(T14.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T6, db_leave.leave_detail T14
			WHERE
			T6.leave_ID = T1.leave_ID AND T14.leave_detail_ID = T9.leave_detail_ID AND T6.ap_payment_ID = 5 AND T6.leave_type_ID = 4),0)) AS `leave2`,
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T15.end_time,'%H:%i') - TIME_FORMAT(T15.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T7, db_leave.leave_detail T15
			WHERE
			T7.leave_ID = T1.leave_ID AND T15.leave_detail_ID = T9.leave_detail_ID AND T7.ap_payment_ID = 4 AND T7.leave_type_ID = 5),0)) AS `leave3`,
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T16.end_time,'%H:%i') - TIME_FORMAT(T16.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T8, db_leave.leave_detail T16
			WHERE
			T8.leave_ID = T1.leave_ID AND T16.leave_detail_ID = T9.leave_detail_ID AND T8.ap_payment_ID = 4 
			AND (T8.leave_type_ID = 9 OR T8.leave_type_ID = 10 OR T8.leave_type_ID = 11 OR T8.leave_type_ID = 12 OR T8.leave_type_ID = 13) ),0)) AS `leave5`,
			SUM(COALESCE((SELECT IF(((TIME_FORMAT(T16.end_time,'%H:%i') - TIME_FORMAT(T16.start_time,'%H:%i'))/9) = 1,1,0.5)
			FROM db_leave.`leaves` T8, db_leave.leave_detail T16
			WHERE
			T8.leave_ID = T1.leave_ID AND T16.leave_detail_ID = T9.leave_detail_ID AND T8.ap_payment_ID = 5 AND T8.leave_type_ID = 5),0)) AS `leave4`
			FROM
			db_leave.`leaves` AS T1
			INNER JOIN db_leave.`user` AS T2 ON T1.user_leave = T2.user_ID
			INNER JOIN db_leave.leave_detail T9 ON T1.leave_ID = T9.leave_ID
			INNER JOIN db_leave.leave_type AS T3 ON T1.leave_type_ID = T3.leave_type_ID
			INNER JOIN db_leave.department ON T2.department_ID = db_leave.department.department_ID
			WHERE
			T1.ap_payment_ID <> 0
			AND
			T1.ap_payment_ID <> 1
			AND
			T1.ap_payment_ID <> 2
			AND
			T1.ap_payment_ID <> 3
			AND
			T9.leave_date BETWEEN '".$data['search_start_date']."T00:00:00' and '".$data['search_end_date']."T23:59:59.998'
			AND
			db_leave.department.department_Name = '".$data['user']['department_Name']."'
			GROUP BY
			T2.user_ID, db_leave.department.department_Name, T2.name_en, T2.surname_en
			ORDER BY Dep
			");
		return $q->result();
	}
	function report_user_time($data)
	{

		$this->db->select('*');
		$this->db->from('leaves l');
		$this->db->join('acceptation a','l.acceptation_ID =a.acceptation_ID');
		$this->db->join('leave_type le','l.leave_type_ID =le.leave_type_ID');
		$this->db->join('leave_detail ld','ld.leave_ID =l.leave_ID');
		$this->db->where('l.user_leave',$data['user']['user_ID']);
		$this->db->like('l.start_date',date("Y"),'befor');
		$query=$this->db->get();
		return $query->result();
	}
	function report_user_print($data)
	{
		//$this->db->select('l.active_date,l.start_date,l.end_date,l.leave_ID,le.leave_type_Name,l.total_date,l.subject,a.acceptation_Name,u.name_th as a,u2.name_th as b');
		$this->db->select('*,u.name_th as manager_name,u2.name_th as hr_name');
		$this->db->from('leaves l');
		$this->db->join('acceptation a','l.acceptation_ID =a.acceptation_ID');
		$this->db->join('leave_type le','l.leave_type_ID =le.leave_type_ID');
		$this->db->join('user u','l.manager_approv =u.user_ID');
		$this->db->join('user u2','l.hr_approv =u2.user_ID');

		$this->db->where('l.user_leave',$data['user']['user_ID']);
		$this->db->like('l.start_date',date("Y"),'befor');
		$query=$this->db->get();
		return $query->result();
	}
	function report_alluser($data)
	{
		if(empty($data['search_start_date'])){
			$m=date('Y-m-');
			$m2=date('Y-m-',strtotime("-1 month"));
			$data['search_start_date']=$m2."15";
			$data['search_end_date']=$m."16";
		}
			$q=$this->db->query("
SELECT
T2.user_ID AS `ID`,
db_leave.department.department_Name AS `Dep`,
T2.name_en AS `Nname`,
T2.surname_en AS `Lname`,
FORMAT((DATEDIFF('".$data['search_end_date']."','".$data['search_start_date']."')+1),1) AS `daywork`,
DATEDIFF('".$data['search_end_date']."','".$data['search_start_date']."')+1 - SUM(IF(((TIME_FORMAT(T9.end_time,'%H:%i') 
- TIME_FORMAT(T9.start_time,'%H:%i'))/9) = 1,1,0.5)) AS `sumdaywork`,
SUM(IF(((TIME_FORMAT(T9.end_time,'%H:%i') - TIME_FORMAT(T9.start_time,'%H:%i'))/9) = 1,1,0.5)) AS `lostdaywork`,
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T10.end_time,'%H:%i') - TIME_FORMAT(T10.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T4, db_leave.leave_detail T10
WHERE
T4.leave_ID = T1.leave_ID AND T10.leave_detail_ID = T9.leave_detail_ID  AND T4.leave_type_ID = 6),0)) AS `leavesummer`,
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T11.end_time,'%H:%i') - TIME_FORMAT(T11.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T5, db_leave.leave_detail T11
WHERE
T5.leave_ID = T1.leave_ID AND T11.leave_detail_ID = T9.leave_detail_ID AND T5.ap_payment_ID = 4 AND T5.leave_type_ID = 3),0)) +
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T12.end_time,'%H:%i') - TIME_FORMAT(T12.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T6, db_leave.leave_detail T12
WHERE
T6.leave_ID = T1.leave_ID AND T12.leave_detail_ID = T9.leave_detail_ID AND T6.ap_payment_ID = 4 AND T6.leave_type_ID = 4),0)) AS `leave1`,
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T13.end_time,'%H:%i') - TIME_FORMAT(T13.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T5, db_leave.leave_detail T13
WHERE
T5.leave_ID = T1.leave_ID AND T13.leave_detail_ID = T9.leave_detail_ID AND T5.ap_payment_ID = 5 AND T5.leave_type_ID = 3),0)) +
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T14.end_time,'%H:%i') - TIME_FORMAT(T14.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T6, db_leave.leave_detail T14
WHERE
T6.leave_ID = T1.leave_ID AND T14.leave_detail_ID = T9.leave_detail_ID AND T6.ap_payment_ID = 5 AND T6.leave_type_ID = 4),0)) AS `leave2`,
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T15.end_time,'%H:%i') - TIME_FORMAT(T15.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T7, db_leave.leave_detail T15
WHERE
T7.leave_ID = T1.leave_ID AND T15.leave_detail_ID = T9.leave_detail_ID AND T7.ap_payment_ID = 4 AND T7.leave_type_ID = 5),0)) AS `leave3`,
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T16.end_time,'%H:%i') - TIME_FORMAT(T16.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T8, db_leave.leave_detail T16
WHERE
T8.leave_ID = T1.leave_ID AND T16.leave_detail_ID = T9.leave_detail_ID AND T8.ap_payment_ID = 4 
AND (T8.leave_type_ID = 9 OR T8.leave_type_ID = 10 OR T8.leave_type_ID = 11 OR T8.leave_type_ID = 12 OR T8.leave_type_ID = 13) ),0)) AS `leave5`,
SUM(COALESCE((SELECT IF(((TIME_FORMAT(T16.end_time,'%H:%i') - TIME_FORMAT(T16.start_time,'%H:%i'))/9) = 1,1,0.5)
FROM db_leave.`leaves` T8, db_leave.leave_detail T16
WHERE
T8.leave_ID = T1.leave_ID AND T16.leave_detail_ID = T9.leave_detail_ID AND T8.ap_payment_ID = 5 AND T8.leave_type_ID = 5),0)) AS `leave4`
FROM
db_leave.`leaves` AS T1
INNER JOIN db_leave.`user` AS T2 ON T1.user_leave = T2.user_ID
INNER JOIN db_leave.leave_detail T9 ON T1.leave_ID = T9.leave_ID
INNER JOIN db_leave.leave_type AS T3 ON T1.leave_type_ID = T3.leave_type_ID
INNER JOIN db_leave.department ON T2.department_ID = db_leave.department.department_ID
WHERE
T1.ap_payment_ID <> 0
AND
T1.ap_payment_ID <> 1
AND
T1.ap_payment_ID <> 2
AND
T1.ap_payment_ID <> 3
AND
T9.leave_date BETWEEN '".$data['search_start_date']."T00:00:00' and '".$data['search_end_date']."T23:59:59.998'
GROUP BY
T2.user_ID, db_leave.department.department_Name, T2.name_en, T2.surname_en
ORDER BY Dep
			");
		return $q->result();
	}
	function report_alluser_print($data)
	{
		//$this->db->select('l.active_date,l.start_date,l.end_date,l.leave_ID,le.leave_type_Name,l.total_date,l.subject,a.acceptation_Name,u.name_th as a,u2.name_th as b');
		$this->db->select('*,u.name_th as manager_name,u2.name_th as hr_name');
		$this->db->from('leaves l');
		$this->db->join('acceptation a','l.acceptation_ID =a.acceptation_ID');
		$this->db->join('leave_type le','l.leave_type_ID =le.leave_type_ID');
		$this->db->join('user u','l.manager_approv =u.user_ID');
		$this->db->join('user u2','l.hr_approv =u2.user_ID');
	//$this->db->where('l.user_leave',$data['user']['user_ID']);
		$this->db->like('l.start_date',date("Y"),'befor');
		$query=$this->db->get();
		return $query->result();
	}
	function report_alluser_time($data)
	{

		$this->db->select('*');
		$this->db->from('leaves l');
		$this->db->join('acceptation a','l.acceptation_ID =a.acceptation_ID');
		$this->db->join('leave_type le','l.leave_type_ID =le.leave_type_ID');
		$this->db->join('leave_detail ld','ld.leave_ID =l.leave_ID');
		$this->db->like('l.start_date',date("Y"),'befor');
		$query=$this->db->get();
		return $query->result();
	}
	function report_alluser_getdetail($data)
	{
		foreach ($data['report_user'] as $key => $value) {
			$q=$this->db->query("
			select *
			from db_leave.`leaves`
			inner join db_leave.leave_detail ON `leaves`.leave_ID = leave_detail.leave_ID
			where user_leave = '".$value->ID."'
			");
		$j[]=$q->result();
		}
		return $j;
	}
	
	
}
?>
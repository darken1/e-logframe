<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Calendarmodel extends CI_Model {

	private $tbl_roles= 'calendar';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('calendar');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   function list_by_user($user_id)
	 {
	 	$array='array';
		$data = array();
		$this->db->select('t1.*,t1.id AS calendar_id, t2.*')
          ->from('calendar AS t1, users AS t2')
		  ->where('t1.user_id = t2.id')
		  ->where('t1.user_id',$user_id)
		  ->order_by('t1.id DESC');
		  
		return $this->db->get();
	 }
	 
	 
	 function get_by_date($date)
	 {
	 	$query = $this->db->query("SELECT t1.*
	 	FROM calendar AS t1
	 	WHERE t1.start_date<='".$date."' AND t1.end_date >='".$date."'
	 	ORDER BY t1.id DESC");
		return $query->result();
	 }

   public function count_all()
   {
       return $this->db->count_all($this->tbl_roles);
   }

   public function get_by_id($id)
   {
       $this->db->where('id', $id);
       return $this->db->get($this->tbl_roles);
   }

   public function save($role)
   {
       $this->db->insert($this->tbl_roles, $role);
       return $this->db->insert_id();
   }

   public function update($id,$role)
   {
       $this->db->where('id', $id);
       $this->db->update($this->tbl_roles, $role);
   }

   public function delete($id)
   {
       $this->db->where('id', $id);
       $this->db->delete($this->tbl_roles);
   }

}

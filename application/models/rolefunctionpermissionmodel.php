<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rolefunctionpermissionmodel extends CI_Model {

	private $tbl_roles= 'rolefunctionpermission';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('rolefunctionpermission');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function get_tables()
   {
	   $sql = "SELECT table_name FROM information_schema.tables
WHERE table_type = 'base table'
AND  table_schema = 'drcdbase';";
	   $query = $this->db->query($sql);
        
       return $query->result();
   }
   
   /**
    public function get_tables()
   {
	   $sql = "SELECT table_name FROM information_schema.tables
WHERE table_type = 'base table'
AND  table_schema = 'drc_crdb';";
	   $query = $this->db->query($sql);
        
       return $query->result();
   }
    **/
   
  
   
   public function get_permissions()
   {
       $data = array();
       $Q = $this->db->get('permissions');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function authorised($role,$function,$permission)
   {
	   $this->db->where('role', $role);
	   $permission =  $this->db->get($this->tbl_roles)->row();
	   $json = $permission->rolefunction;
		$myarray=json_decode($json,true);
		$values = $myarray[0];
		
		$authorised = 0;
		foreach($values as $key=>$value)
		{
			if($value==$function)
			{
				$authorised = $authorised+1;
			}
		}
		
		if($authorised > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
   }
   
   public function check_function($role_id,$rolefunction)
   {
	   
	    $this->db->where('role_id', $role_id);
		$permission =  $this->db->get($this->tbl_roles)->row();
		
		$json = $permission->rolefunction;
		$myarray=json_decode($json,true);
		$values = $myarray[0];
		
		$authorised = 0;
		foreach($values as $key=>$value)
		{
			if($value==$rolefunction)
			{
				$authorised = $authorised+1;
			}
		}
		
		if($authorised > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
													
   }
   
   public function check_permission($role_id,$rolepermission)
   {
	   
	    $this->db->where('role_id', $role_id);
		$permission =  $this->db->get($this->tbl_roles)->row();
		
		$json = $permission->rolepermission;
		$myarray=json_decode($json,true);
		$values = $myarray[0];
		
		$authorised = 0;
		foreach($values as $key=>$value)
		{
			if($value==$rolepermission)
			{
				$authorised = $authorised+1;
			}
		}
		
		if($authorised > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
													
   }
   
    public function delete_by_role($role_id)
   {
       $this->db->where('role_id', $role_id);
       $this->db->delete($this->tbl_roles);
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

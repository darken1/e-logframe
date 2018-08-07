<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rollingactionplansmodel extends CI_Model {

	private $tbl_roles= 'rollingactionplans';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('rollingactionplans');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
    public function get_list_by_project($project_id)
   {
       $data = array();
	   $this->db->where('project_id',$project_id);
       $Q = $this->db->get('rollingactionplans');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   
   public function get_list_by_primary_activity($plannedactivity_id,$primary)
   {
       $data = array();
	   $this->db->where('plannedactivity_id',$plannedactivity_id);
	   $this->db->where('primary_activity',$primary);
       $Q = $this->db->get('rollingactionplans');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
    public function get_list_by_activity_region($plannedactivity_id,$county_id)
   {
       $data = array();
	   $this->db->where('plannedactivity_id',$plannedactivity_id)
	   			->where('county_id',$county_id);
       $Q = $this->db->get('rollingactionplans');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   
    public function get_list_by_activity($plannedactivity_id)
   {
       $data = array();
	   $this->db->where('plannedactivity_id',$plannedactivity_id);
       $Q = $this->db->get('rollingactionplans');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
    public function get_list_by_parent($parent_id)
   {
       $data = array();
	   $this->db->where('parent_id',$parent_id);
       $Q = $this->db->get('rollingactionplans');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
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

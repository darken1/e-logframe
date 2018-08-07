<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectsmodel extends CI_Model {

	private $tbl_roles= 'projects';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('projects');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   
   function get_combined_list()
	 {
	 	$array='array';
		$data = array();
		$this->db->select('t1.*')
          ->from('projects AS t1')
		  ->order_by('t1.id DESC')
		  ->limit(10);
		  
		return $this->db->get();
	 }
   
   public function get_list_by_organization($organization_id)
   {
       $data = array();
	   $this->db->where('organization_id',$organization_id);
       $Q = $this->db->get('projects');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function get_by_country_dates_all($country_id,$start_date,$end_date)
   {
	    $data = array();
	   
	   $sql = 'SELECT * FROM projects
	   WHERE projects.country_id = '.$country_id.'
	   AND "'.$end_date.'" >= project_start_date AND project_end_date >= "'.$start_date.'"';
	   
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   
   public function get_by_country_dates($country_id,$start_date,$end_date)
   {
	    $data = array();
	   
	   $sql = 'SELECT * FROM projects
	   WHERE projects.country_id = '.$country_id.'
	   AND "'.$end_date.'" >= project_start_date AND project_end_date >= "'.$start_date.'"
	   AND projects.projectactivitystatus_id=2';
	   
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   
   public function get_list_by_country($country_id)
   {
       $data = array();
	   $this->db->where('country_id',$country_id);
       $Q = $this->db->get('projects');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function get_list_by_country_status($country_id,$projectactivitystatus_id)
   {
       $data = array();
	   $this->db->where('country_id',$country_id)
	            ->where('projectactivitystatus_id',$projectactivitystatus_id);
       $Q = $this->db->get('projects');
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
   
    public function get_by_no($project_no)
   {
       $this->db->where('project_no', $project_no);
       return $this->db->get($this->tbl_roles);
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

<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Subsectorsmodel extends CI_Model {

	private $tbl_roles= 'subsectors';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('subsectors');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   function get_list_by_sector($sector_id) {

		$data = array();
		$this->db->where('sector_id',$sector_id);
		$Q = $this->db->get('subsectors');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
   
   
    function get_funding($project_id,$county_id,$organization_id,$donor_id,$status,$sector_id)
	{
		$data = array();		
		$sql = 'SELECT projects.*, projects.id AS theproject_id, counties.*, organizations.*, sectors.*, donors.*, projectscounties.*,projectdonors.*,projectsectors.*
	   			FROM projects, counties, organizations, sectors, donors, projectscounties,projectdonors,projectsectors
				WHERE projects.id !=0';
	   $sql .= ' AND projects.id =  projectscounties.project_id
	   AND counties.id = projectscounties.county_id
	   AND organizations.id = projects.organization_id
	   AND projects.id = projectsectors.project_id
	   AND sectors.id = projectsectors.sector_id
	   AND projects.id = projectdonors.project_id
	   AND donors.id = projectdonors.donor_id';
	   
	   if ($project_id != 0) {
            $sql .= ' AND projects.id =' . $project_id;
        }
		
	   if ($county_id != 0) {
            $sql .= ' AND counties.id =' . $county_id;
        }
		
		if ($organization_id != 0) {
            $sql .= ' AND organizations.id =' . $organization_id;
        }
		
		if ($sector_id != 0) {
            $sql .= ' AND sectors.id =' . $sector_id;
        }
		
		if ($donor_id != 0) {
            $sql .= ' AND donors.id =' . $donor_id;
        }
		/**
		if ($status != 0) {
            $sql .= ' AND projects.projectactivitystatus_id =' . $status;
        }
		**/
		
		$sql .= ' GROUP by sectors.id';
			
		$query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       //$data[] = $row['number'];
			   $data[] =  preg_replace("/,/", "", $row['project_budget']);

		 }
			   
	   $total_budget= array_sum($data);
	   
	   return $total_budget;
	}
	
	 function get_by_sector_funding($sector_id)
	{
		$data = array();		
		$sql = 'SELECT projects.*, sectors.*, projectsectors.*
			FROM projects,sectors,projectsectors
			WHERE projects.id = projectsectors.project_id
			AND sectors.id = projectsectors.sector_id
			AND sectors.id = '.$sector_id;
			
		$query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       //$data[] = $row['number'];
			   $data[] =  preg_replace("/,/", "", $row['project_budget']);

		 }
			   
	   $total_budget= array_sum($data);
	   
	   return $total_budget;
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

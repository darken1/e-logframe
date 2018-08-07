<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Donorsmodel extends CI_Model {

   private $tbl_roles= 'donors';

   function __construct()
   {
       parent::__construct();
   }
   
   function get_list() {

		$data = array();

		$Q = $this->db->get('donors');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
	public function get_total_donor($donor_id,$start_date,$end_date)
   {
	   $data = array();
	   
	   $sql = 'SELECT * FROM projects,donors,projectdonors
	   WHERE projects.id = projectdonors.project_id
	   AND donors.id = projectdonors.donor_id
	   AND donors.id='.$donor_id.'
	   AND "'.$end_date.'" >= projects.project_start_date AND projects.project_end_date >= "'.$start_date.'"
	   AND projects.projectactivitystatus_id=2';
	   
	   $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
   
   public function get_total_donor_status($donor_id,$start_date,$end_date,$projectactivitystatus_id)
   {
	   $data = array();
	   
	   $sql = 'SELECT * FROM projects,donors,projectdonors
	   WHERE projects.id = projectdonors.project_id
	   AND donors.id = projectdonors.donor_id
	   AND donors.id='.$donor_id.'
	   AND "'.$end_date.'" >= projects.project_start_date AND projects.project_end_date >= "'.$start_date.'"
	   AND projects.projectactivitystatus_id='.$projectactivitystatus_id.'';
	   
	   $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
	
	function testproject_by_donor($donor_id)
	{
		$data = array();		
		$sql = 'SELECT testprojects.*, donors.*, testprojectdonors.*
			FROM testprojects,donors,testprojectdonors
			WHERE testprojects.id = testprojectdonors.project_id
			AND donors.id = testprojectdonors.donor_id
			AND donors.id = '.$donor_id;
			
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function project_by_donor($donor_id)
	{
		$data = array();		
		$sql = 'SELECT projects.*, donors.*, projectdonors.*
			FROM projects,donors,projectdonors
			WHERE projects.id = projectdonors.project_id
			AND donors.id = projectdonors.donor_id
			AND donors.id = '.$donor_id;
			
		$query = $this->db->query($sql);
		
		return $query->result();
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
		
		$sql .= ' GROUP by donors.id';
		/**
		if ($status != 0) {
            $sql .= ' AND projects.projectactivitystatus_id =' . $status;
        }
		**/
			
		$query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       //$data[] = $row['number'];
			   $data[] =  preg_replace("/,/", "", $row['project_budget']);

		 }
			   
	   $total_budget= array_sum($data);
	   
	   return $total_budget;
	}
	
	
	 function get_donor_funding($donor_id)
	{
		$data = array();		
		$sql = 'SELECT projectdonors.* 
		FROM projectdonors 
		WHERE projectdonors.donor_id='.$donor_id;
	   
	   			
		$query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){
			
			$qry = 'SELECT * FROM projects WHERE id='.$row['project_id'];
			$myquery = $this->db->query($qry);
			
			foreach ($myquery->result_array() as $therow){
				
				   $data[] = preg_replace("/,/", "", $therow['project_budget']);
			
			}

		       

		 }
			   
	   $total_budget= array_sum($data);
	   
	   return $total_budget;
	}
	
	
	
	// get number of roles in database

	function count_all(){

		return $this->db->count_all($this->tbl_roles);

	}

	// get roles with paging

	function get_paged_list($limit = 10, $offset = 0){

		$this->db->order_by('id','asc');

		return $this->db->get($this->tbl_roles, $limit, $offset);

	}

	// get role by id

	function get_by_id($id){

		$this->db->where('id', $id);

		return $this->db->get($this->tbl_roles);

	}

	// add new role

	function save($role){

		$this->db->insert($this->tbl_roles, $role);

		return $this->db->insert_id();

	}

	// update role by id

	function update($id, $role){

		$this->db->where('id', $id);

		$this->db->update($this->tbl_roles, $role);

	}

	// delete role by id

	function delete($id){

		$this->db->where('id', $id);

		$this->db->delete($this->tbl_roles);

	}

}

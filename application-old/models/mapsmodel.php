<?php

class Mapsmodel extends CI_Model {


   function __construct()
   {
       parent::__construct();
   }
   
   function get_by_locations($county_id,$constituency_id,$subcounty_id,$sublocation_id,$sector_id)
   {
	   
	   $sql = 'SELECT * FROM projectactivities WHERE id!=0 ';
				 
		if ($county_id != 0) {
            $sql .= ' AND county_id =' . $county_id;
        }
        
        if ($constituency_id != 0) {
            $sql .= ' AND constituency_id =' . $constituency_id;
        }
        
        if ($subcounty_id != 0) {
            $sql .= ' AND subcounty_id =' . $subcounty_id;
        }
		
		if ($sublocation_id != 0) {
            $sql .= ' AND sublocation_id=' . $sublocation_id;
        }
		
		if ($sector_id != 0) {
            $sql .= ' AND sector_id=' . $sector_id;
        }
		
		$query = $this->db->query($sql);
        
        return $query->result();
   }
   
   function get_by_project($project_id)
   {
	   
	   $sql = 'SELECT * FROM projectscounties WHERE project_id='.$project_id;
				 
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   function get_by_county($county_id,$sector_id)
   {
	   
	   $sql = 'SELECT projects.*,projectscounties.*,projectactivities.*,projectactivities.id AS projectactivity_id, projectactivities.projectactivitystatus_id AS status_id
	   FROM projects,projectscounties,projectactivities 
	   WHERE projectscounties.county_id='.$county_id.'
	   AND projects.id = projectscounties.project_id
	   AND projects.id = projectactivities.project_id
	   AND projectactivities.sector_id='.$sector_id.'
	   AND projectactivities.activity_reach=2	   
	   ';
				 
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   function get_by_county_coordinates($county_id,$project_id)
   {
	   
	   $sql = 'SELECT * FROM projectscounties WHERE county_id = '.$county_id.' AND project_id='.$project_id;
				 
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   function get_by_project_counties($county_id)
   {
	   $sql = 'SELECT * FROM projectscounties WHERE id !=0';
	   if ($county_id != 0) {
            $sql .= ' AND county_id =' . $county_id;
        }
				 
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   function get_by_project_details($project_id,$county_id,$organization_id,$sector_id,$donor_id,$status)
   {
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
		
		if ($status != 0) {
            $sql .= ' AND projects.projectactivitystatus_id =' . $status;
        }
				 
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
}

<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectactivitiesmodel extends CI_Model {

	private $tbl_roles= 'projectactivities';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('projectactivities');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   
   public function get_by_task($rollingactionplan_id)
   {
       $data = array();
	   $this->db->where('rollingactionplan_id', $rollingactionplan_id);
       $Q = $this->db->get('projectactivities');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function get_list_by_category($activitycategory_id)
   {
       $data = array();
	   $this->db->where('activitycategory_id', $activitycategory_id);
       $Q = $this->db->get('projectactivities');
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
	   $this->db->where('project_id', $project_id);
       $Q = $this->db->get('projectactivities');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   
    public function get_by_activity($plannedactivity_id)
   {
	   $sql = 'SELECT *
		FROM projectactivities
		WHERE plannedactivity_id = '.$plannedactivity_id.'';
	   $query = $this->db->query($sql);
        
       $query = $this->db->query($sql);
	   $data = array();
		
		foreach ($query->result_array() as $row){

		       //$data[] = $row['number'];
			   $data[] =  preg_replace("/,/", "", $row['total_beneficiaries']);

		 }
			   
	   $total_reached= array_sum($data);
	   
	   return $total_reached;
   }
   
    public function get_by_activity_date($plannedactivity_id,$start_date,$end_date)
   {
	   $sql = 'SELECT *
		FROM projectactivities
		WHERE plannedactivity_id = '.$plannedactivity_id.'
		AND date_added BETWEEN "'.$start_date.'" AND "'.$end_date.'"';
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
    public function get_list_by_county($county_id)
   {
       $data = array();
	   $this->db->where('county_id', $county_id);
       $Q = $this->db->get('projectactivities');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function get_total_county($county_id,$project_month,$project_year)
   {
	   $data = array();
	   
	    $sql = 'SELECT * FROM projectactivities
		WHERE county_id = '.$county_id.'
		AND project_month = "'.$project_month.'"
		AND project_year = "'.$project_year.'"';
	   
	   $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
   
   public function get_total_type($activitycategory_id,$project_month,$project_year)
   {
	   $data = array();
	   
	    $sql = 'SELECT * FROM projectactivities
		WHERE activitycategory_id = '.$activitycategory_id.'
		AND project_month = "'.$project_month.'"
		AND project_year = "'.$project_year.'"';
	   
	   $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
   
   public function get_by_county_date($county_id,$start_date,$end_date)
   {
	   $sql = 'SELECT *
		FROM projectactivities
		WHERE county_id = '.$county_id.'
		AND date_added BETWEEN "'.$start_date.'" AND "'.$end_date.'"';
	   $query = $this->db->query($sql);
        
        return $query->result();
   }
   
   public function get_by_country_date_test($country_id,$project_month,$project_year)
   {
	   $sql = 'SELECT countries.*,counties.*,projectactivities.*
		FROM countries,counties,projectactivities
		WHERE countries.id = counties.country_id
		AND counties.id = projectactivities.county_id
		AND countries.id = '.$country_id.'
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"';
	   $query = $this->db->query($sql);
        
        return $sql;
		
   }
   
   
    public function count_by_county_type($county_id,$activity_type,$project_month,$project_year)
   {
	   $sql = 'SELECT counties.*,projectactivities.*, projectactivities.id AS activityID,activitycategories.*
		FROM counties,projectactivities, activitycategories
		WHERE activitycategories.id = projectactivities.activitycategory_id
		AND counties.id = projectactivities.county_id
		AND counties.id = '.$county_id.'
		AND activitycategories.activity_category = "'.$activity_type.'"
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"';
	   $query = $this->db->query($sql);
        
        $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
   
    public function count_by_county_status($county_id,$project_month,$project_year)
   {
	   $sql = 'SELECT counties.*,projectactivities.*, projectactivities.id AS activityID,rollingactionplans.*
		FROM counties,projectactivities, rollingactionplans
		WHERE rollingactionplans.id = projectactivities.rollingactionplan_id
		AND counties.id = projectactivities.county_id
		AND counties.id = '.$county_id.'
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"';
	   $query = $this->db->query($sql);
        
        $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
   
   public function get_by_county_status_completed($county_id,$project_month,$project_year)
   {
	   $sql = 'SELECT counties.*,projectactivities.*, projectactivities.id AS activityID,rollingactionplans.*
		FROM counties,projectactivities, rollingactionplans
		WHERE rollingactionplans.id = projectactivities.rollingactionplan_id
		AND counties.id = projectactivities.county_id
		AND counties.id = '.$county_id.'
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"
		AND rollingactionplans.progress = "100"
		';
	   $query = $this->db->query($sql);
        
        $i = 0;
	   
	   $query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row){

		       $i++;
		 }
		 
		 return $i;
   }
   
      
    public function get_by_county_status($county_id,$project_month,$project_year,$status_type)
   {
	   $sql = 'SELECT counties.*,projectactivities.*, projectactivities.id AS activityID,rollingactionplans.*
		FROM counties,projectactivities, rollingactionplans
		WHERE rollingactionplans.id = projectactivities.rollingactionplan_id
		AND counties.id = projectactivities.county_id
		AND counties.id = '.$county_id.'
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"
		';
	   $query = $this->db->query($sql);
        
        $total_overdue = 0;
		$total_warning = 0;
		$total_on_time = 0;
		
	   foreach ($query->result_array() as $row){
			
			
		       $today = date('Y-m-d');
			   $target_end = $row['end_date'];
				
			   $thestart = strtotime($today);
			   $theend = strtotime($row['end_date']);
			   $the_days_between = ceil(abs($theend - $thestart) / 86400);
			   
			   $percentage = $row['progress'];
			   
			   
			   if($target_end<$today)
				{
					  $days_left = 0;

				  }
				  else
				  {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				  }
				  
				  
			  if($target_end<$today)
			  {
				  if($percentage<100)
				  {
					  //overdue
					  
					  $total_overdue = $total_overdue+1;
				  }
				  else
				  {
					  //on time
					 $total_on_time = $total_on_time + 1;
				  }
			  }
			  else
			  {
				  $start = strtotime($today);
				  $end = strtotime($target_end);



				  $days_between = ceil(abs($end - $start) / 86400);


				  if($days_between <=90)//3 months
				  {
					  if($percentage<=60)
					  {
						  //overdue
						  $total_overdue = $total_overdue+1;
					  }
					  elseif($percentage>=61 && $percentage<=80)
					  {
						  //warning
						  $total_warning = $total_warning + 1;
					  }
					  else
					  {
						   //ontime
						   $total_on_time = $total_on_time + 1;
					  }
				  }//end 90 days check
				  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
				  {
					  if($percentage<=30)
					  {
						  //overdue
						  $total_overdue = $total_overdue+1;
					  }
					  elseif($percentage>=31 && $percentage<=50)
					  {
						  //warning
						  $total_warning = $total_warning + 1;
					  }
					  else
					  {
						   //ontime
						   $total_on_time = $total_on_time + 1;
					  }
				  }
				  else
				  {
            
            			//ontime
						$total_on_time = $total_on_time + 1;
				  }

			  }//end first else
				  
				  
			  
		 }
		 
		 if($status_type==1)//on time
		 {
			 return $total_on_time;
		 }
		 else if ($status_type==2)// warning
		 {
			 return $total_warning;
		 }
		 else
		 {
			 //overdue
			 return $total_overdue;
		 }
		 
		 
   }
   
  
   
   public function get_by_country_date($country_id,$project_month,$project_year)
   {
	   $sql = 'SELECT countries.*,counties.*,projectactivities.*
		FROM countries,counties,projectactivities
		WHERE countries.id = counties.country_id
		AND counties.id = projectactivities.county_id
		AND countries.id = '.$country_id.'
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"';
	   $query = $this->db->query($sql);
        
        return $query->result();
		
   }
   
    public function get_by_country_period($country_id,$project_month,$project_year)
   {
	   $sql = 'SELECT countries.*,counties.*,projectactivities.*,projectactivities.id AS activityID
		FROM countries,counties,projectactivities
		WHERE countries.id = counties.country_id
		AND counties.id = projectactivities.county_id
		AND countries.id = '.$country_id.'
		AND projectactivities.project_month = "'.$project_month.'"
		AND projectactivities.project_year = "'.$project_year.'"';
	   $query = $this->db->query($sql);
        
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


   public function get_by_title($activity)
   {
       $this->db->where('activity', $activity);
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

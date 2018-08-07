<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Beneficiarysubcategoriesmodel extends CI_Model {

	private $tbl_roles= 'beneficiarysubcategories';
   function __construct()
   {
       parent::__construct();
   }

   public function get_list()
   {
       $data = array();
       $Q = $this->db->get('beneficiarysubcategories');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   public function get_by_aggregation_type($aggregationtype_id)
   {
       $data = array();
	   $this->db->where('aggregationtype_id', $aggregationtype_id);
       $Q = $this->db->get('beneficiarysubcategories');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
    public function get_by_beneficiary_type($beneficiarytype_id)
   {
       $data = array();
	   $this->db->where('beneficiarytype_id', $beneficiarytype_id);
       $Q = $this->db->get('beneficiarysubcategories');
       if ($Q->num_rows() > 0) {
       	foreach ($Q->result_array() as $row){
       		$data[] = $row;
       	}
       }
       $Q->free_result();
       return $data;
   }
   
   function get_activities_by_sector_beneficiary($country_id,$sector_id,$project_month,$project_year,$beneficiarycategory_id)
	{
		
		$data = array();
		
		$sql = 'SELECT sectors.*,countries.*, counties.*, projectactivities.*, projectactivitiesbeneficiarycategories.*
		FROM sectors,countries, counties, projectactivities, projectactivitiesbeneficiarycategories
		WHERE projectactivities.id = projectactivitiesbeneficiarycategories.projectactivity_id
		AND sectors.id = projectactivities.sector_id
		AND countries.id = counties.country_id
		AND counties.id = projectactivities.county_id
		AND sectors.id = '.$sector_id.'
		AND counties.country_id = '.$country_id.'
		AND projectactivities.project_month = "'.$project_month.'" AND projectactivities.project_year = "'.$project_year.'"
		AND projectactivitiesbeneficiarycategories.beneficiarycategory_id='.$beneficiarycategory_id;
		
		$query = $this->db->query($sql);
		
		$result = count($query->result_array());
		
			
		foreach ($query->result_array() as $row){
			   //$data[] =  preg_replace("/,/", "", $row['total_beneficiaries']); // for projectactivities
			   $data[] =  preg_replace("/,/", "", $row['number_reached']); // for projectactivitiesbeneficiaries

		 }
			   
	   $total_diversity = array_sum($data);
	   
	   return $total_diversity;
	}
	
	 function get_activities_by_sector_beneficiary_sql($country_id,$sector_id,$project_month,$project_year,$beneficiarycategory_id)
	{
		
		$data = array();
		
		$sql = 'SELECT sectors.*,countries.*, counties.*, projectactivities.*, projectactivitiesbeneficiarycategories.*
		FROM sectors,countries, counties, projectactivities, projectactivitiesbeneficiarycategories
		WHERE projectactivities.id = projectactivitiesbeneficiarycategories.projectactivity_id
		AND sectors.id = projectactivities.sector_id
		AND countries.id = counties.country_id
		AND counties.id = projectactivities.county_id
		AND sectors.id = '.$sector_id.'
		AND counties.country_id = '.$country_id.'
		AND projectactivities.project_month = "'.$project_month.'" AND projectactivities.project_year = "'.$project_year.'"
		AND projectactivitiesbeneficiarycategories.beneficiarycategory_id='.$beneficiarycategory_id;
		
		return $sql;
	}
	
	
	
	function get_activities_by_county_beneficiary($count_id,$project_month,$project_year,$beneficiarycategory_id)
	{
		
		$data = array();
		
		$sql = 'SELECT counties.*, projectactivities.*, projectactivitiesbeneficiarycategories.*
		FROM counties, projectactivities, projectactivitiesbeneficiarycategories
		WHERE projectactivities.id = projectactivitiesbeneficiarycategories.projectactivity_id
		AND counties.id = projectactivities.county_id
		AND counties.id = '.$count_id.'
		AND projectactivities.project_month = "'.$project_month.'" AND projectactivities.project_year = "'.$project_year.'"
		AND projectactivitiesbeneficiarycategories.beneficiarycategory_id='.$beneficiarycategory_id;
		
		$query = $this->db->query($sql);
		
		$result = count($query->result_array());
		
			
		foreach ($query->result_array() as $row){
			   //$data[] =  preg_replace("/,/", "", $row['total_beneficiaries']); // for projectactivities
			   $data[] =  preg_replace("/,/", "", $row['number_reached']); // for projectactivitiesbeneficiaries

		 }
			   
	   $total_diversity = array_sum($data);
	   
	   return $total_diversity;
	}
	
	
	function get_activities_by_gender_beneficiary($projectactivity_id,$project_month,$project_year,$gender)
	{
		
		$data = array();
		
		$sql = 'SELECT projectactivities.*, projectactivitiesbeneficiarycategories.*,beneficiarysubcategories.*
		FROM  projectactivities, projectactivitiesbeneficiarycategories, beneficiarysubcategories
		WHERE projectactivities.id = projectactivitiesbeneficiarycategories.projectactivity_id
		AND beneficiarysubcategories.id = projectactivitiesbeneficiarycategories.beneficiarycategory_id
		AND projectactivities.id = '.$projectactivity_id.'
		AND beneficiarysubcategories.gender = '.$gender.'
		AND projectactivities.project_month = "'.$project_month.'" AND projectactivities.project_year = "'.$project_year.'"';
		
		$query = $this->db->query($sql);
		
		$result = count($query->result_array());
		
			
		foreach ($query->result_array() as $row){
			   //$data[] =  preg_replace("/,/", "", $row['total_beneficiaries']); // for projectactivities
			   $data[] =  preg_replace("/,/", "", $row['number_reached']); // for projectactivitiesbeneficiaries

		 }
			   
	   $total_diversity = array_sum($data);
	   
	   return $total_diversity;
	}
	
	
	function get_project_by_gender_beneficiary($project_id,$project_month,$project_year,$gender)
	{
		
		$data = array();
		
		$sql = 'SELECT projects.*,projectactivities.*, projectactivitiesbeneficiarycategories.*,beneficiarysubcategories.*
		FROM  projects,projectactivities, projectactivitiesbeneficiarycategories, beneficiarysubcategories
		WHERE projectactivities.id = projectactivitiesbeneficiarycategories.projectactivity_id
		AND beneficiarysubcategories.id = projectactivitiesbeneficiarycategories.beneficiarycategory_id
		AND projects.id = projectactivities.project_id
		AND projects.id = '.$project_id.'
		AND beneficiarysubcategories.gender = '.$gender.'
		AND projectactivities.project_month = "'.$project_month.'" AND projectactivities.project_year = "'.$project_year.'"';
		
		$query = $this->db->query($sql);
		
		$result = count($query->result_array());
		
			
		foreach ($query->result_array() as $row){
			   //$data[] =  preg_replace("/,/", "", $row['total_beneficiaries']); // for projectactivities
			   $data[] =  preg_replace("/,/", "", $row['number_reached']); // for projectactivitiesbeneficiaries

		 }
			   
	   $total_diversity = array_sum($data);
	   
	   return $total_diversity;
	}
	
	function get_project_by_beneficiary_target($project_id)
	 {
		 $sql = 'SELECT SUM(target) AS total_target
				FROM projectbeneficiaries
				WHERE project_id ='.$project_id;

		$query = $this->db->query($sql);
		$row = $query->row();
		
		return $row->total_target;
	 }
	
	
	function get_project_by_beneficiary($project_id,$project_month,$project_year)
	{
		
		$data = array();
		
		$sql = 'SELECT projects.*,projectactivities.*
		FROM  projects,projectactivities
		WHERE projects.id = projectactivities.project_id
		AND projects.id = '.$project_id.'
		AND projectactivities.project_month = "'.$project_month.'" AND projectactivities.project_year = "'.$project_year.'"';
		
		$query = $this->db->query($sql);
		
		$result = count($query->result_array());
		
			
		foreach ($query->result_array() as $row){
			   $data[] =  preg_replace("/,/", "", $row['total_beneficiaries']); // for projectactivities
			   //$data[] =  preg_replace("/,/", "", $row['number_reached']); // for projectactivitiesbeneficiaries

		 }
			   
	   $total_diversity = array_sum($data);
	   
	   return $total_diversity;
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

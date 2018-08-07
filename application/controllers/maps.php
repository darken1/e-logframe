<?php
/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Maps extends CI_Controller {

   function __construct()
   {
       parent::__construct();
   }

   public function index()
   {
       
	   if (!$this->erkanaauth->try_session_login()) {
            
            redirect('login', 'refresh');
            
        }
		
	   $data = array();
	   
	 $counties = $this->countiesmodel->get_list();
	  
	   
	 $county_id = 0; 
	 $constituency_id = 0;	
	 $subcounty_id = 0; 
	 $sublocation_id = 0;  
	 $sector_id = 0;
	 $points = array();
	   
	 $projectrows = $this->mapsmodel->get_by_project_counties($county_id);
			foreach ($projectrows as $projectkey=>$projectrow):
				$coordinates = $this->mapsmodel->get_by_project($projectrow->project_id);
				foreach($coordinates as $ckey=>$coordinate):
						$county = $this->countiesmodel->get_by_id($coordinate->county_id)->row();
						$project = $this->projectsmodel->get_by_id($projectrow->project_id)->row();
						$projectsector = $this->projectsectorsmodel->get_by_project($projectrow->project_id)->row();
						$sector = $this->sectorsmodel->get_by_id($projectsector->sector_id)->row();
						$status = $this->projectactivitystatusmodel->get_by_id($project->projectactivitystatus_id)->row();
						$gps['lat'] = $county->lat;
						$gps['lng'] = $county->long;
						$mapdata['position'] = $gps;
						
					   if($sector->sector=='Education')
					   {
						   $mapdata['icon'] = ''.base_url().'img/education.png';
					   }
					   else if($sector->sector=='Health and nutrition')
					   {
						   $mapdata['icon'] = ''.base_url().'img/health_nutrition.png';
					   }
					   
					   else if($sector->sector=='Water, sanitation and public health')
					   {
						   $mapdata['icon'] = ''.base_url().'img/water_sanitation_public_health.png';
					   }
					   
					   else if($sector->sector=='Production')
					   {
						   $mapdata['icon'] = ''.base_url().'img/production.png';
					   }
					   
					   else if($sector->sector=='Land, environment and climate change')
					   {
						   $mapdata['icon'] = ''.base_url().'img/land_environment_climate_chage.png';
					   }
					   
					   else if($sector->sector=='Humanitarian aid and protection')
					   {
						   $mapdata['icon'] = ''.base_url().'img/humanitarian_aid_protection.png';
					   }
					   
					   else if($sector->sector=='Economic infrastructure and services')
					   {
						   $mapdata['icon'] = ''.base_url().'img/economic_infrastructure_services.png';
					   }
					   
					   else if($sector->sector=='Government and civil society')
					   {
						   $mapdata['icon'] = ''.base_url().'img/government_civil_society.png';
					   }
					   
					   else if($sector->sector=='Other')
					   {
						   $mapdata['icon'] = ''.base_url().'img/other.png';
					   }
					   else
					   {
						   $mapdata['icon'] = ''.base_url().'img/other.png';
					   }
					   
					   $project_donor = '';
					   $projectdonors = $this->projectdonorsmodel->get_list_by_project($project->id);
					   foreach($projectdonors as $key=>$projectdonor):
							$donor = $this->donorsmodel->get_by_id($projectdonor['donor_id'])->row();
							$project_donor .= $donor->donor_name.',';
						endforeach;
						
					  $thesectors = $this->sectorsmodel->get_list();
					  $sectorlist = '';
					  foreach($thesectors as $key=>$thesector)
					  {
							$projectsector = $this->projectsectorsmodel->get_by_sector_project($project->id,$thesector['id'])->row();
														
							if(empty($projectsector))
							{
								$sectorselected = '';
							}
							else
							{
								$sectorlist .= $thesector['sector'].',';
							}
														
						}
					   
					   $mapdata['info'] = '
					   District: '.$county->county.'<br>
					   Project: '.$project->project_title.'<br>
					   Project No.: '.$project->project_no.'<br>
					   Objective: '.$project->project_objective.'<br>					  
					   Project Start: '.date("d F Y",strtotime($project->project_start_date)).'<br>
					   Project End: '.date("d F Y",strtotime($project->project_end_date)).'<br>
					   Donor: '.$project_donor.'<br>
					   Budget: '.$project->currency.' '.$project->project_budget.'<br>
					   Sector(s): '.$sectorlist.'<br> 
					   Status: '.$status->status.'<br>
					   ';
					   
					   $points[] = $mapdata;
					
					endforeach;
			endforeach; 
	
		
		$data['points'] = $points;
		$data['counties'] = $counties;
		$data['sectors'] = $this->sectorsmodel->get_list();
		$data['status'] = $this->projectactivitystatusmodel->get_list();

       $this->load->view('maps/index', $data);
   }
   
   public function projectactivities()
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {
            
            redirect('login', 'refresh');
            
       }
		
	   $data = array();
	   $points = array();
	   $projectactivities = $this->projectactivitiesmodel->get_list();
	   
	   foreach($projectactivities as $key=>$projectactivity)
	   {
		   $gps['lat'] = $projectactivity['lat'];
		   $gps['lng'] = $projectactivity['long'];
		   $mapdata['position'] = $gps;
		   
		   $activitycategory = $this->activitycategoriesmodel->get_by_id($projectactivity['activitycategory_id'])->row();
		   
		   //$mapdata['icon'] = ''.base_url().'img/letter_a.png';
		   
		   if(empty($activitycategory))
		   {
			   $mapdata['icon'] = ''.base_url().'img/letter_a.png';
		   }
		   else
		   {
		   	 $mapdata['icon'] = ''.base_url().'img/activity/'.$activitycategory->icon;
		   }
		   
		   $project = $this->projectsmodel->get_by_id($projectactivity['project_id'])->row();
		   //$activity = $this->activitiesmodel->get_by_id($projectactivity['activity_id'])->row();
		   
		   $activity = $this->activitycategoriesmodel->get_by_id($projectactivity['activitycategory_id'])->row();
		   
		   if($projectactivity['project_month']==1)
					  {
					  	$month = 'January';
					  }
					  if($projectactivity['project_month']==2)
					  {
					  	$month = 'February';
					  }
					  if($projectactivity['project_month']==3)
					  {
					  	$month = 'March';
					  }
					  if($projectactivity['project_month']==4)
					  {
					  	$month = 'April';
					  }
					  if($projectactivity['project_month']==5)
					  {
					  	$month = 'May';
					  }
					  if($projectactivity['project_month']==6)
					  {
					  	$month = 'June';
					  }
					  if($projectactivity['project_month']==7)
					  {
					  	$month = 'July';
					  }
					  if($projectactivity['project_month']==8)
					  {
					  	$month = 'August';
					  }
					  if($projectactivity['project_month']==9)
					  {
					  	$month = 'September';
					  }
					  if($projectactivity['project_month']==10)
					  {
					  	$month = 'October';
					  }
					  if($projectactivity['project_month']==11)
					  {
					  	$month = 'November';
					  }
					  if($projectactivity['project_month']==12)
					  {
					  	$month = 'December';
					  }
					  
					  $beneficiaries = $this->projectactivitiesbeneficiariesmodel->get_by_activity($projectactivity['id']);
					  
					  $table = '<table border="1" width="100%">';
					  
					  $beneficiarytypes = $this->db->get('beneficiarytypes');
					  
					  foreach($beneficiarytypes->result() as $beneficiarytype):
					  
					  	$activitybeneficiary = $this->projectactivitiesbeneficiariesmodel->get_by_beneficiary_project($project->id,$projectactivity['id'],$beneficiarytype->id)->row();
					  
					  if(empty($activitybeneficiary))
					  {
					  }
					  else
					  {
					  	$table .= '<tr><td>'.$beneficiarytype->beneficiary_type.'</td><td>'.$activitybeneficiary->number_reached.'</td></tr>';
					  }
						
					  endforeach;
					 
					 
					  
					  
					  
					  $projectdiversities = $this->projectdiversitiesmodel->get_list_by_project_activity($project->id,$projectactivity['id']);
					  foreach($projectdiversities as $key=>$projectdiversity)
					  {
						  // $table .= '<tr><td>'.$projectdiversity['beneficiary'].'</td><td>'.$projectdiversity['number'].'</td></tr>'; 
					  }
					  
					  $table .= '</table>';
					  
					  if(empty($activity))
					  {
						  $activity_type = '';
					  }
					  else
					  {
						  $activity_type = $activity->activity_category;
					  }
					  
					  
					  
					  $activitystatus = $this->projectactivitystatusmodel->get_by_id($projectactivity['projectactivitystatus_id'])->row();
		   
		   $mapdata['info'] = '
					   <strong>Project:</strong> <a href="'.base_url().'index.php/projects/detail/'.$project->id.'" target="_blank">'.$project->project_title.'</a><br>
					   <strong>Project No.:</strong> '.$project->project_no.'<br>
					   <strong>Activity type:</strong> '.$activity_type.'<br>
					   <strong>Activity</strong>: '.$projectactivity['activity'].'<br>
					   <strong>Status</strong>: '.$activitystatus->status.'<br>
					   <strong>Description</strong>: '.$projectactivity['activity_description'].'<br>
					   <strong>Total Beneficiaries:</strong> '.$projectactivity['total_beneficiaries'].'<br>
					   <strong>Year:</strong> '.$projectactivity['project_year'].'<br>
					   <strong>Month:</strong> '.$month.'<br>
					   <strong>Beneficiary Breakdown</strong>: '.$table.'
					   ';
					   
		  $points[] = $mapdata;
	   }
	   
	   $project_id = 0;
	   
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['points'] = $points;
	   $data['project_id'] = $project_id;
	   $data['activitycategories'] = $this->activitycategoriesmodel->get_list();
	   
	   $this->load->view('maps/projectactivities', $data);
   }
   
   public function searchactivity()
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {
            
            redirect('login', 'refresh');
            
       }
		
	   $data = array();
	   $points = array();
	   
	   $project_id = $this->input->post('project_id');
	   $projectactivities = $this->projectactivitiesmodel->get_list_by_project($project_id);
	   
	   foreach($projectactivities as $key=>$projectactivity)
	   {
		   $gps['lat'] = $projectactivity['lat'];
		   $gps['lng'] = $projectactivity['long'];
		   $mapdata['position'] = $gps;
		   
		    $activitycategory = $this->activitycategoriesmodel->get_by_id($projectactivity['activitycategory_id'])->row();
		   
		   
		   if(empty($activitycategory))
		   {
			   $mapdata['icon'] = ''.base_url().'img/letter_a.png';
		   }
		   else
		   {
		   		$mapdata['icon'] = ''.base_url().'img/activity/'.$activitycategory->icon;
		   }
		   
		   $project = $this->projectsmodel->get_by_id($projectactivity['project_id'])->row();
		   //$activity = $this->activitiesmodel->get_by_id($projectactivity['activity_id'])->row();
		   
		   
		   
		   if($projectactivity['project_month']==1)
					  {
					  	$month = 'January';
					  }
					  if($projectactivity['project_month']==2)
					  {
					  	$month = 'February';
					  }
					  if($projectactivity['project_month']==3)
					  {
					  	$month = 'March';
					  }
					  if($projectactivity['project_month']==4)
					  {
					  	$month = 'April';
					  }
					  if($projectactivity['project_month']==5)
					  {
					  	$month = 'May';
					  }
					  if($projectactivity['project_month']==6)
					  {
					  	$month = 'June';
					  }
					  if($projectactivity['project_month']==7)
					  {
					  	$month = 'July';
					  }
					  if($projectactivity['project_month']==8)
					  {
					  	$month = 'August';
					  }
					  if($projectactivity['project_month']==9)
					  {
					  	$month = 'September';
					  }
					  if($projectactivity['project_month']==10)
					  {
					  	$month = 'October';
					  }
					  if($projectactivity['project_month']==11)
					  {
					  	$month = 'November';
					  }
					  if($projectactivity['project_month']==12)
					  {
					  	$month = 'December';
					  }
					  
					  $beneficiaries = $this->projectactivitiesbeneficiariesmodel->get_by_activity($projectactivity['id']);
					  
					  $table = '<table border="1" width="100%">';
					  foreach($beneficiaries as $beneficiary)
					  {
						 $beneficiarytype = $this->beneficiarytypesmodel->get_by_id($beneficiary['beneficiary_id'])->row();
						 if(empty($beneficiarytype))
						 {
						 }
						 else
						 {
						 	$table .= '<tr><td>'.$beneficiarytype->beneficiary_type.'</td><td>'.$beneficiary['number_reached'].'</td></tr>'; 
						 }
					  }
					  
					  $projectdiversities = $this->projectdiversitiesmodel->get_list_by_project_activity($project->id,$projectactivity['id']);
					  foreach($projectdiversities as $key=>$projectdiversity)
					  {
						   $table .= '<tr><td>'.$projectdiversity['beneficiary'].'</td><td>'.$projectdiversity['number'].'</td></tr>'; 
					  }
					  
					  $table .= '</table>';
					  
					  $activity = $this->activitycategoriesmodel->get_by_id($projectactivity['activitycategory_id'])->row();
					  
					  if(empty($activity))
					  {
						 $activity_type = '';
					  }
					  else
					  {
						  $activity_type = $activity->activity_category;
					  }
		   
		   $mapdata['info'] = '
					   <strong>Project:</strong> '.$project->project_title.'<br>
					   <strong>Project No.:</strong> '.$project->project_no.'<br>
					   <strong>Activity type:</strong> '.$activity_type.'<br>
					   <strong>Activity</strong>: '.$projectactivity['activity'].'<br>
					   <strong>Description</strong>: '.$projectactivity['activity_description'].'<br>
					   <strong>Total Beneficiaries:</strong> '.$projectactivity['total_beneficiaries'].'<br>
					   <strong>Year:</strong> '.$projectactivity['project_year'].'<br>
					   <strong>Month:</strong> '.$month.'<br>
					   <strong>Beneficiary Breakdown</strong>: '.$table.'
					   ';
					   
		  $points[] = $mapdata;
	   }
	   
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['points'] = $points;
	   $data['project_id'] = $project_id;
	   $data['activitycategories'] = $this->activitycategoriesmodel->get_list();
	   
	   $this->load->view('maps/projectactivities', $data);
   }


	public function getmap()
	{
		
		if (!$this->erkanaauth->try_session_login()) {
            
            redirect('login', 'refresh');
            
        }
		
	   $data = array();
	   
	 $counties = $this->countiesmodel->get_list();
	  
	   
	 $county_id = $this->input->post('county_id'); 
	 $constituency_id = 0;	
	 $subcounty_id = 0; 
	 $sublocation_id = 0;  
	 $sector_id = 0;
	 $points = array();
	   
	 $projectrows = $this->mapsmodel->get_by_project_counties($county_id);
			foreach ($projectrows as $projectkey=>$projectrow):
				$coordinates = $this->mapsmodel->get_by_project($projectrow->project_id);
				foreach($coordinates as $ckey=>$coordinate):
						$county = $this->countiesmodel->get_by_id($coordinate->county_id)->row();
						$project = $this->projectsmodel->get_by_id($projectrow->project_id)->row();
						$projectsector = $this->projectsectorsmodel->get_by_project($projectrow->project_id)->row();
						$sector = $this->sectorsmodel->get_by_id($projectsector->sector_id)->row();
						$status = $this->projectactivitystatusmodel->get_by_id($project->projectactivitystatus_id)->row();
						$gps['lat'] = $county->lat;
						$gps['lng'] = $county->long;
						$mapdata['position'] = $gps;
						
					   if($sector->sector=='Education')
					   {
						   $mapdata['icon'] = ''.base_url().'img/education.png';
					   }
					   
					   if($sector->sector=='Health and nutrition')
					   {
						   $mapdata['icon'] = ''.base_url().'img/health_nutrition.png';
					   }
					   
					   if($sector->sector=='Water, sanitation and public health')
					   {
						   $mapdata['icon'] = ''.base_url().'img/water_sanitation_public_health.png';
					   }
					   
					   if($sector->sector=='Production')
					   {
						   $mapdata['icon'] = ''.base_url().'img/production.png';
					   }
					   
					   if($sector->sector=='Land, environment and climate change')
					   {
						   $mapdata['icon'] = ''.base_url().'img/land_environment_climate_chage.png';
					   }
					   
					   if($sector->sector=='Humanitarian aid and protection')
					   {
						   $mapdata['icon'] = ''.base_url().'img/humanitarian_aid_protection.png';
					   }
					   
					   if($sector->sector=='Economic infrastructure and services')
					   {
						   $mapdata['icon'] = ''.base_url().'img/economic_infrastructure_services.png';
					   }
					   
					   if($sector->sector=='Government and civil society')
					   {
						   $mapdata['icon'] = ''.base_url().'img/government_civil_society.png';
					   }
					   
					   if($sector->sector=='Other')
					   {
						   $mapdata['icon'] = ''.base_url().'img/other.png';
					   }
					   
					   $project_donor = '';
					   $projectdonors = $this->projectdonorsmodel->get_list_by_project($project->id);
					   foreach($projectdonors as $key=>$projectdonor):
							$donor = $this->donorsmodel->get_by_id($projectdonor['donor_id'])->row();
							$project_donor .= $donor->donor_name.',';
						endforeach;
						
					  $thesectors = $this->sectorsmodel->get_list();
					  $sectorlist = '';
					  foreach($thesectors as $key=>$thesector)
					  {
							$projectsector = $this->projectsectorsmodel->get_by_sector_project($project->id,$thesector['id'])->row();
														
							if(empty($projectsector))
							{
								$sectorselected = '';
							}
							else
							{
								$sectorlist .= $thesector['sector'].',';
							}
														
						}
					   
					   $mapdata['info'] = '
					   District: '.$county->county.'<br>
					   Project: '.$project->project_title.'<br>
					   Project No.: '.$project->project_no.'<br>
					   Objective: '.$project->project_objective.'<br>					  
					   Project Start: '.date("d F Y",strtotime($project->project_start_date)).'<br>
					   Project End: '.date("d F Y",strtotime($project->project_end_date)).'<br>
					   Donor: '.$project_donor.'<br>
					   Budget: '.$project->currency.' '.$project->project_budget.'<br>
					   Sector(s): '.$sectorlist.'<br> 
					   Status: '.$status->status.'<br>
					   ';
					   
					   $points[] = $mapdata;
					
					endforeach;
			endforeach; 
	
		
		$data['points'] = $points;
		$data['counties'] = $counties;
		$data['sectors'] = $this->sectorsmodel->get_list();
		$data['status'] = $this->projectactivitystatusmodel->get_list();

       $this->load->view('maps/index', $data);
	}
	
   public function fullscreen()
   {
      		
	   $counties = $this->countiesmodel->get_list();
	  
	   
	 $county_id = 0; 
	 $constituency_id = 0;	
	 $subcounty_id = 0; 
	 $sublocation_id = 0;  
	 $sector_id = 0;
	 $points = array();
	   
	 $projectrows = $this->mapsmodel->get_by_project_counties($county_id);
			foreach ($projectrows as $projectkey=>$projectrow):
				$coordinates = $this->mapsmodel->get_by_project($projectrow->project_id);
				foreach($coordinates as $ckey=>$coordinate):
						$county = $this->countiesmodel->get_by_id($coordinate->county_id)->row();
						$project = $this->projectsmodel->get_by_id($projectrow->project_id)->row();
						$projectsector = $this->projectsectorsmodel->get_by_project($projectrow->project_id)->row();
						$sector = $this->sectorsmodel->get_by_id($projectsector->sector_id)->row();
						$status = $this->projectactivitystatusmodel->get_by_id($project->projectactivitystatus_id)->row();
						$gps['lat'] = $county->lat;
						$gps['lng'] = $county->long;
						$mapdata['position'] = $gps;
						
					   if($sector->sector=='Education')
					   {
						   $mapdata['icon'] = ''.base_url().'img/education.png';
					   }
					   
					   if($sector->sector=='Health and nutrition')
					   {
						   $mapdata['icon'] = ''.base_url().'img/health_nutrition.png';
					   }
					   
					   if($sector->sector=='Water, sanitation and public health')
					   {
						   $mapdata['icon'] = ''.base_url().'img/water_sanitation_public_health.png';
					   }
					   
					   if($sector->sector=='Production')
					   {
						   $mapdata['icon'] = ''.base_url().'img/production.png';
					   }
					   
					   if($sector->sector=='Land, environment and climate change')
					   {
						   $mapdata['icon'] = ''.base_url().'img/land_environment_climate_chage.png';
					   }
					   
					   if($sector->sector=='Humanitarian aid and protection')
					   {
						   $mapdata['icon'] = ''.base_url().'img/humanitarian_aid_protection.png';
					   }
					   
					   if($sector->sector=='Economic infrastructure and services')
					   {
						   $mapdata['icon'] = ''.base_url().'img/economic_infrastructure_services.png';
					   }
					   
					   if($sector->sector=='Government and civil society')
					   {
						   $mapdata['icon'] = ''.base_url().'img/government_civil_society.png';
					   }
					   
					   if($sector->sector=='Other')
					   {
						   $mapdata['icon'] = ''.base_url().'img/other.png';
					   }
					   
					   $project_donor = '';
					   $projectdonors = $this->projectdonorsmodel->get_list_by_project($project->id);
					   foreach($projectdonors as $key=>$projectdonor):
							$donor = $this->donorsmodel->get_by_id($projectdonor['donor_id'])->row();
							$project_donor .= $donor->donor_name.',';
						endforeach;
						
					  $thesectors = $this->sectorsmodel->get_list();
					  $sectorlist = '';
					  foreach($thesectors as $key=>$thesector)
					  {
							$projectsector = $this->projectsectorsmodel->get_by_sector_project($project->id,$thesector['id'])->row();
														
							if(empty($projectsector))
							{
								$sectorselected = '';
							}
							else
							{
								$sectorlist .= $thesector['sector'].',';
							}
														
						}
					   
					   $mapdata['info'] = '
					   County: '.$county->county.'<br>
					   Project: '.$project->project_title.'<br>
					   Project No.: '.$project->project_no.'<br>
					   Objective: '.$project->project_objective.'<br>					  
					   Project Start: '.date("d F Y",strtotime($project->project_start_date)).'<br>
					   Project End: '.date("d F Y",strtotime($project->project_end_date)).'<br>
					   Donor: '.$project_donor.'<br>
					   Budget: '.$project->currency.' '.$project->project_budget.'<br>
					   Sector(s): '.$sectorlist.'<br> 
					   Status: '.$status->status.'<br>
					   ';
					   
					   $points[] = $mapdata;
					
					endforeach;
			endforeach; 
	
		
		$data['points'] = $points;
		$data['counties'] = $counties;	
       $this->load->view('maps/fullscreen_hfs', $data);
   }
   
   public function getfullscreen_hfs()
   {
      $counties = $this->countiesmodel->get_list();
	  
	   
	 $county_id = $this->input->post('county_id'); 
	 $constituency_id = 0;	
	 $subcounty_id = 0; 
	 $sublocation_id = 0;  
	 $sector_id = 0;
	 $points = array();
	   
	 $projectrows = $this->mapsmodel->get_by_project_counties($county_id);
			foreach ($projectrows as $projectkey=>$projectrow):
				$coordinates = $this->mapsmodel->get_by_project($projectrow->project_id);
				foreach($coordinates as $ckey=>$coordinate):
						$county = $this->countiesmodel->get_by_id($coordinate->county_id)->row();
						$project = $this->projectsmodel->get_by_id($projectrow->project_id)->row();
						$projectsector = $this->projectsectorsmodel->get_by_project($projectrow->project_id)->row();
						$sector = $this->sectorsmodel->get_by_id($projectsector->sector_id)->row();
						$status = $this->projectactivitystatusmodel->get_by_id($project->projectactivitystatus_id)->row();
						$gps['lat'] = $county->lat;
						$gps['lng'] = $county->long;
						$mapdata['position'] = $gps;
						
					   if($sector->sector=='Education')
					   {
						   $mapdata['icon'] = ''.base_url().'img/education.png';
					   }
					   
					   if($sector->sector=='Health and nutrition')
					   {
						   $mapdata['icon'] = ''.base_url().'img/health_nutrition.png';
					   }
					   
					   if($sector->sector=='Water, sanitation and public health')
					   {
						   $mapdata['icon'] = ''.base_url().'img/water_sanitation_public_health.png';
					   }
					   
					   if($sector->sector=='Production')
					   {
						   $mapdata['icon'] = ''.base_url().'img/production.png';
					   }
					   
					   if($sector->sector=='Land, environment and climate change')
					   {
						   $mapdata['icon'] = ''.base_url().'img/land_environment_climate_chage.png';
					   }
					   
					   if($sector->sector=='Humanitarian aid and protection')
					   {
						   $mapdata['icon'] = ''.base_url().'img/humanitarian_aid_protection.png';
					   }
					   
					   if($sector->sector=='Economic infrastructure and services')
					   {
						   $mapdata['icon'] = ''.base_url().'img/economic_infrastructure_services.png';
					   }
					   
					   if($sector->sector=='Government and civil society')
					   {
						   $mapdata['icon'] = ''.base_url().'img/government_civil_society.png';
					   }
					   
					   if($sector->sector=='Other')
					   {
						   $mapdata['icon'] = ''.base_url().'img/other.png';
					   }
					   
					   $project_donor = '';
					   $projectdonors = $this->projectdonorsmodel->get_list_by_project($project->id);
					   foreach($projectdonors as $key=>$projectdonor):
							$donor = $this->donorsmodel->get_by_id($projectdonor['donor_id'])->row();
							$project_donor .= $donor->donor_name.',';
						endforeach;
						
					  $thesectors = $this->sectorsmodel->get_list();
					  $sectorlist = '';
					  foreach($thesectors as $key=>$thesector)
					  {
							$projectsector = $this->projectsectorsmodel->get_by_sector_project($project->id,$thesector['id'])->row();
														
							if(empty($projectsector))
							{
								$sectorselected = '';
							}
							else
							{
								$sectorlist .= $thesector['sector'].',';
							}
														
						}
					   
					   $mapdata['info'] = '
					   County: '.$county->county.'<br>
					   Project: '.$project->project_title.'<br>
					   Project No.: '.$project->project_no.'<br>
					   Objective: '.$project->project_objective.'<br>					  
					   Project Start: '.date("d F Y",strtotime($project->project_start_date)).'<br>
					   Project End: '.date("d F Y",strtotime($project->project_end_date)).'<br>
					   Donor: '.$project_donor.'<br>
					   Budget: '.$project->currency.' '.$project->project_budget.'<br>
					   Sector(s): '.$sectorlist.'<br> 
					   Status: '.$status->status.'<br>
					   ';
					   
					   $points[] = $mapdata;
					
					endforeach;
			endforeach; 
	
		
		$data['points'] = $points;
		$data['counties'] = $counties;	
       $this->load->view('maps/fullscreen_hfs', $data);
	  
   }
   
   
   
   
   
  
   
}

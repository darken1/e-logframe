<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectactivities extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectactivitiesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectactivities'),
       );
       $this->load->view('projectactivities/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   $data['counties'] = $this->countiesmodel->get_list();
	   $data['projectactivitystatus'] = $this->projectactivitystatusmodel->get_list();
	   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list(); 
	   $data['projectdiversities'] = $this->projectdiversitiesmodel->get_list();
       $this->load->view('projectactivities/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project', 'trim|required');
       $this->form_validation->set_rules('sector_id', 'Sector', 'trim|required');
       $this->form_validation->set_rules('subsector_id', 'Sub sector', 'trim|required');
       $this->form_validation->set_rules('activity_id', 'Activity', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Planned activity', 'trim|required');
       $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
       $this->form_validation->set_rules('activity_description', 'Activity description', 'trim|required');
       $this->form_validation->set_rules('county_id', 'Region', 'trim|required');
       //$this->form_validation->set_rules('constituency_id', 'Constituency id', 'trim|required');
       //$this->form_validation->set_rules('subcounty_id', 'Subcounty id', 'trim|required');
       //$this->form_validation->set_rules('location_id', 'Location id', 'trim|required');
       //$this->form_validation->set_rules('sublocation_id', 'Sublocation id', 'trim|required');
       $this->form_validation->set_rules('activity_cost', 'Activity cost', 'trim|required');
       $this->form_validation->set_rules('total_beneficiaries', 'Total beneficiaries', 'trim|required');
       $this->form_validation->set_rules('projectactivitystatus_id', 'Status', 'trim|required');
       $this->form_validation->set_rules('date_added', 'Date added', 'trim|required');
       $this->form_validation->set_rules('project_month', 'Activity month', 'trim|required');
	   $this->form_validation->set_rules('project_year', 'Activity year', 'trim|required');
	   $this->form_validation->set_rules('lat', 'Latitude', 'trim|required');
	   $this->form_validation->set_rules('long', 'Longitude', 'trim|required');
       //$this->form_validation->set_rules('activity_reach', 'Activity reach', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'sector_id' => $this->input->post('sector_id'),
               'subsector_id' => $this->input->post('subsector_id'),
               'activity_id' => $this->input->post('activity_id'),
               'plannedactivity_id' => $this->input->post('plannedactivity_id'),
               'activity' => $this->input->post('activity'),
               'activity_description' => $this->input->post('activity_description'),
               'county_id' => $this->input->post('county_id'),
               'constituency_id' => $this->input->post('constituency_id'),
               'subcounty_id' => $this->input->post('subcounty_id'),
               'location_id' => $this->input->post('location_id'),
               'sublocation_id' => $this->input->post('sublocation_id'),
               'activity_cost' => $this->input->post('activity_cost'),
               'total_beneficiaries' => $this->input->post('total_beneficiaries'),
               'projectactivitystatus_id' => $this->input->post('projectactivitystatus_id'),
               'date_added' => $this->input->post('date_added'),
               'project_month' => $this->input->post('project_month'),
			   'project_year' => $this->input->post('project_year'),
               'activity_reach' => $this->input->post('activity_reach'),
			   'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
           );
           $this->db->insert('projectactivities', $data);
		   $projectactivity_id = $this->db->insert_id();
		   
		   $project_id = $this->input->post('project_id');
		   
		   //add the activity beneficiaries
		   $beneficiaries = $this->beneficiarytypesmodel->get_list(); 
		   
		   foreach($beneficiaries as $key=>$beneficiary)
		   {
			   $field = 'beneficiary_'.$beneficiary['id'];
			   $number_reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST[''.$field.'']))));
			   
			   if($number_reached==0)
			   {
				   
			   }
			   else
			   {
				    $projectactivitiesbeneficiariesdata = array(
					   'project_id' => $project_id,
					   'projectactivity_id' => $projectactivity_id,
					   'beneficiary_id' => $beneficiary['id'],
					   'number_reached' => $number_reached,
				   );
				   $this->db->insert('projectactivitiesbeneficiaries', $projectactivitiesbeneficiariesdata);
			   }
			   
		   }
		   
		   //add other types of beneficiaries
		    if (!empty($_POST['mybeneficiary'])) {
                foreach ($_POST['mybeneficiary'] as $brow => $bid) {
                    
                    $mybeneficiary = trim($bid);
					$unit_of_measure    = $_POST['unit_of_measure'][$brow];
					$number    = $_POST['number'][$brow];
					
					
					$projectdiversitiesdata = array(
						   'project_id' => $project_id,
						   'projectactivity_id' => $projectactivity_id,
						   'beneficiary' => strtoupper($mybeneficiary),
						   'unit_of_measure' => $unit_of_measure,
						   'number' => $number,
					   );
					$this->db->insert('projectdiversities', $projectdiversitiesdata);
					
				}
		   }
			
			
			
           redirect('projectactivities/edit/'.$projectactivity_id,'refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectactivities','refresh');
       }
       $row = $this->db->get_where('projectactivities', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectactivities','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	    $photos = $this->activityphotosmodel->get_list_by_activity($row->id);
		 
		 $imagetable = '<table class="table table-hover table-nomargin">
		   <thead>
			
		   <tr>
			 <th>Image</th>
			 <th>Caption</th>
			 <th>Date Added</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($photos as $key=>$photo)
		   {
			  $imagetable .= '<tr><td><img src="'.base_url().'activityphotos/'.$photo['file_name'].'" height="90" width="90"></td><td valign="top">'.$photo['caption'].'</td><td valign="top">'.$photo['date_added'].'</td></tr>'; 
		   }
		   
		    $imagetable .= '
		   </tbody>
		   </table>';
		   
	   $data['imagetable'] = $imagetable;
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   $data['counties'] = $this->countiesmodel->get_list();
	   $data['projectactivitystatus'] = $this->projectactivitystatusmodel->get_list();
	   $data['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->project_id);
	   $data['subsectors'] = $this->subsectorsmodel->get_list_by_sector($row->sector_id);
	   $data['activities'] = $this->activitiesmodel->get_list_by_sub_sector($row->subsector_id);
	   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	   $data['projectdiversities'] = $this->projectdiversitiesmodel->get_list_by_project_activity($row->project_id,$id);
	   
       $this->load->view('projectactivities/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('sector_id', 'Sector id', 'trim|required');
       $this->form_validation->set_rules('subsector_id', 'Subsector id', 'trim|required');
       $this->form_validation->set_rules('activity_id', 'Activity id', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Plannedactivity id', 'trim|required');
       $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
       $this->form_validation->set_rules('activity_description', 'Activity description', 'trim|required');
       $this->form_validation->set_rules('county_id', 'Region', 'trim|required');
       //$this->form_validation->set_rules('constituency_id', 'Constituency id', 'trim|required');
       //$this->form_validation->set_rules('subcounty_id', 'Subcounty id', 'trim|required');
       //$this->form_validation->set_rules('location_id', 'Location id', 'trim|required');
       //$this->form_validation->set_rules('sublocation_id', 'Sublocation id', 'trim|required');
       $this->form_validation->set_rules('activity_cost', 'Activity cost', 'trim|required');
       $this->form_validation->set_rules('total_beneficiaries', 'Total beneficiaries', 'trim|required');
       $this->form_validation->set_rules('projectactivitystatus_id', 'Projectactivitystatus id', 'trim|required');
       $this->form_validation->set_rules('date_added', 'Date added', 'trim|required');
       $this->form_validation->set_rules('project_month', 'Activity month', 'trim|required');
	   $this->form_validation->set_rules('lat', 'Latitude', 'trim|required');
	   $this->form_validation->set_rules('long', 'Longitude', 'trim|required');
       //$this->form_validation->set_rules('activity_reach', 'Activity reach', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'sector_id' => $this->input->post('sector_id'),
               'subsector_id' => $this->input->post('subsector_id'),
               'activity_id' => $this->input->post('activity_id'),
               'plannedactivity_id' => $this->input->post('plannedactivity_id'),
               'activity' => $this->input->post('activity'),
               'activity_description' => $this->input->post('activity_description'),
               'county_id' => $this->input->post('county_id'),
               'constituency_id' => $this->input->post('constituency_id'),
               'subcounty_id' => $this->input->post('subcounty_id'),
               'location_id' => $this->input->post('location_id'),
               'sublocation_id' => $this->input->post('sublocation_id'),
               'activity_cost' => $this->input->post('activity_cost'),
               'total_beneficiaries' => $this->input->post('total_beneficiaries'),
               'projectactivitystatus_id' => $this->input->post('projectactivitystatus_id'),
               'project_month' => $this->input->post('project_month'),
			   'project_year' => $this->input->post('project_year'),
			   'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectactivities', $data);
		   
		   $project_id = $this->input->post('project_id');
		   $projectactivity_id = $id;
		   
		    //add the activity beneficiaries
		   $beneficiaries = $this->beneficiarytypesmodel->get_list(); 
		   
		   foreach($beneficiaries as $key=>$beneficiary)
		   {
			   $field = 'beneficiary_'.$beneficiary['id'];
			   $number_reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST[''.$field.'']))));
			   
			   if($number_reached==0)
			   {
				   
			   }
			   else
			   {
				   $deletebeneficiaries = $this->projectactivitiesbeneficiariesmodel->delete_by_beneficiary_project($project_id,$projectactivity_id,$beneficiary['id']);
				   
				    $projectactivitiesbeneficiariesdata = array(
					   'project_id' => $project_id,
					   'projectactivity_id' => $projectactivity_id,
					   'beneficiary_id' => $beneficiary['id'],
					   'number_reached' => $number_reached,
				   );
				   $this->db->insert('projectactivitiesbeneficiaries', $projectactivitiesbeneficiariesdata);
			   }
			   
		   }
		   
		   //add other types of beneficiaries
		    if (!empty($_POST['mybeneficiary'])) {
				$deletediversity = $this->projectdiversitiesmodel->delete_by_activity($projectactivity_id);
                foreach ($_POST['mybeneficiary'] as $brow => $bid) {
                    
                    $mybeneficiary = trim($bid);
					$unit_of_measure    = $_POST['unit_of_measure'][$brow];
					$number    = $_POST['number'][$brow];
					
					
					$projectdiversitiesdata = array(
						   'project_id' => $project_id,
						   'projectactivity_id' => $projectactivity_id,
						   'beneficiary' => strtoupper($mybeneficiary),
						   'unit_of_measure' => $unit_of_measure,
						   'number' => $number,
					   );
					$this->db->insert('projectdiversities', $projectdiversitiesdata);
					
				}
		   }
		   
           redirect('projectactivities','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectactivities','refresh');
       }
       $this->db->delete('projectactivities', array('id' => $id));
       redirect('projectactivities','refresh');
   }
   
   
    function getsubsectors()
   {
	   $sector_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['sector_id']))));
	   
	   $subsectors = $this->subsectorsmodel->get_list_by_sector($sector_id);
	   
	   
	   $subsectorselect = '<select name="subsector_id" id="subsector_id" class="chosen-select form-control" required="required" onChange="Getactivitytypes(this)">';
	    $subsectorselect .= '<option value="0">Select Sub Sector</option>';  
		if(empty($subsectors))
		 {
			 
			   $subsectorselect .= '<option value="0">No Sub Sector Added</option>';
		   
		 }
		 else
		 { 
		   foreach($subsectors as $key => $subsector)
		   {
			   $subsectorselect .= '<option value="'.$subsector['id'].'">'.$subsector['sub_sector'].'</option>';
		   }
		 }
	   
	   $subsectorselect .= '</select>';
	   
	   echo $subsectorselect;
   }
   
   
    function getactivitytypes()
   {
	   $subsector_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['subsector_id']))));
	   
	   $activities = $this->activitiesmodel->get_list_by_sub_sector($subsector_id);
	   
	   
	   $activityselect = '<select name="activity_id" id="activity_id" class="form-control" required="required">';
	    $activityselect .= '<option value="">Select Activity</option>';  
		if(empty($activities))
		 {
			 
			   $activityselect .= '<option value="0">No Sub Activity Added</option>';
		   
		 }
		 else
		 { 
		   foreach($activities as $key => $activity)
		   {
			   $activityselect .= '<option value="'.$activity['id'].'">'.$activity['activity'].'</option>';
		   }
		 }
	   
	   $activityselect .= '</select>';
	   
	   echo $activityselect;
   }
   
   function upload()
	 {
		 $file_element_name = 'userImage';
		 $config['upload_path'] = './activityphotos/';
		 $config['overwrite'] = 'TRUE';
		 $config['allowed_types'] = 'gif|jpg|png|jpeg';
		 $this->load->library('upload', $config);
		   
		 if (!$this->upload->do_upload($file_element_name))
		 {
			$error = array('error' => $this->upload->display_errors());
			foreach($error as $key=>$err)
			{
			  echo '<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Warning!</strong> '.$err.'
			   </div>
			  ';	
			}
		 }
		 else
		 {
			$user_id = $this->erkanaauth->getField('id');
			$filedata = $this->upload->data();
			$projectactivity_id = $this->input->post('theprojectactivity_id');
				
			 $data = array(
				   'caption' => $this->input->post('caption'),
				   'tags' => $this->input->post('tags'),
				   'file_name' => $filedata['file_name'],
				   'file_type' => $filedata['file_type'],
				   'file_size' => $filedata['file_size'],
				   'projectactivity_id' => $this->input->post('theprojectactivity_id'),
				   'date_added' => date('Y-m-d'),
			   );
			   $this->db->insert('activityphotos', $data);
			
			
			echo '<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Document successfully added
			   </div>
			  ';
		 }
		 
		 $photos = $this->activityphotosmodel->get_list_by_activity($projectactivity_id);
		 
		 $imagetable = '<table class="table table-hover table-nomargin">
		   <thead>
			
		   <tr>
			 <th>Image</th>
			 <th>Caption</th>
			 <th>Date Added</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($photos as $key=>$photo)
		   {
			  $imagetable .= '<tr><td><img src="'.base_url().'activityphotos/'.$photo['file_name'].'" height="90" width="90"></td><td valign="top">'.$photo['caption'].'</td><td valign="top">'.$photo['date_added'].'</td></tr>'; 
		   }
		   
		    $imagetable .= '
		   </tbody>
		   </table>';
		   
		   echo $imagetable;
		 
		 
	 }

}

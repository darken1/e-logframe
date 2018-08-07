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
	   
	   $user_id = $this->erkanaauth->getField('id');
	   
	   if (getRole() == 'SuperAdmin') {
		   
		  $this->db->select('*')->from('projectactivities')->order_by("id", "DESC");
		   //$this->db->select('*')->from('projectactivities')->where('user_id', $user_id)->or_where('user_id', 0)->order_by("id", "DESC");
	   }
	   else
	   {
	   	   	$this->db->select('*')->from('projectactivities')->where('user_id', $user_id)->or_where('user_id', 0)->order_by("id", "DESC");
	   }

	   $rows = $this->db->get();
       $data = array(
           'rows' => $rows,
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
	   $data['beneficiarysubcategories'] = $this->beneficiarysubcategoriesmodel->get_list();
	   $data['projectdiversities'] = $this->projectdiversitiesmodel->get_list();
	   $data['activitycategories'] = $this->activitycategoriesmodel->get_list();
	   $data['aggregationtypes'] = $this->aggregationtypesmodel->get_list();
	   $organizations = $this->organizationsmodel->get_list();
	   $data['organizations'] = $organizations;
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
       //$this->form_validation->set_rules('activity_id', 'Activity', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Planned activity', 'trim|required');
	   $this->form_validation->set_rules('rollingactionplan_id', 'Task', 'trim|required');
       $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
       $this->form_validation->set_rules('activity_description', 'Activity description', 'trim|required');
       $this->form_validation->set_rules('county_id', 'Region', 'trim|required');
	   $this->form_validation->set_rules('settlement', 'Settlement', 'trim|required');
       //$this->form_validation->set_rules('constituency_id', 'Constituency id', 'trim|required');
       //$this->form_validation->set_rules('subcounty_id', 'Subcounty id', 'trim|required');
       //$this->form_validation->set_rules('location_id', 'Location id', 'trim|required');
       //$this->form_validation->set_rules('sublocation_id', 'Sublocation id', 'trim|required');
       //$this->form_validation->set_rules('activity_cost', 'Activity cost', 'trim|required');
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
		   $user_id = $this->erkanaauth->getField('id');
		   
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
               'activity_cost' => 0,
               'total_beneficiaries' => $this->input->post('total_beneficiaries'),
               'projectactivitystatus_id' => $this->input->post('projectactivitystatus_id'),
               'date_added' => $this->input->post('date_added'),
               'project_month' => $this->input->post('project_month'),
			   'project_year' => $this->input->post('project_year'),
               'activity_reach' => $this->input->post('activity_reach'),
			   'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
			   'activitycategory_id' => $this->input->post('activitycategory_id'),
			   'organization_id' => $this->input->post('organization_id'),
			   'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
			   'settlement' => $this->input->post('settlement'),
			   'user_id' => $user_id,
           );
           $this->db->insert('projectactivities', $data);
		   $projectactivity_id = $this->db->insert_id();
		   
		   $project_id = $this->input->post('project_id');
		   
		    //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $this->input->post('activity');
			
			$project = $this->projectsmodel->get_by_id($project_id)->row();
			
			
			$content = 'Added the activity '.$activity.' under the project '.$project->project_title.', and all its beneficiaries.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectactivities',
					   'item_db_id' => $projectactivity_id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
		   
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
		   
		   
		   //add the activity beneficiaries
		   $beneficiarycategories = $this->beneficiarysubcategoriesmodel->get_list(); 
		   
		   foreach($beneficiarycategories as $key=>$beneficiarycategory)
		   {
			   $subfield = 'beneficiarysub_'.$beneficiarycategory['id'];
			   $subnumber_reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST[''.$subfield.'']))));
			   
			   if($subnumber_reached==0)
			   {
				   
			   }
			   else
			   {
				    $subdata = array(
					   'project_id' => $project_id,
					   'projectactivity_id' => $projectactivity_id,
					   'beneficiarycategory_id' => $beneficiarycategory['id'],
					   'number_reached' => $subnumber_reached,
				   );
				   $this->db->insert('projectactivitiesbeneficiarycategories', $subdata);
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
		   
		   
		   $projectactivitystatus_id = $this->input->post('projectactivitystatus_id');
		   
		   if($projectactivitystatus_id==1)
		   {
			   $progress = 100;
		   }
		   else
		   {
			   $progress = $this->input->post('progress');
		   }
		   
		   
		   $user_id = $this->erkanaauth->getField('id');
		   
		   $rollingactionplan_id = $this->input->post('rollingactionplan_id');
		   $description = $this->input->post('activity_description');
			$taskdata = array(
				   'rollingactionplan_id' => $rollingactionplan_id,
				   'tasklog_date' => date('Y-m-d'),
				   'progress' => $progress,
				   'hours_worked' => '-',
				   'description' => $description,
				   'user_id' => $user_id,
			   );
			$this->db->insert('rollingactionplanlogs', $taskdata);
			
			$plandata = array(
				   'progress' => $progress,
			   );
			$this->db->where('id', $rollingactionplan_id);
			$this->db->update('rollingactionplans', $plandata);
			
			
			$activitycategory_id = $this->input->post('activitycategory_id');
			
			/**
			
			if($activitycategory_id==1)
			{
				redirect('trainingreports/add','refresh');
			}
			else if($activitycategory_id==6)
			{
				redirect('cashforwork/addreport/'.$project_id.'/'.$projectactivity_id,'refresh');
			}
			else if($activitycategory_id==5)
			{
				redirect('noncashdistribution/add_report/'.$project_id.'/'.$projectactivity_id,'refresh');
			}
			else if($activitycategory_id==4)
			{
				redirect('noncashdistribution/add_report/'.$project_id.'/'.$projectactivity_id,'refresh');
			}
			else if($activitycategory_id==14)
			{
				redirect('noncashdistribution/add_report/'.$project_id.'/'.$projectactivity_id,'refresh');
			}
			else
			{
			
           		redirect('projectactivities/edit/'.$projectactivity_id,'refresh');
			}
			
			**/
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
	   $data['activitycategories'] = $this->activitycategoriesmodel->get_list();
	   $data['error_message'] = $this->session->flashdata('error_message');
	   
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   $data['counties'] = $this->countiesmodel->get_list();
	   $data['districts'] = $this->districtsmodel->get_by_county($row->county_id);
	   $data['projectactivitystatus'] = $this->projectactivitystatusmodel->get_list();
	   $data['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->project_id);
	   $data['subsectors'] = $this->subsectorsmodel->get_list_by_sector($row->sector_id);
	   $data['activities'] = $this->activitiesmodel->get_list_by_sub_sector($row->subsector_id);
	   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	   $data['beneficiarysubcategories'] = $this->beneficiarysubcategoriesmodel->get_list();
	   $data['projectdiversities'] = $this->projectdiversitiesmodel->get_list_by_project_activity($row->project_id,$id);
	   $organizations = $this->organizationsmodel->get_list();
	   $data['organizations'] = $organizations;
	   $tasks = $this->rollingactionplansmodel->get_list_by_activity($row->plannedactivity_id);
	   $data['tasks'] = $tasks;	 
	   $data['aggregationtypes'] = $this->aggregationtypesmodel->get_list();  
	   
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
       //$this->form_validation->set_rules('activity_id', 'Activity id', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Plannedactivity id', 'trim|required');
	   $this->form_validation->set_rules('rollingactionplan_id', 'Task', 'trim|required');
       $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
       $this->form_validation->set_rules('activity_description', 'Activity description', 'trim|required');
       $this->form_validation->set_rules('county_id', 'Region', 'trim|required');
       //$this->form_validation->set_rules('constituency_id', 'Constituency id', 'trim|required');
       //$this->form_validation->set_rules('subcounty_id', 'Subcounty id', 'trim|required');
       //$this->form_validation->set_rules('location_id', 'Location id', 'trim|required');
       //$this->form_validation->set_rules('sublocation_id', 'Sublocation id', 'trim|required');
	   $this->form_validation->set_rules('settlement', 'Settlement', 'trim|required');
       //$this->form_validation->set_rules('activity_cost', 'Activity cost', 'trim|required');
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
               'activity_cost' => 0,
               'total_beneficiaries' => $this->input->post('total_beneficiaries'),
               'projectactivitystatus_id' => $this->input->post('projectactivitystatus_id'),
               'project_month' => $this->input->post('project_month'),
			   'project_year' => $this->input->post('project_year'),
			   'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
			   'activitycategory_id' => $this->input->post('activitycategory_id'),
			   'organization_id' => $this->input->post('organization_id'),
			   'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
			   'settlement' => $this->input->post('settlement'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectactivities', $data);
		   
		   $project_id = $this->input->post('project_id');
		   $projectactivity_id = $id;
		   
		   
		   //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $this->input->post('activity');
			
			
			
			$project = $this->projectsmodel->get_by_id($project_id)->row();
			
			
			$content = 'Edited the activity '.$activity.' under the project '.$project->project_title.', and all its beneficiaries.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectactivities',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
       
		   
		    //add the activity beneficiaries
		   $beneficiaries = $this->beneficiarytypesmodel->get_list(); 
		   
		   foreach($beneficiaries as $key=>$beneficiary)
		   {
			   $field = 'beneficiary_'.$beneficiary['id'];
			   $number_reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST[''.$field.'']))));
			   
			   if($number_reached==0)
			   {
				   $deletebeneficiaries = $this->projectactivitiesbeneficiariesmodel->delete_by_beneficiary_project($project_id,$projectactivity_id,$beneficiary['id']);
				    $deletebyactivity = $this->projectactivitiesbeneficiariesmodel->delete_by_project_activity($projectactivity_id);
			   }
			   else
			   {
				   $deletebeneficiaries = $this->projectactivitiesbeneficiariesmodel->delete_by_beneficiary_project($project_id,$projectactivity_id,$beneficiary['id']);
				   
				   $deletebyactivity = $this->projectactivitiesbeneficiariesmodel->delete_by_project_activity($projectactivity_id);
				   
				    $projectactivitiesbeneficiariesdata = array(
					   'project_id' => $project_id,
					   'projectactivity_id' => $projectactivity_id,
					   'beneficiary_id' => $beneficiary['id'],
					   'number_reached' => $number_reached,
				   );
				   $this->db->insert('projectactivitiesbeneficiaries', $projectactivitiesbeneficiariesdata);
			   }
			   
		   }
		   
		   
		   $beneficiarycategories = $this->beneficiarysubcategoriesmodel->get_list(); 
		   
		   foreach($beneficiarycategories as $key=>$beneficiarycategory)
		   {
			   $subfield = 'beneficiarysub_'.$beneficiarycategory['id'];
			   $subnumber_reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST[''.$subfield.'']))));
			   
			  			   
			   if($subnumber_reached==0)
			   {
				   $deletebeneficiariescategory = $this->projectactivitiesbeneficiarycategoriesmodel->delete_by_beneficiary_project($project_id,$projectactivity_id,$beneficiarycategory['id']);
				   $deletebyactivity = $this->projectactivitiesbeneficiarycategoriesmodel->delete_by_activity($projectactivity_id);
			   }
			   else
			   {
				   $deletebeneficiariescategory = $this->projectactivitiesbeneficiarycategoriesmodel->delete_by_beneficiary_project($project_id,$projectactivity_id,$beneficiarycategory['id']);
				   
				   $deletebyactivity = $this->projectactivitiesbeneficiarycategoriesmodel->delete_by_activity($projectactivity_id);
				   
				    $subdata = array(
					   'project_id' => $project_id,
					   'projectactivity_id' => $projectactivity_id,
					   'beneficiarycategory_id' => $beneficiarycategory['id'],
					   'number_reached' => $subnumber_reached,
				   );
				   $this->db->insert('projectactivitiesbeneficiarycategories', $subdata);
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
		   
		   
		   $projectactivitystatus_id = $this->input->post('projectactivitystatus_id');
		   
		   if($projectactivitystatus_id==1)
		   {
			   $progress = 100;
		   }
		   else
		   {
			   $progress = $this->input->post('progress');
		   }
		   
		   
		   $user_id = $this->erkanaauth->getField('id');
		   
		   $rollingactionplan_id = $this->input->post('rollingactionplan_id');
		   $description = $this->input->post('activity_description');
			$taskdata = array(
				   'rollingactionplan_id' => $rollingactionplan_id,
				   'tasklog_date' => date('Y-m-d'),
				   'progress' => $progress,
				   'hours_worked' => '-',
				   'description' => $description,
				   'user_id' => $user_id,
			   );
			$this->db->insert('rollingactionplanlogs', $taskdata);
			
			$plandata = array(
				   'progress' => $progress,
			   );
			$this->db->where('id', $rollingactionplan_id);
			$this->db->update('rollingactionplans', $plandata);
		   
          redirect('projectactivities','refresh');
       }
   }
   
   
   public function uploadphoto()
   {
	   
	   $config['upload_path'] = './activityphotos/';
	   $config['overwrite'] = 'TRUE';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $this->load->library('upload', $config);
	   
	   $id = $this->input->post('theprojectactivity_id');
	   
	   $file_element_name = 'userImage';	
	   
	    if (!$this->upload->do_upload($file_element_name))
		{
			$error = array('error' => $this->upload->display_errors());
			
			$message = '';
			
			foreach($error as $key=>$err)
			{
				$message .= $err;
			  
			}
			
			$this->session->set_flashdata('error_message', $message);
			
			redirect('projectactivities/edit/'.$id,'refresh');
		}
		else
		{
			$filedata = $this->upload->data();
				
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
			 
			 redirect('projectactivities/edit/'.$id,'refresh');
			
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
	   
	   $row = $this->db->get_where('projectactivities', array('id' => $id))->row();
       
	   $this->db->delete('projectactivitiesbeneficiaries', array('projectactivity_id' => $id));
	   
	   $this->db->delete('projectactivitiesbeneficiarycategories', array('projectactivity_id' => $id));
	   
	   $this->db->delete('projectactivities', array('id' => $id));
	   
	   
	   //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $row->activity;
			
			$project = $this->projectsmodel->get_by_id($row->project_id)->row();
			
			
			$content = 'Deleted the activity '.$activity.' under the project '.$project->project_title.', and all its beneficiaries.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectactivities',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
       
	   redirect('projectactivities','refresh');
   }
   
   function getdistricts()
   {
	   $county_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['county_id']))));
	   
	   $districts = $this->districtsmodel->get_by_county($county_id);
	   
	   
	   $subsectorselect = '<select name="subcounty_id" id="subcounty_id" class="chosen-select form-control" required="required">';
	    $subsectorselect .= '<option value="">Select District</option>';  
		if(empty($districts))
		 {
			 
			   $subsectorselect .= '<option value="">No Districts Added</option>';
		   
		 }
		 else
		 { 
		   foreach($districts as $key => $district)
		   {
			   $subsectorselect .= '<option value="'.$district['id'].'">'.$district['district'].'</option>';
		   }
		 }
	   
	   $subsectorselect .= '</select>';
	   
	   echo $subsectorselect;
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
   
   
   function getactivities()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   
	   $activities = $this->projectactivitiesmodel->get_list_by_project($project_id);
	   
	   
	   $activityselect = '<select name="projectaactivity_id" id="projectaactivity_id" class="form-control" required="required">';
	    $activityselect .= '<option value="">Select Activity</option>';  
		if(empty($activities))
		 {
			 
			   $activityselect .= '<option value="">No Activity Added</option>';
		   
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
   
   
   function getplannedactivities()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	  	 
		 
	   $activityselect = '<select name="plannedactivity_id" id="plannedactivity_id" class=\'chosen-select form-control\' required="required" onChange="getTasks(this)">';
	   $activityselect .= '<option value="">Select Activity</option>';
	     
		 if(empty($projectplannedactivities))
		 {
			//$activityselect .= '<option value="0">All</option>';
			$activityselect .= '<option value="">No Activity Added</option>';
		 }
		 else
		 { 
		   foreach($projectplannedactivities as $key => $projectplannedactivity)
		   {
			   $activityselect .= '<option value="'.$projectplannedactivity['id'].'">'.$projectplannedactivity['activity'].'</option>';
		   }
		 }
	   
	   $activityselect .= '</select>';
	   
	   echo $activityselect;
   }
   
   
   
    function gettasks()
   {
	   $plannedactivity_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['plannedactivity_id']))));
	   
	   $tasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity_id);
	  	 
		 
	   $activityselect = '<select name="rollingactionplan_id" id="rollingactionplan_id" class=\'chosen-select form-control\' required="required" >';
	   $activityselect .= '<option value="">Select Task</option>';
	     
		 if(empty($tasks))
		 {
			$activityselect .= '<option value="">No Task</option>';
		 }
		 else
		 { 
		   foreach($tasks as $key => $task)
		   {
			   $activityselect .= '<option value="'.$task['id'].'">'.$task['task_name'].'</option>';
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
	 
	 
	  public function getsectors()
   {
	   
	   $organization_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['organization_id']))));
	   
	   $sectors = $this->sectorsmodel->get_by_organization_list($organization_id);
	   
	   $sectorselect = '<select name="sector_id" id="sector_id" onChange="GetSubsectors(this)" class="form-control" required="required">';
	    $sectorselect .=  '<option value="">Select sector</option>';
	   foreach($sectors as $key=>$sector)
		{
	
            $sectorselect .=  '<option value="'.$sector['id'].'" >'.$sector['sector'].'</option>';
      
		}
					
					
	   $sectorselect .= '</select>';
	   
	   
	   echo $sectorselect;
	   
   }
   
   
     function getlist()
   {
	   $organization_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['organization_id']))));
	   
	   $activities = $this->activitycategoriesmodel->get_list_by_organization($organization_id);
	   
	   
	   $activityselect = '<select name="activitycategory_id" id="activitycategory_id" class="form-control" required="required">';
	    $activityselect .= '<option value="">Select Activity</option>';  
		if(empty($activities))
		 {
			 
			   $activityselect .= '<option value="0">No Activity Added</option>';
		   
		 }
		 else
		 { 
		   foreach($activities as $key => $activity)
		   {
			   $activityselect .= '<option value="'.$activity['id'].'">'.$activity['activity_category'].'</option>';
		   }
		 }
	   
	   $activityselect .= '</select>';
	   
	   echo $activityselect;
   }
   
   public function download($id)
   {
	    // create new PDF document
			$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('DRC');
			$pdf->SetTitle('DRC/DDG Action Plan');
			$pdf->SetSubject('DRC/DDG Action Plan');
			$pdf->SetKeywords('Projects, Task, Plan, action','Activities');
			
			// set default header data
			$pdf->SetHeaderData(false, false, '', '');
			
			
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			
			//set margins
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
			$pdf->SetMargins(7, 7, 7);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			//set some language-dependent strings
			//$pdf->setLanguageArray($l);
			
			// ---------------------------------------------------------
			
			// set font
			$pdf->SetFont('dejavusans', '', 9);
			
			$pdf->SetPrintHeader(false);
			
			// add a page
			$pdf->AddPage();
			
			
	   $row = $this->db->get_where('projectactivities', array('id' => $id))->row();
	   $project = $this->projectsmodel->get_by_id($row->project_id)->row();
	   $projectplannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
	   $task = $this->rollingactionplansmodel->get_by_id($row->rollingactionplan_id)->row();
	   $organization = $this->organizationsmodel->get_by_id($row->organization_id)->row();
	   $sector = $this->sectorsmodel->get_by_id($row->sector_id)->row();
	   $activitytype = $this->activitycategoriesmodel->get_by_id($row->activitycategory_id)->row();
	   $region = $this->countiesmodel->get_by_id($row->county_id)->row();
	   $status = $this->projectactivitystatusmodel->get_by_id($row->projectactivitystatus_id)->row();
	   
	   $html = '<table width="100%" cellpadding="2" cellspacing="2" border="1">';
	   $html .= '<tr><td><strong>Project</strong></td><td>'.$project->project_no.'/'.$project->project_title.'</td></tr>';
	   $html .= '<tr><td><strong>Planned activity</strong></td><td>'.$projectplannedactivity->activity.'</td></tr>';
	   $html .= '<tr><td><strong>Task</strong></td><td>'.$task->task_name.'</td></tr>';
	   $html .= '<tr><td><strong>Organization</strong></td><td>'.$organization->organization_name.'</td></tr>';
	   $html .= '<tr><td><strong>Sector</strong></td><td>'.$sector->sector.'</td></tr>';
	   $html .= '<tr><td><strong>Activity Type</strong></td><td>'.$activitytype->activity_category.'</td></tr>';
	   $html .= '<tr><td><strong>Activity</strong></td><td>'.$row->activity.'</td></tr>';
	   $html .= '<tr><td><strong>Activity Description</strong></td><td>'.$row->activity_description.'</td></tr>';
	   $html .= '<tr><td><strong>Region</strong></td><td>'.$region->county.'</td></tr>';
	   $html .= '<tr><td><strong>Total beneficiaries</strong></td><td>'.$row->total_beneficiaries.'</td></tr>';
	   $html .= '<tr><td><strong>Status</strong></td><td>'.$status->status.'</td></tr>';
	   $html .= '<tr><td><strong>Date</strong></td><td>'.$row->date_added.'</td></tr>';
	   $html .= '</table>';
	   
	   
	   
	    $pdf->writeHTML($html, true, false, true, false, '');
			
			$txt = date("m/d/Y h:m:s");    
	
	 // print a block of text using Write()
	 //$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// test pre tag
			
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			// reset pointer to the last page
			$pdf->lastPage();
			ob_start();
				// ---------------------------------------------------------
			 //ob_end_clean();
			//Close and output PDF document
			$pdf->Output('Project_Activity.pdf', 'I');
   }
   
    function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
  }
   
   
   

}

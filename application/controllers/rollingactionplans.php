<?php

/**
DO NOT REMOVE THIS NOTICE FROM THE CODE
This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rollingactionplans extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('rollingactionplansmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   //users should only see tasks that they create	   
	   $user_id = $this->erkanaauth->getField('id');
	   
	   if (getRole() == 'SuperAdmin') {
		   
		   $this->db->select('*')->from('rollingactionplans')->order_by("id", "DESC");
		   //$this->db->select('*')->from('rollingactionplans')->where('task_owner_id', $user_id)->order_by("id", "DESC");
	   }
	   else
	   {
	   	   	$this->db->select('*')->from('rollingactionplans')->where('task_owner_id', $user_id)->order_by("id", "DESC");
	   }

	   $rows = $this->db->get();
       $data = array(
           'rows' => $rows,
       );
	   
	   $data['warning_message'] = $this->session->flashdata('delete_warning_message');
	   
       $this->load->view('rollingactionplans/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $data['projects'] = $this->db->get('projects');
	   $data['organizations'] = $this->db->get('organizations');
	   $data['counties'] = $this->db->get('counties');
	   $data['rollingactionplans'] = $this->rollingactionplansmodel->get_list();
	   $data['taskcategories'] = $this->taskcategoriesmodel->get_list();
	   $data['tasks'] = $this->tasksmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
       $this->load->view('rollingactionplans/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
	   $this->form_validation->set_rules('organization_id', 'Organization', 'trim|required');
	   $this->form_validation->set_rules('county_id', 'Location', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Plannedactivity id', 'trim|required');
	   $this->form_validation->set_rules('taskcategory_id', 'Activity type', 'trim|required');
	   $this->form_validation->set_rules('task_id', 'Task', 'trim|required');
       //$this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
	   $this->form_validation->set_rules('primary', 'Activity milestone task', 'trim|required');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       $this->form_validation->set_rules('progress', 'Progress', 'trim|required');
       $this->form_validation->set_rules('priority', 'Priority', 'trim|required');
       //$this->form_validation->set_rules('task_type', 'Task type', 'trim|required');
       $this->form_validation->set_rules('target_budget', 'Target budget', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       //$this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       //$this->form_validation->set_rules('end_time', 'End time', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   $user_id = $this->erkanaauth->getField('id');
		   
		   $taskcategory_id = $this->input->post('taskcategory_id');
		   $task_id = $this->input->post('task_id');
		   
		   $task = $this->tasksmodel->get_by_id($task_id)->row();
		   $taskcategory = $this->taskcategoriesmodel->get_by_id($taskcategory_id)->row();
		   
		   $task_name = $taskcategory->category.' - '.$task->task;
		   
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'plannedactivity_id' => $this->input->post('plannedactivity_id'),
               'task_name' => $task_name,
               'status' => $this->input->post('status'),
               'progress' => $this->input->post('progress'),
               'priority' => $this->input->post('priority'),
               'task_owner_id' => $user_id,
               'task_type' => 'Operative',
               'parent_id' => $this->input->post('parent_id'),
               'target_budget' => $this->input->post('target_budget'),
               'description' => $this->input->post('description'),
               'start_date' => $this->input->post('start_date'),
               'start_time' => '08:00',
               'end_date' => $this->input->post('end_date'),
               'end_time' => '17:00',
               'date_created' => date('Y-m-d'),
			   'organization_id' => $this->input->post('organization_id'),
			   'county_id' => $this->input->post('county_id'),
			   'primary_activity' => 1,
			   'taskcategory_id' => $this->input->post('taskcategory_id'),
			   'task_id' => $this->input->post('task_id'),
           );
           $this->db->insert('rollingactionplans', $data);
		   $rollingactionplan_id = $this->db->insert_id();
		   
		   
		    //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $this->input->post('activity');
			
			$plannedactivity_id = $this->input->post('plannedactivity_id');
			$project_id = $this->input->post('project_id');
			
			$project = $this->projectsmodel->get_by_id($project_id)->row();
			$projectplannedactivity = $this->projectplannedactivitiesmodel->get_by_id($plannedactivity_id)->row();
			
			
			$content = 'Added the task '.$task_name.' for the planned activity '.$projectplannedactivity->activity.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'rollingactionplans',
					   'item_db_id' => $rollingactionplan_id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
		   
		  if (!empty($_POST['user_id'])) {
                foreach ($_POST['user_id'] as $rrow => $rid) {
                    
                    $user_id = $rid;
					
					 $data = array(
						   'user_id' => $user_id,
						   'rollingactionplan_id' => $rollingactionplan_id,
					   );
					   $this->db->insert('rollingactionplanassignees', $data);
					
				}
		   }
		   
		   if (!empty($_POST['dependancy_id'])) {
                foreach ($_POST['dependancy_id'] as $drow => $did) {
                    
                    $dependancy_id = $did;
					
					 $data = array(
						   'rollingactionplan_id' => $rollingactionplan_id,
						   'dependancy_id' => $dependancy_id,
					   );
					 $this->db->insert('rollingactionplandependancies', $data);
					
				}
		   }
		   
		   if (!empty($_POST['milestone'])) {
                foreach ($_POST['milestone'] as $mrow => $mid) {
                    
                    $milestone = $mid;
					$milestone_date = $_POST['milestone_date'][$mrow];
					if(empty($milestone))
					{
						//do not save on the database
					}
					else
					{
						 $data = array(
							   'milestone' => $milestone,
							   'milestone_date' => $milestone_date,
							   'rollingactionplan_id' => $rollingactionplan_id,
						   );
						 $this->db->insert('rollingactionplanmilestones', $data);
					}
					
				}
		   }
		   
		   
           redirect('rollingactionplans','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplans','refresh');
       }
       $row = $this->db->get_where('rollingactionplans', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rollingactionplans','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $data['counties'] = $this->db->get('counties');
	   $data['organizations'] = $this->db->get('organizations');
	   $data['projects'] = $this->db->get('projects');
	   $data['rollingactionplans'] = $this->rollingactionplansmodel->get_list();
	   $data['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->project_id);
	   $data['users'] = $this->usersmodel->get_list();
       $this->load->view('rollingactionplans/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
	   $this->form_validation->set_rules('organization_id', 'Organization', 'trim|required');
	   $this->form_validation->set_rules('county_id', 'Location', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Plannedactivity id', 'trim|required');
       //$this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
	   $this->form_validation->set_rules('primary', 'Activity milestone task', 'trim|required');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       $this->form_validation->set_rules('progress', 'Progress', 'trim|required');
       $this->form_validation->set_rules('priority', 'Priority', 'trim|required');
       $this->form_validation->set_rules('task_type', 'Task type', 'trim|required');
       $this->form_validation->set_rules('target_budget', 'Target budget', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       //$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
      //$this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       //$this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       //$this->form_validation->set_rules('end_time', 'End time', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'plannedactivity_id' => $this->input->post('plannedactivity_id'),
               'status' => $this->input->post('status'),
               'progress' => $this->input->post('progress'),
               'priority' => $this->input->post('priority'),
               'task_type' => $this->input->post('task_type'),
               'target_budget' => $this->input->post('target_budget'),
               'description' => $this->input->post('description'),
               'organization_id' => $this->input->post('organization_id'),
			   'county_id' => $this->input->post('county_id'),
			   'primary_activity' => 1,
           );
           $this->db->where('id', $id);
           $this->db->update('rollingactionplans', $data);
		   
		   
		   //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $this->input->post('activity');
			
			$plannedactivity_id = $this->input->post('plannedactivity_id');
			$project_id = $this->input->post('project_id');
			
			$project = $this->projectsmodel->get_by_id($project_id)->row();
			$projectplannedactivity = $this->projectplannedactivitiesmodel->get_by_id($plannedactivity_id)->row();
			
			$description = $this->input->post('description');
			
			
			$content = 'Edited and updated the task '.$description.' for the planned activity '.$projectplannedactivity->activity.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'rollingactionplans',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
		   
		   if (!empty($_POST['user_id'])) {
                foreach ($_POST['user_id'] as $rrow => $rid) {
                    
                    $user_id = $rid;
					
					$eraseassignee = $this->rollingactionplanassigneesmodel->delete_plan_user($id,$user_id);
					
					 $data = array(
						   'user_id' => $user_id,
						   'rollingactionplan_id' => $id,
					   );
					   $this->db->insert('rollingactionplanassignees', $data);
					
				}
		   }
		   
		   if (!empty($_POST['dependancy_id'])) {
                foreach ($_POST['dependancy_id'] as $drow => $did) {
                    
                    $dependancy_id = $did;
					
					$erasedependancy = $this->rollingactionplandependanciesmodel->delete_plan_dependancy($id,$dependancy_id);
					
					 $data = array(
						   'rollingactionplan_id' => $id,
						   'dependancy_id' => $dependancy_id,
					   );
					 $this->db->insert('rollingactionplandependancies', $data);
					
				}
		   }
		   
		   if (!empty($_POST['milestone'])) {
                foreach ($_POST['milestone'] as $mrow => $mid) {
                    
                    $milestone = $mid;
					$milestone_date = $_POST['milestone_date'][$mrow];
					if(empty($milestone))
					{
						//do not save on the database
					}
					else
					{
						$erasemilestone = $this->rollingactionplanmilestonesmodel->delete_by_plan($id);
						 $data = array(
							   'milestone' => $milestone,
							   'milestone_date' => $milestone_date,
							   'rollingactionplan_id' => $id,
						   );
						 $this->db->insert('rollingactionplanmilestones', $data);
					}
					
				}
		   }
		   
		   
           redirect('rollingactionplans','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplans','refresh');
       }
	   
	   $row = $this->db->get_where('rollingactionplans', array('id' => $id))->row();
	   
	   $projectactivities = $this->projectactivitiesmodel->get_by_task($id);
	   $count = count($projectactivities);
	 	   
	   if($count>0)
	   {
		    $this->session->set_flashdata('delete_warning_message', 'The action plan you attempted to delete has at leat one activity reported under it.');
			
			 //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $this->input->post('activity');
			
			$project = $this->projectsmodel->get_by_id($row->project_id)->row();
			$projectplannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
			
			
			$content = 'Attempted to delete the task '.$row->task_name.' for the planned activity '.$projectplannedactivity->activity.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'rollingactionplans',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   else
	   {
       					
			 //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$activity = $this->input->post('activity');
			
			$project = $this->projectsmodel->get_by_id($row->project_id)->row();
			$projectplannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
			
			
			$content = 'Deleted the task '.$row->task_name.' for the planned activity '.$projectplannedactivity->activity.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'rollingactionplans',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
			
			
			$this->db->delete('rollingactionplans', array('id' => $id));
       
	   }
       redirect('rollingactionplans','refresh');
   }
   
   function getactivities()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	  	 
		 
	   $activityselect = '<select name="plannedactivity_id" id="plannedactivity_id" class=\'chosen-select form-control\' onChange="getTasks(this)">';
	     
		 $activityselect .= '<option value="">Select Activity</option>';
		 if(empty($projectplannedactivities))
		 {
			//$activityselect .= '<option value="">Select Activity</option>';
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
   
   
   public function trackactivities()
   {
		
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
      
	   $data = array();
	   
	   $data['projects'] = $this->projectsmodel->get_list();
	   
	   $this->load->view('rollingactionplans/trackactivities',$data);
   }
   
   public function tracklist()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   
	   $table = ' <table class="table table-nomargin" width="100%">';
	   $table .= '<thead>
	   <tr><th colspan="7">Activities</th></tr>
	   <tr><th>Start Date</th><th>End Date</th><th>Duration</th><th>Task</th><th>Activity</th><th>Assigned</th><th>Status</th></tr>
	   </thead>';
	   
	   
	   $table .= '</table>';

	   echo $table;
	   
   }
   
   
   function getprimarytasks()
   {
	   $plannedactivity_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['plannedactivity_id']))));
	   
	   $tasks = $this->rollingactionplansmodel->get_list_by_primary_activity($plannedactivity_id,1);
	  	 
		
	   $activityselect = '<select  id="rollingactionplan_id" name="rollingactionplan_id" class=\'form-control\' >';
	
	     $activityselect .= '<option value="0">None</option>';
		 if(empty($tasks))
		 {
			//$activityselect .= '<option value="0">None</option>';
			
			$activityselect .= '<option value="">No task added for activity</option>';
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
   
   
   function gettasks()
   {
	   $plannedactivity_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['plannedactivity_id']))));
	   
	   $tasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity_id);
	  	 
		
	   $activityselect = '<select  id="dependancy_id" name="dependancy_id[]" class=\'form-control\' >';
	
	     $activityselect .= '<option value="0">None</option>';
		 if(empty($tasks))
		 {
			//$activityselect .= '<option value="0">None</option>';
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
   
   public function getregions()
   {
	   
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   
	   $regions = $this->projectscountiesmodel->get_list_by_project($project_id);
	   
	   $sectorselect = '<select id="county_id" name="county_id" class=\'chosen-select form-control\' required="required">';
	   
	   $sectorselect .=  '<option value="">Select Region</option>';
	   
	   foreach($regions as $key=>$region)
		{
			$theregion = $this->countiesmodel->get_by_id($region['county_id'])->row();
				
            $sectorselect .=  '<option value="'.$region['county_id'].'" >'.$theregion->county.'</option>';
      
		}
					
					
	   $sectorselect .= '</select>';
	   
	   
	   echo $sectorselect;
	   
   }
   
   
    function getdependancies()
   {
	   $plannedactivity_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['plannedactivity_id']))));
	   
	   $tasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity_id);
	  	 
		$activityselect = '
		<span class="help-block">
           <code>Cick on CTRL &amp; Shift to select multiple</code>
       </span>
		'; 
	   $activityselect .= '<select  multiple="multiple" id="dependancy_id" name="dependancy_id[]" class=\'multiselect\' >';
	   //$activityselect .= '<option value="">Select Task</option>';
	     
		 if(empty($tasks))
		 {
			//$activityselect .= '<option value="">No Task</option>';
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

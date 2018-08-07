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
       $data = array(
           'rows' => $this->db->get('rollingactionplans'),
       );
       $this->load->view('rollingactionplans/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $data['projects'] = $this->db->get('projects');
	   $data['rollingactionplans'] = $this->rollingactionplansmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
       $this->load->view('rollingactionplans/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Plannedactivity id', 'trim|required');
       $this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       $this->form_validation->set_rules('progress', 'Progress', 'trim|required');
       $this->form_validation->set_rules('priority', 'Priority', 'trim|required');
       $this->form_validation->set_rules('task_type', 'Task type', 'trim|required');
       $this->form_validation->set_rules('target_budget', 'Target budget', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('end_time', 'End time', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   $user_id = $this->erkanaauth->getField('id');
		   
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'plannedactivity_id' => $this->input->post('plannedactivity_id'),
               'task_name' => $this->input->post('task_name'),
               'status' => $this->input->post('status'),
               'progress' => $this->input->post('progress'),
               'priority' => $this->input->post('priority'),
               'task_owner_id' => $user_id,
               'task_type' => $this->input->post('task_type'),
               'parent_id' => $this->input->post('parent_id'),
               'target_budget' => $this->input->post('target_budget'),
               'description' => $this->input->post('description'),
               'start_date' => $this->input->post('start_date'),
               'start_time' => $this->input->post('start_time'),
               'end_date' => $this->input->post('end_date'),
               'end_time' => $this->input->post('end_time'),
               'date_created' => date('Y-m-d'),
           );
           $this->db->insert('rollingactionplans', $data);
		   $rollingactionplan_id = $this->db->insert_id();
		   
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
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('plannedactivity_id', 'Plannedactivity id', 'trim|required');
       $this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       $this->form_validation->set_rules('progress', 'Progress', 'trim|required');
       $this->form_validation->set_rules('priority', 'Priority', 'trim|required');
       $this->form_validation->set_rules('task_type', 'Task type', 'trim|required');
       $this->form_validation->set_rules('target_budget', 'Target budget', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('end_time', 'End time', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'plannedactivity_id' => $this->input->post('plannedactivity_id'),
               'task_name' => $this->input->post('task_name'),
               'status' => $this->input->post('status'),
               'progress' => $this->input->post('progress'),
               'priority' => $this->input->post('priority'),
               'task_type' => $this->input->post('task_type'),
               'parent_id' => $this->input->post('parent_id'),
               'target_budget' => $this->input->post('target_budget'),
               'description' => $this->input->post('description'),
               'start_date' => $this->input->post('start_date'),
               'start_time' => $this->input->post('start_time'),
               'end_date' => $this->input->post('end_date'),
               'end_time' => $this->input->post('end_time'),
           );
           $this->db->where('id', $id);
           $this->db->update('rollingactionplans', $data);
		   
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
       $this->db->delete('rollingactionplans', array('id' => $id));
       redirect('rollingactionplans','refresh');
   }
   
   function getactivities()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	  	 
		 
	   $activityselect = '<select name="plannedactivity_id" id="plannedactivity_id" class=\'chosen-select form-control\'>';
	     
		 if(empty($projectplannedactivities))
		 {
			$activityselect .= '<option value="0">All</option>';
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

}

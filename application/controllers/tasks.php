<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Tasks extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('tasksmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('tasks'),
       );
       $this->load->view('tasks/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['taskcategories'] = $this->taskcategoriesmodel->get_list();
       $this->load->view('tasks/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('taskcategory_id', 'Task category', 'trim|required');
       $this->form_validation->set_rules('task', 'Task', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'taskcategory_id' => $this->input->post('taskcategory_id'),
               'task' => $this->input->post('task'),
           );
           $this->db->insert('tasks', $data);
           redirect('tasks','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('tasks','refresh');
       }
       $row = $this->db->get_where('tasks', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('tasks','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['taskcategories'] = $this->taskcategoriesmodel->get_list();
       $this->load->view('tasks/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('taskcategory_id', 'Task category', 'trim|required');
       $this->form_validation->set_rules('task', 'Task', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'taskcategory_id' => $this->input->post('taskcategory_id'),
               'task' => $this->input->post('task'),
           );
           $this->db->where('id', $id);
           $this->db->update('tasks', $data);
           redirect('tasks','refresh');
       }
   }
   
   
   function gettasks()
   {
	   $taskcategory_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['taskcategory_id']))));
	   
	   $tasks = $this->tasksmodel->get_by_category($taskcategory_id);
	  	 
		 
	   $activityselect = '<select name="task_id" id="task_id" class=\'chosen-select form-control\' >';
	     
		 $activityselect .= '<option value="">Select task</option>';
		 if(empty($tasks))
		 {
			//$activityselect .= '<option value="">Select Activity</option>';
		 }
		 else
		 { 
		   foreach($tasks as $key => $task)
		   {
			   $activityselect .= '<option value="'.$task['id'].'">'.$task['task'].'</option>';
		   }
		 }
	   
	   $activityselect .= '</select>';
	   
	   echo $activityselect;
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('tasks','refresh');
       }
       $this->db->delete('tasks', array('id' => $id));
       redirect('tasks','refresh');
   }

}

<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Activitycategories extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('activitycategoriesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('activitycategories'),
       );
       $this->load->view('activitycategories/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('activitycategories/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('activity_category', 'Activity category', 'trim|required');
       $this->form_validation->set_rules('icon', 'Icon', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'activity_category' => $this->input->post('activity_category'),
               'icon' => $this->input->post('icon'),
           );
           $this->db->insert('activitycategories', $data);
           redirect('activitycategories','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('activitycategories','refresh');
       }
       $row = $this->db->get_where('activitycategories', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('activitycategories','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('activitycategories/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('activity_category', 'Activity category', 'trim|required');
       $this->form_validation->set_rules('icon', 'Icon', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'activity_category' => $this->input->post('activity_category'),
               'icon' => $this->input->post('icon'),
           );
           $this->db->where('id', $id);
           $this->db->update('activitycategories', $data);
           redirect('activitycategories','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('activitycategories','refresh');
       }
       $this->db->delete('activitycategories', array('id' => $id));
       redirect('activitycategories','refresh');
   }

}

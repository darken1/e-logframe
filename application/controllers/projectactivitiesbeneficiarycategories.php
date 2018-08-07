<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectactivitiesbeneficiarycategories extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectactivitiesbeneficiarycategoriesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectactivitiesbeneficiarycategories'),
       );
       $this->load->view('projectactivitiesbeneficiarycategories/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('projectactivitiesbeneficiarycategories/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('projectactivity_id', 'Projectactivity id', 'trim|required');
       $this->form_validation->set_rules('beneficiarycategory_id', 'Beneficiarycategory id', 'trim|required');
       $this->form_validation->set_rules('number_reached', 'Number reached', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'projectactivity_id' => $this->input->post('projectactivity_id'),
               'beneficiarycategory_id' => $this->input->post('beneficiarycategory_id'),
               'number_reached' => $this->input->post('number_reached'),
           );
           $this->db->insert('projectactivitiesbeneficiarycategories', $data);
           redirect('projectactivitiesbeneficiarycategories','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectactivitiesbeneficiarycategories','refresh');
       }
       $row = $this->db->get_where('projectactivitiesbeneficiarycategories', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectactivitiesbeneficiarycategories','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('projectactivitiesbeneficiarycategories/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('projectactivity_id', 'Projectactivity id', 'trim|required');
       $this->form_validation->set_rules('beneficiarycategory_id', 'Beneficiarycategory id', 'trim|required');
       $this->form_validation->set_rules('number_reached', 'Number reached', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'projectactivity_id' => $this->input->post('projectactivity_id'),
               'beneficiarycategory_id' => $this->input->post('beneficiarycategory_id'),
               'number_reached' => $this->input->post('number_reached'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectactivitiesbeneficiarycategories', $data);
           redirect('projectactivitiesbeneficiarycategories','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectactivitiesbeneficiarycategories','refresh');
       }
       $this->db->delete('projectactivitiesbeneficiarycategories', array('id' => $id));
       redirect('projectactivitiesbeneficiarycategories','refresh');
   }

}

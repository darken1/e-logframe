<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Formcategories extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('formcategoriesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('formcategories'),
       );
       $this->load->view('formcategories/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('formcategories/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('form_category', 'Form category', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'form_category' => $this->input->post('form_category'),
           );
           $this->db->insert('formcategories', $data);
           redirect('formcategories','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('formcategories','refresh');
       }
       $row = $this->db->get_where('formcategories', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('formcategories','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('formcategories/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('form_category', 'Form category', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'form_category' => $this->input->post('form_category'),
           );
           $this->db->where('id', $id);
           $this->db->update('formcategories', $data);
           redirect('formcategories','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('formcategories','refresh');
       }
       $this->db->delete('formcategories', array('id' => $id));
       redirect('formcategories','refresh');
   }

}

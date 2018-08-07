<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Documentcategories extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('documentcategoriesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('documentcategories'),
       );
       $this->load->view('documentcategories/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('documentcategories/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('category', 'Category', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'category' => $this->input->post('category'),
           );
           $this->db->insert('documentcategories', $data);
           redirect('documentcategories','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('documentcategories','refresh');
       }
       $row = $this->db->get_where('documentcategories', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('documentcategories','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('documentcategories/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('category', 'Category', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'category' => $this->input->post('category'),
           );
           $this->db->where('id', $id);
           $this->db->update('documentcategories', $data);
           redirect('documentcategories','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('documentcategories','refresh');
       }
       $this->db->delete('documentcategories', array('id' => $id));
       redirect('documentcategories','refresh');
   }

}

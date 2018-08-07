<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Taskcategories extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('taskcategoriesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('taskcategories'),
       );
       $this->load->view('taskcategories/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('taskcategories/add',$data);
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
           $this->db->insert('taskcategories', $data);
           redirect('taskcategories','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('taskcategories','refresh');
       }
       $row = $this->db->get_where('taskcategories', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('taskcategories','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('taskcategories/edit', $data);
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
           $this->db->update('taskcategories', $data);
           redirect('taskcategories','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('taskcategories','refresh');
       }
       $this->db->delete('taskcategories', array('id' => $id));
       redirect('taskcategories','refresh');
   }

}

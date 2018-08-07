<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Aggregationtypes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('aggregationtypesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('aggregationtypes'),
       );
       $this->load->view('aggregationtypes/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('aggregationtypes/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'type' => $this->input->post('type'),
           );
           $this->db->insert('aggregationtypes', $data);
           redirect('aggregationtypes','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('aggregationtypes','refresh');
       }
       $row = $this->db->get_where('aggregationtypes', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('aggregationtypes','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('aggregationtypes/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'type' => $this->input->post('type'),
           );
           $this->db->where('id', $id);
           $this->db->update('aggregationtypes', $data);
           redirect('aggregationtypes','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('aggregationtypes','refresh');
       }
       $this->db->delete('aggregationtypes', array('id' => $id));
       redirect('aggregationtypes','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Organizationtypes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('organizationtypesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('organizationtypes'),
       );
       $this->load->view('organizationtypes/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('organizationtypes/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('organization_type', 'Organization type', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'organization_type' => $this->input->post('organization_type'),
           );
           $this->db->insert('organizationtypes', $data);
           redirect('organizationtypes','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('organizationtypes','refresh');
       }
       $row = $this->db->get_where('organizationtypes', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('organizationtypes','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('organizationtypes/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('organization_type', 'Organization type', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'organization_type' => $this->input->post('organization_type'),
           );
           $this->db->where('id', $id);
           $this->db->update('organizationtypes', $data);
           redirect('organizationtypes','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('organizationtypes','refresh');
       }
       $this->db->delete('organizationtypes', array('id' => $id));
       redirect('organizationtypes','refresh');
   }

}

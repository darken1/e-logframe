<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Roles extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('rolesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('roles'),
       );
	   
	   $data['warning_message'] = $this->session->flashdata('warning_message');
       $this->load->view('roles/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('roles/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('name', 'Name', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'name' => $this->input->post('name'),
               'description' => $this->input->post('description'),
           );
           $this->db->insert('roles', $data);
           redirect('roles','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('roles','refresh');
       }
       $row = $this->db->get_where('roles', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('roles','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('roles/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('name', 'Name', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'name' => $this->input->post('name'),
               'description' => $this->input->post('description'),
           );
           $this->db->where('id', $id);
           $this->db->update('roles', $data);
           redirect('roles','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('roles','refresh');
       }
	   
	   $userrole = $this->usersmodel->get_by_role_id($id)->row();
	   if(empty($userrole))
	   {
       		$this->db->delete('roles', array('id' => $id));
		
	   }
	   else
	   {
		   
		   $this->session->set_flashdata('warning_message','The role you attempted to delete has users classified under it and you cannot delete it.');
		   
	   }
      redirect('roles','refresh');
   }

}

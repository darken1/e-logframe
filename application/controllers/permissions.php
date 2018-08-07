<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Permissions extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('permissionsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('permissions'),
       );
       $this->load->view('permissions/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['tables'] = $this->rolefunctionpermissionmodel->get_tables();
       $this->load->view('permissions/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('table_name', 'Table name', 'trim|required');
       $this->form_validation->set_rules('permission', 'Permission', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'table_name' => $this->input->post('table_name'),
               'permission' => $this->input->post('permission'),
           );
           $this->db->insert('permissions', $data);
           redirect('permissions','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('permissions','refresh');
       }
       $row = $this->db->get_where('permissions', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('permissions','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['tables'] = $this->rolefunctionpermissionmodel->get_tables();
       $this->load->view('permissions/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       //$this->form_validation->set_rules('table_name', 'Table name', 'trim|required');
       $this->form_validation->set_rules('permission', 'Permission', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'permission' => $this->input->post('permission'),
           );
           $this->db->where('id', $id);
           $this->db->update('permissions', $data);
           redirect('permissions','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('permissions','refresh');
       }
       //$this->db->delete('permissions', array('id' => $id));
       redirect('permissions','refresh');
   }

}

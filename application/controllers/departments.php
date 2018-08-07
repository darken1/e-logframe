<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Departments extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('departmentsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('departments'),
       );
       $this->load->view('departments/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('departments/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('department', 'Department', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'department' => $this->input->post('department'),
           );
           $this->db->insert('departments', $data);
           redirect('departments','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('departments','refresh');
       }
       $row = $this->db->get_where('departments', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('departments','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('departments/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('department', 'Department', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'department' => $this->input->post('department'),
           );
           $this->db->where('id', $id);
           $this->db->update('departments', $data);
           redirect('departments','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('departments','refresh');
       }
       $this->db->delete('departments', array('id' => $id));
       redirect('departments','refresh');
   }

}

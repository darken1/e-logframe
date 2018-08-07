<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Audittrail extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('audittrailmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   $this->db->select('*')->from('audittrail')->order_by("id", "DESC");

	   $rows = $this->db->get();

       $data = array(
           'rows' => $rows,
       );
       $this->load->view('audittrail/index', $data);
   }

   public function add()
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('audittrail/add',$data);
	   **/
	   redirect('audittrail','refresh');
   }

   public function add_validate()
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('username', 'Username', 'trim|required');
       $this->form_validation->set_rules('ip_address', 'Ip address', 'trim|required');
       $this->form_validation->set_rules('date_time', 'Date time', 'trim|required');
       $this->form_validation->set_rules('content', 'Content', 'trim|required');
       $this->form_validation->set_rules('user_db_id', 'User db id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'username' => $this->input->post('username'),
               'ip_address' => $this->input->post('ip_address'),
               'date_time' => $this->input->post('date_time'),
               'content' => $this->input->post('content'),
               'user_db_id' => $this->input->post('user_db_id'),
           );
           $this->db->insert('audittrail', $data);
           redirect('audittrail','refresh');
       }
	   **/
	   redirect('audittrail','refresh');
   }

   public function edit($id)
   {
       
	   /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('audittrail','refresh');
       }
       $row = $this->db->get_where('audittrail', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('audittrail','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('audittrail/edit', $data);
	   **/
	   redirect('audittrail','refresh');
   }

   public function edit_validate($id)
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('username', 'Username', 'trim|required');
       $this->form_validation->set_rules('ip_address', 'Ip address', 'trim|required');
       $this->form_validation->set_rules('date_time', 'Date time', 'trim|required');
       $this->form_validation->set_rules('content', 'Content', 'trim|required');
       $this->form_validation->set_rules('user_db_id', 'User db id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'username' => $this->input->post('username'),
               'ip_address' => $this->input->post('ip_address'),
               'date_time' => $this->input->post('date_time'),
               'content' => $this->input->post('content'),
               'user_db_id' => $this->input->post('user_db_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('audittrail', $data);
           redirect('audittrail','refresh');
       }
	   **/
	   redirect('audittrail','refresh');
   }

   public function delete($id)
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('audittrail','refresh');
       }
       $this->db->delete('audittrail', array('id' => $id));
       redirect('audittrail','refresh');
	   **/
	   redirect('audittrail','refresh');
   }

}

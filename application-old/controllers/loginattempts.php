<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Loginattempts extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('loginattemptsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	 
	   
       $data = array(
           'rows' => $this->db->get('loginattempts'),
       );
       $this->load->view('loginattempts/index', $data);
   }

   public function add()
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('loginattempts/add',$data);
	   
	   **/
	   
	    redirect('loginattempts','refresh');
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
       $this->form_validation->set_rules('success', 'Success', 'trim|required');
       $this->form_validation->set_rules('time', 'Time', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'username' => $this->input->post('username'),
               'ip_address' => $this->input->post('ip_address'),
               'date_time' => $this->input->post('date_time'),
               'success' => $this->input->post('success'),
               'time' => $this->input->post('time'),
           );
           $this->db->insert('loginattempts', $data);
           redirect('loginattempts','refresh');
       }
	   **/
	   
	    redirect('loginattempts','refresh');
   }

   public function edit($id)
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('loginattempts','refresh');
       }
       $row = $this->db->get_where('loginattempts', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('loginattempts','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('loginattempts/edit', $data);
	   
	   **/
	    redirect('loginattempts','refresh');
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
       $this->form_validation->set_rules('success', 'Success', 'trim|required');
       $this->form_validation->set_rules('time', 'Time', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'username' => $this->input->post('username'),
               'ip_address' => $this->input->post('ip_address'),
               'date_time' => $this->input->post('date_time'),
               'success' => $this->input->post('success'),
               'time' => $this->input->post('time'),
           );
           $this->db->where('id', $id);
           $this->db->update('loginattempts', $data);
           redirect('loginattempts','refresh');
       }
	   **/
	    redirect('loginattempts','refresh');
   }

   public function delete($id)
   {
       /**
	    (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('loginattempts','refresh');
       }
       $this->db->delete('loginattempts', array('id' => $id));
       redirect('loginattempts','refresh');
	   **/
	    redirect('loginattempts','refresh');
   }

}

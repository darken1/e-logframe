<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Passwordpolicies extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('passwordpoliciesmodel');
   }

   public function index()
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('passwordpolicies'),
       );
       $this->load->view('passwordpolicies/index', $data);
	   **/
	   redirect('passwordpolicies/edit','refresh');
   }

   public function add()
   {
	   /**
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('passwordpolicies/add',$data);
	   **/
	   redirect('passwordpolicies/edit','refresh');
   }

   public function add_validate()
   {
	   /**
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('max_login_attempts', 'Max login attempts', 'trim|required');
       $this->form_validation->set_rules('login_attempts_counted_within', 'Login attempts counted within', 'trim|required');
       $this->form_validation->set_rules('lock_account_after_attempts', 'Lock account after attempts', 'trim|required');
       $this->form_validation->set_rules('blacklist_ip_after_attempts', 'Blacklist ip after attempts', 'trim|required');
       $this->form_validation->set_rules('password_life', 'Password life', 'trim|required');
       $this->form_validation->set_rules('notification_period', 'Notification period', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'max_login_attempts' => $this->input->post('max_login_attempts'),
               'login_attempts_counted_within' => $this->input->post('login_attempts_counted_within'),
               'lock_account_after_attempts' => $this->input->post('lock_account_after_attempts'),
               'blacklist_ip_after_attempts' => $this->input->post('blacklist_ip_after_attempts'),
               'password_life' => $this->input->post('password_life'),
               'notification_period' => $this->input->post('notification_period'),
           );
           $this->db->insert('passwordpolicies', $data);
           redirect('passwordpolicies','refresh');
       }
	   **/
	   redirect('passwordpolicies/edit','refresh');
   }

   public function edit()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $id = 1;
       if(!is_numeric($id)) {
       	redirect('passwordpolicies','refresh');
       }
       $row = $this->db->get_where('passwordpolicies', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('passwordpolicies','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('passwordpolicies/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('max_login_attempts', 'Max login attempts', 'trim|required|numeric');
       $this->form_validation->set_rules('login_attempts_counted_within', 'Login attempts counted within', 'trim|required|numeric');
       $this->form_validation->set_rules('lock_account_after_attempts', 'Lock account after attempts', 'trim|required|numeric');
       $this->form_validation->set_rules('blacklist_ip_after_attempts', 'Blacklist ip after attempts', 'trim|required|numeric');
	   $this->form_validation->set_rules('notify_admin_after_attempts', 'Notify Admin after attempts', 'trim|required|numeric');
       $this->form_validation->set_rules('password_life', 'Password life', 'trim|required|numeric');
       $this->form_validation->set_rules('notification_period', 'Notification period', 'trim|required|numeric');
       if ($this->form_validation->run() == false) {
           $this->edit();
       } else {
           $data = array(
               'max_login_attempts' => $this->input->post('max_login_attempts'),
               'login_attempts_counted_within' => $this->input->post('login_attempts_counted_within'),
               'lock_account_after_attempts' => $this->input->post('lock_account_after_attempts'),
               'blacklist_ip_after_attempts' => $this->input->post('blacklist_ip_after_attempts'),
			   'notify_admin_after_attempts' => $this->input->post('notify_admin_after_attempts'),
               'password_life' => $this->input->post('password_life'),
               'notification_period' => $this->input->post('notification_period'),
           );
           $this->db->where('id', $id);
           $this->db->update('passwordpolicies', $data);
           redirect('passwordpolicies/edit','refresh');
       }
   }

   public function delete($id)
   {
      /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('passwordpolicies','refresh');
       }
       $this->db->delete('passwordpolicies', array('id' => $id));
       redirect('passwordpolicies','refresh');
	   
	   **/
	   redirect('passwordpolicies/edit','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Lockedips extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('lockedipsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('lockedips'),
       );
       $this->load->view('lockedips/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('lockedips/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('ip_address', 'Ip address', 'trim|required|valid_ip');
       $this->form_validation->set_rules('reason', 'Reason', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'ip_address' => $this->input->post('ip_address'),
               'reason' => $this->input->post('reason'),
           );
           $this->db->insert('lockedips', $data);
           redirect('lockedips','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('lockedips','refresh');
       }
       $row = $this->db->get_where('lockedips', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('lockedips','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('lockedips/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('ip_address', 'Ip address', 'trim|required');
       $this->form_validation->set_rules('reason', 'Reason', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'ip_address' => $this->input->post('ip_address'),
               'reason' => $this->input->post('reason'),
           );
           $this->db->where('id', $id);
           $this->db->update('lockedips', $data);
           redirect('lockedips','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('lockedips','refresh');
       }
       $this->db->delete('lockedips', array('id' => $id));
       redirect('lockedips','refresh');
   }

}

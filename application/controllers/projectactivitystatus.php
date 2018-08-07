<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectactivitystatus extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectactivitystatusmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectactivitystatus'),
       );
       $this->load->view('projectactivitystatus/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('projectactivitystatus/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'status' => $this->input->post('status'),
           );
           $this->db->insert('projectactivitystatus', $data);
           redirect('projectactivitystatus','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectactivitystatus','refresh');
       }
       $row = $this->db->get_where('projectactivitystatus', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectactivitystatus','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('projectactivitystatus/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'status' => $this->input->post('status'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectactivitystatus', $data);
           redirect('projectactivitystatus','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectactivitystatus','refresh');
       }
       $this->db->delete('projectactivitystatus', array('id' => $id));
       redirect('projectactivitystatus','refresh');
   }

}

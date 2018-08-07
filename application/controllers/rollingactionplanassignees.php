<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rollingactionplanassignees extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('rollingactionplanassigneesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('rollingactionplanassignees'),
       );
       $this->load->view('rollingactionplanassignees/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('rollingactionplanassignees/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
       $this->form_validation->set_rules('rollingactionplan_id', 'Rollingactionplan id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'user_id' => $this->input->post('user_id'),
               'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
           );
           $this->db->insert('rollingactionplanassignees', $data);
           redirect('rollingactionplanassignees','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplanassignees','refresh');
       }
       $row = $this->db->get_where('rollingactionplanassignees', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rollingactionplanassignees','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('rollingactionplanassignees/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
       $this->form_validation->set_rules('rollingactionplan_id', 'Rollingactionplan id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'user_id' => $this->input->post('user_id'),
               'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('rollingactionplanassignees', $data);
           redirect('rollingactionplanassignees','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplanassignees','refresh');
       }
       $this->db->delete('rollingactionplanassignees', array('id' => $id));
       redirect('rollingactionplanassignees','refresh');
   }

}

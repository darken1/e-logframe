<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Typesofsupport extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('typesofsupportmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('typesofsupport'),
       );
       $this->load->view('typesofsupport/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('typesofsupport/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('support', 'Support', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'support' => $this->input->post('support'),
           );
           $this->db->insert('typesofsupport', $data);
           redirect('typesofsupport','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('typesofsupport','refresh');
       }
       $row = $this->db->get_where('typesofsupport', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('typesofsupport','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('typesofsupport/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('support', 'Support', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'support' => $this->input->post('support'),
           );
           $this->db->where('id', $id);
           $this->db->update('typesofsupport', $data);
           redirect('typesofsupport','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('typesofsupport','refresh');
       }
       $this->db->delete('typesofsupport', array('id' => $id));
       redirect('typesofsupport','refresh');
   }

}

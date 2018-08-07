<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Beneficiarytypes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('beneficiarytypesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('beneficiarytypes'),
       );
       $this->load->view('beneficiarytypes/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('beneficiarytypes/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('beneficiary_type', 'Beneficiary type', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'beneficiary_type' => $this->input->post('beneficiary_type'),
           );
           $this->db->insert('beneficiarytypes', $data);
           redirect('beneficiarytypes','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('beneficiarytypes','refresh');
       }
       $row = $this->db->get_where('beneficiarytypes', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('beneficiarytypes','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('beneficiarytypes/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('beneficiary_type', 'Beneficiary type', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'beneficiary_type' => $this->input->post('beneficiary_type'),
           );
           $this->db->where('id', $id);
           $this->db->update('beneficiarytypes', $data);
           redirect('beneficiarytypes','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('beneficiarytypes','refresh');
       }
       $this->db->delete('beneficiarytypes', array('id' => $id));
       redirect('beneficiarytypes','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Currencies extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('currenciesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('currencies'),
       );
       $this->load->view('currencies/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('currencies/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('iso_code', 'Iso code', 'trim|required');
       $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'iso_code' => $this->input->post('iso_code'),
               'currency' => $this->input->post('currency'),
           );
           $this->db->insert('currencies', $data);
           redirect('currencies','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('currencies','refresh');
       }
       $row = $this->db->get_where('currencies', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('currencies','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('currencies/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('iso_code', 'Iso code', 'trim|required');
       $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'iso_code' => $this->input->post('iso_code'),
               'currency' => $this->input->post('currency'),
           );
           $this->db->where('id', $id);
           $this->db->update('currencies', $data);
           redirect('currencies','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('currencies','refresh');
       }
       $this->db->delete('currencies', array('id' => $id));
       redirect('currencies','refresh');
   }

}

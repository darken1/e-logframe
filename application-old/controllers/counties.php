<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Counties extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('countiesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('counties'),
       );
       $this->load->view('counties/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('counties/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('county', 'Region', 'trim|required');
       $this->form_validation->set_rules('population', 'Population', 'trim|required');
       $this->form_validation->set_rules('lat', 'Lat', 'trim|required');
       $this->form_validation->set_rules('long', 'Long', 'trim|required');
       $this->form_validation->set_rules('active', 'Active', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'county' => $this->input->post('county'),
               'population' => $this->input->post('population'),
               'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
               'active' => $this->input->post('active'),
           );
           $this->db->insert('counties', $data);
           redirect('counties','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('counties','refresh');
       }
       $row = $this->db->get_where('counties', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('counties','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('counties/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('county', 'Region', 'trim|required');
       $this->form_validation->set_rules('population', 'Population', 'trim|required');
       $this->form_validation->set_rules('lat', 'Lat', 'trim|required');
       $this->form_validation->set_rules('long', 'Long', 'trim|required');
       $this->form_validation->set_rules('active', 'Active', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'county' => $this->input->post('county'),
               'population' => $this->input->post('population'),
               'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
               'active' => $this->input->post('active'),
           );
           $this->db->where('id', $id);
           $this->db->update('counties', $data);
           redirect('counties','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('counties','refresh');
       }
       $this->db->delete('counties', array('id' => $id));
       redirect('counties','refresh');
   }

}

<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Districts extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('districtsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('districts'),
       );
       $this->load->view('districts/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['counties'] = $this->countiesmodel->get_list();
       $this->load->view('districts/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('county_id', 'Region', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('population', 'Population', 'trim|required');
       $this->form_validation->set_rules('lat', 'Lat', 'trim|required');
       $this->form_validation->set_rules('long', 'Long', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'county_id' => $this->input->post('county_id'),
               'district' => $this->input->post('district'),
               'population' => $this->input->post('population'),
               'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
           );
           $this->db->insert('districts', $data);
           redirect('districts','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('districts','refresh');
       }
       $row = $this->db->get_where('districts', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('districts','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['counties'] = $this->countiesmodel->get_list();
       $this->load->view('districts/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('county_id', 'Region', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('population', 'Population', 'trim|required');
       $this->form_validation->set_rules('lat', 'Lat', 'trim|required');
       $this->form_validation->set_rules('long', 'Long', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'county_id' => $this->input->post('county_id'),
               'district' => $this->input->post('district'),
               'population' => $this->input->post('population'),
               'lat' => $this->input->post('lat'),
               'long' => $this->input->post('long'),
           );
           $this->db->where('id', $id);
           $this->db->update('districts', $data);
           redirect('districts','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('districts','refresh');
       }
       $this->db->delete('districts', array('id' => $id));
       redirect('districts','refresh');
   }

}

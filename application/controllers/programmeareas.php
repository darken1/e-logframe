<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Programmeareas extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('programmeareasmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('programmeareas'),
       );
       $this->load->view('programmeareas/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('programmeareas/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programmearea', 'Programmearea', 'trim|required');
       $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
       $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'programmearea' => $this->input->post('programmearea'),
               'longitude' => $this->input->post('longitude'),
               'latitude' => $this->input->post('latitude'),
           );
           $this->db->insert('programmeareas', $data);
           redirect('programmeareas','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('programmeareas','refresh');
       }
       $row = $this->db->get_where('programmeareas', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('programmeareas','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('programmeareas/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programmearea', 'Programmearea', 'trim|required');
       $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
       $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'programmearea' => $this->input->post('programmearea'),
               'longitude' => $this->input->post('longitude'),
               'latitude' => $this->input->post('latitude'),
           );
           $this->db->where('id', $id);
           $this->db->update('programmeareas', $data);
           redirect('programmeareas','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('programmeareas','refresh');
       }
       $this->db->delete('programmeareas', array('id' => $id));
       redirect('programmeareas','refresh');
   }

}

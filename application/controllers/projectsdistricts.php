<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectsdistricts extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectsdistrictsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectsdistricts'),
       );
       $this->load->view('projectsdistricts/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('projectsdistricts/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('district_id', 'District id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'district_id' => $this->input->post('district_id'),
           );
           $this->db->insert('projectsdistricts', $data);
           redirect('projectsdistricts','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectsdistricts','refresh');
       }
       $row = $this->db->get_where('projectsdistricts', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectsdistricts','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('projectsdistricts/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('district_id', 'District id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'district_id' => $this->input->post('district_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectsdistricts', $data);
           redirect('projectsdistricts','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectsdistricts','refresh');
       }
       $this->db->delete('projectsdistricts', array('id' => $id));
       redirect('projectsdistricts','refresh');
   }

}

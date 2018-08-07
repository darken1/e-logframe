<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectobjectiveindicators extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectobjectiveindicatorsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectobjectiveindicators'),
       );
       $this->load->view('projectobjectiveindicators/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('projectobjectiveindicators/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('indicator', 'Indicator', 'trim|required');
       $this->form_validation->set_rules('target', 'Target', 'trim|required');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       $this->form_validation->set_rules('means', 'Means', 'trim|required');
       $this->form_validation->set_rules('assumptions', 'Assumptions', 'trim|required');
       $this->form_validation->set_rules('objective_id', 'Objective id', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'indicator' => $this->input->post('indicator'),
               'target' => $this->input->post('target'),
               'type' => $this->input->post('type'),
               'means' => $this->input->post('means'),
               'assumptions' => $this->input->post('assumptions'),
               'objective_id' => $this->input->post('objective_id'),
               'project_id' => $this->input->post('project_id'),
           );
           $this->db->insert('projectobjectiveindicators', $data);
           redirect('projectobjectiveindicators','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectobjectiveindicators','refresh');
       }
       $row = $this->db->get_where('projectobjectiveindicators', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectobjectiveindicators','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('projectobjectiveindicators/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('indicator', 'Indicator', 'trim|required');
       $this->form_validation->set_rules('target', 'Target', 'trim|required');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       $this->form_validation->set_rules('means', 'Means', 'trim|required');
       $this->form_validation->set_rules('assumptions', 'Assumptions', 'trim|required');
       $this->form_validation->set_rules('objective_id', 'Objective id', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'indicator' => $this->input->post('indicator'),
               'target' => $this->input->post('target'),
               'type' => $this->input->post('type'),
               'means' => $this->input->post('means'),
               'assumptions' => $this->input->post('assumptions'),
               'objective_id' => $this->input->post('objective_id'),
               'project_id' => $this->input->post('project_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectobjectiveindicators', $data);
           redirect('projectobjectiveindicators','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectobjectiveindicators','refresh');
       }
       $this->db->delete('projectobjectiveindicators', array('id' => $id));
       redirect('projectobjectiveindicators','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rollingactionplanmilestones extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('rollingactionplanmilestonesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('rollingactionplanmilestones'),
       );
       $this->load->view('rollingactionplanmilestones/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('rollingactionplanmilestones/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('milestone', 'Milestone', 'trim|required');
       $this->form_validation->set_rules('milestone_date', 'Milestone date', 'trim|required');
       $this->form_validation->set_rules('rollingactionplan_id', 'Rollingactionplan id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'milestone' => $this->input->post('milestone'),
               'milestone_date' => $this->input->post('milestone_date'),
               'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
           );
           $this->db->insert('rollingactionplanmilestones', $data);
           redirect('rollingactionplanmilestones','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplanmilestones','refresh');
       }
       $row = $this->db->get_where('rollingactionplanmilestones', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rollingactionplanmilestones','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('rollingactionplanmilestones/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('milestone', 'Milestone', 'trim|required');
       $this->form_validation->set_rules('milestone_date', 'Milestone date', 'trim|required');
       $this->form_validation->set_rules('rollingactionplan_id', 'Rollingactionplan id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'milestone' => $this->input->post('milestone'),
               'milestone_date' => $this->input->post('milestone_date'),
               'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('rollingactionplanmilestones', $data);
           redirect('rollingactionplanmilestones','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplanmilestones','refresh');
       }
       $this->db->delete('rollingactionplanmilestones', array('id' => $id));
       redirect('rollingactionplanmilestones','refresh');
   }

}

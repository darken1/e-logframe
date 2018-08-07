<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Reportinglines extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('reportinglinesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('reportinglines'),
       );
       $this->load->view('reportinglines/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['organizations'] = $this->organizationsmodel->get_list();
	   $data['reportinglines'] = $this->reportinglinesmodel->get_list();
       $this->load->view('reportinglines/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('organization_id', 'Organization id', 'trim|required');
       $this->form_validation->set_rules('title', 'Title', 'trim|required');
       $this->form_validation->set_rules('parent_id', 'Parent id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'organization_id' => $this->input->post('organization_id'),
               'title' => $this->input->post('title'),
               'parent_id' => $this->input->post('parent_id'),
           );
           $this->db->insert('reportinglines', $data);
           redirect('reportinglines','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('reportinglines','refresh');
       }
       $row = $this->db->get_where('reportinglines', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('reportinglines','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['organizations'] = $this->organizationsmodel->get_list();
	   $data['reportinglines'] = $this->reportinglinesmodel->get_list();
       $this->load->view('reportinglines/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('organization_id', 'Organization id', 'trim|required');
       $this->form_validation->set_rules('title', 'Title', 'trim|required');
       $this->form_validation->set_rules('parent_id', 'Parent id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'organization_id' => $this->input->post('organization_id'),
               'title' => $this->input->post('title'),
               'parent_id' => $this->input->post('parent_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('reportinglines', $data);
           redirect('reportinglines','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('reportinglines','refresh');
       }
       $this->db->delete('reportinglines', array('id' => $id));
       redirect('reportinglines','refresh');
   }
   
   public function view()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array();
	   
	   $data['reportinglines'] = $this->reportinglinesmodel->get_parent(0);
	   $data['organization'] = $this->organizationsmodel->get_by_id(1)->row();
	   
	   $this->load->view('reportinglines/view', $data);
   }
   
   public function graphical()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array();
	   
	   $data['reportinglines'] = $this->reportinglinesmodel->get_parent(0);
	   $data['organization'] = $this->organizationsmodel->get_by_id(1)->row();
	   
	   $this->load->view('reportinglines/graphical', $data);
   }

}

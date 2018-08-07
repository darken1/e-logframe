<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Staff extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('staffmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('staff'),
       );
       $this->load->view('staff/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['departments'] = $this->departmentsmodel->get_list();
	   $data['reportinglines'] = $this->reportinglinesmodel->get_list();
       $this->load->view('staff/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required');
       $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required');
       $this->form_validation->set_rules('department_id', 'Department id', 'trim|required');
       $this->form_validation->set_rules('reportingline_id', 'Reportingline id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'full_name' => $this->input->post('full_name'),
               'email' => $this->input->post('email'),
               'telephone' => $this->input->post('telephone'),
               'department_id' => $this->input->post('department_id'),
               'reportingline_id' => $this->input->post('reportingline_id'),
           );
           $this->db->insert('staff', $data);
           redirect('staff','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('staff','refresh');
       }
       $row = $this->db->get_where('staff', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('staff','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['departments'] = $this->departmentsmodel->get_list();
	   $data['reportinglines'] = $this->reportinglinesmodel->get_list();
	   
       $this->load->view('staff/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required');
       $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required');
       $this->form_validation->set_rules('department_id', 'Department id', 'trim|required');
       $this->form_validation->set_rules('reportingline_id', 'Reportingline id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'full_name' => $this->input->post('full_name'),
               'email' => $this->input->post('email'),
               'telephone' => $this->input->post('telephone'),
               'department_id' => $this->input->post('department_id'),
               'reportingline_id' => $this->input->post('reportingline_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('staff', $data);
           redirect('staff','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('staff','refresh');
       }
       $this->db->delete('staff', array('id' => $id));
       redirect('staff','refresh');
   }
   
   public function liststaff()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('staff'),
       );
       $this->load->view('staff/liststaff', $data);
   }

}

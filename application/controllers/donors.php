<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Donors extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('donorsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('donors'),
       );
       $this->load->view('donors/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('donors/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('donor_name', 'Donor name', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'trim|required');
       $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
       $this->form_validation->set_rules('contact_email', 'Contact email', 'trim|required|valid_email');
       $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'donor_name' => $this->input->post('donor_name'),
               'email' => $this->input->post('email'),
               'telephone_number' => $this->input->post('telephone_number'),
               'contact_person' => $this->input->post('contact_person'),
               'contact_email' => $this->input->post('contact_email'),
               'contact_number' => $this->input->post('contact_number'),
           );
           $this->db->insert('donors', $data);
           redirect('donors','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('donors','refresh');
       }
       $row = $this->db->get_where('donors', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('donors','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('donors/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('donor_name', 'Donor name', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'trim|required');
       $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
       $this->form_validation->set_rules('contact_email', 'Contact email', 'trim|required|valid_email');
       $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'donor_name' => $this->input->post('donor_name'),
               'email' => $this->input->post('email'),
               'telephone_number' => $this->input->post('telephone_number'),
               'contact_person' => $this->input->post('contact_person'),
               'contact_email' => $this->input->post('contact_email'),
               'contact_number' => $this->input->post('contact_number'),
           );
           $this->db->where('id', $id);
           $this->db->update('donors', $data);
           redirect('donors','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('donors','refresh');
       }
       $this->db->delete('donors', array('id' => $id));
       redirect('donors','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Partners extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('partnersmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('partners'),
       );
       $this->load->view('partners/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['organizationtypes'] = $this->organizationtypesmodel->get_list();
	   $data['levelsofoperation'] = $this->levelsofoperationmodel->get_list();
	   
       $this->load->view('partners/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('partner', 'Partner', 'trim|required');
       $this->form_validation->set_rules('physical_address', 'Physical address', 'trim|required');
       $this->form_validation->set_rules('postal_address', 'Postal address', 'trim|required');
       $this->form_validation->set_rules('postal_code', 'Postal code', 'trim|required');
       $this->form_validation->set_rules('city', 'City', 'trim|required');
       $this->form_validation->set_rules('organization_email', 'Organization email', 'trim|required|valid_email');
       $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required');
       $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
       $this->form_validation->set_rules('contact_email', 'Contact email', 'trim|required|valid_email');
       $this->form_validation->set_rules('levelofoperation_id', 'Levelofoperation id', 'trim|required');
       $this->form_validation->set_rules('organizationtype_id', 'Organizationtype id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'partner' => $this->input->post('partner'),
               'physical_address' => $this->input->post('physical_address'),
               'postal_address' => $this->input->post('postal_address'),
               'postal_code' => $this->input->post('postal_code'),
               'city' => $this->input->post('city'),
               'organization_email' => $this->input->post('organization_email'),
               'telephone' => $this->input->post('telephone'),
               'contact_person' => $this->input->post('contact_person'),
               'contact_email' => $this->input->post('contact_email'),
               'levelofoperation_id' => $this->input->post('levelofoperation_id'),
               'organizationtype_id' => $this->input->post('organizationtype_id'),
           );
           $this->db->insert('partners', $data);
           redirect('partners','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('partners','refresh');
       }
       $row = $this->db->get_where('partners', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('partners','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['organizationtypes'] = $this->organizationtypesmodel->get_list();
	   $data['levelsofoperation'] = $this->levelsofoperationmodel->get_list();
	   
       $this->load->view('partners/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('partner', 'Partner', 'trim|required');
       $this->form_validation->set_rules('physical_address', 'Physical address', 'trim|required');
       $this->form_validation->set_rules('postal_address', 'Postal address', 'trim|required');
       $this->form_validation->set_rules('postal_code', 'Postal code', 'trim|required');
       $this->form_validation->set_rules('city', 'City', 'trim|required');
       $this->form_validation->set_rules('organization_email', 'Organization email', 'trim|required|valid_email');
       $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required');
       $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
       $this->form_validation->set_rules('contact_email', 'Contact email', 'trim|required|valid_email');
       $this->form_validation->set_rules('levelofoperation_id', 'Levelofoperation id', 'trim|required');
       $this->form_validation->set_rules('organizationtype_id', 'Organizationtype id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'partner' => $this->input->post('partner'),
               'physical_address' => $this->input->post('physical_address'),
               'postal_address' => $this->input->post('postal_address'),
               'postal_code' => $this->input->post('postal_code'),
               'city' => $this->input->post('city'),
               'organization_email' => $this->input->post('organization_email'),
               'telephone' => $this->input->post('telephone'),
               'contact_person' => $this->input->post('contact_person'),
               'contact_email' => $this->input->post('contact_email'),
               'levelofoperation_id' => $this->input->post('levelofoperation_id'),
               'organizationtype_id' => $this->input->post('organizationtype_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('partners', $data);
           redirect('partners','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('partners','refresh');
       }
       $this->db->delete('partners', array('id' => $id));
       redirect('partners','refresh');
   }

}

<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Beneficiarysubcategories extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('beneficiarysubcategoriesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('beneficiarysubcategories'),
       );
       $this->load->view('beneficiarysubcategories/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	   $data['aggregationtypes'] = $this->aggregationtypesmodel->get_list();
       $this->load->view('beneficiarysubcategories/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('beneficiarytype_id', 'Beneficiary type', 'trim|required');
       $this->form_validation->set_rules('beneficiary_category', 'Beneficiary category', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'beneficiarytype_id' => $this->input->post('beneficiarytype_id'),
               'beneficiary_category' => $this->input->post('beneficiary_category'),
			   'aggregationtype_id' => $this->input->post('aggregationtype_id'),
			   'gender' => $this->input->post('gender'),
           );
           $this->db->insert('beneficiarysubcategories', $data);
           redirect('beneficiarysubcategories','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('beneficiarysubcategories','refresh');
       }
       $row = $this->db->get_where('beneficiarysubcategories', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('beneficiarysubcategories','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	   $data['aggregationtypes'] = $this->aggregationtypesmodel->get_list();
       $this->load->view('beneficiarysubcategories/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('beneficiarytype_id', 'Beneficiary type', 'trim|required');
       $this->form_validation->set_rules('beneficiary_category', 'Beneficiary category', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'beneficiarytype_id' => $this->input->post('beneficiarytype_id'),
               'beneficiary_category' => $this->input->post('beneficiary_category'),
			   'aggregationtype_id' => $this->input->post('aggregationtype_id'),
			   'gender' => $this->input->post('gender'),
           );
           $this->db->where('id', $id);
           $this->db->update('beneficiarysubcategories', $data);
           redirect('beneficiarysubcategories','refresh');
       }
   }
   
   
    public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('beneficiarysubcategories','refresh');
       }
       $this->db->delete('beneficiarysubcategories', array('id' => $id));
       redirect('beneficiarysubcategories','refresh');
   }

}

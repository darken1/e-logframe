<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Sectors extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('sectorsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('sectors'),
       );
       $this->load->view('sectors/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $organizations = $this->organizationsmodel->get_list();
	   $data['organizations'] = $organizations;
       $this->load->view('sectors/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('sector', 'Sector', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'sector' => $this->input->post('sector'),
			   'organization_id' => $this->input->post('organization_id'),
           );
           $this->db->insert('sectors', $data);
           redirect('sectors','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('sectors','refresh');
       }
       $row = $this->db->get_where('sectors', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('sectors','refresh');
       }
       $data = array(
           'row' => $row,
       );
	    $organizations = $this->organizationsmodel->get_list();
	   $data['organizations'] = $organizations;
       $this->load->view('sectors/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('sector', 'Sector', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'sector' => $this->input->post('sector'),
			   'organization_id' => $this->input->post('organization_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('sectors', $data);
           redirect('sectors','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('sectors','refresh');
       }
       $this->db->delete('sectors', array('id' => $id));
       redirect('sectors','refresh');
   }

}

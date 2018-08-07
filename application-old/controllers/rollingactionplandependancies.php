<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rollingactionplandependancies extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('rollingactionplandependanciesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('rollingactionplandependancies'),
       );
       $this->load->view('rollingactionplandependancies/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('rollingactionplandependancies/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('rollingactionplan_id', 'Rollingactionplan id', 'trim|required');
       $this->form_validation->set_rules('dependancy_id', 'Dependancy id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
               'dependancy_id' => $this->input->post('dependancy_id'),
           );
           $this->db->insert('rollingactionplandependancies', $data);
           redirect('rollingactionplandependancies','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplandependancies','refresh');
       }
       $row = $this->db->get_where('rollingactionplandependancies', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rollingactionplandependancies','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('rollingactionplandependancies/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('rollingactionplan_id', 'Rollingactionplan id', 'trim|required');
       $this->form_validation->set_rules('dependancy_id', 'Dependancy id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'rollingactionplan_id' => $this->input->post('rollingactionplan_id'),
               'dependancy_id' => $this->input->post('dependancy_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('rollingactionplandependancies', $data);
           redirect('rollingactionplandependancies','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplandependancies','refresh');
       }
       $this->db->delete('rollingactionplandependancies', array('id' => $id));
       redirect('rollingactionplandependancies','refresh');
   }

}

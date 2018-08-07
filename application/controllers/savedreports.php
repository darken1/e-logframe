<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Savedreports extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('savedreportsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   $user_id = $this->erkanaauth->getField('id');
	   
       $data = array(
           'rows' => $this->savedreportsmodel->get_combined_list($user_id),
       );
       $this->load->view('savedreports/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('savedreports/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   /**
       $this->load->library('form_validation');
       $this->form_validation->set_rules('searchparameter', 'Searchparameter', 'trim|required');
       $this->form_validation->set_rules('searchvalue', 'Searchvalue', 'trim|required');
       $this->form_validation->set_rules('from_year', 'From year', 'trim|required');
       $this->form_validation->set_rules('from_month', 'From month', 'trim|required');
       $this->form_validation->set_rules('to_year', 'To year', 'trim|required');
       $this->form_validation->set_rules('to_month', 'To month', 'trim|required');
       $this->form_validation->set_rules('reportmethod', 'Reportmethod', 'trim|required');
       $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'searchparameter' => $this->input->post('searchparameter'),
               'searchvalue' => $this->input->post('searchvalue'),
               'from_year' => $this->input->post('from_year'),
               'from_month' => $this->input->post('from_month'),
               'to_year' => $this->input->post('to_year'),
               'to_month' => $this->input->post('to_month'),
               'reportmethod' => $this->input->post('reportmethod'),
               'user_id' => $this->input->post('user_id'),
           );
           $this->db->insert('savedreports', $data);
           redirect('savedreports','refresh');
       }
	   **/
	    redirect('savedreports','refresh');
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	    redirect('savedreports','refresh');
	   /**
       if(!is_numeric($id)) {
       	redirect('savedreports','refresh');
       }
       $row = $this->db->get_where('savedreports', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('savedreports','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('savedreports/edit', $data);
	   **/
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	    redirect('savedreports','refresh');
	   /**
       $this->load->library('form_validation');
       $this->form_validation->set_rules('searchparameter', 'Searchparameter', 'trim|required');
       $this->form_validation->set_rules('searchvalue', 'Searchvalue', 'trim|required');
       $this->form_validation->set_rules('from_year', 'From year', 'trim|required');
       $this->form_validation->set_rules('from_month', 'From month', 'trim|required');
       $this->form_validation->set_rules('to_year', 'To year', 'trim|required');
       $this->form_validation->set_rules('to_month', 'To month', 'trim|required');
       $this->form_validation->set_rules('reportmethod', 'Reportmethod', 'trim|required');
       $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'searchparameter' => $this->input->post('searchparameter'),
               'searchvalue' => $this->input->post('searchvalue'),
               'from_year' => $this->input->post('from_year'),
               'from_month' => $this->input->post('from_month'),
               'to_year' => $this->input->post('to_year'),
               'to_month' => $this->input->post('to_month'),
               'reportmethod' => $this->input->post('reportmethod'),
               'user_id' => $this->input->post('user_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('savedreports', $data);
           redirect('savedreports','refresh');
       }
	   **/
   }

   public function delete($id)
   {
	    redirect('savedreports','refresh');
	 
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('savedreports','refresh');
       }
       $this->db->delete('savedreports', array('id' => $id));
	   
       redirect('savedreports','refresh');
	  
   }
   
   public function view($id)
   {
	   if(!is_numeric($id)) {
       	redirect('savedreports','refresh');
       }
       $row = $this->db->get_where('savedreports', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('savedreports','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('savedreports/view', $data);
   }

}

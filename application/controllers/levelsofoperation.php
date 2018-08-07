<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Levelsofoperation extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('levelsofoperationmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('levelsofoperation'),
       );
       $this->load->view('levelsofoperation/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('levelsofoperation/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('level_of_operation', 'Level of operation', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'level_of_operation' => $this->input->post('level_of_operation'),
           );
           $this->db->insert('levelsofoperation', $data);
           redirect('levelsofoperation','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('levelsofoperation','refresh');
       }
       $row = $this->db->get_where('levelsofoperation', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('levelsofoperation','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('levelsofoperation/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('level_of_operation', 'Level of operation', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'level_of_operation' => $this->input->post('level_of_operation'),
           );
           $this->db->where('id', $id);
           $this->db->update('levelsofoperation', $data);
           redirect('levelsofoperation','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('levelsofoperation','refresh');
       }
       $this->db->delete('levelsofoperation', array('id' => $id));
       redirect('levelsofoperation','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Subsectors extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('subsectorsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('subsectors'),
       );
       $this->load->view('subsectors/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['sectors'] = $this->sectorsmodel->get_list();
       $this->load->view('subsectors/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('sub_sector', 'Sub sector', 'trim|required');
       $this->form_validation->set_rules('sector_id', 'Sector id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'sub_sector' => $this->input->post('sub_sector'),
               'sector_id' => $this->input->post('sector_id'),
           );
           $this->db->insert('subsectors', $data);
           redirect('subsectors','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('subsectors','refresh');
       }
       $row = $this->db->get_where('subsectors', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('subsectors','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   
       $this->load->view('subsectors/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('sub_sector', 'Sub sector', 'trim|required');
       $this->form_validation->set_rules('sector_id', 'Sector id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'sub_sector' => $this->input->post('sub_sector'),
               'sector_id' => $this->input->post('sector_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('subsectors', $data);
           redirect('subsectors','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('subsectors','refresh');
       }
       $this->db->delete('subsectors', array('id' => $id));
       redirect('subsectors','refresh');
   }

}

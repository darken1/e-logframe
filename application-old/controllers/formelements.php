<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Formelements extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('formelementsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('formelements'),
       );
       $this->load->view('formelements/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('formelements/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('form_id', 'Form id', 'trim|required');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       $this->form_validation->set_rules('label', 'Label', 'trim|required');
       $this->form_validation->set_rules('default_value', 'Default value', 'trim|required');
       $this->form_validation->set_rules('tool_tip', 'Tool tip', 'trim|required');
       $this->form_validation->set_rules('size', 'Size', 'trim|required');
       $this->form_validation->set_rules('max_length', 'Max length', 'trim|required');
       $this->form_validation->set_rules('rows', 'Rows', 'trim|required');
       $this->form_validation->set_rules('cols', 'Cols', 'trim|required');
       $this->form_validation->set_rules('custom_display_format', 'Custom display format', 'trim|required');
       $this->form_validation->set_rules('folder_path', 'Folder path', 'trim|required');
       $this->form_validation->set_rules('folder_url', 'Folder url', 'trim|required');
       $this->form_validation->set_rules('permitted_file_types', 'Permitted file types', 'trim|required');
       $this->form_validation->set_rules('max_file_size', 'Max file size', 'trim|required');
       $this->form_validation->set_rules('options', 'Options', 'trim|required');
       $this->form_validation->set_rules('input_type', 'Input type', 'trim|required');
       $this->form_validation->set_rules('required', 'Required', 'trim|required');
       $this->form_validation->set_rules('date_time_created', 'Date time created', 'trim|required');
       $this->form_validation->set_rules('date_time_modified', 'Date time modified', 'trim|required');
       $this->form_validation->set_rules('listorder', 'Listorder', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'form_id' => $this->input->post('form_id'),
               'type' => $this->input->post('type'),
               'label' => $this->input->post('label'),
               'default_value' => $this->input->post('default_value'),
               'tool_tip' => $this->input->post('tool_tip'),
               'size' => $this->input->post('size'),
               'max_length' => $this->input->post('max_length'),
               'rows' => $this->input->post('rows'),
               'cols' => $this->input->post('cols'),
               'custom_display_format' => $this->input->post('custom_display_format'),
               'folder_path' => $this->input->post('folder_path'),
               'folder_url' => $this->input->post('folder_url'),
               'permitted_file_types' => $this->input->post('permitted_file_types'),
               'max_file_size' => $this->input->post('max_file_size'),
               'options' => $this->input->post('options'),
               'input_type' => $this->input->post('input_type'),
               'required' => $this->input->post('required'),
               'date_time_created' => $this->input->post('date_time_created'),
               'date_time_modified' => $this->input->post('date_time_modified'),
               'listorder' => $this->input->post('listorder'),
           );
           $this->db->insert('formelements', $data);
           redirect('formelements','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('formelements','refresh');
       }
       $row = $this->db->get_where('formelements', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('formelements','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('formelements/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('form_id', 'Form id', 'trim|required');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       $this->form_validation->set_rules('label', 'Label', 'trim|required');
       $this->form_validation->set_rules('default_value', 'Default value', 'trim|required');
       $this->form_validation->set_rules('tool_tip', 'Tool tip', 'trim|required');
       $this->form_validation->set_rules('size', 'Size', 'trim|required');
       $this->form_validation->set_rules('max_length', 'Max length', 'trim|required');
       $this->form_validation->set_rules('rows', 'Rows', 'trim|required');
       $this->form_validation->set_rules('cols', 'Cols', 'trim|required');
       $this->form_validation->set_rules('custom_display_format', 'Custom display format', 'trim|required');
       $this->form_validation->set_rules('folder_path', 'Folder path', 'trim|required');
       $this->form_validation->set_rules('folder_url', 'Folder url', 'trim|required');
       $this->form_validation->set_rules('permitted_file_types', 'Permitted file types', 'trim|required');
       $this->form_validation->set_rules('max_file_size', 'Max file size', 'trim|required');
       $this->form_validation->set_rules('options', 'Options', 'trim|required');
       $this->form_validation->set_rules('input_type', 'Input type', 'trim|required');
       $this->form_validation->set_rules('required', 'Required', 'trim|required');
       $this->form_validation->set_rules('date_time_created', 'Date time created', 'trim|required');
       $this->form_validation->set_rules('date_time_modified', 'Date time modified', 'trim|required');
       $this->form_validation->set_rules('listorder', 'Listorder', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'form_id' => $this->input->post('form_id'),
               'type' => $this->input->post('type'),
               'label' => $this->input->post('label'),
               'default_value' => $this->input->post('default_value'),
               'tool_tip' => $this->input->post('tool_tip'),
               'size' => $this->input->post('size'),
               'max_length' => $this->input->post('max_length'),
               'rows' => $this->input->post('rows'),
               'cols' => $this->input->post('cols'),
               'custom_display_format' => $this->input->post('custom_display_format'),
               'folder_path' => $this->input->post('folder_path'),
               'folder_url' => $this->input->post('folder_url'),
               'permitted_file_types' => $this->input->post('permitted_file_types'),
               'max_file_size' => $this->input->post('max_file_size'),
               'options' => $this->input->post('options'),
               'input_type' => $this->input->post('input_type'),
               'required' => $this->input->post('required'),
               'date_time_created' => $this->input->post('date_time_created'),
               'date_time_modified' => $this->input->post('date_time_modified'),
               'listorder' => $this->input->post('listorder'),
           );
           $this->db->where('id', $id);
           $this->db->update('formelements', $data);
           redirect('formelements','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('formelements','refresh');
       }
       $this->db->delete('formelements', array('id' => $id));
       redirect('formelements','refresh');
   }

}

<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Documents extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('documentsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->documentsmodel->get_combined_list(),
       );
       $this->load->view('documents/index', $data);
   }
   
   
    public function search()
   {
           //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	   $data = array();
	   $data['doccategories'] = $this->documentcategoriesmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
	   $data['projects'] = $this->projectsmodel->get_list();
	   	   
       $this->load->view('documents/search', $data);
   }
   
   
   public function searchdocument()
   {
	  //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  $data = array();
	   
	  $doccategory_id = $this->input->post('doccategory_id');
	  $user_id = $this->input->post('user_id');
	  $year_published = $this->input->post('year_published');
	  $project_id = $this->input->post('project_id');
	  
	  if(empty($year_published))
	  {
		  $year_p = 0;
	  }
	  else
	  {
		  $year_p = $year_published;
	  }
	  
	  $documents = $this->documentsmodel->search($doccategory_id,$user_id,$year_p,$project_id);
	  
	  $data['rows'] = $documents;
	  
	    
	  $this->load->view('documents/searchdocument', $data);
   }
   
    public function mydocuments()
   {
           //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  $user_id = $this->erkanaauth->getField('id');
	  
	   $data = array(
           'rows' => $this->documentsmodel->get_combined_list_by_user($user_id),
       );
	   
	   /***
	  ======================================
	  Begin audit trail info capture
	  ======================================	  
	  ***/ 
	
	  
       $this->load->view('documents/mylist', $data);
   }



   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['doccategories'] = $this->documentcategoriesmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['error'] = '';
	   
       $this->load->view('documents/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('document_title', 'Document title', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('documentcategory_id', 'Documentcategory id', 'trim|required');
       $this->form_validation->set_rules('date_added', 'Date added', 'trim|required');
       $this->form_validation->set_rules('author', 'Author', 'trim|required');
       $this->form_validation->set_rules('year_published', 'Year published', 'trim|required');
	   
	   $user_id = $this->erkanaauth->getField('id');
	   $file_element_name = 'userfile';		
	   $user = $this->usersmodel->get_by_id($user_id)->row();
	   
	   if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   
		   $config['upload_path'] = './documents/';
		   $config['overwrite'] = 'TRUE';
		   $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|xls|docx|xlsx|ppt|pptx';
		   $this->load->library('upload', $config);
		   
		   if (!$this->upload->do_upload($file_element_name))
			{
				$error = array('error' => $this->upload->display_errors());
				
				$data = array();
				$data['error'] = $error;
				
				$data['doccategories'] = $this->documentcategoriesmodel->get_list();
				$data['users'] = $this->usersmodel->get_list();
	   			$data['projects'] = $this->projectsmodel->get_list();
				
				$this->load->view('documents/add',$data);
	
			}
			else
			{
			   $filedata = $this->upload->data();
				
			   $data = array(
				   'document_title' => $this->input->post('document_title'),
				   'description' => $this->input->post('description'),
				   'file_name' => $filedata['file_name'],
				   'file_type' => $filedata['file_type'],
				   'file_size' => $filedata['file_size'],
				   'documentcategory_id' => $this->input->post('documentcategory_id'),
				   'date_added' => $this->input->post('date_added'),
				   'author' => $this->input->post('author'),
				   'year_published' => $this->input->post('year_published'),
				   'user_id' => $user_id,
				   'project_id' => 0,
				   'published' => $this->input->post('published'),
				   'tags' => $this->input->post('tags'),
				   'public' => $this->input->post('public'),
			   );
			   $this->db->insert('documents', $data);
			   redirect('documents/mydocuments','refresh');
			}
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('documents','refresh');
       }
       $row = $this->db->get_where('documents', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('documents','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['doccategories'] = $this->documentcategoriesmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
	   $data['projects'] = $this->projectsmodel->get_list();
	   
       $this->load->view('documents/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('document_title', 'Document title', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('documentcategory_id', 'Documentcategory id', 'trim|required');
       $this->form_validation->set_rules('date_added', 'Date added', 'trim|required');
       $this->form_validation->set_rules('author', 'Author', 'trim|required');
       $this->form_validation->set_rules('year_published', 'Year published', 'trim|required');
       $this->form_validation->set_rules('published', 'Published', 'trim|required');
       $this->form_validation->set_rules('tags', 'Tags', 'trim|required');
       $this->form_validation->set_rules('public', 'Public', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
		   $config['upload_path'] = './documents/';
		   $config['overwrite'] = 'TRUE';
		   $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|xls|docx|xlxs|ppt|pptx';
		   $this->load->library('upload', $config);
		  				
		   $file_element_name = 'userfile';
		   
		    if (!$this->upload->do_upload($file_element_name))
			{
			   $data = array(
               'document_title' => $this->input->post('document_title'),
               'description' => $this->input->post('description'),
               'documentcategory_id' => $this->input->post('documentcategory_id'),
			   'year_published' => $this->input->post('year_published'),
			   'public' => $this->input->post('public'),
			   'tags' => $this->input->post('tags'),
           		);
			}
			else
			{
			   $filedata = $this->upload->data();				
			   $data = array(
				   'document_title' => $this->input->post('document_title'),
				   'description' => $this->input->post('description'),
				   'file_name' => $filedata['file_name'],
				   'file_type' => $filedata['file_type'],
				   'file_size' => $filedata['file_size'],
				   'documentcategory_id' => $this->input->post('documentcategory_id'),
				   'year_published' => $this->input->post('year_published'),
			   	   'public' => $this->input->post('public'),
				   'tags' => $this->input->post('tags'),
			   );
			}
           $this->db->where('id', $id);
           $this->db->update('documents', $data);
           redirect('documents','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('documents','refresh');
       }
       $this->db->delete('documents', array('id' => $id));
       redirect('documents','refresh');
   }
   
    public function view($id)
   {
           //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	   $row = $this->db->get_where('documents', array('id' => $id))->row();
       $data = array(
           'row' => $row,
       );
	   $data['error'] = '';
	   $data['category'] = $this->documentcategoriesmodel->get_by_id($row->documentcategory_id)->row();
	   $data['user'] = $this->usersmodel->get_by_id($row->user_id)->row();
	
	  
       $this->load->view('documents/view', $data);
   }
   

}

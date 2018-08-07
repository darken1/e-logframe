<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Organizations extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('organizationsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('organizations'),
       );
       $this->load->view('organizations/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	    $data['organizationtypes'] = $this->organizationtypesmodel->get_list();
	   $data['levelsofoperation'] = $this->levelsofoperationmodel->get_list();
	   
       $this->load->view('organizations/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('organization_name', 'Organization name', 'trim|required');
       $this->form_validation->set_rules('address', 'Address', 'trim|required');
       $this->form_validation->set_rules('postal_address', 'Postal address', 'trim|required');
       $this->form_validation->set_rules('postal_code', 'Postal code', 'trim|required');
       $this->form_validation->set_rules('city', 'City', 'trim|required');
       $this->form_validation->set_rules('country', 'Country', 'trim|required');
       $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required');
       $this->form_validation->set_rules('web_address', 'Web address', 'trim|required');
       $this->form_validation->set_rules('organizationtype_id', 'Organizationtype id', 'trim|required');
       //$this->form_validation->set_rules('logo', 'Logo', 'trim|required');
	   
	   $file_element_name = 'userfile';
	   
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   
		   $config['upload_path'] = './logos/';
		   $config['overwrite'] = 'TRUE';
		   $config['allowed_types'] = 'gif|jpg|png';
		   $this->load->library('upload', $config);
		   
		   if (!$this->upload->do_upload($file_element_name))
			{
				$filename = '';
	
			}
			else
			{
				$filedata = $this->upload->data();
				
				$filename = $filedata['file_name'];
				$rconfig['image_library'] = 'gd2';
				$rconfig['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				//$rconfig['create_thumb'] = TRUE;
				$rconfig['maintain_ratio'] = TRUE;
				$rconfig['width'] = 180;
				$rconfig['height'] = 200;
				
				$this->load->library('image_lib', $rconfig);
				
				$this->image_lib->resize();
			}
			
           $data = array(
               'organization_name' => $this->input->post('organization_name'),
               'address' => $this->input->post('address'),
               'postal_address' => $this->input->post('postal_address'),
               'postal_code' => $this->input->post('postal_code'),
               'city' => $this->input->post('city'),
               'country' => $this->input->post('country'),
               'telephone' => $this->input->post('telephone'),
               'email' => $this->input->post('email'),
               'web_address' => $this->input->post('web_address'),
               'organizationtype_id' => $this->input->post('organizationtype_id'),
			   'levelofoperation_id' => $this->input->post('levelofoperation_id'),
               'logo' => $filename,
           );
           $this->db->insert('organizations', $data);
           redirect('organizations','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('organizations','refresh');
       }
       $row = $this->db->get_where('organizations', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('organizations','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['organizationtypes'] = $this->organizationtypesmodel->get_list();
	   $data['levelsofoperation'] = $this->levelsofoperationmodel->get_list();
	   
       $this->load->view('organizations/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('organization_name', 'Organization name', 'trim|required');
       $this->form_validation->set_rules('address', 'Address', 'trim|required');
       $this->form_validation->set_rules('postal_address', 'Postal address', 'trim|required');
       $this->form_validation->set_rules('postal_code', 'Postal code', 'trim|required');
       $this->form_validation->set_rules('city', 'City', 'trim|required');
       $this->form_validation->set_rules('country', 'Country', 'trim|required');
       $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required');
       $this->form_validation->set_rules('web_address', 'Web address', 'trim|required');
       $this->form_validation->set_rules('organizationtype_id', 'Organizationtype id', 'trim|required');
       $this->form_validation->set_rules('logo', 'Logo', 'trim|required');
	   
	   $file_element_name = 'userfile';
	   
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
		   
		   $config['upload_path'] = './logos/';
		   $config['overwrite'] = 'TRUE';
		   $config['allowed_types'] = 'gif|jpg|png';
		   $this->load->library('upload', $config);
		   
		  if (!$this->upload->do_upload($file_element_name))
		  {
				
			   $data = array(
				   'organization_name' => $this->input->post('organization_name'),
				   'address' => $this->input->post('address'),
				   'postal_address' => $this->input->post('postal_address'),
				   'postal_code' => $this->input->post('postal_code'),
				   'city' => $this->input->post('city'),
				   'country' => $this->input->post('country'),
				   'telephone' => $this->input->post('telephone'),
				   'email' => $this->input->post('email'),
				   'web_address' => $this->input->post('web_address'),
				   'organizationtype_id' => $this->input->post('organizationtype_id'),
				   'levelofoperation_id' => $this->input->post('levelofoperation_id'),
			   );
			   $this->db->where('id', $id);
			   $this->db->update('organizations', $data);
		  }
		  else
		  {
			  $filedata = $this->upload->data();
				
			 $filename = $filedata['file_name'];
			 $rconfig['image_library'] = 'gd2';
			 $rconfig['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			 //$rconfig['create_thumb'] = TRUE;
			 $rconfig['maintain_ratio'] = TRUE;
			 $rconfig['width'] = 180;
			 $rconfig['height'] = 200;
				
			 $this->load->library('image_lib', $rconfig);
				
			 $this->image_lib->resize();
				
			  $data = array(
				   'organization_name' => $this->input->post('organization_name'),
				   'address' => $this->input->post('address'),
				   'postal_address' => $this->input->post('postal_address'),
				   'postal_code' => $this->input->post('postal_code'),
				   'city' => $this->input->post('city'),
				   'country' => $this->input->post('country'),
				   'telephone' => $this->input->post('telephone'),
				   'email' => $this->input->post('email'),
				   'web_address' => $this->input->post('web_address'),
				   'organizationtype_id' => $this->input->post('organizationtype_id'),
				   'levelofoperation_id' => $this->input->post('levelofoperation_id'),
				   'logo' => $filename,
			   );
			   $this->db->where('id', $id);
			   $this->db->update('organizations', $data);
		  }
           redirect('organizations','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('organizations','refresh');
       }
       $this->db->delete('organizations', array('id' => $id));
       redirect('organizations','refresh');
   }

}

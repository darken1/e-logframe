<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Profiles extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('profilesmodel');
   }

   public function index()
   {
      /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('profiles'),
       );
       $this->load->view('profiles/index', $data);
	   
	   **/
	   redirect('home','refresh');
   }

   public function add()
   {
	   /**
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('profiles/add',$data);
	   **/
	    redirect('home','refresh');
   }

   public function add_validate()
   {
	   /**
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
       $this->form_validation->set_rules('photo', 'Photo', 'trim|required');
       $this->form_validation->set_rules('about_me', 'About me', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'user_id' => $this->input->post('user_id'),
               'photo' => $this->input->post('photo'),
               'about_me' => $this->input->post('about_me'),
           );
           $this->db->insert('profiles', $data);
           redirect('profiles','refresh');
       }
	   **/
	   redirect('home','refresh');
   }

   public function edit()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $user_id = $this->erkanaauth->getField('id');
		
		$profile = $this->profilesmodel->get_by_user_id($user_id)->row();
		$id = $profile->id;
		
	   $row = $this->db->get_where('profiles', array('id' => $id))->row();
       $data = array(
           'row' => $row,
       );
	   
	   $data['user'] = $this->usersmodel->get_by_id($user_id)->row();
	   $data['success_message'] = $this->session->flashdata('success_message');
	   
       $this->load->view('profiles/edit', $data);
   }

   public function edit_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
       $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
	   $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
	   $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
	   $this->form_validation->set_rules('organization', 'Organization', 'trim|required');
	   $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
	   $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	   
	   $file_element_name = 'userfile';
	   
       if ($this->form_validation->run() == false) {
           $this->edit();
       } else {
		   
		   $user_id = $this->input->post('user_id');
		   $id = $this->input->post('profile_id');
           $data = array(
               'user_id' => $this->input->post('user_id'),
			   'gender' => $this->input->post('gender'),
           );
           $this->db->where('id', $id);
           $this->db->update('profiles', $data);
		   
		   $config['upload_path'] = './profilepics/';
		   $config['overwrite'] = 'TRUE';
		   $config['allowed_types'] = 'gif|jpg|png|';
		   $this->load->library('upload', $config);
		   
		   if (!$this->upload->do_upload($file_element_name))
		   {
		   }
		   else
		   {
			   $filedata = $this->upload->data();
			   $profiledata = array(
				   'photo' => $filedata['file_name'],
			   );
			   
			   $this->db->where('id', $id);
           	   $this->db->update('profiles', $profiledata);
			   
			   $rconfig['image_library'] = 'gd2';
				$rconfig['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				//$rconfig['create_thumb'] = TRUE;
				$rconfig['maintain_ratio'] = TRUE;
				$rconfig['width'] = 180;
				$rconfig['height'] = 200;
				
				$this->load->library('image_lib', $rconfig);
				
				$this->image_lib->resize();
		   }
		   
		   $userdata = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
			   'designation' => $this->input->post('designation'),
			   'organization' => $this->input->post('organization'),
			   'contact_number' => $this->input->post('contact_number'),
			   'email' => $this->input->post('email'),
			   'username' => $this->input->post('email'),
           );
           $this->db->where('id', $user_id);
           $this->db->update('users', $userdata);
		   
		   $this->session->set_flashdata('success_message', 'Profile successfully updated.');
           redirect('profiles/edit','refresh');
       }
   }
   
   public function update_bio()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
       $this->load->library('form_validation');
       $this->form_validation->set_rules('about_me', 'Bio', 'trim|required');;
       if ($this->form_validation->run() == false) {
           $this->edit();
       } else {
		   
		   $user_id = $this->input->post('user_id');
		   $id = $this->input->post('profile_id');
           $data = array(
			   'about_me' => $this->input->post('about_me'),
           );
           $this->db->where('id', $id);
           $this->db->update('profiles', $data);
		   
		    $this->session->set_flashdata('success_message', 'Your bio has been successfully updated.');
		  		   
           redirect('profiles/edit','refresh');
       }
   }
   
   public function update_security()
   {
	   $id = $this->input->post('user_id');
	   
	    $passvalue = $this->input->post('password');
		
		$today = date('Y-m-d');
		
		if(empty($passvalue))
		{
			$password = $this->input->post('oldpassword');
			$salt = $this->input->post('oldsalt');
			$date_created = $this->input->post('date_created');
			$expiry_date = $this->input->post('expiry_date');
		 }
		 else
		 {
			 CRYPT_BLOWFISH or die ('No Blowfish found.');
				//This string tells crypt to use blowfish for 5 rounds.
				$Blowfish_Pre = '$2a$05$';
				$Blowfish_End = '$';
				$Allowed_Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
				$Chars_Len = 63;
			
				// 18 would be secure as well.
				$Salt_Length = 21;
				
				$mysql_date = date( 'Y-m-d' );
				$salt = "";
				
				for($i=0; $i<$Salt_Length; $i++)
				{
					$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
				}
				$bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
				
				$password = $this->input->post('password');
				
				$hashed_password = crypt($passvalue, $bcrypt_salt);
			   	$password = $hashed_password;
				
				$date_created = date('Y-m-d');
			
		    	$expiry_date = $this->addDayswithdate($today, 60);//password to expiry in 60 days
				
				$this->session->set_flashdata('success_message', 'Password successfully updated.');
		 }
		 
		 
		  $data = array(
               'salt' => $salt,
               'password' => $password,
			   'date_created' => $date_created,
			   'expiry_date' => $expiry_date,
           );
           $this->db->where('id', $id);
           $this->db->update('users', $data);
		   
		 
		 
		 redirect('profiles/edit','refresh');
   }
   
   function addDayswithdate($date,$days){

		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);

	}

   public function delete($id)
   {
       /**
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->db->delete('profiles', array('id' => $id));
       redirect('profiles','refresh');
	   
	   **/
	   redirect('profiles/edit','refresh');
   }

}

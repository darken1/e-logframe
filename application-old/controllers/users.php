<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Users extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('usersmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('users'),
       );
       $this->load->view('users/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['roles'] = $this->role->get_list();
       $this->load->view('users/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('fname', 'Fname', 'trim|required');
       $this->form_validation->set_rules('lname', 'Lname', 'trim|required');
       $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
       $this->form_validation->set_rules('organization', 'Organization', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
       $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
       //$this->form_validation->set_rules('username', 'Username', 'trim|required');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[pswdconf]');
	   $this->form_validation->set_rules('pswdconf', 'Password Confirmation', 'required');
       $this->form_validation->set_rules('role_id', 'Role id', 'trim|required');
       $this->form_validation->set_rules('active', 'Active', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
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
			
			$hashed_password = crypt($password, $bcrypt_salt);
			
			$today = date('Y-m-d');
			
			$policy = $this->passwordpoliciesmodel->get_by_id(1)->row();
			
		    $expiry_date = $this->addDayswithdate($today, $policy->password_life);//password to expiry in 60 days
	 			
			
           $data = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
               'designation' => $this->input->post('designation'),
               'organization' => $this->input->post('organization'),
               'email' => $this->input->post('email'),
               'contact_number' => $this->input->post('contact_number'),
               'username' => $this->input->post('email'),
               'salt' => $salt,
               'password' => $hashed_password,
               'role_id' => $this->input->post('role_id'),
               'active' => $this->input->post('active'),
			   'date_created' => date('Y-m-d'),
			   'expiry_date' => $expiry_date,
           );
           $this->db->insert('users', $data);
		   $user_id = $this->db->insert_id();
		   
		   $fname = $this->input->post('fname');
           $lname = $this->input->post('lname');
		   $designation = $this->input->post('designation');
		   $organization = $this->input->post('organization');
		   $email = $this->input->post('email');
		   $username = $this->input->post('email');
		   
		   $about_me = 'My name is '.$fname.' '.$lname.'. I am a '.$designation.' at '.$organization;
		   
		   
		   $profiledata = array(
               'user_id' => $user_id,
               'photo' => '',
			   'gender' => '',
               'about_me' => $about_me,
           );
           $this->db->insert('profiles', $profiledata);
		   
		   //send email to user with the login details
			$message = '<p>Dear '.$fname.' '.$lname.'<p>
			<p>
			Please find below your login details for the DRC Database system:<br>
			Username: '.$username.'<br>
			Password: '.$password.'
			</p>
			<p>Please go to the link: http://drcdatabase.org/ to access the system.</p>
			<p>Please login and update your profile</p>
			
			<p>This is an auto generated email, please do not respond.</p>			
			';
			
			$subject = 'Login details - '.$fname.' '.$lname;
			$from = 'no-reply@drcdatabase.org';
						   
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$config['newline'] = '\r\n';
												
			$this->email->initialize($config);
			$this->email->from($from, 'eLogFrame');
			$this->email->to($email);
														
			$this->email->subject($subject);
							
			$this->email->message($message);
																	
			$this->email->send();
		   
           redirect('users','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $row = $this->db->get_where('users', array('id' => $id))->row();
       $data = array(
           'row' => $row,
       );
	   $data['roles'] = $this->role->get_list();
       $this->load->view('users/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('fname', 'Fname', 'trim|required');
       $this->form_validation->set_rules('lname', 'Lname', 'trim|required');
       $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
       $this->form_validation->set_rules('organization', 'Organization', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
       //$this->form_validation->set_rules('username', 'Username', 'trim|required');
       $this->form_validation->set_rules('role_id', 'Role id', 'trim|required');
       $this->form_validation->set_rules('active', 'Active', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
		   
		   $passvalue = $this->input->post('password');
		   
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
			
		    	$expiry_date = $this->addDayswithdate($date_created, 100);//password to expiry in 60 days
			
		   }
		   
           $data = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
               'designation' => $this->input->post('designation'),
               'organization' => $this->input->post('organization'),
               'email' => $this->input->post('email'),
               'contact_number' => $this->input->post('contact_number'),
               'username' => $this->input->post('email'),
               'salt' => $salt,
               'password' => $password,
               'role_id' => $this->input->post('role_id'),
               'active' => $this->input->post('active'),
			   'date_created' => $date_created,
			   'expiry_date' => $expiry_date,
           );
           $this->db->where('id', $id);
           $this->db->update('users', $data);
           redirect('users','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->db->delete('users', array('id' => $id));
       redirect('users','refresh');
   }
   
   function checkusername()
   {
	  $username = trim(addslashes(htmlspecialchars(rawurldecode($_POST['username']))));
      
	  $user = $this->usersmodel->get_by_username($username)->row();
	  $count=count($user);
      $HTML='';
      if($count > 0){
        $HTML='<font color="#FF0000"><strong>USERNAME ALREADY EXISTS</strong>';
      }else{
        $HTML='<font color="#00FF33"><strong>USERNAME AVAILABLE</strong></font>';
      }
      echo $HTML;
	
   }
   
    function addDayswithdate($date,$days){

		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);

	}


}

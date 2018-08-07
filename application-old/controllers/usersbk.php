<?php

class Users extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('usersmodel');
   }

   public function index()
   {
           //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  if(getRole() != 'SuperAdmin')
	  {
		redirect('home', 'refresh');
	  }
	  
	   $data = array(
           'rows' => $this->usersmodel->get_combined_list(),
       );
	   
	  /***
	  ======================================
	  Begin audit trail info capture
	  ======================================	  
	  ***/ 
	
	$active_class = $this->router->fetch_class();
	$active_method =  $this->router->fetch_method();	
	$visited_page = $active_class.'/'.$active_method;
	
	$username = $this->erkanaauth->getField('username');
	$user_db_id = $this->erkanaauth->getField('id');
	$ip_address = $this->getIp();
	
	 $auditdata = array(
               'username' => $username,
               'ip_address' => $ip_address,
               'date_time' => date("Y-m-d H:i:s"),
               'content' => $visited_page,
			   'user_db_id' => $user_db_id,
           );
      
	  $this->db->insert('audittrail', $auditdata);
	  /***
	  ======================================
	  End audit trail info capture
	  ======================================	  
	  ***/
	  
       $this->load->view('users/index', $data);
   }

   public function add()
   {
	        //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  if(getRole() != 'SuperAdmin')
	  {
		redirect('home', 'refresh');
	  }
	  
	   $data = array();
	   $data['departments'] = $this->departmentsmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
	   $data['roles'] = $this->role->get_list();
	   $data['locations'] = $this->locationsmodel->get_list();
	   
	    /***
	  ======================================
	  Begin audit trail info capture
	  ======================================	  
	  ***/ 
	
	$active_class = $this->router->fetch_class();
	$active_method =  $this->router->fetch_method();	
	$visited_page = $active_class.'/'.$active_method;
	
	$username = $this->erkanaauth->getField('username');
	$user_db_id = $this->erkanaauth->getField('id');
	$ip_address = $this->getIp();
	
	 $auditdata = array(
               'username' => $username,
               'ip_address' => $ip_address,
               'date_time' => date("Y-m-d H:i:s"),
               'content' => $visited_page,
			   'user_db_id' => $user_db_id,
           );
      
	  $this->db->insert('audittrail', $auditdata);
	  /***
	  ======================================
	  End audit trail info capture
	  ======================================	  
	  ***/
	  
       $this->load->view('users/add',$data);
   }

   public function add_validate()
   {
       //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  if(getRole() != 'SuperAdmin')
	  {
		redirect('home', 'refresh');
	  }
	  
	   $this->load->library('form_validation');
       $this->form_validation->set_rules('fname', 'First name', 'trim|required');
       $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
       $this->form_validation->set_rules('institution_id', 'Institution', 'trim|required');
       $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
       $this->form_validation->set_rules('username', 'Username', 'trim|required');
       $this->form_validation->set_rules('password', 'Password', 'trim|required');
       $this->form_validation->set_rules('role_id', 'Role', 'trim|required');
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
	
           $data = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
               'department_id' => $this->input->post('department_id'),
               'designation' => $this->input->post('designation'),
               'email' => $this->input->post('email'),
               'contact_number' => $this->input->post('contact_number'),
               'username' => $this->input->post('username'),
               'password' => md5($this->input->post('password')),
               'role_id' => $this->input->post('role_id'),
               'active' => $this->input->post('active'),
			   'supervisor_id' => $this->input->post('supervisor_id'),
			   'location_id' => $this->input->post('location_id'),
           );
           $this->db->insert('users', $data);
		   $user_id = $this->db->insert_id();
		   
		    $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
			$designation = $this->input->post('designation');
			$location_id = $this->input->post('location_id');
			$contact_number = $this->input->post('contact_number');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$location = $this->locationsmodel->get_by_id($location_id)->row();
			
			$about_me = 'My name is '.$fname.' '.$lname.'. I work at AAR as the '.$designation.' and my current location is '.$location->location_name.'. I can be reached through the following number '.$contact_number;
		   
		   //add profile
		   $data = array(
               'user_id' => $user_id,
               'date_of_birth' => '0000-00-00',
			   'gender' => '',
               'address' => '',
               'post_code' => '',
               'city' => 'Nairobi',
               'country' => 'Kenya',
               'telephone' => $this->input->post('contact_number'),
               'extension' => '',
               'mobile' => '',
               'official_email' =>  $this->input->post('email'),
               'personal_email' => '',
               'facebook' => '',
               'twitter' => '',
               'google_plus' => '',
               'residential_address' => '',
               'photo' => '',
			   'about_me' => $about_me,
           );
           $this->db->insert('profiles', $data);
		   
		   		
			//send email to user with the login details
			$message = '<p>Dear '.$fname.' '.$lname.'<p>
			<p>
			Please find below your login details for the AAR premium calculator and Profoma system:<br>
			Username: '.$username.'<br>
			Password: '.$password.'
			</p>
			<p>Please login and update your profile</p>
			
			<p>This is an auto generated email, please do not respond.</p>			
			';
			
			$subject = 'Login details - '.$fname.' '.$lname;
			$from = 'no-reply@aar.co.ke';
						   
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$config['newline'] = '\r\n';
												
			$this->email->initialize($config);
			$this->email->from($from, 'AAR Premium Calculator System');
			$this->email->to($email);
														
			$this->email->subject($subject);
							
			$this->email->message($message);
																	
			$this->email->send();
			
			redirect('users', 'refresh');
       }
   }

   public function edit($id)
   {
          //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  if(getRole() != 'SuperAdmin')
	  {
		redirect('home', 'refresh');
	  }
	   
	   $row = $this->db->get_where('users', array('id' => $id))->row();
       $data = array(
           'row' => $row,
       );
	   
	   $data['departments'] = $this->departmentsmodel->get_list();
	   $data['users'] = $this->usersmodel->get_list();
	   $data['roles'] = $this->role->get_list();
	   $data['locations'] = $this->locationsmodel->get_list();
	   
		   
	    /***
	  ======================================
	  Begin audit trail info capture
	  ======================================	  
	  ***/ 
	
	$active_class = $this->router->fetch_class();
	$active_method =  $this->router->fetch_method();	
	$visited_page = $active_class.'/'.$active_method;
	
	$username = $this->erkanaauth->getField('username');
	$user_db_id = $this->erkanaauth->getField('id');
	$ip_address = $this->getIp();
	
	 $auditdata = array(
               'username' => $username,
               'ip_address' => $ip_address,
               'date_time' => date("Y-m-d H:i:s"),
               'content' => $visited_page,
			   'user_db_id' => $user_db_id,
           );
      
	  $this->db->insert('audittrail', $auditdata);
	  /***
	  ======================================
	  End audit trail info capture
	  ======================================	  
	  ***/
	  
	   
       $this->load->view('users/edit', $data);
   }

   public function edit_validate($id)
   {
       
	  //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  if(getRole() != 'SuperAdmin')
	  {
		redirect('home', 'refresh');
	  }
	  
	   $this->load->library('form_validation');
       $this->form_validation->set_rules('fname', 'First name', 'trim|required');
       $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
       $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
       $this->form_validation->set_rules('username', 'Username', 'trim|required');
       //$this->form_validation->set_rules('password', 'Password', 'trim|required');
       $this->form_validation->set_rules('role_id', 'Role', 'trim|required');
       $this->form_validation->set_rules('active', 'Active', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
		   
		   $passvalue = $this->input->post('password');
		   
		   if(empty($passvalue))
		   {
			   $password = $this->input->post('oldpassword');
		   }
		   else
		   {
			   $password = md5($passvalue);
		   }
		   
           $data = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
               'designation' => $this->input->post('designation'),
               'email' => $this->input->post('email'),
               'contact_number' => $this->input->post('contact_number'),
               'username' => $this->input->post('username'),
               'password' => $password,
               'role_id' => $this->input->post('role_id'),
               'active' => $this->input->post('active'),
			   'supervisor_id' => $this->input->post('supervisor_id'),
			   'location_id' => $this->input->post('location_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('users', $data);
           redirect('users', 'refresh');
       }
   }

   public function delete($id)
   {
          //ensure that the user is logged in
	  if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  if(getRole() != 'SuperAdmin')
	  {
		redirect('home', 'refresh');
	  }
	   $this->db->delete('users', array('id' => $id));
	   
	    /***
	  ======================================
	  Begin audit trail info capture
	  ======================================	  
	  ***/ 
	
	$active_class = $this->router->fetch_class();
	$active_method =  $this->router->fetch_method();	
	$visited_page = $active_class.'/'.$active_method;
	
	$username = $this->erkanaauth->getField('username');
	$user_db_id = $this->erkanaauth->getField('id');
	$ip_address = $this->getIp();
	
	 $auditdata = array(
               'username' => $username,
               'ip_address' => $ip_address,
               'date_time' => date("Y-m-d H:i:s"),
               'content' => $visited_page,
			   'user_db_id' => $user_db_id,
           );
      
	  $this->db->insert('audittrail', $auditdata);
	  /***
	  ======================================
	  End audit trail info capture
	  ======================================	  
	  ***/
	  
       redirect('users', 'refresh');
   }
   
   function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
  }

}

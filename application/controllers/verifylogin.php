<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
This code belongs to Joash Gomba (The developer). The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/

/**
NEED TO SECURE THE SYSTEM AGAINST THE FOLLOWING:
SQL Injections
Session Hijacking
Network Eavesdropping
Cross Site Scripting
Brute Force Attacks
**/


class VerifyLogin extends CI_Controller {



 function __construct()

 {

   parent::__construct();

   $this->load->library('erkanaauth');
   $this->load->library('recaptcha');

   $this->load->database();

 }



 function index()
 {

   //This method will have the credentials validation

   $this->load->library('form_validation');

   
	//get the user's IP address
	$ip_address = $this->getIp();
	
	$user_name = $this->input->post('username');
	
	if(empty($user_name))
	{
		$username = 'Empty';
	}
	else
	{
		$username = $user_name;
	}
	

	$captcha_required = $this->input->post('captcha_required');
  	
	if($captcha_required==1)
	{
		if ($this->_check_capthca())//check if they entered the capture correctly
		{
		}
		else
		{
			$this->session->set_flashdata('lock_message', 'Please enter the word that appears in the image correctly.');
			redirect('login');
		}
	}
	

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');

   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
   
   //$this->form_validation->set_rules('g-recaptcha-response', 'Verify you are not a robot', 'trim|required');

   $this->form_validation->set_error_delimiters('<div class="alert info">', '</div>');



   if($this->form_validation->run() == FALSE)

   {

     //Field validation failed.  User redirected to login page
	 
	 $pagedata = array();
	 
	 $now = time();
	 
	   $data = array(
               'username' => $username,
               'ip_address' => $ip_address,
               'date_time' => date("Y-m-d H:i:s"),
               'success' => 'N',
			   'time' => $now,
           );
       $this->db->insert('loginattempts', $data);
	   
	   $policy = $this->passwordpoliciesmodel->get_by_id(1)->row();
	   
	   
	    // Get timestamp of current time 
		$now = time();
	 
		// All login attempts are counted from the past 2 hours. 
		$valid_attempts = $now - ($policy->login_attempts_counted_within * 60 * 60);
		
		$attempts = $this->loginattemptsmodel->checkbrute($username,$valid_attempts);
		
		$totalattempts = count($attempts);
		
		if($totalattempts >=$policy->max_login_attempts)//add the captcha
		{
			$pagedata["cap_img"] = $this -> _make_captcha();
			$pagedata['message'] = 'More than 3 failed login attempts by user '.$username.'. CAPTCHA required';
		}
		else
		{
			$pagedata["cap_img"] = '';
			$pagedata['message'] = '';
		}
		
		if($totalattempts >=$policy->lock_account_after_attempts)//lock the account
		{
			$userdata = array(
               'active' => 0
           );
           $this->db->where('username', $username);
           $this->db->update('users', $userdata);
		   
		    $this->session->set_flashdata('lock_message', 'The account for '.$username.' has been locked due to continious login attempts. Please contact the system administrator.');
			redirect('login');
		}
		
		if($totalattempts >=$policy->blacklist_ip_after_attempts)// blacklist the IP address
		{
			$ipdata = array(
               'ip_address' => $ip_address,
			   'ip_address' => 'Brute force password attempt. More than '.$policy->blacklist_ip_after_attempts.' login attempts',
           );
           $this->db->insert('lockedips', $ipdata);
		}
		
       $this->load->view('login/login_view',$pagedata);
	

   }

   else

   {
	   $username = $this->input->post('username');   
   	   $user = $this->usersmodel->get_by_username($username)->row();
	   
	   $today = date('Y-m-d');
	   $expiry = $user->expiry_date;
	   
	   $days = $this->dateDiff($expiry,$today);
	   
	   $policy = $this->passwordpoliciesmodel->get_by_id(1)->row();
	   
	   if($days<=$policy->notification_period)
	   {
		    $this->session->set_flashdata('warning_message', 'Hi '.$user->fname.' '.$user->lname.'. Please note that your password will expire in '.$days.' day(s). Please access your profile and change it so that you are not locked out of the system.');
	   }
	   
	   $now = time();
   
	   $data = array(
               'username' => $username,
               'ip_address' => $ip_address,
               'date_time' => date("Y-m-d H:i:s"),
               'success' => 'Y',
			   'time' => $now,
           );
       $this->db->insert('loginattempts', $data);

     //Go to private area

      redirect('home');

   }



 }


 function check_capture($recaptcha)
 {
	 $ip_address = $this->getIp();
	 $response = $this->recaptcha->verifyResponse($ip_address,$recaptcha);
	 if (isset($response['success']) && $response['success'] === true) 
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
	 
 }
 function check_database($password)

 {

   //Field validation succeeded.  Validate against database
   
   CRYPT_BLOWFISH or die ('No Blowfish found.');
   //This string tells crypt to use blowfish for 5 rounds.
	$Blowfish_Pre = '$2a$05$';
	$Blowfish_End = '$';

   $username = $this->input->post('username');
   
   $user = $this->usersmodel->get_by_username($username)->row();
   
   if(empty($user))
   {
	   $this->form_validation->set_message('check_database', 'Invalid username or password');
	
		return false;
   }
   else
   {

	   //$this->load->helper('security');
	
	   //$pass = do_hash($password,'md5');
	   
	   $hashed_pass = crypt($password, $Blowfish_Pre . $user->salt . $Blowfish_End);
	   
	   if ($hashed_pass == $user->password) {
		   
		   $today = date('Y-m-d');
	       $expiry = $user->expiry_date;
		   
		   if($today>$expiry)
		   {
			   $this->form_validation->set_message('check_database', 'Your password has expired.');		 
	
		 		return false;
		   }
		   else
		   {
	   
			   if ($this->erkanaauth->try_login(array('username'=>$username, 'password'=>$hashed_pass))) {
		
				return TRUE;
		
			  } else {
		
				$this->form_validation->set_message('check_database', 'Invalid username or password');		 
		
				return false;
		
			  }
		   }
	   }
	   else
	   {
		  $this->form_validation->set_message('check_database', 'Invalid username or password');		 
	
		 	return false; 
	   }
	
	  
   }

 }
 
 public function forgotpassword()
 {
	 
	 $this->load->library('form_validation');
     $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	 $this->form_validation->set_error_delimiters('<div class="alert info">', '</div>');
       if ($this->form_validation->run() == false) {
		   $data = array();
	 		$data['error'] = '';
			$data['success_message'] = $this->session->flashdata('success_message');
           $this->load->view('login/forgotpassword');
       } else {
		   $email = $this->input->post('email');
		   $user_detail = $this->usersmodel->get_by_username($email)->row();
		   
		   if(empty($user_detail))
		   {
			   $data = array();
	 		   $data['error'] = 'The email '.$email.' is not registered in the system.';
			   $data['success_message'] = $this->session->flashdata('success_message');
			   $this->load->view('login/forgotpassword',$data);
		   }
		   else
		   {
			   $user_id = $user_detail->id;
			  			   
			   
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
				
				 $password = $this->generatePassword(9,4);
				
				$hashed_password = crypt($password, $bcrypt_salt);
				
				$today = date('Y-m-d');
				
				$policy = $this->passwordpoliciesmodel->get_by_id(1)->row();
				
				$expiry_date = $this->addDayswithdate($today, $policy->password_life);//password to expiry in 60 days
			
			   
			    $data = array(
				   'salt' => $salt,
				   'password' => $hashed_password,
				   'date_created' => date('Y-m-d'),
				   'expiry_date' => $expiry_date,
			   );
			   $this->db->where('id', $user_id);
			   $this->db->update('users', $data);
			   
			   $this->email->clear();
			   
			   $subject = 'Password Reset';
			   $message = '<p>Dear '.$user_detail->fname.' '.$user_detail->lname.',</p>
				<p>You have requested for a password reset. Below please find your new login details:<br>
				Username: '.$user_detail->username.'<br>
				Password: '.$password.'
				</p>
				<p>If you did request for the password please contact the system administrator</p>';
				
				$config['protocol'] = 'mail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$config['newline'] = '\r\n';
					
				$this->email->initialize($config);
				
				$this->email->from('no-reply@drcdatabase.org', 'DRC Database');
				$this->email->to($email);
				
				$this->email->subject($subject);
							
				$this->email->message($message);
																		
				$this->email->send();			
				
			    $this->session->set_flashdata('success_message', 'Your login details have been sent to your email.');
			    redirect('verifylogin/forgotpassword');
			   
		   }
	   }
 }
 
 
 function generatePassword($length=9, $strength=0) {
			$vowels = 'aeuy';
			$consonants = 'bdghjmnpqrstvz';
			if ($strength & 1) {
				$consonants .= 'BDGHJLMNPQRSTVWXZ';
			}
			if ($strength & 2) {
				$vowels .= "AEUY";
			}
			if ($strength & 4) {
				$consonants .= '23456789';
			}
			if ($strength & 8) {
				$consonants .= '@#$%';
			}
		 
			$password = '';
			$alt = time() % 2;
			for ($i = 0; $i < $length; $i++) {
				if ($alt == 1) {
					$password .= $consonants[(rand() % strlen($consonants))];
					$alt = 0;
				} else {
					$password .= $vowels[(rand() % strlen($vowels))];
					$alt = 1;
				}
			}
			return $password;
	}
	
	
	function dateDiff ($d1, $d2) {
	// Return the number of days between the two dates:
	
	  return round(abs(strtotime($d1)-strtotime($d2))/86400);
	
	}  // end function dateDiff
	
	
	function _make_captcha()
	  {
	  //$this -> load -> plugin('captcha');
	  $vals = array(
	    'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
	    //'img_url' => 'http://127.0.0.1:81/elogframe/captcha/', // URL for captcha img
		'img_url' => 'http://www.drcdatabase.org/captcha/', // URL for captcha img
	    'img_width' => 200, // width
	    'img_height' => 60, // height
	    // 'font_path'    => '../system/fonts/2.ttf',
	    // 'expiration' => 7200 , 
	    ); 
	  // Create captcha
	  $cap = create_captcha($vals); 
	  // Write to DB
	  if ($cap) {
	    $data = array(
	      'captcha_id' => '',
	      'captcha_time' => $cap['time'],
	      'ip_address' => $this -> input -> ip_address(),
	      'word' => $cap['word'] , 
	      );
	    $query = $this -> db -> insert_string( 'captcha', $data );
	    $this -> db -> query( $query );
	  }else {
	    return "Umm captcha not work" ;
	  }
	  return $cap['image'] ;
	  }
	

	  function _check_capthca()
	  { 
	  // Delete old data ( 2hours)
	  $expiration = time()-7200 ;
	  $sql = " DELETE FROM captcha WHERE captcha_time < ? ";
	  $binds = array($expiration);
	  $query = $this->db->query($sql, $binds);
	  
	  //checking input
	  $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
	  $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
	  $query = $this->db->query($sql, $binds);
	  $row = $query->row();
	
	  if ( $row -> count > 0 )
	  {
	    return true;
	  }
	  return false;

  	}

 function addDayswithdate($date,$days){

		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);

	}
 
 public function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

}

?>
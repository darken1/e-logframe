<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
This code belongs to Joash Gomba (The developer). The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/

class Login extends CI_Controller {

 function __construct()
 {

   parent::__construct();

 }

 function index()
 {

   $this->load->helper(array('form', 'url'));
   
   $data = array();
   //get the user's IP address
	$ip_address = $this->getIp();
	
	$locked = $this->lockedipsmodel->get_by_ip($ip_address)->row();
	
	if(!empty($locked))
	{
		redirect('errorpage/iplocked');
	}
	
   	$policy = $this->passwordpoliciesmodel->get_by_id(1)->row();
    // Get timestamp of current time 
		$now = time();
	 
		// All login attempts are counted from the past 2 hours. 
		$valid_attempts = $now - ($policy->login_attempts_counted_within * 60 * 60);
		
		$attempts = $this->loginattemptsmodel->checkbrute_by_ip($ip_address,$valid_attempts);
		
		$totalattempts = count($attempts);
		
		if($totalattempts >=$policy->max_login_attempts)
		{
			$data["cap_img"] = $this -> _make_captcha();
			$data['message'] = 'More than '.$policy->max_login_attempts.' failed login attempts on this IP address. CAPTCHA required';
		}
		else
		{
			$data["cap_img"] = '';
			$data['message'] = '';
		}
		
		$data['lock_message'] = $this->session->flashdata('lock_message');

   $this->load->view('login/login_view',$data);

 }
 
 public function forgotpassword()
 {
	 $data = array();
	 $data['error'] = '';
	 
	 $data['success_message'] = $this->session->flashdata('success_message');
	 $this->load->view('login/forgotpassword',$data);
	 
 }
 
 function _make_captcha()
	  {
	  //$this -> load -> plugin('captcha');
	  $vals = array(
	    'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
	    'img_url' => 'http://127.0.0.1:81/elogframe/captcha/', // URL for captcha img
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


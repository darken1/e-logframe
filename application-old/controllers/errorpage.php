<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Errorpage extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('profilesmodel');
   }

   public function index()
   {
        
		$data = array();
		$this->load->view('errorpages/error_page', $data);
	   
   }
   
   public function iplocked()
   {
	   $data = array();
	   $this->load->view('errorpages/iplocked', $data);
   }

   

}

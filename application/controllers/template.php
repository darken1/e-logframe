<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
This code belongs to Joash Gomba (The developer). The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/

class Template extends CI_Controller {

 function __construct()
 {

   parent::__construct();

 }

 function index()
 {

   
   $this->load->view('template/listpage');

 }
 
 function add()
 {

   
   $this->load->view('template/form');

 }
 
 function profile()
 {
	 $this->load->view('template/profile');
 }
 



}


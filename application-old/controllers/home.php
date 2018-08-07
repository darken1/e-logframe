<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
DO NOT REMOVE THIS NOTICE FROM THE CODE
This code belongs to Joash Gomba (The developer). The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/

class Home extends CI_Controller {

 function __construct()
 {

   parent::__construct();
   $this->load->library("Excel");
   
  }

 function index()
 {
	if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	 }
	 
	 
	 
	 $data = array();	 
	
	$data['users'] = $this->usersmodel->get_list();
	$data['warning_message'] = $this->session->flashdata('warning_message');

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
      
	 // $this->db->insert('audittrail', $auditdata);
	  /***
	  ======================================
	  End audit trail info capture
	  ======================================	  
	  ***/
	  
	  $piedata = '';
	  $bardata = '';
	  $barcategories = '';
	  
	  /**SECTORS BY BUDGET**/	  
	  $sectors = $this->sectorsmodel->get_list();	 
	  
	  foreach($sectors as $key=>$sector)
	  {
		   $sectorbudget = $this->sectorsmodel->get_by_sector_funding($sector['id']);
		   
		   if(empty($sectorbudget))
		   {
			   /// do not display on chart
		   }
		   else
		   {
			   
			   $piedata .= "['".$sector['sector']."',     ".$sectorbudget."],";
		   }
		   
			   
		   
	  }
	  
	  /**PROJECTS BY DONORS**/
	  $donors = $this->db->get('donors');
	  
	  foreach($donors->result() as $donor)
	  {
		  $barcategories .= "'".$donor->donor_name."',";
		  
		  
		  $projectdonors = $this->donorsmodel->project_by_donor($donor->id);
		  $donorprojects = count($projectdonors);
		  $bardata .= $donorprojects.',';
	  }
	  
	  /**BUDGET BY DONORS**/
	  $donorcategories = '';
	  $donorsdata = '';
	  
	  foreach($donors->result() as $donor)
	  {
		  
		  $donorcategories .= "'".$donor->donor_name."',";
		  
		  $thefunding = $this->donorsmodel->get_donor_funding($donor->id);
		  
		   $donorsdata .= $thefunding.',';
	  }
	  
	  $data['rollingactionplanassignees'] = $this->rollingactionplanassigneesmodel->get_list_by_user($user_db_id);
	  $data['savedreports'] = $this->savedreportsmodel->get_combined_list($user_db_id);	  
	  $data['donorcategories'] = $donorcategories;
	  $data['donorsdata'] = $donorsdata;
	  $data['barcategories'] = $barcategories;
	  $data['bardata'] = $bardata;
	  $data['piedata'] = $piedata;
	  $data['counties'] = $this->countiesmodel->get_list();
	  $data['sectors'] = $this->sectorsmodel->get_list();
	  $data['donors'] = $this->donorsmodel->get_list();
	  $data['status'] = $this->projectactivitystatusmodel->get_list();
	  $data['rows'] = $this->db->get('projects'); 	  	
	  $data['documents'] = $this->documentsmodel->get_list();
	  
   	$this->load->view('home/home_view', $data); 

 }
 
 
  /* draws a calendar */
	function draw_calendar($month,$year){
	
	  /* draw table */
	  $calendar = '<table cellpadding="0" cellspacing="0" id="listtable" width="100%">';
	
	  /* table headings */
	  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	  $calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';
	
	  /* days and weeks vars now ... */
	  $running_day = date('w',mktime(0,0,0,$month,1,$year));
	  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	  $days_in_this_week = 1;
	  $day_counter = 0;
	  $dates_array = array();
	
	  /* row for week one */
	  $calendar.= '<tr >';
	
	  /* print "blank" days until the first of the current week */
	  for($x = 0; $x < $running_day; $x++):
	    $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
	    $days_in_this_week++;
	  endfor;
	
	  /* keep going with days.... */
	  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		  
		  if($list_day==date('d'))
		  {
		  	$bgcolor = 'class="alt"';
		  }
		else {
			$bgcolor = '';
		}
	    $calendar.= '<td  '.$bgcolor.'>';
	      /* add in the day number */
	      $calendar.= '<div class="day-number"><a href="" class="day-number">'.$list_day.'</a></div>';
	
	      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
	     $qryDate = $year."-".$month."-".$list_day;	
		 
		 $events = $this->calendarmodel->get_by_date($qryDate);
		 
		 $totalevents = count($events);
		 
		 if($totalevents==0)
		 {
			 $calendar.= str_repeat('<p>&nbsp;</p>',2);
		 }
		 else
		 {
			 foreach ($events as $key => $event):
			 	$string = character_limiter($event->title, 10);
				
				$atts = array(
		              'width'      => '500',
		              'height'     => '300',
		              'scrollbars' => 'yes',
		              'status'     => 'no',
		              'resizable'  => 'no',
		              'screenx'    => '0',
		              'screeny'    => '0',
					  'class'    => 'text-success',
					  'data-rel'    => 'tooltip',
					  'title'    => $event->title
					  
		            );
				$url = 'calendar/detail/'.$event->id;
				
				$linktext = $string;
				$viewlink = anchor_popup($url, $linktext, $atts);
				
			 	$calendar.= str_repeat("<i class='icon-circle green'></i> ".$viewlink."&nbsp;",1);
				//$calendar.= str_repeat('&nbsp;',1);
				 
			 endforeach;
		 }
		
	    $calendar.= '</td>';
		 
		
	    $calendar.= '</td>';
	    if($running_day == 6):
	      $calendar.= '</tr>';
	      if(($day_counter+1) != $days_in_month):
	        $calendar.= '<tr class="calendar-row">';
	      endif;
	      $running_day = -1;
	      $days_in_this_week = 0;
	    endif;
	    $days_in_this_week++; $running_day++; $day_counter++;
	  endfor;
	
	  /* finish the rest of the days in the week */
	  if($days_in_this_week < 8):
	    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
	      $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
	    endfor;
	  endif;
	
	  /* final row */
	  $calendar.= '</tr>';
	
	  /* end the table */
	  $calendar.= '</table>';
	  
	  /* all done, return result */
	  return $calendar;
	}

 function logout()
 {

   $this->erkanaauth->logout();
   $this->session->sess_destroy();

   redirect('login', 'refresh');
  
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
  
  function createsheet()
  {
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("RN Kushwaha")
				->setLastModifiedBy("Aryan")
				->setTitle("Reports")
				->setSubject("Excel Turorials")
				->setDescription("Test document ")
				->setKeywords("phpExcel")
				->setCategory("Test file");
				
		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Phone');
		
		$n=2;
		/**
		$qry= mysql_query("select * from tbl_agent ");
		while($d= mysql_fetch_array($qry)){
		 $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['id']);
		 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['name']);
		 $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['email']);
		 $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['contact_no']);
		   $n++;
		}  
		
		**/      
		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', '1');
		 $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Joash Gomba');
		 $objPHPExcel->getActiveSheet()->setCellValue('C2', 'joashgomba@gmail.com');
		 $objPHPExcel->getActiveSheet()->setCellValue('D2', '254721937404');        
						
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Agents');
		
		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();
		
		// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Phone No');
		
		$n=2;
		/**
		$qry=executeQuery("select * from tbl_technician ");
		while($d= mysql_fetch_array($qry)){
		 $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['id']);
		 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['title']);
		 $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['email']);
		 $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['phone']);
		$n++;
		}     
		
		**/  
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Armana Gomba');
		 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, 'Technitian');
		 $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, 'armanagomba@gmail.com');
		 $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, '254721937404');
		
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('Technician');
		/**
		// Redirect output to a client's web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="data.xls"');
		header('Cache-Control: max-age=0');
		**/
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//$objWriter->save('php://output');
		$objWriter->save('output.xlsx');
	
  }
  
  
  function ODKSheet()
  {
	  $objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Danish Refugee Council")
				->setLastModifiedBy("DRC")
				->setTitle("ODK XLS FORM")
				->setSubject("ODK Excel Form")
				->setDescription("This excel sheet is used to generate an ODK survey form. ")
				->setKeywords("phpExcel")
				->setCategory("ODK Forms");
				
		// Create a first sheet, representing sales data
		/**
		http://schoolofdata.org/creating-your-odk-data-collection-form-excel/
		
		TYPE (required): ODK recognizes a set of question types like single select (Yes or No questions), multi-select, text, numbers, and even photos and geographical locations. (date,text,begin_group (section break),end_group,integer,calculate,note,select_one yes_no,select_multiple {field}, select_one {field},geopoint)
		NAME (required): this column will be the headers for the responses. The name should be related to your question. Names should be unique and must not have spaces. Your Names must only have letters, number and/or underscore e.g. pop1, no_persons, city.
		Label (required): this is basically how your survey questions will appear on your mobile device. You can type this in whichever format e.g. What is your name?, Age, Date today. Try to copy the screenshot on your own sheet.
		Hint: as the name implies, this is where you can give your respondents a hint on how you want your question answered.
		Calculation: for questions requiring numerical answers, ODK gives you a chance to do calculations. ${name_of_calculated_field} is the expression used to perform a calculation. Under this column, you can request ODK to perform simple calculations for you. As an example, in the screenshot below, the name of your calculated field for the question "How many days in a week do you work?" is days_of_work. 7-$(days_of_work) is your calculation. This means that if your responder answers 6, Kobo Toolbox will perform the calculation 7.
		
		Appearance: this column determines how your question or groups of question will appear on your mobile device. Questions can be grouped together using the code field-list per group of questions.
		
		Constraint: this column is used to set restrictions for numerical questions. If you would like to have a minimum or maximum value of numerical answers, you can put in a constraint i.e. (.>= 0 and .<=1000) which means you can only answer values between 0 to 1000. If you go back to calculation example, you can put a constraint that answers can only be between 0-7 to make a logical calculation. Thus, your constraint can be typed as (.>=0 and .<=7). * Constraint_message – if you have a constraint, this column allows you to show an error message if the responder fails to follow the constraint.
		
		Required – just put in Yes across the question which you want to require the responder to answer.
		**/
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'type');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'name');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'label');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'hint');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'calculation');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'appearance');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'relevant');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'constraint');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'constraint_message');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'required');
		
		$n=2;
		/**
		$qry= mysql_query("select * from tbl_agent ");
		while($d= mysql_fetch_array($qry)){
		 $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['id']);
		 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['name']);
		 $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['email']);
		 $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['contact_no']);
		   $n++;
		}  
		
		**/      
		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'start');
		 $objPHPExcel->getActiveSheet()->setCellValue('B2', 'start');
		 $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Start Time');
		 $objPHPExcel->getActiveSheet()->setCellValue('D2', 'From this point, you can copy everything else. This is system generated.');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E2', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F2', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G2', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H2', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I2', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J2', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A3', 'end');
		 $objPHPExcel->getActiveSheet()->setCellValue('B3', 'end');
		 $objPHPExcel->getActiveSheet()->setCellValue('C3', 'End Time');
		 $objPHPExcel->getActiveSheet()->setCellValue('D3', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E3', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F3', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G3', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H3', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I3', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J3', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A4', 'today');
		 $objPHPExcel->getActiveSheet()->setCellValue('B4', 'today');
		 $objPHPExcel->getActiveSheet()->setCellValue('C4', 'Date of Survey');
		 $objPHPExcel->getActiveSheet()->setCellValue('D4', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E4', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F4', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G4', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H4', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I4', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J4', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A5', 'deviceid');
		 $objPHPExcel->getActiveSheet()->setCellValue('B5', 'deviceid');
		 $objPHPExcel->getActiveSheet()->setCellValue('C5', 'Phone Serial Number');
		 $objPHPExcel->getActiveSheet()->setCellValue('D5', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E5', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F5', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G5', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H5', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I5', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J5', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A6', 'subscriberid');
		 $objPHPExcel->getActiveSheet()->setCellValue('B6', 'subscriberid');
		 $objPHPExcel->getActiveSheet()->setCellValue('C6', 'Subscriber Identifier');
		 $objPHPExcel->getActiveSheet()->setCellValue('D6', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E6', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F6', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G6', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H6', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I6', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J6', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A7', 'imei');
		 $objPHPExcel->getActiveSheet()->setCellValue('B7', 'simserial');
		 $objPHPExcel->getActiveSheet()->setCellValue('C7', 'SIM Serial');
		 $objPHPExcel->getActiveSheet()->setCellValue('D7', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E7', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F7', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G7', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H7', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I7', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J7', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A8', 'phonenumber');
		 $objPHPExcel->getActiveSheet()->setCellValue('B8', 'phonenumber');
		 $objPHPExcel->getActiveSheet()->setCellValue('C8', 'Phone Number');
		 $objPHPExcel->getActiveSheet()->setCellValue('D8', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E8', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F8', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G8', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H8', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I8', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J8', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A9', 'note');
		 $objPHPExcel->getActiveSheet()->setCellValue('B9', 'note_heading');
		 $objPHPExcel->getActiveSheet()->setCellValue('C9', 'ODK sample Survey registration');
		 $objPHPExcel->getActiveSheet()->setCellValue('D9', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E9', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F9', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G9', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H9', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I9', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J9', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A10', 'begin_group');
		 $objPHPExcel->getActiveSheet()->setCellValue('B10', 'group_profile');
		 $objPHPExcel->getActiveSheet()->setCellValue('C10', 'Sample ODK Survey');
		 $objPHPExcel->getActiveSheet()->setCellValue('D10', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E10', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F10', 'field-list');
		 $objPHPExcel->getActiveSheet()->setCellValue('G10', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H10', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I10', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J10', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A11', 'select_one yes_no');
		 $objPHPExcel->getActiveSheet()->setCellValue('B11', 'consent');
		 $objPHPExcel->getActiveSheet()->setCellValue('C11', 'Have you gotten consent?');
		 $objPHPExcel->getActiveSheet()->setCellValue('D11', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E11', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F11', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G11', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H11', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I11', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J11', 'yes');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A12', 'date');
		 $objPHPExcel->getActiveSheet()->setCellValue('B12', 'birth_date');
		 $objPHPExcel->getActiveSheet()->setCellValue('C12', 'Birth date');
		 $objPHPExcel->getActiveSheet()->setCellValue('D12', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E12', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F12', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G12', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H12', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I12', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J12', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A13', 'text');
		 $objPHPExcel->getActiveSheet()->setCellValue('B13', 'full_name');
		 $objPHPExcel->getActiveSheet()->setCellValue('C13', 'Full name');
		 $objPHPExcel->getActiveSheet()->setCellValue('D13', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E13', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F13', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G13', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H13', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I13', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J13', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A14', 'geopoint');
		 $objPHPExcel->getActiveSheet()->setCellValue('B14', 'geopoint');
		 $objPHPExcel->getActiveSheet()->setCellValue('C14', 'Where are you right now?');
		 $objPHPExcel->getActiveSheet()->setCellValue('D14', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E14', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F14', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G14', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H14', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I14', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J14', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A15', 'integer');
		 $objPHPExcel->getActiveSheet()->setCellValue('B15', 'siblings');
		 $objPHPExcel->getActiveSheet()->setCellValue('C15', 'How many siblings do you have');
		 $objPHPExcel->getActiveSheet()->setCellValue('D15', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E15', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F15', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G15', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H15', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I15', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J15', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A16', 'select_one education');
		 $objPHPExcel->getActiveSheet()->setCellValue('B16', 'education');
		 $objPHPExcel->getActiveSheet()->setCellValue('C16', 'What is your highest level of education.');
		 $objPHPExcel->getActiveSheet()->setCellValue('D16', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E16', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F16', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G16', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H16', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I16', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J16', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A17', 'country');
		 $objPHPExcel->getActiveSheet()->setCellValue('B17', 'select_multiple country');
		 $objPHPExcel->getActiveSheet()->setCellValue('C17', 'Which countries did you visit last?');
		 $objPHPExcel->getActiveSheet()->setCellValue('D17', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E17', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F17', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G17', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H17', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I17', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J17', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A18', 'image');
		 $objPHPExcel->getActiveSheet()->setCellValue('B18', 'photo');
		 $objPHPExcel->getActiveSheet()->setCellValue('C18', 'Take a selfie');
		 $objPHPExcel->getActiveSheet()->setCellValue('D18', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E18', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F18', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G18', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H18', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I18', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J18', '');
		 
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A19', 'end_group');
		 $objPHPExcel->getActiveSheet()->setCellValue('B19', 'profile_end');
		 $objPHPExcel->getActiveSheet()->setCellValue('C19', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('D19', '');  
		 $objPHPExcel->getActiveSheet()->setCellValue('E19', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('F19', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('G19', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('H19', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('I19', '');
		 $objPHPExcel->getActiveSheet()->setCellValue('J19', '');
		       
						
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('survey');
		
		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();
		
		/**
		List_name – this one serves the same purpose as your Type column in the survey sheet. This is your main reference in single-select or multiple-select questions in your survey sheet

Name – this is similar to your Name column from the survey sheet. This must be unique and is related to your choices Labels. You can use letters, number and/or underscore for the choices names.

Label – this shows how your choices will appear on your device
		
		**/
		
		// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'list_name');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'name');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'label');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'image');
		
		$n=2;
		/**
		$qry=executeQuery("select * from tbl_technician ");
		while($d= mysql_fetch_array($qry)){
		 $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['id']);
		 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['title']);
		 $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['email']);
		 $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['phone']);
		$n++;
		}     
		
		**/  
		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'yes_no');
		 $objPHPExcel->getActiveSheet()->setCellValue('B2', 'yes');
		 $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Yes');
		 $objPHPExcel->getActiveSheet()->setCellValue('D2', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A3', 'yes_no');
		 $objPHPExcel->getActiveSheet()->setCellValue('B3', 'no');
		 $objPHPExcel->getActiveSheet()->setCellValue('C3', 'No');
		 $objPHPExcel->getActiveSheet()->setCellValue('D3', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A4', 'education');
		 $objPHPExcel->getActiveSheet()->setCellValue('B4', 'basic_ed');
		 $objPHPExcel->getActiveSheet()->setCellValue('C4', 'Basic education');
		 $objPHPExcel->getActiveSheet()->setCellValue('D4', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A5', 'education');
		 $objPHPExcel->getActiveSheet()->setCellValue('B5', 'highchool');
		 $objPHPExcel->getActiveSheet()->setCellValue('C5', 'High School');
		 $objPHPExcel->getActiveSheet()->setCellValue('D5', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A6', 'education');
		 $objPHPExcel->getActiveSheet()->setCellValue('B6', 'post_secondary');
		 $objPHPExcel->getActiveSheet()->setCellValue('C6', 'Post Secondary');
		 $objPHPExcel->getActiveSheet()->setCellValue('D6', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A7', 'country');
		 $objPHPExcel->getActiveSheet()->setCellValue('B7', 'asia');
		 $objPHPExcel->getActiveSheet()->setCellValue('C7', 'Some place in Asia');
		 $objPHPExcel->getActiveSheet()->setCellValue('D7', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A8', 'country');
		 $objPHPExcel->getActiveSheet()->setCellValue('B8', 'africa');
		 $objPHPExcel->getActiveSheet()->setCellValue('C8', 'Africa');
		 $objPHPExcel->getActiveSheet()->setCellValue('D8', '');
		 
		 $objPHPExcel->getActiveSheet()->setCellValue('A9', 'country');
		 $objPHPExcel->getActiveSheet()->setCellValue('B9', 'europe');
		 $objPHPExcel->getActiveSheet()->setCellValue('C9', 'Europe');
		 $objPHPExcel->getActiveSheet()->setCellValue('D9', '');
		
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('choices');
		
		
		$objPHPExcel->createSheet();
		
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'form_title');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'form_id');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'default_language');
		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Sample ODK Form');
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'sample_odk');
		$objPHPExcel->getActiveSheet()->setCellValue('C2', 'english');
		
		
		//rename the third sheet
		$objPHPExcel->getActiveSheet()->setTitle('settings');
		
				
	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//$objWriter->save('php://output');
		$objWriter->save('ODK_Forms/ODK_DRC_Form.xlsx');
  }
 
}

?>
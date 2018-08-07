<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Calendar extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('calendarmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   $user_id = $this->erkanaauth->getField('id');
        $data = array(
           'rows' => $this->calendarmodel->list_by_user($user_id),
       );
       $this->load->view('calendar/index', $data);
   }
   
   public function calendarview()
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  $data = array();
	  
	  $month = date('m');
	  $year = date('Y');
	  $data['calendar'] = $this->draw_calendar($month,$year);
	  
	  $data['month'] = $month;
	  
	  
	  /* select month control */
		$select_month_control = '<select name="month" id="month" class="form-control">';
		for($x = 1; $x <= 12; $x++) {
		  $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
		}
		$select_month_control.= '</select>';
		
		/* select year control */
		$year_range = 7;
		$select_year_control = '<select name="year" id="year" class="form-control">';
		for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
		  $select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
		}
		$select_year_control.= '</select>';
		
			/* "next month" control */
	
		$next_month_link = '<a href="'.site_url().'calendar/browsecalendar/'.($month != 12 ? $month + 1 : 1).'/'.($month != 12 ? $year : $year + 1).'"" class="btn btn-info">Next Month <i class="fa fa-forward"></i></a>';
		
		/* "previous month" control */
	
	
	$previous_month_link ='<a href="'.site_url().'calendar/browsecalendar/'.($month != 1 ? $month - 1 : 12).'/'.($month != 1 ? $year : $year - 1).'"" class="btn btn-info"><i class="fa fa-backward"></i>  Previous Month</a>';
		
		
		$data['select_month_control'] = $select_month_control;
		$data['select_year_control'] = $select_year_control;
		$data['next_month_link'] = $next_month_link;
		$data['previous_month_link'] = $previous_month_link;
		
		
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
	  
	  $this->load->view('calendar/calendarview', $data);
   }
   
    public function browsecalendar($month,$year)
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  $data = array();
	  
	  $data['calendar'] = $this->draw_calendar($month,$year);
	  
	  
	   /* select month control */
		$select_month_control = '<select name="month" id="month" class="form-control">';
		for($x = 1; $x <= 12; $x++) {
		  $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
		}
		$select_month_control.= '</select>';
		
		/* select year control */
		$year_range = 7;
		$select_year_control = '<select name="year" id="year" class="form-control">';
		for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
		  $select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
		}
		$select_year_control.= '</select>';
		
			/* "next month" control */
	
		$next_month_link = '<a href="'.site_url().'calendar/browsecalendar/'.($month != 12 ? $month + 1 : 1).'/'.($month != 12 ? $year : $year + 1).'"" class="btn btn-info">Next Month <i class="fa fa-forward"></i></a>';
		
		/* "previous month" control */
	
	
	$previous_month_link ='<a href="'.site_url().'calendar/browsecalendar/'.($month != 1 ? $month - 1 : 12).'/'.($month != 1 ? $year : $year - 1).'"" class="btn btn-info"><i class="fa fa-backward"></i>   Previous Month</a>';
		
		
		$data['select_month_control'] = $select_month_control;
		$data['select_year_control'] = $select_year_control;
		$data['next_month_link'] = $next_month_link;
		$data['previous_month_link'] = $previous_month_link;
		
		
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
	  
	  $this->load->view('calendar/calendarview', $data);
   }
   
   public function searchcalendar()
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {

    	redirect('login','refresh');

  	  }
	  
	  $data = array();
	  
	  $month = $this->input->post('month');
	  $year = $this->input->post('year');
	  
	  $data['calendar'] = $this->draw_calendar($month,$year);
	  
	  
	   /* select month control */
		$select_month_control = '<select name="month" id="month" class="form-control">';
		for($x = 1; $x <= 12; $x++) {
		  $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
		}
		$select_month_control.= '</select>';
		
		/* select year control */
		$year_range = 7;
		$select_year_control = '<select name="year" id="year" class="form-control">';
		for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
		  $select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
		}
		$select_year_control.= '</select>';
		
			/* "next month" control */
	
		$next_month_link = '<a href="'.site_url().'calendar/browsecalendar/'.($month != 12 ? $month + 1 : 1).'/'.($month != 12 ? $year : $year + 1).'"" class="btn btn-info">Next Month <i class="fa fa-forward"></i></a>';
		
		/* "previous month" control */
	
	
	$previous_month_link ='<a href="'.site_url().'calendar/browsecalendar/'.($month != 1 ? $month - 1 : 12).'/'.($month != 1 ? $year : $year - 1).'"" class="btn btn-info"><i class="fa fa-backward"></i> Previous Month</a>';
		
		
		$data['select_month_control'] = $select_month_control;
		$data['select_year_control'] = $select_year_control;
		$data['next_month_link'] = $next_month_link;
		$data['previous_month_link'] = $previous_month_link;
		
		
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
	  
	  $this->load->view('calendar/calendarview', $data);
   }
   

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('calendar/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('title', 'Title', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       $this->form_validation->set_rules('end_time', 'End time', 'trim|required');
       $this->form_validation->set_rules('location', 'Location', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   $user_id = $this->erkanaauth->getField('id');
           $data = array(
               'title' => $this->input->post('title'),
               'description' => $this->input->post('description'),
               'start_date' => $this->input->post('start_date'),
               'end_date' => $this->input->post('end_date'),
               'start_time' => $this->input->post('start_time'),
               'end_time' => $this->input->post('end_time'),
               'location' => $this->input->post('location'),
               'user_id' => $user_id,
           );
           $this->db->insert('calendar', $data);
           redirect('calendar','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('calendar','refresh');
       }
       $row = $this->db->get_where('calendar', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('calendar','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('calendar/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('title', 'Title', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       $this->form_validation->set_rules('end_time', 'End time', 'trim|required');
       $this->form_validation->set_rules('location', 'Location', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
		   $user_id = $this->erkanaauth->getField('id');
           $data = array(
               'title' => $this->input->post('title'),
               'description' => $this->input->post('description'),
               'start_date' => $this->input->post('start_date'),
               'end_date' => $this->input->post('end_date'),
               'start_time' => $this->input->post('start_time'),
               'end_time' => $this->input->post('end_time'),
               'location' => $this->input->post('location'),
               'user_id' => $user_id,
           );
           $this->db->where('id', $id);
           $this->db->update('calendar', $data);
           redirect('calendar','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('calendar','refresh');
       }
       $this->db->delete('calendar', array('id' => $id));
       redirect('calendar','refresh');
   }
   
   
    /* draws a calendar */
	function draw_calendar($month,$year){
	
	  /* draw table */
	  //$calendar = '<table class="table table-hover table-nomargin table-bordered">';
	  $calendar = '<table class="event-calendar animate-onscroll" width="100%">';
	  /* table headings */
	  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	  //$calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';
	  $calendar.= '<tr class="calendar-days"><th>'.implode('</th><th>',$headings).'</th></tr>';
	
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
	    //$calendar.= '<td class="calendar-day-np" >&nbsp;</td>';
		$calendar.= '<td class="not-this-month" >&nbsp;</td>';
	    $days_in_this_week++;
	  endfor;
	
	  /* keep going with days.... */
	  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		  
		  if($list_day==date('d'))
		  {
		  	$bgcolor = 'bgcolor="#FFFFCC"';
		  }
		else {
			$bgcolor = '';
		}
	   $calendar.= '<td  '.$bgcolor.'>';
		//$calendar.= '<td>';
	      /* add in the day number */
	      //$calendar.= '<div class="day-number"><a href="" class="day-number">'.$list_day.'</a></div>';
		  $calendar.= '<span class="day"><a href="" class="day-number">'.$list_day.'</a></span>';
	
	      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
	     $qryDate = $year."-".$month."-".$list_day;	
		 
		 $events = $this->calendarmodel->get_by_date($qryDate);
		 
		 $totalevents = count($events);
		 
		 if($totalevents==0)
		 {
			 //$calendar.= str_repeat('<p>&nbsp;</p>',2);
		 }
		 else
		 {
			 $calendar .= '<ul class="events">';
			 foreach ($events as $key => $event):
			 	$string = character_limiter($event->title, 10);
				$summary = character_limiter($event->title, 50);
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
				
				$calendar .= '<li>
												<a href="#">'.$string.'</a>
												
											<div class="event-popover">
												
												<h6><a href="#">'.$event->title.'</a></h6>
												<ul class="event-meta">
													<li><i class="fa fa-clock-o"></i></i> '.$event->start_time.' - '.$event->end_time.'</li>
													<li><i class="fa fa-map-marker"></i> '.$event->location.'</li>
												</ul>
												
												<p>'.$summary.'</p>
												
											</div>
																					</li>';
				
			 	//$calendar.= str_repeat("<i class='icon-circle green'></i> ".$viewlink."&nbsp;",1);
				//$calendar.= str_repeat('&nbsp;',1);
				 
			 endforeach;
			 
			  $calendar .= '</ul>';
		 }
		
	    $calendar.= '</td>';
		 
		
	    $calendar.= '</td>';
	    if($running_day == 6):
	      $calendar.= '</tr>';
	      if(($day_counter+1) != $days_in_month):
	        //$calendar.= '<tr class="calendar-row">';
			$calendar.= '<tr class="no-events">';
	      endif;
	      $running_day = -1;
	      $days_in_this_week = 0;
	    endif;
	    $days_in_this_week++; $running_day++; $day_counter++;
	  endfor;
	
	  /* finish the rest of the days in the week */
	  if($days_in_this_week < 8):
	    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
	     // $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		  $calendar.= '<td class="no-events">&nbsp;</td>';
	    endfor;
	  endif;
	
	  /* final row */
	  $calendar.= '</tr>';
	
	  /* end the table */
	  $calendar.= '</table>';
	  
	  /* all done, return result */
	  return $calendar;
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

<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Outcomeindicatortracking extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('outcomeindicatortrackingmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('outcomeindicatortracking'),
       );
       $this->load->view('outcomeindicatortracking/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
       $this->load->view('outcomeindicatortracking/add',$data);
   }

    public function trackoutcomeindicator()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();


	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['organizations'] = $this->db->get('organizations');
       $this->load->view('outcomeindicatortracking/trackoutcomeindicator',$data);
   }

    function tracklist()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $project = $this->projectsmodel->get_by_id($project_id)->row();

	   $projectoutcomeindicators = $this->projectoutcomeindicatorsmodel->get_list_by_project($project_id);
	   
	   if(empty($projectoutcomeindicators))
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="6">Outcome Indicators</th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Indicator</th><th>target</th><th>Reach</th><th>Status</th></tr>
		   </thead>';
		}
		else
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="5">Outcome Indicators</th><th><a href="'.base_url().'index.php/outcomeindicatortracking/download/'.$project_id.'"  class="btn btn-primary" target="_blank">DOWNLOAD</a></th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Indicator</th><th>target</th><th>Reach</th><th>Status</th></tr>
		   </thead>';
		}
	

	   $total_reached = 0;


	   if(empty($projectoutcomeindicators))
	   {
			$table .= '<tr><td colspan="6">No indicators added</td></tr>';
	   }
	   else
	   {

		  foreach($projectoutcomeindicators as $key => $projectoutcomeindicator)
		  {
			  $no_of_days = ($projectoutcomeindicator['outcomeimplementation_time']*30);
			  $target_end = $this->addDayswithdate($project->project_start_date, $no_of_days);

			  $thereach = $this->outcomeindicatortrackingmodel->getreach($projectoutcomeindicator['id']);
			  if(empty($thereach))
			  {
				  $reach = 0;
			  }
			  else
			  {
				  $reach = $thereach;
			  }
			  $thetarget = preg_replace("/[^0-9,.]/", "", $projectoutcomeindicator['outcometarget'] );

			  $targettext = preg_replace('/\d/', '',$projectoutcomeindicator['outcometarget'] );

			  //track status

			  $bgcolor = 'bgcolor="#FFFFFF"';

			  $today = date('Y-m-d');

			  if(!is_numeric($thetarget) || $thetarget==0)
			  {
				  $percentage = 0;
			  }
			  else
			  {
			 	$percentage = ($reach/$thetarget)*100;
			  }

			  if($target_end<$today)
			  {
				  if($percentage<100)
				  {
					  $bgcolor = 'bgcolor="#FF0000"';//overdue
				  }
				  else
				  {
					  $bgcolor = 'bgcolor="#00CC00"';//ontime
				  }
			  }
			  else
			  {
				  $start = strtotime($today);
				  $end = strtotime($target_end);



				  $days_between = ceil(abs($end - $start) / 86400);


				  if($days_between <=90)//3 months
				  {
					  if($percentage<=60)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=61 && $percentage<=80)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }//end 90 days check
				  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
				  {
					  if($percentage<=30)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=31 && $percentage<=50)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }
				  else
				  {
            /**
					  if($reach==0)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  else
					  {
					   	$bgcolor = 'bgcolor="#00CC00"';//ontime
					  }

            **/

            $bgcolor = 'bgcolor="#00CC00"';//ontime
				  }

			  }//end first else

			  $thestart = strtotime($today);
			  $theend = strtotime($target_end);
			  $the_days_between = ceil(abs($theend - $thestart) / 86400);

				  if($target_end<$today)
				  {
					  $days_left = 0;

				  }
				  else
				  {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				  }

			  $table .= '<tr><td>'.$target_end.'</td><td>'.$days_left.'</td><td>'.$projectoutcomeindicator['outcomeindicator'].'</td><td>'.$projectoutcomeindicator['outcometarget'].'</td><td>'.$reach.''.$targettext.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).'%</strong></td></tr>';
		  }

	   }

	   $table .= '</table>';

	   echo $table;
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('projectoutcomeindicator_id', 'Projectoutcomeindicator id', 'trim|required');
       $this->form_validation->set_rules('report_month', 'Report month', 'trim|required');
       $this->form_validation->set_rules('report_year', 'Report year', 'trim|required');
       $this->form_validation->set_rules('reached', 'Reached', 'trim|required');
       $this->form_validation->set_rules('comments', 'Comments', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'projectoutcomeindicator_id' => $this->input->post('projectoutcomeindicator_id'),
               'report_month' => $this->input->post('report_month'),
               'report_year' => $this->input->post('report_year'),
               'reached' => $this->input->post('reached'),
               'comments' => $this->input->post('comments'),
           );
           $this->db->insert('outcomeindicatortracking', $data);
           redirect('outcomeindicatortracking','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('outcomeindicatortracking','refresh');
       }
       $row = $this->db->get_where('outcomeindicatortracking', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('outcomeindicatortracking','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('outcomeindicatortracking/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('projectoutcomeindicator_id', 'Projectoutcomeindicator id', 'trim|required');
       $this->form_validation->set_rules('report_month', 'Report month', 'trim|required');
       $this->form_validation->set_rules('report_year', 'Report year', 'trim|required');
       $this->form_validation->set_rules('reached', 'Reached', 'trim|required');
       $this->form_validation->set_rules('comments', 'Comments', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'projectoutcomeindicator_id' => $this->input->post('projectoutcomeindicator_id'),
               'report_month' => $this->input->post('report_month'),
               'report_year' => $this->input->post('report_year'),
               'reached' => $this->input->post('reached'),
               'comments' => $this->input->post('comments'),
           );
           $this->db->where('id', $id);
           $this->db->update('outcomeindicatortracking', $data);
           redirect('outcomeindicatortracking','refresh');
       }
   }
   
   
   function getoutcomes()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $projectoutcomeindicators = $this->projectoutcomesmodel->get_by_project_list($project_id);


	   $indicatorselect = '<select name="projectoutcome_id" id="projectoutcome_id" class=\'chosen-select form-control\' onChange="GetOutcomeIndicators(this)" required="required">';

		 if(empty($projectoutcomeindicators))
		 {
			$indicatorselect .= '<option value="0">Select Outcome</option>';
		 }
		 else
		 {
		 	$indicatorselect .= '<option value="0">Select Outcome</option>';
		   foreach($projectoutcomeindicators as $key => $projectoutcomeindicator)
		   {
			   $indicatorselect .= '<option value="'.$projectoutcomeindicator['id'].'">'.$projectoutcomeindicator['outcome'].'</option>';
		   }
		 }

	   $indicatorselect .= '</select>';

	   echo $indicatorselect;
   }


   function getindicators()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $projectoutcomeindicators = $this->projectoutcomeindicatorsmodel->get_list_by_project($project_id);


	   $indicatorselect = '<select name="projectoutcomeindicator_id" id="projectoutcomeindicator_id" class=\'chosen-select form-control\' onChange="GetTargets(this)" required="required">';

		 if(empty($projectoutcomeindicators))
		 {
			$indicatorselect .= '<option value="0">Select Indicator</option>';
		 }
		 else
		 {
		 	$indicatorselect .= '<option value="0">Select Indicator</option>';
		   foreach($projectoutcomeindicators as $key => $projectoutcomeindicator)
		   {
			   $indicatorselect .= '<option value="'.$projectoutcomeindicator['id'].'">'.$projectoutcomeindicator['outcomeindicator'].' ('.$projectoutcomeindicator['outcometype'].')</option>';
		   }
		 }

	   $indicatorselect .= '</select>';

	   echo $indicatorselect;
   }
   
   
    function getoutcomeindicators()
   {
	   $projectoutcome_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutcome_id']))));

	   $projectoutcomeindicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($projectoutcome_id);


	   $indicatorselect = '<select name="projectoutcomeindicator_id" id="projectoutcomeindicator_id" class=\'chosen-select form-control\' onChange="GetTargets(this)" required="required">';

		 if(empty($projectoutcomeindicators))
		 {
			$indicatorselect .= '<option value="0">Select Indicator</option>';
		 }
		 else
		 {
		 	$indicatorselect .= '<option value="0">Select Indicator</option>';
		   foreach($projectoutcomeindicators as $key => $projectoutcomeindicator)
		   {
			   $indicatorselect .= '<option value="'.$projectoutcomeindicator['id'].'">'.$projectoutcomeindicator['outcomeindicator'].' ('.$projectoutcomeindicator['outcometype'].')</option>';
		   }
		 }

	   $indicatorselect .= '</select>';

	   echo $indicatorselect;
   }

   public function gettargets()
   {
	   $projectoutcomeindicator_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutcomeindicator_id']))));
	   $projectoutcomeindicator = $this->projectoutcomeindicatorsmodel->get_by_id($projectoutcomeindicator_id)->row();

	   $targetinput = '';
	   if(empty($projectoutcomeindicator))
	   {
	   }
	   else
	   {
		   $targetinput = '<table><tr><td>Target</td>
                    <td><input type="text" name="target" id="target" value="'.$projectoutcomeindicator->outcometarget.'" class="form-control" readonly>
                     </td></tr>

                     <tr><td>Reached</td>
                    <td><input type="text" name="reached" id="reached" class="form-control" onKeyPress="return isNumberKey(event);">
					<span class="help-block">
					<code>For qualitative enter 1 if met and 0 if not met </code>
					</span>
					
                     </td></tr>
					  <tr><td>Comments</td>
                    <td><textarea name="comments" id="comments"></textarea>
                     </td></tr>
					  <tr><td colspan="2">    <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick=\'addHistory(this)\'>VIEW HISTORY <i class="fa fa-refresh"></i></a> &nbsp; <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick=\'addReach(this)\'>ADD <i class="fa fa-plus"></i></a></td></tr>
					 </table>';
	   }

	   echo $targetinput;
   }


   public function addreach()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $projectoutcomeindicator_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutcomeindicator_id']))));
	   $report_month = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_month']))));
	   $report_year = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_year']))));
	   $reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST['reached']))));
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $comments = trim(addslashes(htmlspecialchars(rawurldecode($_POST['comments']))));


	   if(empty($project_id) || empty($projectoutcomeindicator_id)|| empty($report_month) || empty($report_year) || empty($reached)|| empty($comments) ){

		  echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> Please enteraall the required information
		   </div>
		  ';
	  }
	  else
	  {

	    $data = array(
               'project_id' => $project_id,
               'projectoutcomeindicator_id' => $projectoutcomeindicator_id,
               'report_month' => $report_month,
               'report_year' => $report_year,
               'reached' => $reached,
			   'comments' => $comments,
           );
           $this->db->insert('outcomeindicatortracking', $data);
	  }

		   $trackingtable = '<table class="table table-nomargin" width="100%">
                                                                <thead>
                                                                	<tr><th>Month</th><th>Year</th><th>Reach</th><th>Comments</th></tr>
                                                                </thead>
                                                                <tbody>';

			$indicatorstracking = $this->outcomeindicatortrackingmodel->get_list_by_indicator($projectoutcomeindicator_id);

			foreach($indicatorstracking as $key=>$indicatortracking)
			{
				$trackingtable .= '<tr><td>'.$indicatortracking['report_month'].'</td><td>'.$indicatortracking['report_year'].'</td><td>'.$indicatortracking['reached'].'</td><td>'.$indicatortracking['comments'].'</td></tr>';
			}





		$trackingtable .= '</tbody></table>';

		echo $trackingtable;
   }
   
   public function addhistory()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $projectoutcomeindicator_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutcomeindicator_id']))));
	   $report_month = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_month']))));
	   $report_year = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_year']))));
	   $reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST['reached']))));
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $comments = trim(addslashes(htmlspecialchars(rawurldecode($_POST['comments']))));


	   if(empty($project_id) || empty($projectoutcomeindicator_id)|| empty($report_month) || empty($report_year) || empty($reached)|| empty($comments) ){

		  echo '<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  Please view the tracking history below
		   </div>
		  ';
	  }
	  else
	  {

	    $data = array(
               'project_id' => $project_id,
               'projectoutcomeindicator_id' => $projectoutcomeindicator_id,
               'report_month' => $report_month,
               'report_year' => $report_year,
               'reached' => $reached,
			   'comments' => $comments,
           );
           $this->db->insert('outcomeindicatortracking', $data);
	  }

		   $trackingtable = '<table class="table table-nomargin" width="100%">
                                                                <thead>
                                                                	<tr><th>Month</th><th>Year</th><th>Reach</th><th>Comments</th></tr>
                                                                </thead>
                                                                <tbody>';

			$indicatorstracking = $this->outcomeindicatortrackingmodel->get_list_by_indicator($projectoutcomeindicator_id);

			foreach($indicatorstracking as $key=>$indicatortracking)
			{
				$trackingtable .= '<tr><td>'.$indicatortracking['report_month'].'</td><td>'.$indicatortracking['report_year'].'</td><td contenteditable="true" onBlur="saveToDatabase(this,\'reached\',\''.$indicatortracking['id'].'\')" onClick="showEdit(this);">'.$indicatortracking['reached'].'</td><td contenteditable="true" onBlur="saveToTheDatabase(this,\'comments\',\''.$indicatortracking['id'].'\')" onClick="showTheEdit(this);">'.$indicatortracking['comments'].'</td></tr>';
			}





		$trackingtable .= '</tbody></table>';

		echo $trackingtable;
   }
   
   
    public function editreached()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               'reached' => $editval,
           );
          $this->db->where('id', $id);
           $this->db->update('outcomeindicatortracking', $data);
		   
		   
   }
   
   public function editcomment()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               'comments' => $editval,
           );
          $this->db->where('id', $id);
           $this->db->update('outcomeindicatortracking', $data);
		   
		   
   }
   
   
   
   function download($project_id)
   {
	   $project = $this->projectsmodel->get_by_id($project_id)->row();

	   $projectoutcomeindicators = $this->projectoutcomeindicatorsmodel->get_list_by_project($project_id);
	   
	   $table = ' <table border="1" width="100%">';
	   $table .= '<thead>
	   <tr><th colspan="6">'.$project->project_title.'</th></tr>
		   <tr><th colspan="6">Outcome Indicators</th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Indicator</th><th>target</th><th>Reach</th><th>Status</th></tr>
		   </thead>';
		
	   $total_reached = 0;


	   if(empty($projectoutcomeindicators))
	   {
			$table .= '<tr><td colspan="6">No indicators added</td></tr>';
	   }
	   else
	   {

		  foreach($projectoutcomeindicators as $key => $projectoutcomeindicator)
		  {
			  $no_of_days = ($projectoutcomeindicator['outcomeimplementation_time']*30);
			  $target_end = $this->addDayswithdate($project->project_start_date, $no_of_days);

			  $thereach = $this->outcomeindicatortrackingmodel->getreach($projectoutcomeindicator['id']);
			  if(empty($thereach))
			  {
				  $reach = 0;
			  }
			  else
			  {
				  $reach = $thereach;
			  }
			  $thetarget = preg_replace("/[^0-9,.]/", "", $projectoutcomeindicator['outcometarget'] );

			  $targettext = preg_replace('/\d/', '',$projectoutcomeindicator['outcometarget'] );

			  //track status

			  $bgcolor = 'bgcolor="#FFFFFF"';

			  $today = date('Y-m-d');

			  if(!is_numeric($thetarget) || $thetarget==0)
			  {
				  $percentage = 0;
			  }
			  else
			  {
			 	$percentage = ($reach/$thetarget)*100;
			  }

			  if($target_end<$today)
			  {
				  if($percentage<100)
				  {
					  $bgcolor = 'bgcolor="#FF0000"';//overdue
				  }
				  else
				  {
					  $bgcolor = 'bgcolor="#00CC00"';//ontime
				  }
			  }
			  else
			  {
				  $start = strtotime($today);
				  $end = strtotime($target_end);



				  $days_between = ceil(abs($end - $start) / 86400);


				  if($days_between <=90)//3 months
				  {
					  if($percentage<=60)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=61 && $percentage<=80)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }//end 90 days check
				  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
				  {
					  if($percentage<=30)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=31 && $percentage<=50)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }
				  else
				  {
            /**
					  if($reach==0)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  else
					  {
					   	$bgcolor = 'bgcolor="#00CC00"';//ontime
					  }

            **/

            $bgcolor = 'bgcolor="#00CC00"';//ontime
				  }

			  }//end first else

			  $thestart = strtotime($today);
			  $theend = strtotime($target_end);
			  $the_days_between = ceil(abs($theend - $thestart) / 86400);

				  if($target_end<$today)
				  {
					  $days_left = 0;

				  }
				  else
				  {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				  }

			  $table .= '<tr><td>'.$target_end.'</td><td>'.$days_left.'</td><td>'.$projectoutcomeindicator['outcomeindicator'].'</td><td>'.$projectoutcomeindicator['outcometarget'].'</td><td>'.$reach.''.$targettext.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).'%</strong></td></tr>';
		  }

	   }

	   $table .= '</table>';

	    $filename = "Outcome_Indicators_Tracking_".$project->project_title."".date('dmY-his').".xls";
		
		$this->output->set_header("Content-Type: application/vnd.ms-excel");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=".$filename."");
		
		
	  $this->output->append_output($table);
   }



    function addDayswithdate($date,$days){

		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);

	}

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('outcomeindicatortracking','refresh');
       }
       $this->db->delete('outcomeindicatortracking', array('id' => $id));
       redirect('outcomeindicatortracking','refresh');
   }
   
   
    public function beneficiaryactivities()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['organizations'] = $this->db->get('organizations');
       $this->load->view('outcomeindicatortracking/beneficiaryactivities',$data);
   }
   
   function trackbeneficiaries()
	{
		$project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
		
		$project = $this->projectsmodel->get_by_id($project_id)->row();
		   
		   if(empty($project))
		   {
			   $display = '&nbsp;';
		   }
		   else
		   {
			   $display = $project->project_title;
		   }
		
		$projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
		
		if(empty($projectplannedactivities))
			{
			  $table = '<table class="table table-nomargin" width="100%">';
			  $table .= '<thead>
			   <tr><th colspan="6">'.$display.'</th></tr>
				   <tr><th colspan="6">Activities</th></tr>
				   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Target Beneficiaries</th><th>Beneficiaries Reached</th><th>Status</th></tr>
				   </thead>';
			}
			else
			{
			   $table = ' <table class="table table-nomargin" width="100%">';
			   $table .= '<thead>
				<tr><th colspan="6">'.$display.'</th></tr>
			   <tr><th colspan="6">Activities</th></tr>
			   <tr><th colspan="5">&nbsp;</th><th><a href="'.base_url().'index.php/outcomeindicatortracking/downloadbeneficiarytracking/'.$project_id.'"  class="btn btn-primary" target="_blank">DOWNLOAD</a></th></tr>
			   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Target Beneficiaries</th><th>Beneficiaries Reached</th><th>Status</th></tr>
			   </thead>';
			}
			
			
		   if(empty($projectplannedactivities))
		   {
				$table .= '<tr><td colspan="6">No Activities added</td></tr>';
		   }
		   else
		   {
			   
			  foreach($projectplannedactivities as $key=>$plannedactivity)
			  {
				  $today = date('Y-m-d');
				  $target_end = $plannedactivity['activity_end_date'];
					
				  $thestart = strtotime($today);
				  $theend = strtotime($plannedactivity['activity_end_date']);
				  $the_days_between = ceil(abs($theend - $thestart) / 86400);
				  
				  if($target_end<$today)
				  {
					  $days_left = 0;
	
				   }
				   else
				   {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				   }
				   
				   $beneficiaries_reached = $this->projectactivitiesmodel->get_by_activity($plannedactivity['id']);
				   $beneficaiary_target = $plannedactivity['total_beneficiary_target'];
				   
				   if(empty($beneficiaries_reached) || $beneficiaries_reached==0)
				   {
						   $percentage = 0;
				   }
				   else
				   {
					   if($beneficiaries_reached>$beneficaiary_target)
					   {
						   $percentage = 100;
					   }
					   else
					   {
					   	$percentage = ($beneficiaries_reached/$beneficaiary_target)*100;
					   }
				   }
				   
				   				   
					 if($target_end<$today)
					  {
						  if($percentage<100)
						  {
							  $bgcolor = 'bgcolor="#FF0000"';//overdue
						  }
						  else
						  {
							  $bgcolor = 'bgcolor="#00CC00"';//ontime
						  }
					  }
					  else
					  {
						  $start = strtotime($today);
							$end = strtotime($target_end);
							
							$days_between = ceil(abs($end - $start) / 86400);
							
							if($days_between <=90)//3 months
							{
								if($percentage<=75)
								{
									if($percentage<=50)
									{
										$bgcolor = 'bgcolor="#FF0000"';//overdue
									}
									else
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							elseif($days_between>=91 && $days_between<=180)//between 3 to 6 months
							{
								if($percentage<=50)
								{
									if($percentage<=25)
									{
										$bgcolor = 'bgcolor="#FF0000"';//overdue
									}
									else
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							elseif($days_between>=181 && $days_between<=270)//between 6 to 9 months
							{
								if($percentage<=25)
								{
									if($percentage<=12)
									{
										$bgcolor = 'bgcolor="#FF0000"';//overdue
									}
									else
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							elseif($days_between>=271 && $days_between<=362)// between 9 to 12 months
							{
								if($days_between>=271 && $days_between<=317)// if less than 10 monts (2 monhts of first year has elapsed)
								{
									if($percentage<=12)
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
									else
									{
										$bgcolor = 'bgcolor="#00CC00"';//ontime
									}
									
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							else //greater than 12 months
							{
								$bgcolor = 'bgcolor="#00CC00"';//ontime
							}
						  
					  }//end condition for checking if target end has been passed
					  
					  
					  $table .= '<tr><td>'.$plannedactivity['activity_end_date'].'</td><td>'.$days_left.'</td><td>'.$plannedactivity['activity'].'</td><td>'.$beneficaiary_target.'</td><td>'.$beneficiaries_reached.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).' %</strong></td></tr>';
					  
			  }// end for each
		   }//end else
			
		 
		 $table .= '</table>';
		   
		 echo $table;
		
		
	
	}
	
	
  public function downloadbeneficiarytracking($project_id)
  {
	  
	  		
		$project = $this->projectsmodel->get_by_id($project_id)->row();
		   
		   if(empty($project))
		   {
			   $display = '&nbsp;';
		   }
		   else
		   {
			   $display = $project->project_title;
		   }
		
		$projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
		
		if(empty($projectplannedactivities))
			{
			  $table = '<table class="table table-nomargin" border="1" width="100%">';
			  $table .= '<thead>
			   <tr><th colspan="6">'.$display.'</th></tr>
				   <tr><th colspan="6">Activities</th></tr>
				   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Target Beneficiaries</th><th>Beneficiaries Reached</th><th>Status</th></tr>
				   </thead>';
			}
			else
			{
			   $table = ' <table class="table table-nomargin" border="1" width="100%">';
			   $table .= '<thead>
				<tr><th colspan="6">'.$display.'</th></tr>
			   <tr><th colspan="6">Activities</th></tr>
			   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Target Beneficiaries</th><th>Beneficiaries Reached</th><th>Status</th></tr>
			   </thead>';
			}
			
			
		   if(empty($projectplannedactivities))
		   {
				$table .= '<tr><td colspan="6">No Activities added</td></tr>';
		   }
		   else
		   {
			   
			  foreach($projectplannedactivities as $key=>$plannedactivity)
			  {
				  $today = date('Y-m-d');
				  $target_end = $plannedactivity['activity_end_date'];
					
				  $thestart = strtotime($today);
				  $theend = strtotime($plannedactivity['activity_end_date']);
				  $the_days_between = ceil(abs($theend - $thestart) / 86400);
				  
				  if($target_end<$today)
				  {
					  $days_left = 0;
	
				   }
				   else
				   {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				   }
				   
				   $beneficiaries_reached = $this->projectactivitiesmodel->get_by_activity($plannedactivity['id']);
				   $beneficaiary_target = $plannedactivity['total_beneficiary_target'];
				   
				   if(empty($beneficiaries_reached) || $beneficiaries_reached==0)
				   {
						   $percentage = 0;
				   }
				   else
				   {
					   $percentage = ($beneficiaries_reached/$beneficaiary_target)*100;
				   }
				   
				   				   
					 if($target_end<$today)
					  {
						  if($percentage<100)
						  {
							  $bgcolor = 'bgcolor="#FF0000"';//overdue
						  }
						  else
						  {
							  $bgcolor = 'bgcolor="#00CC00"';//ontime
						  }
					  }
					  else
					  {
						  $start = strtotime($today);
							$end = strtotime($target_end);
							
							$days_between = ceil(abs($end - $start) / 86400);
							
							if($days_between <=90)//3 months
							{
								if($percentage<=75)
								{
									if($percentage<=50)
									{
										$bgcolor = 'bgcolor="#FF0000"';//overdue
									}
									else
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							elseif($days_between>=91 && $days_between<=180)//between 3 to 6 months
							{
								if($percentage<=50)
								{
									if($percentage<=25)
									{
										$bgcolor = 'bgcolor="#FF0000"';//overdue
									}
									else
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							elseif($days_between>=181 && $days_between<=270)//between 6 to 9 months
							{
								if($percentage<=25)
								{
									if($percentage<=12)
									{
										$bgcolor = 'bgcolor="#FF0000"';//overdue
									}
									else
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							elseif($days_between>=271 && $days_between<=362)// between 9 to 12 months
							{
								if($days_between>=271 && $days_between<=317)// if less than 10 monts (2 monhts of first year has elapsed)
								{
									if($percentage<=12)
									{
										$bgcolor = 'bgcolor="#FF9900"';//warning
									}
									else
									{
										$bgcolor = 'bgcolor="#00CC00"';//ontime
									}
									
								}
								else
								{
									$bgcolor = 'bgcolor="#00CC00"';//ontime
								}
							}
							else //greater than 12 months
							{
								$bgcolor = 'bgcolor="#00CC00"';//ontime
							}
						  
					  }//end condition for checking if target end has been passed
					  
					  
					  $table .= '<tr><td>'.$plannedactivity['activity_end_date'].'</td><td>'.$days_left.'</td><td>'.$plannedactivity['activity'].'</td><td>'.$beneficaiary_target.'</td><td>'.$beneficiaries_reached.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).' %</strong></td></tr>';
					  
			  }// end for each
		   }//end else
			
		 
		 $table .= '</table>';
	   $filename = "Project_Activity_Beneficiary_Tracking".date('dmY-his').".xls";
		
		$this->output->set_header("Content-Type: application/vnd.ms-excel");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=".$filename."");
		
		
	  $this->output->append_output($table);
  }
   
   
   public function plannedactivities()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['organizations'] = $this->db->get('organizations');
       $this->load->view('outcomeindicatortracking/plannedactivities',$data);
   }
   
   public function trackactivities()
   {
	   
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   	   
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   
	   if(empty($project))
	   {
		   $display = '&nbsp;';
	   }
	   else
	   {
		   $display = $project->project_title;
	   }
	   
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	  
	  if(empty($projectplannedactivities))
		{
		  $table = '<table class="table table-nomargin" width="100%">';
		  $table .= '<thead>
		   <tr><th colspan="6">'.$display.'</th></tr>
			   <tr><th colspan="6">Activities</th></tr>
			   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks (Main)</th><th>Completed Tasks</th><th>Status</th></tr>
			   </thead>';
		}
		else
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="4">Activities</th><th><a href="'.base_url().'index.php/outcomeindicatortracking/taskdetails/'.$project_id.'"  class="btn btn-success" >TASKS DETAILS</a></th><th><a href="'.base_url().'index.php/outcomeindicatortracking/downloadactivitylist/'.$project_id.'"  class="btn btn-primary" target="_blank">DOWNLOAD</a></th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks (Main)</th><th>Completed Tasks</th><th>Status</th></tr>
		   </thead>';
		}
		
	   if(empty($projectplannedactivities))
	   {
			$table .= '<tr><td colspan="6">No Activities added</td></tr>';
	   }
	   else
	   {
		
			foreach($projectplannedactivities as $key=>$plannedactivity)
			{
				
				 $today = date('Y-m-d');
				 $target_end = $plannedactivity['activity_end_date'];
				
				  $thestart = strtotime($today);
				  $theend = strtotime($plannedactivity['activity_end_date']);
				  $the_days_between = ceil(abs($theend - $thestart) / 86400);

				  if($target_end<$today)
				  {
					  $days_left = 0;

				  }
				  else
				  {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				  }
				  
				  
				  if(empty($plannedactivity['total_beneficiary_target']))
				  {
					  $thetarget = 0;
				  }
				  else
				  {
					  $thetarget = $plannedactivity['total_beneficiary_target'];
				  }
				  
				  
				  $bgcolor = 'bgcolor="#FFFFFF"';
				  
				  $thereach = $this->projectactivitiesmodel->get_by_activity($plannedactivity['id']);
				  
				  if(empty($thereach))
				  {
					  $reach = 0;
				  }
				  else
				  {
					  $reach = $thereach;
				  }
				  
				  /**
				  if(!is_numeric($thetarget) || $thetarget==0)
				  {
					  $percentage = 0;
				  }
				  else
				  {
					$percentage = ($reach/$thetarget)*100;
				  }
				  
				  **/
				  
				  $alltasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity['id']);
				  $activitytask = count($alltasks);
				  
				  $completed_tasks = 0;				  
				  
				  
				   $tasks = $this->rollingactionplansmodel->get_list_by_primary_activity($plannedactivity['id'],1);
				   $task_percentage = 0;
				   
				   $progress_aray = array();
				   
				   $total_tasks = count($tasks);
				   
				   if(empty($tasks))
				   {
					   $percentage = 0;
				   }
				   else
				   {
					  
					   foreach($tasks as $key => $task)
		   				{
							//$task_percentage .= $task_percentage+$task['progress'];
							
							//populate the array to get the median value
							//$progress_aray[] = $task['progress'];
							
							if($task['progress']==100)
							{
								$completed_tasks = $completed_tasks + 1;	
							}
						}
						
						//$percentage = $task_percentage/$total_tasks*1;
						
						
						
						if($completed_tasks==0)
						{
							$percentage = 0;
						}
						else
						{
						
							$percentage = ($completed_tasks/$total_tasks)*100;
						}
				   }
				  
				  
				  //$median_progress = $this->calculate_median($progress_aray);
				  
				  if($target_end<$today)
			  {
				  if($percentage<100)
				  {
					  $bgcolor = 'bgcolor="#FF0000"';//overdue
				  }
				  else
				  {
					  $bgcolor = 'bgcolor="#00CC00"';//ontime
				  }
			  }
			  else
			  {
				  $start = strtotime($today);
				  $end = strtotime($target_end);



				  $days_between = ceil(abs($end - $start) / 86400);


				  if($days_between <=90)//3 months
				  {
					  if($percentage<=60)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=61 && $percentage<=80)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }//end 90 days check
				  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
				  {
					  if($percentage<=30)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=31 && $percentage<=50)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }
				  else
				  {
            
            			$bgcolor = 'bgcolor="#00CC00"';//ontime
				  }

			  }//end first else
				  
				  
			  
				
				$table .= '<tr><td>'.$plannedactivity['activity_end_date'].'</td><td>'.$days_left.'</td><td>'.$plannedactivity['activity'].'</td><td>'.$total_tasks.'</td><td>'.$completed_tasks.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).' %</strong></td></tr>';
			}
	   }
		   
		   
		   
		   
	   $table .= '</table>';
	   
	   echo $table;
		   
   }
   
   
    public function downloadactivitylist($project_id)
   {
	   
	  	   	   
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   
	   if(empty($project))
	   {
		   $display = '&nbsp;';
	   }
	   else
	   {
		   $display = $project->project_title;
	   }
	   
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	  
	  if(empty($projectplannedactivities))
		{
		  $table = '<table class="table table-nomargin" width="100%">';
		  $table .= '<thead>
		   <tr><th colspan="6">'.$display.'</th></tr>
			   <tr><th colspan="6">Activities</th></tr>
			   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks (Main)</th><th>Completed Tasks</th><th>Status</th></tr>
			   </thead>';
		}
		else
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="5">Activities</th><th><a href="'.base_url().'index.php/outcomeindicatortracking/downloadactivitylist/'.$project_id.'"  class="btn btn-primary" target="_blank">DOWNLOAD</a></th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks</th><th>Completed Tasks</th><th>Status</th></tr>
		   </thead>';
		}
		
	   if(empty($projectplannedactivities))
	   {
			$table .= '<tr><td colspan="6">No Activities added</td></tr>';
	   }
	   else
	   {
		
			foreach($projectplannedactivities as $key=>$plannedactivity)
			{
				
				 $today = date('Y-m-d');
				 $target_end = $plannedactivity['activity_end_date'];
				
				  $thestart = strtotime($today);
				  $theend = strtotime($plannedactivity['activity_end_date']);
				  $the_days_between = ceil(abs($theend - $thestart) / 86400);

				  if($target_end<$today)
				  {
					  $days_left = 0;

				  }
				  else
				  {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				  }
				  
				  
				  if(empty($plannedactivity['total_beneficiary_target']))
				  {
					  $thetarget = 0;
				  }
				  else
				  {
					  $thetarget = $plannedactivity['total_beneficiary_target'];
				  }
				  
				  
				  $bgcolor = 'bgcolor="#FFFFFF"';
				  
				  $thereach = $this->projectactivitiesmodel->get_by_activity($plannedactivity['id']);
				  
				  if(empty($thereach))
				  {
					  $reach = 0;
				  }
				  else
				  {
					  $reach = $thereach;
				  }
				  
				  /**
				  if(!is_numeric($thetarget) || $thetarget==0)
				  {
					  $percentage = 0;
				  }
				  else
				  {
					$percentage = ($reach/$thetarget)*100;
				  }
				  
				  **/
				  
				  $alltasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity['id']);
				  $activitytask = count($alltasks);
				  
				  $completed_tasks = 0;				  
				  
				  
				   $tasks = $this->rollingactionplansmodel->get_list_by_primary_activity($plannedactivity['id'],1);
				   $task_percentage = 0;
				   
				   $progress_aray = array();
				   
				   $total_tasks = count($tasks);
				   
				   if(empty($tasks))
				   {
					   $percentage = 0;
				   }
				   else
				   {
					   
					   foreach($tasks as $key => $task)
		   				{
							//$task_percentage .= $task_percentage+$task['progress'];
							
							//populate the array to get the median value
							//$progress_aray[] = $task['progress'];
							
							if($task['progress']==100)
							{
								$completed_tasks = $completed_tasks + 1;	
							}
						}
						
						//$percentage = $task_percentage/$total_tasks*1;
						
						if($completed_tasks ==0)
						{
							$percentage = 0;
						}
						else
						{
							$percentage = ($total_tasks/$completed_tasks)*100;
						}
				   }
				  
				  
				  //$median_progress = $this->calculate_median($progress_aray);
				  
				  
				  if($target_end<$today)
			  {
				  if($percentage<100)
				  {
					  $bgcolor = 'bgcolor="#FF0000"';//overdue
				  }
				  else
				  {
					  $bgcolor = 'bgcolor="#00CC00"';//ontime
				  }
			  }
			  else
			  {
				  $start = strtotime($today);
				  $end = strtotime($target_end);



				  $days_between = ceil(abs($end - $start) / 86400);


				  if($days_between <=90)//3 months
				  {
					  if($percentage<=60)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=61 && $percentage<=80)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }//end 90 days check
				  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
				  {
					  if($percentage<=30)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  }
					  elseif($percentage>=31 && $percentage<=50)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
					  }
				  }
				  else
				  {
            
            			$bgcolor = 'bgcolor="#00CC00"';//ontime
				  }

			  }//end first else
				  
				  
			  
				
				$table .= '<tr><td>'.$plannedactivity['activity_end_date'].'</td><td>'.$days_left.'</td><td>'.$plannedactivity['activity'].'</td><td>'.$total_tasks.'</td><td>'.$completed_tasks.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).' %</strong></td></tr>';
			}
	   }
		   
		   
		   
		   
	   $table .= '</table>';
	   
	    $filename = "Project_Activity_Tracking".date('dmY-his').".xls";
		
		$this->output->set_header("Content-Type: application/vnd.ms-excel");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=".$filename."");
		
		
	  $this->output->append_output($table);
		   
   }
   
    public function taskdetails($project_id)
   {
	   
	  if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   
	   if(empty($project))
	   {
		   $display = '&nbsp;';
	   }
	   else
	   {
		   $display = $project->project_no.'/'.$project->project_title;
	   }
	   
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	  
	  if(empty($projectplannedactivities))
		{
		  $table = '<table class="table table-nomargin" width="100%">';
		  $table .= '<thead>
		   <tr><th colspan="6">'.$display.'</th></tr>
			   <tr><th colspan="6">Activities</th></tr>
			   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks (Main)</th><th>Completed Tasks</th><th>Status</th></tr>
			   </thead>';
		}
		else
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="5">Activities</th><th>&nbsp;</th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks</th><th>Completed Tasks</th><th>Status</th></tr>
		   </thead>';
		}
		
	   if(empty($projectplannedactivities))
	   {
			$table .= '<tr><td colspan="6">No Activities added</td></tr>';
	   }
	   else
	   {
		   
		   $accordion = '';
		
			foreach($projectplannedactivities as $key=>$plannedactivity)
			{
				
				 $today = date('Y-m-d');
				 $target_end = $plannedactivity['activity_end_date'];
				
				  $thestart = strtotime($today);
				  $theend = strtotime($plannedactivity['activity_end_date']);
				  $the_days_between = ceil(abs($theend - $thestart) / 86400);

				  if($target_end<$today)
				  {
					  $days_left = 0;

				  }
				  else
				  {
					  $the_days = ($the_days_between/30);
					  $days_left = number_format($the_days);
				  }
				  
				  
				  if(empty($plannedactivity['total_beneficiary_target']))
				  {
					  $thetarget = 0;
				  }
				  else
				  {
					  $thetarget = $plannedactivity['total_beneficiary_target'];
				  }
				  
				  
				  $bgcolor = 'bgcolor="#FFFFFF"';
				  
				  $thereach = $this->projectactivitiesmodel->get_by_activity($plannedactivity['id']);
				  
				  if(empty($thereach))
				  {
					  $reach = 0;
				  }
				  else
				  {
					  $reach = $thereach;
				  }
				  
				  /**
				  if(!is_numeric($thetarget) || $thetarget==0)
				  {
					  $percentage = 0;
				  }
				  else
				  {
					$percentage = ($reach/$thetarget)*100;
				  }
				  
				  **/
				  
				  $alltasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity['id']);
				  $activitytask = count($alltasks);
				  
				  $completed_tasks = 0;				  
				  
				  
				   $tasks = $this->rollingactionplansmodel->get_list_by_primary_activity($plannedactivity['id'],1);
				   $task_percentage = 0;
				   
				  $progress_aray = array();
				   
				   $total_tasks = count($tasks);
				   
				   if(empty($tasks))
				   {
					   $percentage = 0;
				   }
				   else
				   {
					  
					   foreach($tasks as $key => $task)
		   				{
							//$task_percentage .= $task_percentage+$task['progress'];
							
							//populate the array to get the median value
							//$progress_aray[] = $task['progress'];
							
							if($task['progress']==100)
							{
								$completed_tasks = $completed_tasks + 1;	
							}
						}
						
						//$percentage = $task_percentage/$total_tasks*1;
						
						
						if($completed_tasks==0)
						{
							$percentage = 0;
						}
						else
						{
							$percentage = ($completed_tasks/$total_tasks)*100;
						}
				   }
				  
				  
				  //$median_progress = $this->calculate_median($progress_aray);
				  
				  if($target_end<$today)
			  {
				  if($percentage<100)
				  {
					  $bgcolor = 'bgcolor="#FF0000"';//overdue
					  $label = 'label-danger';
				  }
				  else
				  {
					  $bgcolor = 'bgcolor="#00CC00"';//ontime
					  $label = 'label-success';
				  }
			  }
			  else
			  {
				  $start = strtotime($today);
				  $end = strtotime($target_end);



				  $days_between = ceil(abs($end - $start) / 86400);


				  if($days_between <=90)//3 months
				  {
					  if($percentage<=60)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
						  $label = 'label-danger';
					  }
					  elseif($percentage>=61 && $percentage<=80)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
						  $label = 'label-warning';
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
						   $label = 'label-success';
					  }
				  }//end 90 days check
				  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
				  {
					  if($percentage<=30)
					  {
						  $bgcolor = 'bgcolor="#FF0000"';//overdue
						  $label = 'label-danger';
					  }
					  elseif($percentage>=31 && $percentage<=50)
					  {
						  $bgcolor = 'bgcolor="#FF9900"';//warning
						  $label = 'label-warning';
					  }
					  else
					  {
						   $bgcolor = 'bgcolor="#00CC00"';//ontime
						   $label = 'label-success';
					  }
				  }
				  else
				  {
            
            			$bgcolor = 'bgcolor="#00CC00"';//ontime
				  }

			  }//end first else
			  
			  
			  $accordion .= '<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#c'.$plannedactivity['id'].'" data-toggle="collapse" data-parent="#ac4">
													'.$plannedactivity['activity'].'&nbsp;<span class="label '.$label.'">'.number_format($percentage).' %</span>
												</a>
											</h4>
											<!-- /.panel-title -->
										</div>';
				$accordion .= '<!-- /.panel-heading -->
										<div id="c'.$plannedactivity['id'].'" class="panel-collapse collapse">
											<div class="panel-body">';
											
			       $accordion .= ' <table class="table table-nomargin" width="100%">';
		   $accordion .= '<thead>
		   <tr><th>Target End</th><th>Months Left</th><th>Activity</th><th>Total Tasks</th><th>Completed Tasks</th><th>Status</th></tr>
		   </thead>';
		   
		   $accordion .= '<tr><td>'.$plannedactivity['activity_end_date'].'</td><td>'.$days_left.'</td><td>'.$plannedactivity['activity'].'</td><td>'.$total_tasks.'</td><td>'.$completed_tasks.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).' %</strong></td></tr>';
		   
		   
		   $accordion .= '</table>';
		   
		   
				$accordion .= '<table class="table table-nomargin" width="100%">';
				$accordion .= '<thead>';
				$accordion .= '<tr><th>Task</th><th>Start Date</th><th>End Date</th><th>Progress</th><th>responsible</th></tr>';
				$accordion .= '</thead>';
				
				 if(empty($tasks))
				   {
					   $percentage = 0;
				   }
				   else
				   {
					  
					   
					   foreach($tasks as $key => $task)
		   				{
							
							 $assignee_table = '<table with="100%">
						   <tr><th>Name</th><th>Contact</th><th>Email</th></tr>
						   ';
					   
							$responsiblepersons = $this->rollingactionplanassigneesmodel->get_list_by_plane($task['id']);
							
							 foreach($responsiblepersons as $key=>$responsibleperson)
							 {
								 $user = $this->usersmodel->get_by_id($responsibleperson['user_id'])->row();
								 $assignee_table .= '<tr><td>'.$user->fname.' '.$user->lname.'</td><td>'.$user->contact_number.'</td><td>'.$user->email.'</td></tr>';
								 
							 }
							 
							 $assignee_table .= '</table>';
							
							$accordion .= '<tr><td><strong>'.$task['description'].'</strong> ('.$task['task_name'].')</td><td>'.$task['start_date'].'</td><td>'.$task['end_date'].'</td><td>'.$task['progress'].'%</td><td>'.$assignee_table.'</td></tr>';
							
						}
						
						
						
						
				   }
				
				$accordion .= '</table>';
											
				
				
				$accordion .= '</div>
											<!-- /.panel-body -->
										</div>
										<!-- /#c1.panel-collapse collapse in -->
									</div>';
				  
				  
			  
				
				
				
				
				
				
				
			}
	   }
		   
		   
		   
		   
	   $table .= '</table>';
	   
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['organizations'] = $this->db->get('organizations');
	   $data['table'] = $table;
	   $data['accordion'] = $accordion;
	   $data['display'] = $display;
       $this->load->view('outcomeindicatortracking/taskdetails',$data);
		   
   }
   
   
    public function getprojects()
   {
	   
	   $organization_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['organization_id']))));
	   
	   $projects = $this->projectsmodel->get_list_by_organization($organization_id);
	   
	   $sectorselect = '<select id="project_id" name="project_id" onChange="GetActivities(this)" class=\'chosen-select form-control\' required="required">';
	   
	   $sectorselect .=  '<option value="">Select Project</option>';
	   
	   foreach($projects as $key=>$project)
		{
				
            $sectorselect .=  '<option value="'.$project['id'].'" >'.$project['project_no'].'/'.$project['project_title'].'</option>';
      
		}
					
					
	   $sectorselect .= '</select>';
	   
	   
	   echo $sectorselect;
	   
   }
   
   
    public function getoutcomeprojects()
   {
	   
	   $organization_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['organization_id']))));
	   
	   $projects = $this->projectsmodel->get_list_by_organization($organization_id);
	   
	   $sectorselect = '<select id="project_id" name="project_id" onChange="GetIndicators(this)" class=\'chosen-select form-control\' required="required">';
	   
	   $sectorselect .=  '<option value="">Select Project</option>';
	   
	   foreach($projects as $key=>$project)
		{
				
            $sectorselect .=  '<option value="'.$project['id'].'" >'.$project['project_no'].'/'.$project['project_title'].'</option>';
      
		}
					
					
	   $sectorselect .= '</select>';
	   
	   
	   echo $sectorselect;
	   
   }
   
   function calculate_median($arr) {
		sort($arr);
		$count = count($arr); //total numbers in array
		$middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
		if($count % 2) { // odd number, middle is the median
			$median = $arr[$middleval];
		} else { // even number, calculate avg of 2 medians
			$low = $arr[$middleval];
			$high = $arr[$middleval+1];
			$median = (($low+$high)/2);
		}
		return $median;
	}
	
	function calculate_average($arr) {
		$count = count($arr); //total numbers in array
		$total = 0;
		foreach ($arr as $value) {
			$total = $total + $value; // total value of array numbers
		}
		$average = ($total/$count); // get average value
		return $average;
	}

}

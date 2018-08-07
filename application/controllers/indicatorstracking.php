<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Indicatorstracking extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('indicatorstrackingmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('indicatorstracking'),
       );
       $this->load->view('indicatorstracking/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
       $this->load->view('indicatorstracking/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('projectoutputindicator_id', 'Projectoutputindicator id', 'trim|required');
       $this->form_validation->set_rules('report_month', 'Report month', 'trim|required');
       $this->form_validation->set_rules('report_year', 'Report year', 'trim|required');
       $this->form_validation->set_rules('reached', 'Reached', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'projectoutputindicator_id' => $this->input->post('projectoutputindicator_id'),
               'report_month' => $this->input->post('report_month'),
               'report_year' => $this->input->post('report_year'),
               'reached' => $this->input->post('reached'),
           );
           $this->db->insert('indicatorstracking', $data);
           redirect('indicatorstracking','refresh');
       }
   }


    public function trackindicator()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();


	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['organizations'] = $this->db->get('organizations');
       $this->load->view('indicatorstracking/trackindicator',$data);
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('indicatorstracking','refresh');
       }
       $row = $this->db->get_where('indicatorstracking', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('indicatorstracking','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('indicatorstracking/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       $this->form_validation->set_rules('projectoutputindicator_id', 'Projectoutputindicator id', 'trim|required');
       $this->form_validation->set_rules('report_month', 'Report month', 'trim|required');
       $this->form_validation->set_rules('report_year', 'Report year', 'trim|required');
       $this->form_validation->set_rules('reached', 'Reached', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
               'projectoutputindicator_id' => $this->input->post('projectoutputindicator_id'),
               'report_month' => $this->input->post('report_month'),
               'report_year' => $this->input->post('report_year'),
               'reached' => $this->input->post('reached'),
           );
           $this->db->where('id', $id);
           $this->db->update('indicatorstracking', $data);
           redirect('indicatorstracking','refresh');
       }
   }

   function tracklist()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $project = $this->projectsmodel->get_by_id($project_id)->row();

	   $projectoutputindicators = $this->projectoutputindicatorsmodel->get_list_by_project($project_id);
		
		if(empty($projectoutputindicators))
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="6">Output Indicators</th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Indicator</th><th>target</th><th>Reach</th><th>Status</th></tr>
		   </thead>';
		}
		else
		{
		   $table = ' <table class="table table-nomargin" width="100%">';
		   $table .= '<thead>
		   <tr><th colspan="5">Output Indicators</th><th><a href="'.base_url().'index.php/indicatorstracking/download/'.$project_id.'"  class="btn btn-primary" target="_blank">DOWNLOAD</a></th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Indicator</th><th>target</th><th>Reach</th><th>Status</th></tr>
		   </thead>';
		}

	   $total_reached = 0;


	   if(empty($projectoutputindicators))
	   {
			$table .= '<tr><td colspan="6">No indicators added</td></tr>';
	   }
	   else
	   {

		  foreach($projectoutputindicators as $key => $projectoutputindicator)
		  {
			  $no_of_days = ($projectoutputindicator['outputimplementation_time']*30);
			  $target_end = $this->addDayswithdate($project->project_start_date, $no_of_days);

			  $thereach = $this->indicatorstrackingmodel->getreach($projectoutputindicator['id']);
			  if(empty($thereach))
			  {
				  $reach = 0;
			  }
			  else
			  {
				  $reach = $thereach;
			  }
			  $thetarget = preg_replace("/[^0-9,.]/", "", $projectoutputindicator['outputtarget'] );

			  $targettext = preg_replace('/\d/', '',$projectoutputindicator['outputtarget'] );

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
            /***
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



			  $table .= '<tr><td>'.$target_end.'</td><td>'.number_format($days_left).'</td><td>'.$projectoutputindicator['outputindicator'].'</td><td>'.$projectoutputindicator['outputtarget'].'</td><td>'.$reach.''.$targettext.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).'%</strong></td></tr>';
		  }

	   }

	   $table .= '</table>';

	   echo $table;
   }
   
   
   function getoutputs()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $projectoutputs = $this->projectoutputsmodel->get_by_project_list($project_id);


	   $indicatorselect = '<select name="projectoutput_id" id="projectoutput_id" class=\'chosen-select form-control\' onChange="Getprojectindicators(this)" required="required">';

		 if(empty($projectoutputs))
		 {
			$indicatorselect .= '<option value="0">Select Output</option>';
		 }
		 else
		 {
		 	$indicatorselect .= '<option value="0">Select Output</option>';
		   foreach($projectoutputs as $key => $projectoutput)
		   {
			   $indicatorselect .= '<option value="'.$projectoutput['id'].'">'.$projectoutput['output'].'</option>';
		   }
		 }

	   $indicatorselect .= '</select>';

	   echo $indicatorselect;
   }
   
   function getoutputindicators()
   {
	   $projectoutput_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutput_id']))));

	   $projectoutputindicators = $this->projectoutputindicatorsmodel->get_list_by_output($projectoutput_id);


	   $indicatorselect = '<select name="projectoutputindicator_id" id="projectoutputindicator_id" class=\'chosen-select form-control\' onChange="GetTargets(this)" required="required">';

		 if(empty($projectoutputindicators))
		 {
			$indicatorselect .= '<option value="0">Select Indicator</option>';
		 }
		 else
		 {
		 	$indicatorselect .= '<option value="0">Select Indicator</option>';
		   foreach($projectoutputindicators as $key => $projectoutputindicator)
		   {
			   $indicatorselect .= '<option value="'.$projectoutputindicator['id'].'">'.$projectoutputindicator['outputindicator'].' ('.$projectoutputindicator['outputtype'].')</option>';
		   }
		 }

	   $indicatorselect .= '</select>';

	   echo $indicatorselect;
   }


   function getindicators()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));

	   $projectoutputindicators = $this->projectoutputindicatorsmodel->get_list_by_project($project_id);


	   $indicatorselect = '<select name="projectoutputindicator_id" id="projectoutputindicator_id" class=\'chosen-select form-control\' onChange="GetTargets(this)" required="required">';

		 if(empty($projectoutputindicators))
		 {
			$indicatorselect .= '<option value="0">Select Indicator</option>';
		 }
		 else
		 {
		 	$indicatorselect .= '<option value="0">Select Indicator</option>';
		   foreach($projectoutputindicators as $key => $projectoutputindicator)
		   {
			   $indicatorselect .= '<option value="'.$projectoutputindicator['id'].'">'.$projectoutputindicator['outputindicator'].' ('.$projectoutputindicator['outputtype'].')</option>';
		   }
		 }

	   $indicatorselect .= '</select>';

	   echo $indicatorselect;
   }

   public function gettargets()
   {
	   $projectoutputindicator_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutputindicator_id']))));
	   $projectoutputindicator = $this->projectoutputindicatorsmodel->get_by_id($projectoutputindicator_id)->row();

	   $targetinput = '';
	   if(empty($projectoutputindicator))
	   {
	   }
	   else
	   {
		   $targetinput = '<table><tr><td>Target</td>
                    <td><input type="text" name="target" id="target" value="'.$projectoutputindicator->outputtarget.'" class="form-control" readonly>
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
					  <tr><td colspan="2">    <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick=\'viewHistory(this)\'>VIEW HISTORY <i class="fa fa-refresh"></i></a> &nbsp;<a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick=\'addReach(this)\'>ADD <i class="fa fa-plus"></i></a></td></tr>
					 </table>';
	   }

	   echo $targetinput;
   }

   public function addreach()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $projectoutputindicator_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutputindicator_id']))));
	   $report_month = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_month']))));
	   $report_year = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_year']))));
	   $reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST['reached']))));
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $comments = trim(addslashes(htmlspecialchars(rawurldecode($_POST['comments']))));


	   if(empty($project_id) || empty($projectoutputindicator_id)|| empty($report_month) || empty($report_year) || empty($reached)|| empty($comments) ){

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
               'projectoutputindicator_id' => $projectoutputindicator_id,
               'report_month' => $report_month,
               'report_year' => $report_year,
               'reached' => $reached,
			   'comments' => $comments,
           );
           $this->db->insert('indicatorstracking', $data);
	  }

		   $trackingtable = '<table class="table table-nomargin" width="100%">
                                                                <thead>
                                                                	<tr><th>Month</th><th>Year</th><th>Reach</th><th>Comments</th></tr>
                                                                </thead>
                                                                <tbody>';

			$indicatorstracking = $this->indicatorstrackingmodel->get_list_by_indicator($projectoutputindicator_id);

			foreach($indicatorstracking as $key=>$indicatortracking)
			{
				$trackingtable .= '<tr><td>'.$indicatortracking['report_month'].'</td><td>'.$indicatortracking['report_year'].'</td><td>'.$indicatortracking['reached'].'</td><td>'.$indicatortracking['comments'].'</td></tr>';
			}





		$trackingtable .= '</tbody></table>';

		echo $trackingtable;
   }
   
   
   public function viewhistory()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $projectoutputindicator_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutputindicator_id']))));
	   $report_month = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_month']))));
	   $report_year = trim(addslashes(htmlspecialchars(rawurldecode($_POST['report_year']))));
	   $reached = trim(addslashes(htmlspecialchars(rawurldecode($_POST['reached']))));
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
	   $comments = trim(addslashes(htmlspecialchars(rawurldecode($_POST['comments']))));


	   if(empty($project_id) || empty($projectoutputindicator_id)|| empty($report_month) || empty($report_year) || empty($reached)|| empty($comments) ){

		  echo '<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  View the tracking history below
		   </div>
		  ';
	  }
	  else
	  {

	    $data = array(
               'project_id' => $project_id,
               'projectoutputindicator_id' => $projectoutputindicator_id,
               'report_month' => $report_month,
               'report_year' => $report_year,
               'reached' => $reached,
			   'comments' => $comments,
           );
           $this->db->insert('indicatorstracking', $data);
	  }

		   $trackingtable = '<table class="table table-nomargin" width="100%">
                                                                <thead>
                                                                	<tr><th>Month</th><th>Year</th><th>Reach</th><th>Comments</th></tr>
                                                                </thead>
                                                                <tbody>';

			$indicatorstracking = $this->indicatorstrackingmodel->get_list_by_indicator($projectoutputindicator_id);

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
           $this->db->update('indicatorstracking', $data);
		   
		   
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
           $this->db->update('indicatorstracking', $data);
		   
		   
   }

   function addDayswithdate($date,$days){

		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);

	}



	public function download($project_id)
	{
		
	   $project = $this->projectsmodel->get_by_id($project_id)->row();

	   $projectoutputindicators = $this->projectoutputindicatorsmodel->get_list_by_project($project_id);
		
		
		$table = ' <table border="1" width="100%">';
		$table .= '<thead>
		<tr><th colspan="6">'.$project->project_title.'</th></tr>
		   <tr><th colspan="6">Output Indicators</th></tr>
		   <tr><th>Target End</th><th>Months Left</th><th>Indicator</th><th>target</th><th>Reach</th><th>Status</th></tr>
		   </thead>';
		
	   $total_reached = 0;


	   if(empty($projectoutputindicators))
	   {
			$table .= '<tr><td colspan="6">No indicators added</td></tr>';
	   }
	   else
	   {

		  foreach($projectoutputindicators as $key => $projectoutputindicator)
		  {
			  $no_of_days = ($projectoutputindicator['outputimplementation_time']*30);
			  $target_end = $this->addDayswithdate($project->project_start_date, $no_of_days);

			  $thereach = $this->indicatorstrackingmodel->getreach($projectoutputindicator['id']);
			  if(empty($thereach))
			  {
				  $reach = 0;
			  }
			  else
			  {
				  $reach = $thereach;
			  }
			  $thetarget = preg_replace("/[^0-9,.]/", "", $projectoutputindicator['outputtarget'] );

			  $targettext = preg_replace('/\d/', '',$projectoutputindicator['outputtarget'] );

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
            /***
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



			  $table .= '<tr><td>'.$target_end.'</td><td>'.number_format($days_left).'</td><td>'.$projectoutputindicator['outputindicator'].'</td><td>'.$projectoutputindicator['outputtarget'].'</td><td>'.$reach.''.$targettext.'</td><td '.$bgcolor.'><strong>'.number_format($percentage).'%</strong></td></tr>';
		  }

	   }

	   $table .= '</table>';

	   $filename = "Indicators_Tracking_".$project->project_title."".date('dmY-his').".xls";
		
		$this->output->set_header("Content-Type: application/vnd.ms-excel");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=".$filename."");
		
		
	  $this->output->append_output($table);
	}
	
	
	 public function getprojects()
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

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('indicatorstracking','refresh');
       }
       $this->db->delete('indicatorstracking', array('id' => $id));
       redirect('indicatorstracking','refresh');
   }

}

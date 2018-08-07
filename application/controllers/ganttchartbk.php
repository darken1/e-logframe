<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
include(APPPATH . 'libraries/jgraph/jpgraph-3.5.0b1/src/jpgraph.php');
include(APPPATH . 'libraries/jgraph/jpgraph-3.5.0b1/src/jpgraph_gantt.php');
class Ganttchart extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('activitiesmodel');
   }

   public function index()
   {
		redirect('rollingactionplans','refresh');
   }

   public function actionplangantt($id)
   {
	if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplans','refresh');
       }
       $row = $this->db->get_where('rollingactionplans', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rollingactionplans','refresh');
       }
       $mydata = array(
           'row' => $row,
       );

	$project = $this->projectsmodel->get_by_id($row->project_id)->row();
	$plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
	$subtitle = "(".$plannedactivity->activity." Rolling Action Plan)";

	$graph = new GanttGraph();
	$graph->SetShadow();

	// Add title and subtitle
	$graph->title->Set($project->project_title);
	$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
	$graph->subtitle->Set($subtitle);

	// Show day, week and month scale
	$graph->ShowHeaders(GANTT_HDAY | GANTT_HWEEK | GANTT_HMONTH);

	// Instead of week number show the date for the first day in the week
	// on the week scale
	$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

	// Make the week scale font smaller than the default
	$graph->scale->week->SetFont(FF_FONT0);

	// Use the short name of the month together with a 2 digit year
	// on the month scale
	$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR4);
	$graph->scale->month->SetFontColor("white");
	$graph->scale->month->SetBackgroundColor("blue");

	// Format the bar for the first activity
	// ($row,$title,$startdate,$enddate)
	$dependancy = $this->rollingactionplandependanciesmodel->get_by_action_plan($row->id)->row();

	if(empty($dependancy))
	{
		$task = wordwrap($row->task_name, 50, "\n", 1);
		$activity = new GanttBar(0,$task,$row->start_date,$row->end_date,"[".$row->progress."%]");
		// Yellow diagonal line pattern on a red background
		$activity->SetPattern(BAND_RDIAG,"yellow");
		$activity->SetFillColor("red");

		// Set absolute height
		$activity->SetHeight(10);

		// Specify progress
		if($row->progress==0)
		{
			$activitypercentage = 0;
		}
		else
		{
			$activitypercentage = ($row->progress/100);
		}
		$activity->progress->Set($activitypercentage);

		// Finally add the bar to the graph
		$graph->Add($activity);

		// Create a miletone
		$milestones = $this->rollingactionplanmilestonesmodel->get_list_by_plan($row->id);
		if(empty($milestones))
		{
			//no milestones added
		}
		else
		{
			foreach($milestones as $taskmilestone)
			{
				$milestone = new MileStone($taskmilestone['id'],$taskmilestone['milestone'],$taskmilestone['milestone_date'],$taskmilestone['milestone_date']);
				$milestone->title->SetColor("black");
				$milestone->title->SetFont(FF_FONT1,FS_BOLD);
				$graph->Add($milestone);
			}
		}

	}
	else
	{
		//
		// The data for the graphs
		//

		$task = wordwrap($row->task_name, 50, "\n", 1);
		$actionplan = $this->rollingactionplansmodel->get_by_id($dependancy->dependancy_id)->row();
		$data = array(

			array(1,ACTYPE_NORMAL,   $task,      $row->start_date,$row->end_date,'['.$row->progress.'%]'),
			array(2,ACTYPE_NORMAL,   $actionplan->task_name,      $actionplan->start_date,$actionplan->end_date,'['.$actionplan->progress.'%]') );

		// The constrains between the activities
		$constrains = array(array(2,1,CONSTRAIN_ENDSTART));

		if($row->progress==0)
		{
			$progressone = 0;
		}
		else
		{
			$progressone = $activitypercentage = ($row->progress/100);
		}

		if($actionplan->progress==0)
		{
			$progresstwo = 0;
		}
		else
		{
			$progresstwo = $activitypercentage = ($actionplan->progress/100);
		}


		$progress = array(array($progressone,$progresstwo));



		// Create the basic graph
		$graph = new GanttGraph();
		$graph->title->Set($project->project_title);
		$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
		$graph->subtitle->Set($subtitle);
		//$graph->SetFrame(false);

		// Create a miletone
		$milestones = $this->rollingactionplanmilestonesmodel->get_list_by_plan($row->id);
		if(empty($milestones))
		{
			//no milestones added
		}
		else
		{
			foreach($milestones as $taskmilestone)
			{
				$milestone = new MileStone($taskmilestone['id'],$taskmilestone['milestone'],$taskmilestone['milestone_date'],$taskmilestone['milestone_date']);
				$milestone->title->SetColor("black");
				$milestone->title->SetFont(FF_FONT1,FS_BOLD);
				$graph->Add($milestone);
			}
		}

		// Setup scale
		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAYWNBR);

		// Add the specified activities
		$graph->CreateSimple($data,$constrains,$progress);
	}


		// image to the browser
		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

		// Stroke image to a file and browser

		// Default is PNG so use ".png" as suffix
		$fileName = "./documents/action_plan_".$id.".jpg";
		$graph->img->Stream($fileName);

		// Send it back to browser
		//$graph->img->Headers();
		//$graph->img->Stream();



		$mydata['gantt'] = '<img src="'.base_url().'/documents/action_plan_'.$id.'.jpg">';
		$mydata['projects'] = $this->db->get('projects');
	    $mydata['rollingactionplans'] = $this->rollingactionplansmodel->get_list();
	    $mydata['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->id);
	    $mydata['users'] = $this->usersmodel->get_list();

		$this->load->view('rollingactionplans/gantt',$mydata);
   }

   public function detail($id)
   {
	if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rollingactionplans','refresh');
       }
       $row = $this->db->get_where('rollingactionplans', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rollingactionplans','refresh');
       }
       $mydata = array(
           'row' => $row,
       );

	$project = $this->projectsmodel->get_by_id($row->project_id)->row();
	$plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
	$subtitle = "(".$plannedactivity->activity." Rolling Action Plan)";

	$graph = new GanttGraph();
	$graph->SetShadow();

	// Add title and subtitle
	$graph->title->Set($project->project_title);
	$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
	$graph->subtitle->Set($subtitle);

	// Show day, week and month scale
	$graph->ShowHeaders(GANTT_HDAY | GANTT_HWEEK | GANTT_HMONTH);

	// Instead of week number show the date for the first day in the week
	// on the week scale
	$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

	// Make the week scale font smaller than the default
	$graph->scale->week->SetFont(FF_FONT0);

	// Use the short name of the month together with a 2 digit year
	// on the month scale
	$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR4);
	$graph->scale->month->SetFontColor("white");
	$graph->scale->month->SetBackgroundColor("blue");

	// Format the bar for the first activity
	// ($row,$title,$startdate,$enddate)
	$dependancy = $this->rollingactionplandependanciesmodel->get_by_action_plan($row->id)->row();

	if(empty($dependancy))
	{
		$task = wordwrap($row->task_name, 50, "\n", 1);
		$activity = new GanttBar(0,$task,$row->start_date,$row->end_date,"[".$row->progress."%]");
		// Yellow diagonal line pattern on a red background
		$activity->SetPattern(BAND_RDIAG,"yellow");
		$activity->SetFillColor("red");

		// Set absolute height
		$activity->SetHeight(10);

		// Specify progress
		if($row->progress==0)
		{
			$activitypercentage = 0;
		}
		else
		{
			$activitypercentage = ($row->progress/100);
		}
		$activity->progress->Set($activitypercentage);

		// Finally add the bar to the graph
		$graph->Add($activity);

		// Create a miletone
		$milestones = $this->rollingactionplanmilestonesmodel->get_list_by_plan($row->id);
		if(empty($milestones))
		{
			//no milestones added
		}
		else
		{
			foreach($milestones as $taskmilestone)
			{
				$milestone = new MileStone($taskmilestone['id'],$taskmilestone['milestone'],$taskmilestone['milestone_date'],$taskmilestone['milestone_date']);
				$milestone->title->SetColor("black");
				$milestone->title->SetFont(FF_FONT1,FS_BOLD);
				$graph->Add($milestone);
			}
		}

	}
	else
	{
		//
		// The data for the graphs
		//

		$task = wordwrap($row->task_name, 50, "\n", 1);
		$actionplan = $this->rollingactionplansmodel->get_by_id($dependancy->dependancy_id)->row();
		$data = array(

			array(1,ACTYPE_NORMAL,   $task."\n\n\n\n\n",      $row->start_date,$row->end_date,'['.$row->progress.'%]'),
			array(2,ACTYPE_NORMAL,   $actionplan->task_name."\n\n\n\n\n",      $actionplan->start_date,$actionplan->end_date,'['.$actionplan->progress.'%]') );

		// The constrains between the activities
		$constrains = array(array(2,1,CONSTRAIN_ENDSTART));

		if($row->progress==0)
		{
			$progressone = 0;
		}
		else
		{
			$progressone = $activitypercentage = ($row->progress/100);
		}

		if($actionplan->progress==0)
		{
			$progresstwo = 0;
		}
		else
		{
			$progresstwo = $activitypercentage = ($actionplan->progress/100);
		}


		$progress = array(array($progressone,$progresstwo));



		// Create the basic graph
		$graph = new GanttGraph();
		$graph->title->Set($project->project_title);
		$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
		$graph->subtitle->Set($subtitle);
		//$graph->SetFrame(false);

		// Create a miletone
		$milestones = $this->rollingactionplanmilestonesmodel->get_list_by_plan($row->id);
		if(empty($milestones))
		{
			//no milestones added
		}
		else
		{
			foreach($milestones as $taskmilestone)
			{
				$milestone = new MileStone($taskmilestone['id'],$taskmilestone['milestone'],$taskmilestone['milestone_date'],$taskmilestone['milestone_date']);
				$milestone->title->SetColor("black");
				$milestone->title->SetFont(FF_FONT1,FS_BOLD);
				$graph->Add($milestone);
			}
		}

		// Setup scale
		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAYWNBR);

		// Add the specified activities
		$graph->CreateSimple($data,$constrains,$progress);
	}


		// image to the browser
		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

		// Stroke image to a file and browser

		// Default is PNG so use ".png" as suffix
		$fileName = "./documents/action_plan_".$id.".jpg";
		$graph->img->Stream($fileName);

		// Send it back to browser
		//$graph->img->Headers();
		//$graph->img->Stream();


		$rollingactionplanlogs = $this->rollingactionplanlogsmodel->get_list_by_action_plan($row->id);

		$logstable = '<table class="table table-hover table-nomargin">
	   <thead>
	   <tr><th>Date</th><th>Description</th><th>Progress</th><th>Hours Worked</th><th>Log By</th></tr>
	   </thead>
	   <tbody>';

		foreach($rollingactionplanlogs as $key=>$rollingactionplanlog)
		{
			$user = $this->usersmodel->get_by_id($rollingactionplanlog['user_id'])->row();
			$logstable .= '<tr><td>'.$rollingactionplanlog['tasklog_date'].'</td><td>'.$rollingactionplanlog['description'].'</td><td>'.$rollingactionplanlog['progress'].'%</td><td>'.$rollingactionplanlog['hours_worked'].'</td><td>'.$user->fname.' '.$user->lname.'</td></tr>';
		}

		$logstable .= '
		</tbody>
		</table>';

		$mydata['logstable'] = $logstable;
		$mydata['gantt'] = '<img src="'.base_url().'/documents/action_plan_'.$id.'.jpg">';
		$mydata['projects'] = $this->db->get('projects');
	    $mydata['rollingactionplans'] = $this->rollingactionplansmodel->get_list();
	    $mydata['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->id);
	    $mydata['users'] = $this->usersmodel->get_list();
		$activities_for_task = $this->projectactivitiesmodel->get_by_task($id);
		$mydata['activities_for_task'] = $activities_for_task;

		$this->load->view('rollingactionplans/updatetask',$mydata);
   }

   function addtasklogs()
   {
	    $rollingactionplan_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['rollingactionplan_id']))));
		$tasklog_date = trim(addslashes(htmlspecialchars(rawurldecode($_POST['tasklog_date']))));
		$progress = trim(addslashes(htmlspecialchars(rawurldecode($_POST['progress']))));
		$hours_worked = trim(addslashes(htmlspecialchars(rawurldecode($_POST['hours_worked']))));
		$description = trim(addslashes(htmlspecialchars(rawurldecode($_POST['description']))));

		if (empty($rollingactionplan_id) || empty($tasklog_date) || empty($progress) || empty($hours_worked) || empty($description))
		 {

			  echo '<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Warning!</strong> Please fill in all the required fields
			   </div>
			  ';

		 }
		 else
		 {
			$user_id = $this->erkanaauth->getField('id');
			$data = array(
				   'rollingactionplan_id' => $rollingactionplan_id,
				   'tasklog_date' => $tasklog_date,
				   'progress' => $progress,
				   'hours_worked' => $hours_worked,
				   'description' => $description,
				   'user_id' => $user_id,
			   );
			$this->db->insert('rollingactionplanlogs', $data);

			$plandata = array(
				   'progress' => $progress,
			   );
			$this->db->where('id', $rollingactionplan_id);
			$this->db->update('rollingactionplans', $plandata);

				echo '<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Task log successfully added
			   </div>
			  ';
		 }

		$rollingactionplanlogs = $this->rollingactionplanlogsmodel->get_list_by_action_plan($rollingactionplan_id);

		$logstable = '<table class="table table-hover table-nomargin">
	   <thead>
	   <tr><th>Date</th><th>Description</th><th>Progress</th><th>Hours Worked</th><th>Log By</th></tr>
	   </thead>
	   <tbody>';

		foreach($rollingactionplanlogs as $key=>$rollingactionplanlog)
		{
			$user = $this->usersmodel->get_by_id($rollingactionplanlog['user_id'])->row();
			$logstable .= '<tr><td>'.$rollingactionplanlog['tasklog_date'].'</td><td>'.$rollingactionplanlog['description'].'</td><td>'.$rollingactionplanlog['progress'].'%</td><td>'.$rollingactionplanlog['hours_worked'].'</td><td>'.$user->fname.' '.$user->lname.'</td></tr>';
		}

		$logstable .= '
		</tbody>
		</table>';

		echo $logstable;
   }

   function mytasks()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }

	   $data = array();

	   $user_id = $this->erkanaauth->getField('id');

	   $data['rollingactionplanassignees'] = $this->rollingactionplanassigneesmodel->get_list_by_user($user_id);

	   $this->load->view('rollingactionplans/mytasklist',$data);


   }
   
    function getcharts()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }

	   $data = array();

	   $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	   $data['organizations'] = $this->db->get('organizations');

	   $this->load->view('rollingactionplans/getcharts',$data);


   }

   public function projectgantt()
   {
	   $viewdata = array();
	   
	   $project_id = $this->input->post('project_id');
	   $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);

      $project = $this->projectsmodel->get_by_id($project_id)->row();

	    if(empty($projectplannedactivities))
		{

        $viewdata['gantt'] = '';
		$viewdata['project'] = $project;

			$this->load->view('rollingactionplans/projectgantt',$viewdata);

	   }
		else
		{
      $i=-1;

      $thearray = array();
			foreach($projectplannedactivities as $key=>$plannedactivity)
			{
        $i++;

          $thearray[] =$i;
          $thearray[] = ACTYPE_GROUP;
          $thearray[] = $plannedactivity['activity'];
          if($plannedactivity['activity_start_date']=='0000-00-00')
          {
            $thearray[] = $project->project_start_date;
          }
          else {

            $thearray[] = $plannedactivity['activity_start_date'];
          }

          if($plannedactivity['activity_end_date']=='0000-00-00')
          {
            $thearray[] = $project->project_end_date;
          }
          else {

            $thearray[] = $plannedactivity['activity_end_date'];
          }

          $thearray[] = '';

          $tasks = $this->rollingactionplansmodel->get_list_by_activity($plannedactivity['id']);

          //$count = count($tasks);

          //echo $count;

          if(empty($tasks))
          {

          }
          else {
            $subtaskarray = array();

            foreach ($tasks as $key => $task) {

              $i++;

              $thearray[] =$i;
              $thearray[] = ACTYPE_NORMAL;
              $thearray[] = $task['task_name'];
              $thearray[] = $task['start_date'];
              $thearray[] = $task['end_date'];
              $thearray[] = '';

            }

            //$sub_array = array_chunk($subtaskarray,6,false);

          }

			}



      $task_array = array_chunk($thearray,6,false);

    $data = $task_array;


      //print_r($data);


      $constrains = array( );

      $graphtitle = $project->project_no.'/'.$project->project_title;

    		// Create the basic graph
    		$graph = new GanttGraph();
    		$graph->title->Set($graphtitle);

    		// Setup scale
    		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
    		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

    		// Add the specified activities
    		$graph->CreateSimple($data,$constrains);


    		// image to the browser
    		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

    		// Stroke image to a file and browser

    		// Default is PNG so use ".png" as suffix
    		$fileName = "./documents/project_".$project_id."_gantt.jpg";
    		$graph->img->Stream($fileName);

        //echo '<img src="'.base_url().'documents/project_'.$project_id.'_gantt.jpg">';
		$viewdata['gantt'] = '<img src="'.base_url().'documents/project_'.$project_id.'_gantt.jpg">';
		$viewdata['project'] = $project;
		
		$viewdata['gantt_image'] = 'project_'.$project_id.'_gantt.jpg';

		$this->load->view('rollingactionplans/projectgantt',$viewdata);


		}


   }
   
   
   
   public function projectactivitygantt()
   {
	if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
     }
      
	  
	  $viewdata = array();
	   
	  $project_id = $this->input->post('project_id');
	  $projectplannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);

      $project = $this->projectsmodel->get_by_id($project_id)->row();
	 
	$subtitle = "(Activity Gantt Chart)";

	$graph = new GanttGraph();
	$graph->SetShadow();

	// Add title and subtitle
	$graph->title->Set($project->project_title);
	$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
	$graph->subtitle->Set($subtitle);

	// Show day, week and month scale
	$graph->ShowHeaders(GANTT_HDAY | GANTT_HWEEK | GANTT_HMONTH);

	// Instead of week number show the date for the first day in the week
	// on the week scale
	$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

	// Make the week scale font smaller than the default
	$graph->scale->week->SetFont(FF_FONT0);

	// Use the short name of the month together with a 2 digit year
	// on the month scale
	$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR4);
	$graph->scale->month->SetFontColor("white");
	$graph->scale->month->SetBackgroundColor("blue");

	// Format the bar for the first activity
	// ($row,$title,$startdate,$enddate)
	$dependancy = $this->rollingactionplandependanciesmodel->get_by_action_plan($row->id)->row();

	if(empty($dependancy))
	{
		$task = wordwrap($row->task_name, 50, "\n", 1);
		$activity = new GanttBar(0,$task,$row->start_date,$row->end_date,"[".$row->progress."%]");
		// Yellow diagonal line pattern on a red background
		$activity->SetPattern(BAND_RDIAG,"yellow");
		$activity->SetFillColor("red");

		// Set absolute height
		$activity->SetHeight(10);

		// Specify progress
		if($row->progress==0)
		{
			$activitypercentage = 0;
		}
		else
		{
			$activitypercentage = ($row->progress/100);
		}
		$activity->progress->Set($activitypercentage);

		// Finally add the bar to the graph
		$graph->Add($activity);

		// Create a miletone
		$milestones = $this->rollingactionplanmilestonesmodel->get_list_by_plan($row->id);
		if(empty($milestones))
		{
			//no milestones added
		}
		else
		{
			foreach($milestones as $taskmilestone)
			{
				$milestone = new MileStone($taskmilestone['id'],$taskmilestone['milestone'],$taskmilestone['milestone_date'],$taskmilestone['milestone_date']);
				$milestone->title->SetColor("black");
				$milestone->title->SetFont(FF_FONT1,FS_BOLD);
				$graph->Add($milestone);
			}
		}

	}
	else
	{
		//
		// The data for the graphs
		//

		$task = wordwrap($row->task_name, 50, "\n", 1);
		$actionplan = $this->rollingactionplansmodel->get_by_id($dependancy->dependancy_id)->row();
		$data = array(

			array(1,ACTYPE_NORMAL,   $task."\n\n\n\n\n",      $row->start_date,$row->end_date,'['.$row->progress.'%]'),
			array(2,ACTYPE_NORMAL,   $actionplan->task_name."\n\n\n\n\n",      $actionplan->start_date,$actionplan->end_date,'['.$actionplan->progress.'%]') );

		// The constrains between the activities
		$constrains = array(array(2,1,CONSTRAIN_ENDSTART));

		if($row->progress==0)
		{
			$progressone = 0;
		}
		else
		{
			$progressone = $activitypercentage = ($row->progress/100);
		}

		if($actionplan->progress==0)
		{
			$progresstwo = 0;
		}
		else
		{
			$progresstwo = $activitypercentage = ($actionplan->progress/100);
		}


		$progress = array(array($progressone,$progresstwo));



		// Create the basic graph
		$graph = new GanttGraph();
		$graph->title->Set($project->project_title);
		$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
		$graph->subtitle->Set($subtitle);
		//$graph->SetFrame(false);

		// Create a miletone
		$milestones = $this->rollingactionplanmilestonesmodel->get_list_by_plan($row->id);
		if(empty($milestones))
		{
			//no milestones added
		}
		else
		{
			foreach($milestones as $taskmilestone)
			{
				$milestone = new MileStone($taskmilestone['id'],$taskmilestone['milestone'],$taskmilestone['milestone_date'],$taskmilestone['milestone_date']);
				$milestone->title->SetColor("black");
				$milestone->title->SetFont(FF_FONT1,FS_BOLD);
				$graph->Add($milestone);
			}
		}

		// Setup scale
		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAYWNBR);

		// Add the specified activities
		$graph->CreateSimple($data,$constrains,$progress);
	}


		// image to the browser
		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

		// Stroke image to a file and browser

		// Default is PNG so use ".png" as suffix
		$fileName = "./documents/action_plan_".$id.".jpg";
		$graph->img->Stream($fileName);

		// Send it back to browser
		//$graph->img->Headers();
		//$graph->img->Stream();


		$rollingactionplanlogs = $this->rollingactionplanlogsmodel->get_list_by_action_plan($row->id);

		$logstable = '<table class="table table-hover table-nomargin">
	   <thead>
	   <tr><th>Date</th><th>Description</th><th>Progress</th><th>Hours Worked</th><th>Log By</th></tr>
	   </thead>
	   <tbody>';

		foreach($rollingactionplanlogs as $key=>$rollingactionplanlog)
		{
			$user = $this->usersmodel->get_by_id($rollingactionplanlog['user_id'])->row();
			$logstable .= '<tr><td>'.$rollingactionplanlog['tasklog_date'].'</td><td>'.$rollingactionplanlog['description'].'</td><td>'.$rollingactionplanlog['progress'].'%</td><td>'.$rollingactionplanlog['hours_worked'].'</td><td>'.$user->fname.' '.$user->lname.'</td></tr>';
		}

		$logstable .= '
		</tbody>
		</table>';

		$mydata['logstable'] = $logstable;
		$mydata['gantt'] = '<img src="'.base_url().'/documents/action_plan_'.$id.'.jpg">';
		$mydata['projects'] = $this->db->get('projects');
	    $mydata['rollingactionplans'] = $this->rollingactionplansmodel->get_list();
	    $mydata['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->id);
	    $mydata['users'] = $this->usersmodel->get_list();
		$activities_for_task = $this->projectactivitiesmodel->get_by_task($id);
		$mydata['activities_for_task'] = $activities_for_task;

		$this->load->view('rollingactionplans/updatetask',$mydata);
   }

    public function nanhri()
   {
	   $data = array(
    array(0,ACTYPE_GROUP,    "Inception",        "2016-01-11","2016-01-15",''),
	array(1,ACTYPE_NORMAL,   " Review project plan and verify database & website requirements and agree with the NANHRI' team",      "2016-01-15","2016-01-15",''),
	array(2,ACTYPE_NORMAL,   "  Prepare requirements specification document based on the needs analysis",      "2016-01-13","2016-01-15",''),
	array(3,ACTYPE_NORMAL,   "  Carry-out an in-depth review of the NANHRI' website with the relevant staff to  understand requirements and advice on flow of information",      "2016-01-12","2016-01-13",''),
	array(4,ACTYPE_NORMAL,   "  Assign roles and allocate resources",      "2016-01-12","2016-01-12",''),
    array(5,ACTYPE_NORMAL,   "  Determine project resources",      "2016-01-11","2016-01-11",''),
    array(6,ACTYPE_NORMAL,   "  Establish on the Ground Presence and Meet with Client; and Hold Kick-Off  meetings",      "2016-01-11","2016-01-11",''),
	array(7,ACTYPE_MILESTONE,"  Inception Completed, specification document ready", "2016-01-15",'M1'),
	array(8,ACTYPE_GROUP,    "Elaboration",        "2016-01-18","2016-01-29",''),
	array(9,ACTYPE_NORMAL,   " Review website design concepts & functional prototype and agree with the NANHRI project team",      "2016-01-28","2016-01-29",''),
	array(10,ACTYPE_NORMAL,   " Design wireframes and creative design concepts",      "2016-01-25","2016-01-28",''),
	array(11,ACTYPE_NORMAL,   " Design system architecture, flow diagrams and use cases covering all key aspects of design",      "2016-01-20","2016-01-22",''),
	array(12,ACTYPE_NORMAL,   " Develop mock-ups of all fields and forms required by the respective application modules",      "2016-01-18","2016-01-20",''),
	array(13,ACTYPE_MILESTONE,"  Elaboration Completed, website design templates ready", "2016-01-29",'M2'),
	array(14,ACTYPE_GROUP,    "Construction",        "2016-02-01","2016-02-12",''),
	array(15,ACTYPE_NORMAL,    "Plug in CMS to the HTML5 Design elements",        "2016-02-10","2016-02-12",''),
	array(16,ACTYPE_NORMAL,    "Build database tables",        "2016-02-09","2016-02-09",''),
	array(17,ACTYPE_NORMAL,    "Identify database table relationships",        "2016-02-09","2016-02-09",''),
	array(18,ACTYPE_NORMAL,   " Present design to NANHRI and discuss changes/modifications and Incorporate design modifications on final produced design.",      "2016-02-08","2016-02-08",''),
	array(19,ACTYPE_NORMAL,   " Optimize graphics for responsive device display and test design elements on various devices",      "2016-02-04","2016-02-05",''),
	array(20,ACTYPE_NORMAL,   " Convert PSD layouts to actual HTML5 elements",      "2016-02-01","2016-02-03",''),
	array(21,ACTYPE_MILESTONE,"  Construction Completed, website ready for testing and deployment", "2016-02-12",'M3'),
	array(22,ACTYPE_GROUP,    "Transition",        "2016-02-15","2016-02-25",''),
	array(23,ACTYPE_NORMAL,   " Project hand over & project completion report",      "2016-02-25","2016-02-25",''),
	array(24,ACTYPE_NORMAL,   " CMS Administrator training",      "2016-02-24","2016-02-25",''),
	array(25,ACTYPE_NORMAL,   " Design and layout hard copy training manual",      "2016-02-22","2016-02-23",''),
	array(26,ACTYPE_NORMAL,   " Move application to production servers and testing functionality on the same environment.",      "2016-02-17","2016-02-19",''),
	array(27,ACTYPE_NORMAL,   " Content repurposing and population",      "2016-02-16","2016-02-17",''),
	array(28,ACTYPE_NORMAL,   " Connect selected web analytics for web server logs and client interaction",      "2016-02-15","2016-02-15",''),
	array(29,ACTYPE_MILESTONE,"  Transition Completed, documentation and training done and website deployed", "2016-02-25",'M4')
	 );


	$constrains = array(array(3,2,CONSTRAIN_ENDSTART),
            array(5,4,CONSTRAIN_STARTSTART),
			array(1,7,CONSTRAIN_STARTSTART),
			array(10,9,CONSTRAIN_ENDSTART),
			array(11,10,CONSTRAIN_ENDSTART),
			array(9,13,CONSTRAIN_ENDSTART),
			array(20,19,CONSTRAIN_STARTSTART),
			array(15,21,CONSTRAIN_STARTSTART),
			array(24,23,CONSTRAIN_ENDSTART),
			array(25,24,CONSTRAIN_ENDSTART),
			array(26,25,CONSTRAIN_ENDSTART),
			array(27,26,CONSTRAIN_ENDSTART),
			array(28,27,CONSTRAIN_ENDSTART),
			array(25,24,CONSTRAIN_ENDSTART),
			array(23,29,CONSTRAIN_STARTSTART)
			);

		// Create the basic graph
		$graph = new GanttGraph();
		$graph->title->Set("NETWORK OF AFRICAN NATIONAL HUMAN RIGHTS INSTITUTIONS WEBSITE RE-DESIGN");

		// Setup scale
		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

		// Add the specified activities
		$graph->CreateSimple($data,$constrains);


		// image to the browser
		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

		// Stroke image to a file and browser

		// Default is PNG so use ".png" as suffix
		$fileName = "./documents/NANHRI_proposal_gantt.jpg";
		$graph->img->Stream($fileName);

		echo '<img src="'.base_url().'documents/NANHRI_proposal_gantt.jpg">';


   }

   public function proposal()
   {
	   $data = array(
    array(0,ACTYPE_GROUP,    "Inception",        "2016-01-11","2016-01-15",''),
	array(1,ACTYPE_NORMAL,   "  \nConduct user requirements collection capturing all key aspects of design\n including MIS structure, report formats, information flow & architecture,\n hardware/software/data/connectivity requirements \n",      "2016-01-13","2016-01-15",''),
	array(2,ACTYPE_NORMAL,   "  Define project scope, refine TOR based on initial meeting concesus",      "2016-01-13","2016-01-13",''),
	array(3,ACTYPE_NORMAL,   "  Assign roles and allocate resources",      "2016-01-12","2016-01-12",''),
    array(4,ACTYPE_NORMAL,   "  Determine project resources",      "2016-01-11","2016-01-11",''),
    array(5,ACTYPE_NORMAL,   "  Establish on the Ground Presence and Meet with Client; and Hold Kick-Off  meetings",      "2016-01-11","2016-01-11",''),
	array(6,ACTYPE_MILESTONE,"  Inception Completed", "2016-01-15",'M1'),
	array(7,ACTYPE_GROUP,    "Elaboration",        "2016-01-18","2016-01-22",''),
	array(8,ACTYPE_NORMAL,   " Review project plan and verify system requirements and agree with the AGF project team",      "2016-01-22","2016-01-22",''),
	array(9,ACTYPE_NORMAL,   " Prepare requirements specification document/report based on the needs analysis",      "2016-01-20","2016-01-21",''),
	array(10,ACTYPE_NORMAL,   " Design system architecture, flow diagrams and use cases covering all key aspects of design",      "2016-01-19","2016-01-20",''),
	array(11,ACTYPE_NORMAL,   " Carry-out an in-depth assessement and understanding of the AGF business Processes\n and data so as to be able to understand and advice on appropriate flow\n of information appropriate for the system including harware/software/data and connectivity requirements",      "2016-01-18","2016-01-19",''),
	array(12,ACTYPE_MILESTONE,"  Elaboration Completed, specification report prepared", "2016-01-22",'M2'),
	array(13,ACTYPE_GROUP,    "Construction",        "2016-01-25","2016-03-11",''),
	array(14,ACTYPE_NORMAL,    "Integration of all the ssystem components and modules",        "2016-03-11","2016-03-11",''),
	array(15,ACTYPE_NORMAL,    "Development of user management access and security",        "2016-03-09","2016-03-10",''),
	array(16,ACTYPE_NORMAL,    "Develop the information system for monitoring and evaluation based on functional specification, code reports,\n conduct unit test and review functionality of reports and module, and obtain signoff",        "2016-02-26","2016-03-09",''),
	array(17,ACTYPE_NORMAL,   " Develop the information system for risk management based on functional specification, code reports,\n conduct unit test and review functionality of reports and module, and obtain signoff.",      "2016-02-11","2016-02-25",''),
	array(18,ACTYPE_NORMAL,   " Develop the information system for guarantee management based on functional specification, code reports,\n conduct unit test and review functionality of reports and module, and obtain signoff.",      "2016-01-28","2016-02-10",''),
	array(19,ACTYPE_NORMAL,   " Design, review and develop user interfaces, and SQL database including table relationships and database tables",      "2016-01-25","2016-01-27",''),
	array(20,ACTYPE_MILESTONE,"  Construction Completed, information system ready for testing and deployment", "2016-03-11",'M3'),
	array(21,ACTYPE_GROUP,    "Transition",        "2016-03-14","2016-03-31",''),
	array(22,ACTYPE_NORMAL,   " Project hand over, post implementation support  commencement & service level agreement",      "2016-03-31","2016-03-31",''),
	array(23,ACTYPE_NORMAL,   " Full system roll-out and deployment of system in all relevant AGF departments for full functionality",      "2016-03-30","2016-03-30",''),
	array(24,ACTYPE_NORMAL,   " End user and administator training",      "2016-03-28","2016-03-29",''),
	array(25,ACTYPE_NORMAL,   "Development of MIS documentation including user and administrative manuals",      "2016-03-23","2016-03-25",''),
	array(26,ACTYPE_NORMAL,   " Deployment of system on production server",      "2016-03-21","2016-03-22",''),
	array(27,ACTYPE_NORMAL,   " System quality assurance and testing including functionality testing, usability testing, interface testing,\n compatibility testing, performance testing and security testing and pilot run",      "2016-03-14","2016-03-18",''),
	array(28,ACTYPE_MILESTONE,"  Transition Completed, documentation and training done and MIS deployed", "2016-03-31",'M4')
	 );

	$constrains = array(array(2,1,CONSTRAIN_ENDSTART),
            array(1,6,CONSTRAIN_STARTSTART),
			array(9,8,CONSTRAIN_ENDSTART),
			array(11,10,CONSTRAIN_ENDSTART),
			array(8,12,CONSTRAIN_STARTSTART),
			array(16,15,CONSTRAIN_ENDSTART),
			array(15,14,CONSTRAIN_ENDSTART),
			array(14,20,CONSTRAIN_STARTSTART),
			array(26,25,CONSTRAIN_ENDSTART),
			array(25,24,CONSTRAIN_ENDSTART),
			array(24,23,CONSTRAIN_ENDSTART),
			array(23,22,CONSTRAIN_ENDSTART),
			array(22,28,CONSTRAIN_STARTSTART)
			);

		// Create the basic graph
		$graph = new GanttGraph();
		$graph->title->Set("DEVELOPMENT OF INFORMATION SYSTEM FOR GUARANTEE MANAGEMENT, RISK MANAGEMENT AND MONITORING & EVALUATION");

		// Setup scale
		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

		// Add the specified activities
		$graph->CreateSimple($data,$constrains);


		// image to the browser
		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

		// Stroke image to a file and browser

		// Default is PNG so use ".png" as suffix
		$fileName = "./documents/AGF_proposal_gantt.jpg";
		$graph->img->Stream($fileName);

		echo '<img src="'.base_url().'documents/AGF_proposal_gantt.jpg">';
   }

   public function wbproposal()
   {
	   $data = array(
    array(0,ACTYPE_GROUP,    "Inception",        "2015-06-10","2015-06-19",''),
	array(1,ACTYPE_NORMAL,   "  Collect data and requirements for the system including, the programmes existing procurement \narrangements,  data work flows, reporting lines and regulations\n and develop SRS",      "2015-06-17","2015-06-19",''),
	array(2,ACTYPE_NORMAL,   "  Define project scope, refine TOR based on initial meeting concesus",      "2015-06-16","2015-06-18",''),
	array(3,ACTYPE_NORMAL,   "  Assign roles and allocate resources",      "2015-06-15","2015-06-16",''),
    array(4,ACTYPE_NORMAL,   "  Determine project resources",      "2015-06-11","2015-06-12",''),
    array(5,ACTYPE_NORMAL,   "  Establish on the Ground Presence and Meet with Client; and Hold Kick-Off  meetings",      "2015-06-10","2015-06-11",''),
	array(6,ACTYPE_MILESTONE,"  Inception Done, Inception Report", "2015-06-19",'M1'),
	array(7,ACTYPE_GROUP,    "Elaboration",        "2015-06-22","2015-07-03",''),
	array(8,ACTYPE_NORMAL,   " Review project plan and verify system requirements and agree with the PPCDA project team",      "2015-07-02","2015-07-03",''),
	array(9,ACTYPE_NORMAL,   " Develop system mock up/prototype based on the needs analysis and SRS",      "2015-06-25","2015-07-02",''),
	array(10,ACTYPE_NORMAL,   " Design system architecture, flow diagrams and use cases covering all key aspects of design",      "2015-06-24","2015-06-26",''),
	array(11,ACTYPE_NORMAL,   " Carry-out an in-depth understanding of the PPCDA's Procurement Processes and data so as to be able\n to understand and advice on appropriate flow of information appropriate for the system",      "2015-06-22","2015-06-24",''),
	array(12,ACTYPE_MILESTONE,"  Elaboration Done and draft report", "2015-07-03",'M2'),
	array(13,ACTYPE_GROUP,    "Construction",        "2015-07-06","2015-07-24",''),
	array(14,ACTYPE_NORMAL,    "System module and integration testing",        "2015-07-21","2015-07-24",''),
	array(15,ACTYPE_NORMAL,    "System module development, customization & Integration",        "2015-07-14","2015-07-22",''),
	array(16,ACTYPE_NORMAL,    "SQL Database Design",        "2015-07-13","2015-07-14",''),
	array(17,ACTYPE_NORMAL,   " Build Interfaces",      "2015-07-10","2015-07-13",''),
	array(18,ACTYPE_NORMAL,   " Conduct Design Review",      "2015-07-08","2015-07-09",''),
	array(19,ACTYPE_NORMAL,   " Create User Interface Mock-ups",      "2015-07-06","2015-07-08",''),
	array(20,ACTYPE_MILESTONE,"  Construction Done", "2015-07-24",'M3'),
	array(21,ACTYPE_GROUP,    "Transition",        "2015-07-27","2015-08-05",''),
	array(22,ACTYPE_NORMAL,   " Post implementation support  commencement & service level agreement",      "2015-08-04","2015-08-05",''),
	array(23,ACTYPE_NORMAL,   " Project handover & Final Report",      "2015-08-03","2015-08-04",''),
	array(24,ACTYPE_NORMAL,   " Full system roll-out and deployment of system in all project areas for full functionality",      "2015-07-31","2015-08-03",''),
	array(25,ACTYPE_NORMAL,   " End user and administrator training",      "2015-07-29","2015-07-31",''),
	array(26,ACTYPE_NORMAL,   " Development of user and administrative manuals",      "2015-07-28","2015-07-30",''),
	array(27,ACTYPE_NORMAL,   " Deployment of systems on production server",      "2015-07-27","2015-07-28",''),
	array(28,ACTYPE_MILESTONE,"  Transition Done, final report", "2015-08-05",'M4')
	 );

	$constrains = array(array(2,1,CONSTRAIN_ENDSTART),
            array(1,6,CONSTRAIN_STARTSTART),
			array(9,8,CONSTRAIN_ENDSTART),
			array(11,10,CONSTRAIN_ENDSTART),
			array(8,12,CONSTRAIN_STARTSTART),
			array(16,15,CONSTRAIN_ENDSTART),
			array(15,14,CONSTRAIN_ENDSTART),
			array(14,20,CONSTRAIN_STARTSTART),
			array(26,25,CONSTRAIN_ENDSTART),
			array(25,24,CONSTRAIN_ENDSTART),
			array(24,23,CONSTRAIN_ENDSTART),
			array(23,22,CONSTRAIN_ENDSTART),
			array(22,28,CONSTRAIN_STARTSTART)
			);

		// Create the basic graph
		$graph = new GanttGraph();
		$graph->title->Set("DEVELOPMENT, DESIGNING AND DEPLOYMENT OF PPCDA OFFICIAL WEB PORTAL");

		// Setup scale
		$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
		$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);

		// Add the specified activities
		$graph->CreateSimple($data,$constrains);


		// image to the browser
		$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

		// Stroke image to a file and browser

		// Default is PNG so use ".png" as suffix
		$fileName = "./documents/wb_proposal_gantt.jpg";
		$graph->img->Stream($fileName);

		echo '<img src="'.base_url().'documents/wb_proposal_gantt.jpg">';
   }
   
   function download($id)
   {
	   
	    // create new PDF document
			$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('DRC');
			$pdf->SetTitle('DRC/DDG Action Plan');
			$pdf->SetSubject('DRC/DDG Action Plan');
			$pdf->SetKeywords('Projects, Task, Plan, action','Activities');
			
			// set default header data
			$pdf->SetHeaderData(false, false, '', '');
			
			
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			
			//set margins
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
			$pdf->SetMargins(7, 7, 7);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			//set some language-dependent strings
			//$pdf->setLanguageArray($l);
			
			// ---------------------------------------------------------
			
			// set font
			$pdf->SetFont('dejavusans', '', 9);
			
			$pdf->SetPrintHeader(false);
			
			// add a page
			$pdf->AddPage();
	   
	   $row = $this->db->get_where('rollingactionplans', array('id' => $id))->row();
	   
	   $project = $this->projectsmodel->get_by_id($row->project_id)->row();
	   $plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
	    $user = $this->usersmodel->get_by_id($row->task_owner_id)->row();
	   
	   $html = '<table width="100%" cellpadding="2" cellspacing="2" border="1">';
	   $html .= '<tr><td><strong>Project</strong></td><td>'.$project->project_title.'</td></tr>';
	   $html .= '<tr><td><strong>Activity</strong></td><td>'.$plannedactivity->activity.'</td></tr>';
	   $html .= '<tr><td><strong>Task</strong></td><td>'.$row->task_name.'</td></tr>';
	   $html .= '<tr><td><strong>Status</strong></td><td>'.$row->progress.'%</td></tr>';
	   $html .= '<tr><td><strong>Priority</strong></td><td>'.$row->priority.'</td></tr>';
	   $html .= '<tr><td><strong>Task Owner</strong></td><td>'.$user->fname.' '.$user->lname.'</td></tr>';
	   $html .= '<tr><td><strong>Start Date</strong></td><td>'.$row->start_date.'</td></tr>';
	   $html .= '<tr><td><strong>End Date</strong></td><td>'.$row->end_date.'</td></tr>';
	   $html .= '<tr><td><strong>Description</strong></td><td>'.$row->description.'</td></tr>';
	   $html .= '</table>';
	   
	   
	   $pdf->writeHTML($html, true, false, true, false, '');
			
			$txt = date("m/d/Y h:m:s");    
	
	 // print a block of text using Write()
	 //$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// test pre tag
			
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			// reset pointer to the last page
			$pdf->lastPage();
			ob_start();
				// ---------------------------------------------------------
			 //ob_end_clean();
			//Close and output PDF document
			$pdf->Output('Action_Plan.pdf', 'I');
   }


}

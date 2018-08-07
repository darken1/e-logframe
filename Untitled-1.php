<?php

function projectgantt()
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
   
   
   
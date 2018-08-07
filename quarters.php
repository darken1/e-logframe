<?php

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
			   
			   $beneficiaries_reached = $this->plannedactivitiesmodel->get_by_activity($plannedactivity['id']);
			   $beneficaiary_target = $plannedactivity['total_beneficiary_target'];
			   
			   if(empty($beneficiaries_reached) || $beneficiaries_reached==0)
			   {
					   $percentage = 0;
			   }
			   else
			   {
				   $percentage = ($beneficiaries_reached/$beneficaiary_target);
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
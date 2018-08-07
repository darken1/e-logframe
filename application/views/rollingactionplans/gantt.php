<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jsgantt.css"/>
<script language="javascript" src="<?php echo base_url(); ?>js/jsgantt.js"></script>
<script language="javascript" src="<?php echo base_url(); ?>js/graphics.js"></script>
<style>
  div.demo {
    background: #ccc none repeat scroll 0 0;
    border: 3px solid #666;
    margin: 5px;
    padding: 5px;
    position: relative;
    width: 100%;
    height: 400px;
    overflow: auto;
  }
  p {
    margin: 10px;
    padding: 5px;
    border: 2px solid #666;
    width: 1000px;
    height: 1000px;
  }
</style>
		<body>
			<?php include(APPPATH . 'views/common/navigation.php'); ?>
				<div class="container-fluid" id="content">
				<?php include(APPPATH . 'views/common/left.php'); ?>
				<div id="main">
				<div class="container-fluid">
				<?php include(APPPATH . 'views/common/pageheader.php'); ?>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo site_url('home')?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url() ?>index.php/rollingactionplans">Rolling action plans</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div id="row">
                    <div class="col-sm-12">
                            <div class="box box-bordered box-color satblue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-bars"></i>Rolling Action Plan</h3>
                                </div>
                                <div class="box-content nopadding">
                                    <ul class="tabs tabs-inline tabs-top">
                                        <li class='active'>
                                            <a href="#first11" data-toggle='tab'>
                                                <i class="fa fa-tasks"></i>Plan Details</a>
                                        </li>
                                        <li>
                                            <a href="#second22" data-toggle='tab'>
                                                <i class="fa fa-bars"></i>Gantt</a>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content padding tab-content-inline tab-content-bottom">
                                        <div class="tab-pane active" id="first11">
                                        <?php
										$datetime1 = date_create($row->start_date);
										$datetime2 = date_create($row->end_date);
										$interval = date_diff($datetime1, $datetime2);
										
										$today = date('Y-m-d');
										
										if($row->start_date > $today)
										{
											if($row->end_date<$today)
											{
												if($row->progress!=100)
												{
													$progress_bar = 'progress-bar-danger';
												}
												else
												{
													$progress_bar = 'progress-bar-success';
												}
											}
											else
											{
												$first_date = date_create($today);
												$second_date = date_create($row->end_date);
												$days_to_end = date_diff($first_date, $second_date);
												
												if($days_to_end->days <=15)
												{
													if($row->progress<90)
													{
														$progress_bar = 'progress-bar-warning';
													}
													else
													{
														$progress_bar = 'progress-bar-success';
													}
												}
												else
												{
													$progress_bar = 'progress-bar-success';
												}
											}
										}
										else
										{
											$progress_bar = 'progress-bar-info';
										}
										
										?>
                                            <table class="table table-hover table-nomargin">
                                            <tr><td colspan="2"><a href="<?php echo base_url() ?>index.php/ganttchart/download/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Download" target="_blank">

			<i class="fa fa-download"></i>
</a></td></tr>
                                            <tr><td><strong>Project</strong></td><td>
                                            <?php
											$project = $this->projectsmodel->get_by_id($row->project_id)->row();
											echo $project->project_title;
											?>
                                            </td></tr>
                                            <tr><td><strong>Activity</strong></td><td>
                                            <?php
											$plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
											echo $plannedactivity->activity;
											?>
                                            </td></tr>
                                            <tr><td><strong>Task</strong></td><td><?php echo $row->task_name;?></td></tr>
                                            <tr><td><strong>Status</strong></td><td><?php echo $row->status;?></td></tr>
                                            <tr><td><strong>Progress</strong></td><td><?php echo $row->progress;?>%  <div class="progress">
											<div class="progress-bar <?php echo $progress_bar;?>" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->progress;?>%">
												<span class="sr-only"><?php echo $row->progress;?>% Complete </span>
											</div>
										</div></td></tr>
                                            <tr><td><strong>Priority</strong></td><td><?php echo $row->priority;?></td></tr>
                                            <tr><td><strong>Task Ownder</strong></td><td><?php
                                            $user = $this->usersmodel->get_by_id($row->task_owner_id)->row();
											echo $user->fname.' '.$user->lname;
											?></td></tr>
                                            <tr><td><strong>Start Date</strong></td><td><?php echo $row->start_date;?> <?php echo $row->start_time;?></td></tr>
                                            <tr><td><strong>End Date</strong></td><td><?php echo $row->end_date;?> <?php echo $row->end_time;?></td></tr>
                                            <tr><td><strong>Days</strong></td><td><?php echo $interval->days;?></td></tr>
                                            <tr><td><strong>Target Budget</strong></td><td><?php echo $row->target_budget;?></td></tr>
                                            <tr><td><strong>Description</strong></td><td><?php echo $row->description;?></td></tr>
                                             <tr><td><strong>Dependancies</strong></td><td>
											 <?php
                                            foreach($rollingactionplans as $key=>$rollingactionplan)
                                            {
												$plandependancy = $this->rollingactionplandependanciesmodel->get_by_plan_dependancy($row->id,$rollingactionplan['id'])->row();
														
												if(empty($plandependancy))
												{
													echo '';
												}
												else
												{
													echo $rollingactionplan['task_name'].',';
												}	
                                                
                                            }
                                            ?>
                                             </td></tr>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="second22">
                                        
                                        <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
								<script>
                                
                                
                                  // here's all the html code neccessary to display the chart object
                                
                                  // Future idea would be to allow XML file name to be passed in and chart tasks built from file.
                                
                                  var g = new JSGantt.GanttChart('g',document.getElementById('GanttChartDIV'), 'day');
                                
                                    g.setShowRes(1); // Show/Hide Responsible (0/1)
                                    g.setShowDur(1); // Show/Hide Duration (0/1)
                                    g.setShowComp(1); // Show/Hide % Complete(0/1)
                                   g.setCaptionType('Resource');  // Set to Show Caption (None,Caption,Resource,Duration,Complete)
                                
                                
                                  //var gr = new Graphics();
                                
                                  if( g ) {
                                
                                    // Parameters             (pID, pName,                  pStart,      pEnd,        pColor,   pLink,          pMile, pRes,  pComp, pGroup, pParent, pOpen, pDepend, pCaption)
                                    
                                    JSGantt.parseXML('<?php echo base_url(); ?>xml/file_plandetail<?php echo $row->id;?>.xml',g)
                                
                                    g.Draw();	
                                    g.DrawDependencies();
                                
                                  }
                                
                                  else
                                
                                  {
                                
                                    alert("not defined");
                                
                                  }
                                
                                </script>
                                
                                
                                           <!--<div class="demo">
                                            <?php //echo $gantt;?>
                                            </div>-->                                          
                                          <script>
											$( "div.demo" ).scrollLeft( 300 );
										  </script>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                
                </div>
</div>
</div>
</div>

</body>
</html>

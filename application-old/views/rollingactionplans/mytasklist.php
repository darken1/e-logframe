<?php include(APPPATH . 'views/common/head.php'); ?>
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
							<a href="<?php echo base_url() ?>index.php/index.php/ganttchart/mytasks">My Tasks</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-3">
					<p>&nbsp;</p>
					
				</div>
				</div>
				<div class="row">
                
                <div class="col-sm-4">
									
										
										<span class="label label-info">Future Task</span>
										<span class="label label-success">Ontime</span>
										<span class="label label-warning">warning</span>
										<span class="label label-danger">Overdue</span>
									</div>
                
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						My Tasks
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable " data-column_filter_types="null,null,null,null,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th>Task</th>
<th>Progress</th>
<th class='hidden-350'>Start Date</th>
<th class='hidden-1024'>Duration</th>
<th class='hidden-480'>End Date</th>
</tr>
</thead>
<tbody>
<?php
									//progress-bar-info - blue //future
									//progress-bar-success - green //ontime
									//progress-bar-warning - yellow //warning
									//progress-bar-danger - red //overdue
									
									$today = date('Y-m-d');
									
									foreach($rollingactionplanassignees as $key=>$rollingactionplanassignee):
									
									$actionplan = $this->rollingactionplansmodel->get_by_id($rollingactionplanassignee['rollingactionplan_id'])->row();
									if(!empty($actionplan))
									{
										$project = $this->projectsmodel->get_by_id($actionplan->project_id)->row();
										$datetime1 = date_create($actionplan->start_date);
										$datetime2 = date_create($actionplan->end_date);
										$interval = date_diff($datetime1, $datetime2);
											
										if($actionplan->start_date < $today)
										{
											if($actionplan->end_date<$today)
											{
												if($actionplan->progress!=100)
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
												$second_date = date_create($actionplan->end_date);
												$days_to_end = date_diff($first_date, $second_date);
												
												if($days_to_end->days <=15)
												{
													if($actionplan->progress<90)
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
                                    	<tr>
                                        	<td><a href="<?php echo site_url('ganttchart/detail/'.$actionplan->id)?>"><?php echo $actionplan->task_name;?></a> </td>
                                            <td>
                                            <?php echo $actionplan->progress;?>%
                                            <div class="progress">
											<div class="progress-bar <?php echo $progress_bar;?>" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $actionplan->progress;?>%">
												<span class="sr-only"><?php echo $actionplan->progress;?>% Complete </span>
											</div>
										</div> </td>
                                            <td><?php echo $actionplan->start_date;?> <?php echo $actionplan->start_time;?> </td>
                                            <td><?php echo $interval->days; ?></td>
                                            <td><?php echo $actionplan->end_date;?> <?php echo $actionplan->end_time;?></td>
                                       </tr>
                                     <?php
									}
									 endforeach;
									 ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
	</body>
</html>

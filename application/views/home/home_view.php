<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/jquery-1-3-2.min.js"></script>
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
							<a href="">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
                <?php
				if(!empty($warning_message))
				{
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Warning!</strong> <?php echo $warning_message; ?>
					</div>
					<?php
				}
				?>
                <div class="row">
                <div class="col-sm-4">
									
										
										<span class="label label-info">Future Task</span>
										<span class="label label-success">Ontime</span>
										<span class="label label-warning">warning</span>
										<span class="label label-danger">Overdue</span>
									</div>
                <div class="col-sm-12">
						<div class="box box-color box-bordered lightgrey">
							<div class="box-title">
								<h3>
									<i class="fa fa-check"></i>Tasks</h3>
								<!--<div class="actions">
									<a href="#new-task" data-toggle="modal" class='btn btn--icon'>
										<i class="fa fa-plus-circle"></i>Add Task</a>
								</div>-->
							</div>
                           
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
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
										
										/**
											
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
													if($interval<90 && $actionplan->progress<50)
													{
														$progress_bar = 'progress-bar-danger';
													}
													else
													{
														$progress_bar = 'progress-bar-success';
													}
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
										
										**/
										
										
										$percentage = $actionplan->progress;										
										
										 if($actionplan->end_date<$today)
										  {
											  if($actionplan->progress<100)
											  {
												  $progress_bar = 'progress-bar-danger';//overdue
											  }
											  else
											  {
												 $progress_bar = 'progress-bar-success';//ontime
											  }
										  }
										  else
										  {
											  $start = strtotime($today);
											  $end = strtotime($actionplan->end_date);
							
							
							
											  $days_between = ceil(abs($end - $start) / 86400);
							
							
											  if($days_between <=90)//3 months
											  {
												  if($percentage<=60)
												  {
													  $progress_bar = 'progress-bar-danger';//overdue
												  }
												  elseif($percentage>=61 && $percentage<=80)
												  {
													  $progress_bar = 'progress-bar-warning';//warning
												  }
												  else
												  {
													   $progress_bar = 'progress-bar-success';//ontime
												  }
											  }//end 90 days check
											  elseif($days_between>=91 && $days_between<=270)//between 3 to 9 months
											  {
												  if($percentage<=30)
												  {
													  $progress_bar = 'progress-bar-danger';//overdue
												  }
												  elseif($percentage>=31 && $percentage<=50)
												  {
													  $progress_bar = 'progress-bar-warning';//warning
												  }
												  else
												  {
													   $progress_bar = 'progress-bar-success';//ontime
												  }
											  }
											  else
											  {
										
													$progress_bar = 'progress-bar-success';//ontime
											  }
							
										  }//end first else
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
                                     <tr><td colspan="5"> <a href="<?php echo site_url('ganttchart/mytasks')?>" class="btn btn-primary">View more tasks</a></td></tr>
                                    </tbody>
                                    
                                    </table>
							</div>
						</div>
					</div>
                    
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-table"></i>
									Projects Listing
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Project Code</th>
											<th>Project Title</th>
											<th class='hidden-350'>Start Date</th>
											<th class='hidden-1024'>End Date</th>
											<th class='hidden-480'>Status</th>
										</tr>
									</thead>
									<tbody>
                                    <?php foreach ($rows->result() as $row): ?>
										<tr>
											<td><?php echo $row->project_no; ?></td>
											<td>
												 <a href="<?php echo site_url('projects/detail/'.$row->id)?>" ><?php echo $row->project_title; ?></a>
											</td>
											<td class='hidden-350'><?php echo $row->project_start_date; ?></td>
											<td class='hidden-1024'><?php echo $row->project_end_date; ?></td>
											<td class='hidden-480'><?php 
$status = $this->projectactivitystatusmodel->get_by_id($row->projectactivitystatus_id)->row();
echo $status->status;
?></td>

										</tr>
                                    <?php endforeach; ?>
                                    <tr><td colspan="5"><a href="<?php echo site_url('projects/listing')?>" class="btn btn-primary">VIEW FULL PROJECT LIST</a></td></tr>
										
										
										
									</tbody>
								</table>
								
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-sm-12">
						<div class="box box-color lightred box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-bar-chart-o"></i>
									Projects by Donors
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content">
								<script type="text/javascript">
								$(function () {
									var chart;
									$(document).ready(function() {
										chart = new Highcharts.Chart({
											chart: {
												renderTo: 'barcontainer',
												type: 'bar'
											},
											title: {
												text: 'Projects by Donor'
											},
											xAxis: {
												categories: [<?php echo $barcategories;?>],
												title: {
													text: null
												}
											},
											yAxis: {
												min: 0,
												title: {
													text: '',
													align: 'high'
												},
												labels: {
													overflow: 'justify'
												}
											},
											tooltip: {
												formatter: function() {
													return ''+
														this.series.name +': '+ this.y +' ';
												}
											},
											plotOptions: {
												bar: {
													dataLabels: {
														enabled: true
													}
												}
											},
											credits: {
												enabled: false
											},
											series: [{
												name: 'Number of Projects',
												data: [<?php echo $bardata;?>]
											
											}]
										});
									});
									
								});
							   </script>
									
								<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
									<script src="<?php echo base_url(); ?>js/exporting.js"></script>
								<div id="barcontainer" width='100%'></div>
                                
							</div>
						</div>
					</div>
				</div>
                
                <!--<div class="row">
					
					<div class="col-sm-12">
						<div class="box box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-search"></i>Search Projects</h3>
							</div>
							<div class="box-content nopadding">
								
                                 <?php     

$attributes = array('name' => 'searchform','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped');

echo form_open('',$attributes); ?>
									<div class="form-group">
										<label for="county" class="control-label col-sm-2">County</label>
										<div class="col-sm-10">
										<select name="county_id" id="county_id" class='form-control'>
                                        <?php
										foreach($counties as $key=>$county)
										{
										?>
												<option value="<?php echo $county['id'];?>"><?php echo $county['county'];?></option>
                                        <?php
										}
										?>
										
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="sector" class="control-label col-sm-2">Sector</label>
										<div class="col-sm-10">
											<select name="sector_id" id="sector_id" class='form-control'>
												  <?php
													foreach($sectors as $key=>$sector)
													{
													?>
															<option value="<?php echo $sector['id'];?>"><?php echo $sector['sector'];?></option>
													<?php
													}
													?>
											</select>
										</div>
									</div>
                                    <div class="form-group">
										<label for="donor" class="control-label col-sm-2">Donor</label>
										<div class="col-sm-10">
											<select name="donor_id" id="donor_id" class='form-control'>
												 <?php
													foreach($donors as $key=>$donor)
													{
													?>
															<option value="<?php echo $donor['id'];?>"><?php echo $donor['donor_name'];?></option>
													<?php
													}
													?>
											</select>
										</div>
									</div>
                                     <div class="form-group">
										<label for="donor" class="control-label col-sm-2">Status</label>
										<div class="col-sm-10">
											<select name="status_id" id="status_id" class='form-control'>
												 <?php
													foreach($status as $key=>$projectstatus)
													{
													?>
															<option value="<?php echo $projectstatus['id'];?>"><?php echo $projectstatus['status'];?></option>
													<?php
													}
													?>
											</select>
										</div>
									</div>
									
									<div class="form-actions col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">Search</button>
										
									</div>
								
                                <?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>-->
				
				<div class="row">
					<div class="col-sm-6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-table"></i>
									My Saved Reports
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Report Title</th>
											<th>Report Date</th>
											<th class='hidden-350'>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php foreach ($savedreports->result() as $row): ?>
										<tr>
											<td><?php echo $row->reporttitle; ?></td>
											<td>
												<?php echo $row->date_saved; ?>
											</td>
											<td class='hidden-350'><a href="<?php echo base_url() ?>index.php/savedreports/view/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="View">

			<i class="fa fa-search"></i>
</a>
<a href="<?php echo base_url() ?>index.php/savedreports/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

			<i class="fa fa-times"></i>
</a></td>
										</tr>
										<?php endforeach; ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                    
                    <div class="col-sm-6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-table"></i>
									Recent Documents
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Document Title</th>
											<th>Added By</th>
											<th class='hidden-350'>Category</th>
                                            <th class='hidden-350'>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
									foreach($documents as $key=>$document)
									{
									?>
										<tr>
											<td><a href="<?php echo base_url() ?>index.php/documents/view/<?php echo $document['id']; ?>" title="View"><?php echo $document['document_title']; ?></a></td>
											<td>
												<?php
												$user = $this->usersmodel->get_by_id($document['user_id'])->row();
												echo $user->fname.' '.$user->lname;
												?>
											</td>
											<td class='hidden-350'><?php
												$category = $this->documentcategoriesmodel->get_by_id($document['documentcategory_id'])->row();
												echo $category->category;
												?></td>
                                                
                                             <td class='hidden-350'>
                                              <a href="<?php echo base_url() ?>index.php/documents/view/<?php echo $document['id']; ?>" class="btn" rel="tooltip" title="View">
            
                                                              <i class="fa fa-search"></i>
                                                         </a>
                                                         <a href="<?php echo base_url();?>index.php/documents/<?php echo $document['file_name'];?>" class="btn" rel="tooltip" title="Download" target="_blank">
            
                                                              <i class="fa fa-arrow-circle-down"></i>
                                                         </a>
                                             </td>
										</tr>
									<?php
									}
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
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
							<a href="<?php echo base_url() ?>index.php/projectactivities">Project activities</a>
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
					<p>
						<a href="<?php echo base_url() ?>index.php/projectactivities/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Project Activities
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="select,select,null,select,select,select,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th>Project</th>
<!--<th>Planned Activity</th>-->
<th>Task</th>
<th>Activity Title</th>
<th>Status</th>
<th>Activity Year</th>
<th>Activity month</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows->result() as $row): ?>
<tr>
<td><?php 
$project = $this->projectsmodel->get_by_id($row->project_id)->row();
echo $project->project_title;
?></td>
<td><?php 
$task = $this->rollingactionplansmodel->get_by_id($row->rollingactionplan_id)->row();
if(empty($task))
{
	echo ' - ';
}
else
{
	echo $task->task_name;
}
?></td>
<!--<td><?php 
$plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
echo $plannedactivity->activity;
?></td>-->
<td><?php echo $row->activity; ?></td>
<td><?php 
$activitystatus = $this->projectactivitystatusmodel->get_by_id($row->projectactivitystatus_id)->row();
echo $activitystatus->status; ?></td>
<td><?php echo $row->project_year; ?></td>
<td><?php 
 if($row->project_month==1)
					  {
					  	echo 'January';
					  }
					  if($row->project_month==2)
					  {
					  	echo 'February';
					  }
					  if($row->project_month==3)
					  {
					  	echo 'March';
					  }
					  if($row->project_month==4)
					  {
					  	echo 'April';
					  }
					  if($row->project_month==5)
					  {
					  	echo 'May';
					  }
					  if($row->project_month==6)
					  {
					  	echo 'June';
					  }
					  if($row->project_month==7)
					  {
					  	echo 'July';
					  }
					  if($row->project_month==8)
					  {
					  	echo 'August';
					  }
					  if($row->project_month==9)
					  {
					  	echo 'September';
					  }
					  if($row->project_month==10)
					  {
					  	echo 'October';
					  }
					  if($row->project_month==11)
					  {
					  	echo 'November';
					  }
					  if($row->project_month==12)
					  {
					  	echo 'December';
					  }
?></td>
<td><a href="<?php echo base_url() ?>index.php/projectactivities/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<a href="<?php echo base_url() ?>index.php/projectactivities/download/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Download" target="_blank">

			<i class="fa fa-download"></i>
</a>

<a href="<?php echo base_url() ?>index.php/projectactivities/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

			<i class="fa fa-times"></i>
</a>

</td>
</tr>
<?php endforeach; ?>
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

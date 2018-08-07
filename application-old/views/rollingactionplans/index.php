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
							<a href="<?php echo base_url() ?>index.php/rollingactionplans">Rolling action plans</a>
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
						<a href="<?php echo base_url() ?>index.php/rollingactionplans/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Rolling Action Plans
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="select,null,null,select,null,select,select,null,null,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th>Project</th>
<th>Activity</th>
<th>Task name</th>
<th>Status</th>
<th>Progress</th>
<th>Priority</th>
<th>Task owner</th>
<th>Start date</th>
<th>End date</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows->result() as $row): ?>
<tr>
<td><?php 
$project = $this->projectsmodel->get_by_id($row->project_id)->row(); 
echo $project->project_no.'/'.$project->project_title;
?></td>
<td><?php 
$plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
if(empty($plannedactivity))
{
	echo 'All';
}
else
{
	echo $plannedactivity->activity;
}
?></td>
<td><?php echo $row->task_name; ?></td>
<td><?php echo $row->status; ?></td>
<td><?php echo $row->progress; ?>%</td>
<td><?php echo $row->priority; ?></td>
<td><?php 
$user = $this->usersmodel->get_by_id($row->task_owner_id)->row();
echo $user->fname.' '.$user->lname;
?></td>
<td><?php echo $row->start_date; ?></td>
<td><?php echo $row->end_date; ?></td>
<td><a href="<?php echo base_url() ?>index.php/rollingactionplans/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<!--<a href="<?php echo base_url() ?>rollingactionplans/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

			<i class="fa fa-times"></i>
</a>-->
<a href="<?php echo base_url() ?>index.php/ganttchart/actionplangantt/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Ghantt" >

			<i class="fa fa-search"></i>
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

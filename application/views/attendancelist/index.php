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
							<a href="<?php echo base_url() ?>attendancelist">attendancelist</a>
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
						<a href="<?php echo base_url() ?>index.php/attendancelist/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						attendancelist
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th class='with-checkbox'>
<input type="checkbox" name="check_all" class="dataTable-checkall">
</th>
<th>Id</th>
<th>Projectactivity id</th>
<th>Training date</th>
<th>Name</th>
<th>Sex</th>
<th>Contact</th>
<th>District id</th>
<th>Area of settlement</th>
<th>Organization</th>
<th>Occupation</th>
<th>Comments</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows->result() as $row): ?>
<tr>
<td class="with-checkbox">
<input type="checkbox" name="check" value="id">
</td>
<td><?php echo $row->id; ?></td>
<td><?php echo $row->projectactivity_id; ?></td>
<td><?php echo $row->training_date; ?></td>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->sex; ?></td>
<td><?php echo $row->contact; ?></td>
<td><?php echo $row->district_id; ?></td>
<td><?php echo $row->area_of_settlement; ?></td>
<td><?php echo $row->organization; ?></td>
<td><?php echo $row->occupation; ?></td>
<td><?php echo $row->comments; ?></td>
<td><a href="<?php echo base_url() ?>attendancelist/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<a href="<?php echo base_url() ?>attendancelist/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

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
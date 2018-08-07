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
							<a href="<?php echo base_url() ?>index.php/beneficiarysubcategories">beneficiary sub categories</a>
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
						<a href="<?php echo base_url() ?>index.php/beneficiarysubcategories/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Beneficiary sub categories
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="select,null,select,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th>Beneficiary type</th>
<th>Beneficiary category</th>
<th>Aggregation type</th>
<th>Gender Classification</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows->result() as $row): ?>
<tr>
<td><?php 
if($row->beneficiarytype_id==0)
{
	echo 'All';
}
else
{
	$beneficiary = $this->beneficiarytypesmodel->get_by_id($row->beneficiarytype_id)->row(); 
	echo $beneficiary->beneficiary_type;
}
?></td>
<td><?php echo $row->beneficiary_category; ?></td>
<td><?php 
if($row->aggregationtype_id==0)
{
	echo 'All';
}
else
{
	$aggregationtype = $this->aggregationtypesmodel->get_by_id($row->aggregationtype_id)->row(); 
	echo $aggregationtype->type;
}
?></td>
<td>
<?php
if($row->gender==1)
{
	echo 'Male';
}
else
{
	echo 'Female';
}
?>
</td>
<td><a href="<?php echo base_url() ?>index.php/beneficiarysubcategories/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<!--<a href="<?php echo base_url() ?>beneficiarysubcategories/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

			<i class="fa fa-times"></i>
</a>-->
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

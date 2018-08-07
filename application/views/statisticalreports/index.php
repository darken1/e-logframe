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
							<a href="<?php echo base_url() ?>index.php/statisticalreports">statisticalreports</a>
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
						<a href="<?php echo base_url() ?>index.php/statisticalreports/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Statistical Reports
					</h3>
				</div>
                 <?php
				if(!empty($error_message))
				{
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Warning!</strong> <?php echo $error_message; ?>
					</div>
					<?php
				}
				
				if(!empty($success_message))
				{
					?>
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Success!</strong> <?php echo $success_message; ?>
					</div>
					<?php
				}
				?>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="select,select,select,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th>Country</th>
<th>Month</th>
<th>Year</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows->result() as $row): ?>
<tr>
<td><?php 
$country = $this->countriesmodel->get_by_id($row->country_id)->row();
echo $country->country;?></td>
<td><?php 
$dateObj   = DateTime::createFromFormat('!m', $row->statistic_month);
$monthName = $dateObj->format('F'); 
echo $monthName; ?></td>
<td><?php echo $row->statistic_year; ?></td>
<td>
<?php
if(getRole() == 'SuperAdmin')
{
?>
<a href="<?php echo base_url() ?>index.php/statisticalreports/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>

<a href="<?php echo base_url() ?>index.php/statisticalreports/mailreport/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Email">

			<i class="fa fa-envelope"></i>
</a>
<?php
}
?>
<a href="<?php echo base_url() ?>index.php/statisticalreports/view/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="View" target="_blank">

			<i class="fa fa-search"></i>
</a>
<a href="<?php echo base_url() ?>index.php/statisticalreports/templateview/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Download" target="_blank">

			<i class="fa fa-download"></i>
</a>
<!--<a href="<?php echo base_url() ?>statisticalreports/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

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

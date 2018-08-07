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
			<a href="">Projects</a>
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
										<a href="<?php echo base_url() ?>index.php/template/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
										
									</p>
								
								</div>
</div>
<div class="row">

<div class="col-sm-12">
<div class="box box-color box-bordered">
<div class="box-title">
	<h3>
		Projects
	</h3>
</div>
<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="null,select,text,select,daterange,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">
<thead>
<tr>
	<th class='with-checkbox'>
		<input type="checkbox" name="check_all" class="dataTable-checkall">
	</th>
	<th>Username</th>
	<th>Email</th>
	<th class='hidden-350'>Status</th>
	<th class='hidden-1024'>Member since</th>
	<th class='hidden-480'>Options</th>
</tr>
</thead>
<tbody>
<tr>
	<td class="with-checkbox">
		<input type="checkbox" name="check" value="1">
	</td>
	<td>John Doe</td>
	<td>john.doe@johndoe.com</td>
	<td class='hidden-350'>
		Active
	</td>
	<td class='hidden-1024'>03-07-2014</td>
	<td class='hidden-480'>
		<a href="#" class="btn" rel="tooltip" title="View">
			<i class="fa fa-search"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Edit">
			<i class="fa fa-edit"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Delete">
			<i class="fa fa-times"></i>
		</a>
	</td>
</tr>
<tr>
	<td class="with-checkbox">
		<input type="checkbox" name="check" value="1">
	</td>
	<td>Jane Doe</td>
	<td>jane.doe@johndoe.com</td>
	<td class='hidden-350'>
		Active
	</td>
	<td class='hidden-1024'>02-07-2014</td>
	<td class='hidden-480'>
		<a href="#" class="btn" rel="tooltip" title="View">
			<i class="fa fa-search"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Edit">
			<i class="fa fa-edit"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Delete">
			<i class="fa fa-times"></i>
		</a>
	</td>
</tr>
<tr>
	<td class="with-checkbox">
		<input type="checkbox" name="check" value="1">
	</td>
	<td>Max Mustermann</td>
	<td>max.mustermann@maxmustermann.com</td>
	<td class='hidden-350'>
		Inactive
	</td>
	<td class='hidden-1024'>01-07-2014</td>
	<td class='hidden-480'>
		<a href="#" class="btn" rel="tooltip" title="View">
			<i class="fa fa-search"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Edit">
			<i class="fa fa-edit"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Delete">
			<i class="fa fa-times"></i>
		</a>
	</td>
</tr>
<tr>
	<td class="with-checkbox">
		<input type="checkbox" name="check" value="1">
	</td>
	<td>Mary P. Hendrix</td>
	<td>mary.p@maryhendrix.com</td>
	<td class='hidden-350'>
		Disabled
	</td>
	<td class='hidden-1024'>30-06-2014</td>
	<td class='hidden-480'>
		<a href="#" class="btn" rel="tooltip" title="View">
			<i class="fa fa-search"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Edit">
			<i class="fa fa-edit"></i>
		</a>
		<a href="#" class="btn" rel="tooltip" title="Delete">
			<i class="fa fa-times"></i>
		</a>
	</td>
</tr>

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
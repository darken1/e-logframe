<?php include('includes/head.php');?>

<body>
	
	
	<?php include 'includes/navigation.php';?>
	<div class="container-fluid" id="content">
		<?php include 'includes/left.php';?>
		<div id="main">
			<div class="container-fluid">
<div class="page-header">
					<div class="pull-left">
						<h1>Projects</h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">
                        <li class='brown'>
								<i class="fa fa-money"></i>
								<div class="details">
									<span class="big">10</span>
									<span>Donors</span>
								</div>
							</li>
                        <li class='blue'>
								<i class="fa fa-folder-open"></i>
								<div class="details">
									<span class="big">7</span>
									<span>Projects</span>
								</div>
							</li>
							<li class='satgreen'>
								<i class="fa fa-dollar"></i>
								<div class="details">
									<span class="big">$324,12</span>
									<span>Total Funding</span>
								</div>
							</li>
                            <li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big"><?php echo date("d F Y",strtotime(date('Y-m-d')));?></span>
									<span><?php echo date("D");?>, <?php echo date("H:i:s");?></span>
								</div>
							</li>
							
						</ul>
					</div>
				</div>
<div class="breadcrumbs">
	<ul>
		<li>
			<a href="index.php">Home</a>
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
										<a href="form.php" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
										
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
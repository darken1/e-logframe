<?php include('includes/head.php');?>

<body>
	
	
	<?php include 'includes/navigation.php';?>
	<div class="container-fluid" id="content">
		<?php include 'includes/left.php';?>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
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
				<div class="row">
					<div class="col-sm-6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-bar-chart-o"></i>
									Budget by Sector
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
								<div class="statistic-big">
									
									<div class="bottom">
										<div id="flot-5" class='flot'></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
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
								<div class="statistic-big">
									
									<div class="bottom">
										<div id="flot-6" class='flot'></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-sm-6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-bar-chart-o"></i>
									Budget by Donor
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
								<div class="statistic-big">
									
									<div class="bottom">
										<div id="flot-5" class='flot'></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-search"></i>Search</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-striped'>
									<div class="form-group">
										<label for="county" class="control-label col-sm-2">County</label>
										<div class="col-sm-10">
										<select name="a" id="a" class='form-control'>
												<option value="1">Option-1</option>
												<option value="2">Option-2</option>
												<option value="3">Option-3</option>
												<option value="4">Option-4</option>
												<option value="5">Option-5</option>
												<option value="6">Option-6</option>
												<option value="7">Option-7</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="sector" class="control-label col-sm-2">Sector</label>
										<div class="col-sm-10">
											<select name="a" id="a" class='form-control'>
												<option value="1">Option-1</option>
												<option value="2">Option-2</option>
												<option value="3">Option-3</option>
												<option value="4">Option-4</option>
												<option value="5">Option-5</option>
												<option value="6">Option-6</option>
												<option value="7">Option-7</option>
											</select>
										</div>
									</div>
                                    <div class="form-group">
										<label for="donor" class="control-label col-sm-2">Donor</label>
										<div class="col-sm-10">
											<select name="a" id="a" class='form-control'>
												<option value="1">Option-1</option>
												<option value="2">Option-2</option>
												<option value="3">Option-3</option>
												<option value="4">Option-4</option>
												<option value="5">Option-5</option>
												<option value="6">Option-6</option>
												<option value="7">Option-7</option>
											</select>
										</div>
									</div>
                                     <div class="form-group">
										<label for="donor" class="control-label col-sm-2">Status</label>
										<div class="col-sm-10">
											<select name="a" id="a" class='form-control'>
												<option value="1">Option-1</option>
												<option value="2">Option-2</option>
												<option value="3">Option-3</option>
												<option value="4">Option-4</option>
												<option value="5">Option-5</option>
												<option value="6">Option-6</option>
												<option value="7">Option-7</option>
											</select>
										</div>
									</div>
									
									<div class="form-actions col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">Search</button>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
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
										<tr>
											<td>Beneficiaries targeted by location</td>
											<td>
												20151-10-01
											</td>
											<td class='hidden-350'>View | Delete</td>
										</tr>
										
										
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
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Report on preliminary project implementation</td>
											<td>
												Joash Gomba
											</td>
											<td class='hidden-350'>Project Reports</td>
										</tr>
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                    
				</div>
				
                <div class="row">
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
										<tr>
											<td>0001</td>
											<td>
												Improved livelihoods for vularable groups
											</td>
											<td class='hidden-350'>2015-01-01</td>
											<td class='hidden-1024'>2016-01-01</td>
											<td class='hidden-480'>On Going</td>
										</tr>
										<tr>
											<td>0002</td>
											<td>Emergency response in ASAL regions</td>
											<td class='hidden-350'>2014-10-01</td>
											<td class='hidden-1024'>2016-10-01</td>
											<td class='hidden-480'>On Going</td>
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
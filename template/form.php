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
					<div class="col-sm-12">
						<div class="box box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-th-list"></i>Striped form</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-striped'>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Text input</label>
										<div class="col-sm-10">
											<input type="text" name="textfield" id="textfield" placeholder="Text input" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-2">Checkboxes
											<small>More information here</small>
										</label>
										<div class="col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="checkbox">Lorem ipsum dolor.
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="checkbox">Lorem ipsum dolor sit.
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="textarea" class="control-label col-sm-2">Textarea</label>
										<div class="col-sm-10">
											<textarea name="textarea" id="textarea" rows="5" class="form-control">Lorem ipsum mollit minim fugiat tempor dolore sit officia ut dolore.</textarea>
										</div>
									</div>
									<div class="form-actions col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button type="button" class="btn">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



</div>
		</div>
	</div>

</body>

</html>
<?php include('includes/head.php');?>

<body>
	<?php include 'includes/navigation.php';?>
	<div class="container-fluid" id="content">
		<?php include 'includes/left.php';?>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>User Profile</h1>
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
							<a href="">User profile</a>
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
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-user"></i>
									Edit user profile
								</h3>
							</div>
							<div class="box-content nopadding">
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#profile" data-toggle='tab'>
											<i class="fa fa-user"></i>Profile</a>
									</li>
									<li>
										<a href="#notifications" data-toggle='tab'>
											<i class="fa fa-user"></i>About Me</a>
									</li>
                                    <li>
										<a href="#security" data-toggle='tab'>
											<i class="fa fa-lock"></i>Security</a>
									</li>
									
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="profile">
										<form action="index.php" class="form-horizontal">
											<div class="row">
												<div class="col-sm-2">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 84px; height: 84px;">
															<img src="img/demo/user-1.jpg" alt="">
														</div>
														<div>
															<span class="btn btn-default btn-file">
														<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="...">
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="col-sm-10">
													<div class="form-group">
														<label for="name" class="control-label col-sm-2 right">Name:</label>
														<div class="col-sm-10">
															<input type="text" name="name" class='form-control' value="John Doe">
														</div>
													</div>
													<div class="form-group">
														<label for="email" class="control-label col-sm-2 right">Gender:</label>
														<div class="col-sm-10">
															<select name="gender" id="gender">
														<option value="1">Male</option>
														<option value="2">Female</option>
													</select>
															
														</div>
													</div>
													
													
													<div class="form-group">
														<label for="email" class="control-label col-sm-2 right">Email:</label>
														<div class="col-sm-10">
															<input type="text" name="email" class='form-control' value="j.doe@johndoeemail.com">
															
														</div>
													</div>
													
													<div class="form-actions">
														<input type="submit" class='btn btn-primary' value="Save Profile">
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="tab-pane" id="notifications">
										<form action="index.php" class="form-horizontal">
											
											<div class="form-group">
												<label for="asdf" class="control-label col-sm-2">Bio</label>
												<div class="col-sm-10">
													<textarea name=""></textarea>
												</div>
											</div>
											<div class="form-actions">
												<input type="submit" class='btn btn-primary' value="Save Bio">
											</div>
										</form>
									</div>
									
                                   <div class="tab-pane" id="security">
										<form action="#" class="form-horizontal">
											<div class="form-group">
														<label for="pw" class="control-label col-sm-2 right">New Password (If changing):</label>
														<div class="col-sm-10">
															<input type="password" name="pw" class='form-control' value="">
														
														</div>
													</div>
											<div class="form-group">
														<label for="pw" class="control-label col-sm-2 right">Confirm Password:</label>
														<div class="col-sm-10">
															<input type="password" name="pw" class='form-control' value="">
														
														</div>
													</div>
											<div class="form-actions">
												<input type="submit" class='btn btn-primary' value="Save Password">
											</div>
										</form>
									</div> 
                                   
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>


</html>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>eLogFrame - Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/themes.css">


	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="<?php echo base_url(); ?>js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="<?php echo base_url(); ?>js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo base_url(); ?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->


	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<h1>
			<a href="">
				<img src="<?php echo base_url(); ?>img/logo-big.png" alt="" class='retina-ready' width="59" height="49">eLogFrame</a>
		</h1>
		<div class="login-body">
			<h2>FORGOT PASSWORD</h2>
            <?php
				if(!empty($error))
				{
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong> <?php echo $error; ?>
					</div>
					<?php
				}
				
				if(!empty($success_message))
				{
					?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Note!</strong> <?php echo $success_message; ?>
					</div>
					<?php
				}
				   

$attributes = array('name' => 'loginform','enctype' => 'multipart/form-data', 'class'=>'form-validate', 'id'=>'test');

echo form_open('verifylogin/forgotpassword',$attributes);
	
				if(validation_errors())
				{
				?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong><?php echo validation_errors(); ?>
					</div>
                 <?php
				}
				?>

				<div class="form-group">
					<div class="email controls">
						<input type="text" name='email' placeholder="Email address" value="<?php echo set_value('username');?>" class='form-control' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				
                
                
				<div class="submit">
				
					<input type="submit" value="Submit" class='btn btn-primary'>
				</div>
			</form>
            <?php echo form_close(); ?>
			<div class="forget">
				<a href="<?php echo site_url('login');?>">
					<span>Back to Login</span>
				</a>
			</div>
		</div>
	</div>

</body>

</html>

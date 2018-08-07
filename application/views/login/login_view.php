<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>DRC Central Database - Login</title>

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
<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->

</head>

<body class='login'>
	<div class="wrapper">
		<h1>
			<a href="">
				<img src="<?php echo base_url(); ?>img/drc_logo.png" alt="" class='retina-ready' width="118" height="56"> <img src="<?php echo base_url(); ?>img/ddg_logo.png" alt="" class='retina-ready' width="125" height="56"><br>Central Database</a>
		</h1>
		<div class="login-body">
			<h2>SIGN IN</h2>
            <?php
				if(!empty($lock_message))
				{
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Warning!</strong> <?php echo $lock_message; ?>
					</div>
					<?php
				}
				?>
            <?php     

$attributes = array('name' => 'loginform','enctype' => 'multipart/form-data', 'class'=>'form-validate', 'id'=>'test');

echo form_open('verifylogin',$attributes);
	
				if(validation_errors())
				{
				?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Login Failed!</strong><?php echo validation_errors(); ?>
					</div>
                 <?php
				}
				?>

				<div class="form-group">
					<div class="email controls">
						<input type="text" name='username' placeholder="Email address" value="<?php echo set_value('username');?>" class='form-control' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="form-group">
					<div class="pw controls">
						<input type="password" name="password" placeholder="Password" class='form-control' data-rule-required="true">
					</div>
				</div>
                
                <?php
				if(!empty($cap_img))
				{
					?>
                    <div class="form-group">
                        <div class="pw controls">
                         <small><font color="#FF0000"><strong><?php echo $message; ?></strong></font></small><br>
                            <?php echo $cap_img; ?>
                        </div>
                    </div>
                    <div class="form-group">
					<div class="pw controls">
                   		<input type="hidden" name="captcha_required" id="captcha_required" value="1">
						<input type="text" name="captcha" placeholder="Please enter the word you see above" class='form-control' data-rule-required="true">
					</div>
				</div>
                    <?php
				}
				else
				{
					?>
                    <input type="hidden" name="captcha_required" id="captcha_required" value="0">
                    <?php
				}
				?>
                <div class="submit">
					<div class="remember">
						<!--<div class="g-recaptcha" data-sitekey="6LfR0zQUAAAAAOXk2Bqas-4KZRlWHI4BjT8Q0zKc"></div>-->
                        <div id="html_element"></div>
					</div>
					
				</div>
				<div class="submit">
					<div class="remember">
						<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember">
						<label for="remember">Remember me</label>
					</div>
					<input type="submit" value="Sign me in" class='btn btn-primary'>
				</div>
			</form>
        
 
            <?php echo form_close(); ?>
			<div class="forget">
				<a href="<?php echo site_url('login/forgotpassword');?>">
					<span>Forgot password?</span>
				</a>
			</div>
		</div>
	</div>

</body>

</html>

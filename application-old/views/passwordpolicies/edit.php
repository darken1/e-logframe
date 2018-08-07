<?php include(APPPATH . 'views/common/head.php'); ?>
<script>
  $(function() {
    var spinner = $( "#max_login_attempts" ).spinner();
	var spinner = $( "#login_attempts_counted_within" ).spinner();
	var spinner = $( "#lock_account_after_attempts" ).spinner();
	var spinner = $( "#blacklist_ip_after_attempts" ).spinner();
	var spinner = $( "#password_life" ).spinner();
	var spinner = $( "#notification_period" ).spinner();
	var spinner = $( "#notify_admin_after_attempts" ).spinner();
 
    $( "#disable" ).click(function() {
      if ( spinner.spinner( "option", "disabled" ) ) {
        spinner.spinner( "enable" );
      } else {
        spinner.spinner( "disable" );
      }
    });
    $( "#destroy" ).click(function() {
      if ( spinner.spinner( "instance" ) ) {
        spinner.spinner( "destroy" );
      } else {
        spinner.spinner();
      }
    });
    $( "#getvalue" ).click(function() {
      alert( spinner.spinner( "value" ) );
    });
    $( "#setvalue" ).click(function() {
      spinner.spinner( "value", 5 );
    });
 
    $( "button" ).button();
  });
  </script>
  
  <SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
   
   
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
							<a href="<?php echo base_url() ?>passwordpolicies">Password policies</a>
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
						<i class="fa fa-th-list"></i>Password Policies
					</h3>
				</div>
				<div class="box-content nopadding">
					<?php if(validation_errors()){?>
						<p><div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong><?php echo validation_errors(); ?>
							</div>
						</p>
					<?php } ?>
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('passwordpolicies/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Max login attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'max_login_attempts', 'name' => 'max_login_attempts', 'value' => $row->max_login_attempts, 'class'=>'form-control bfh-number', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
 					echo form_input($data, set_value('max_login_attempts'));
					?>
                    <smal>Times</small>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Login attempts counted within</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'login_attempts_counted_within', 'name' => 'login_attempts_counted_within', 'value' => $row->login_attempts_counted_within, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('login_attempts_counted_within'));
					?>
                    <smal>Hours</small>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Lock account after attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'lock_account_after_attempts', 'name' => 'lock_account_after_attempts', 'onkeypress'=>'return isNumberKey(event)', 'value' => $row->lock_account_after_attempts, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('lock_account_after_attempts'));
					?>
                    <smal>Times</small>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Blacklist IP after attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'blacklist_ip_after_attempts', 'name' => 'blacklist_ip_after_attempts', 'onkeypress'=>'return isNumberKey(event)', 'value' => $row->blacklist_ip_after_attempts, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
 					echo form_input($data, set_value('blacklist_ip_after_attempts'));
					?>
                    <smal>Times</small>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Notify Admin after attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'notify_admin_after_attempts', 'name' => 'notify_admin_after_attempts', 'onkeypress'=>'return isNumberKey(event)', 'value' => $row->notify_admin_after_attempts, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
 					echo form_input($data, set_value('notify_admin_after_attempts'));
					?>
                    <smal>Times</small>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Password life</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'password_life', 'name' => 'password_life', 'onkeypress'=>'return isNumberKey(event)', 'value' => $row->password_life, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('password_life'));
					?>
                    <smal>Days</small>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Notification period</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'notification_period', 'name' => 'notification_period', 'onkeypress'=>'return isNumberKey(event)', 'value' => $row->notification_period, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('notification_period'));
					?>
                    <smal>Days</small>
				</div>
			</div>

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">UPDATE CHANGES</button>
					</div>
				<?php echo form_close(); ?>
 			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

</body>
</html>

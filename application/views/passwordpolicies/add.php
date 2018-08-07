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
							<a href="<?php echo base_url() ?>passwordpolicies">passwordpolicies</a>
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
						<i class="fa fa-th-list"></i>Add Form
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
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped');?>
					<?php echo form_open('passwordpolicies/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Max login attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'max_login_attempts', 'name' => 'max_login_attempts','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('max_login_attempts'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Login attempts counted within</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'login_attempts_counted_within', 'name' => 'login_attempts_counted_within','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('login_attempts_counted_within'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Lock account after attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'lock_account_after_attempts', 'name' => 'lock_account_after_attempts','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('lock_account_after_attempts'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Blacklist ip after attempts</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'blacklist_ip_after_attempts', 'name' => 'blacklist_ip_after_attempts','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('blacklist_ip_after_attempts'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Password life</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'password_life', 'name' => 'password_life','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('password_life'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Notification period</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'notification_period', 'name' => 'notification_period','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('notification_period'));
					?>
				</div>
			</div>

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">SAVE ENTRY</button>
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

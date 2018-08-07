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
							<a href="<?php echo base_url() ?>audittrail">Audit Trail</a>
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
					<?php echo form_open('audittrail/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Username</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'username', 'name' => 'username','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('username'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Ip address</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'ip_address', 'name' => 'ip_address','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('ip_address'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date time</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_time', 'name' => 'date_time','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('date_time'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Content</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'content', 'name' => 'content','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('content'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">User db id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'user_db_id', 'name' => 'user_db_id','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('user_db_id'));
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

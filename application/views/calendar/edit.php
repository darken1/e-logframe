<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
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
							<a href="<?php echo base_url() ?>calendar">Calendar</a>
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
						<i class="fa fa-th-list"></i>Edit Form
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
					<?php echo form_open('calendar/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'title', 'name' => 'title', 'value' => $row->title, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'description', 'name' => 'description', 'value' => $row->description, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('description'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'start_date', 'name' => 'start_date', 'value' => $row->start_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">End date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'end_date', 'name' => 'end_date', 'value' => $row->end_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('end_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Start time</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'start_time', 'name' => 'start_time', 'value' => $row->start_time, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('start_time'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">End time</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'end_time', 'name' => 'end_time', 'value' => $row->end_time, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('end_time'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Location</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'location', 'name' => 'location', 'value' => $row->location, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('location'));
					?>
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

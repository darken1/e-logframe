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
							<a href="<?php echo base_url() ?>outcomeindicatortracking">outcomeindicatortracking</a>
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
					<?php echo form_open('outcomeindicatortracking/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_id', 'name' => 'project_id', 'value' => $row->project_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Projectoutcomeindicator id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'projectoutcomeindicator_id', 'name' => 'projectoutcomeindicator_id', 'value' => $row->projectoutcomeindicator_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('projectoutcomeindicator_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Report month</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'report_month', 'name' => 'report_month', 'value' => $row->report_month, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('report_month'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Report year</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'report_year', 'name' => 'report_year', 'value' => $row->report_year, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('report_year'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Reached</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'reached', 'name' => 'reached', 'value' => $row->reached, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('reached'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Comments</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'comments', 'name' => 'comments', 'value' => $row->comments, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('comments'));
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

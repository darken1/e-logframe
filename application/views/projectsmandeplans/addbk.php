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
							<a href="<?php echo base_url() ?>projectsmandeplans">M&amp;E plans</a>
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
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('projectsmandeplans/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_id', 'name' => 'project_id','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Purpose of plan</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'purpose_of_plan', 'name' => 'purpose_of_plan','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('purpose_of_plan'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project summary</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_summary', 'name' => 'project_summary','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('project_summary'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Logical framework</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'logical_framework', 'name' => 'logical_framework','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('logical_framework'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Indicators</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'indicators', 'name' => 'indicators','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('indicators'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Roles and responsibilities</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'roles_and_responsibilities', 'name' => 'roles_and_responsibilities','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('roles_and_responsibilities'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Data flow</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'data_flow', 'name' => 'data_flow','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('data_flow'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Storage</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'storage', 'name' => 'storage','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('storage'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Analysis</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'analysis', 'name' => 'analysis','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('analysis'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Privacy</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'privacy', 'name' => 'privacy','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('privacy'));
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

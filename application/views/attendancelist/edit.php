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
							<a href="<?php echo base_url() ?>attendancelist">attendancelist</a>
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
					<?php echo form_open('attendancelist/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Projectactivity id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'projectactivity_id', 'name' => 'projectactivity_id', 'value' => $row->projectactivity_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('projectactivity_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training date</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_date', 'name' => 'training_date', 'value' => $row->training_date, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('training_date'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'name', 'name' => 'name', 'value' => $row->name, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sex</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sex', 'name' => 'sex', 'value' => $row->sex, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sex'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Contact</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'contact', 'name' => 'contact', 'value' => $row->contact, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('contact'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'district_id', 'name' => 'district_id', 'value' => $row->district_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('district_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Area of settlement</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'area_of_settlement', 'name' => 'area_of_settlement', 'value' => $row->area_of_settlement, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('area_of_settlement'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'organization', 'name' => 'organization', 'value' => $row->organization, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('organization'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Occupation</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'occupation', 'name' => 'occupation', 'value' => $row->occupation, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('occupation'));
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

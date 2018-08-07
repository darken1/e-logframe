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
							<a href="<?php echo base_url() ?>projectactivities">Project activities</a>
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
					<?php echo form_open('projectactivities/edit_validate/'.$row->id,$attributes); ?>
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
				<label for="textfield" class="control-label col-sm-2">Sector id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sector_id', 'name' => 'sector_id', 'value' => $row->sector_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sector_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Subsector id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'subsector_id', 'name' => 'subsector_id', 'value' => $row->subsector_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('subsector_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_id', 'name' => 'activity_id', 'value' => $row->activity_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Plannedactivity id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'plannedactivity_id', 'name' => 'plannedactivity_id', 'value' => $row->plannedactivity_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('plannedactivity_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity', 'name' => 'activity', 'value' => $row->activity, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_description', 'name' => 'activity_description', 'value' => $row->activity_description, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('activity_description'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">County id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'county_id', 'name' => 'county_id', 'value' => $row->county_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('county_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Constituency id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'constituency_id', 'name' => 'constituency_id', 'value' => $row->constituency_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('constituency_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Subcounty id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'subcounty_id', 'name' => 'subcounty_id', 'value' => $row->subcounty_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('subcounty_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Location id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'location_id', 'name' => 'location_id', 'value' => $row->location_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('location_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sublocation id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sublocation_id', 'name' => 'sublocation_id', 'value' => $row->sublocation_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sublocation_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity cost</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_cost', 'name' => 'activity_cost', 'value' => $row->activity_cost, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity_cost'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total beneficiaries</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'total_beneficiaries', 'name' => 'total_beneficiaries', 'value' => $row->total_beneficiaries, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('total_beneficiaries'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Projectactivitystatus id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'projectactivitystatus_id', 'name' => 'projectactivitystatus_id', 'value' => $row->projectactivitystatus_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('projectactivitystatus_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date added <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_added', 'name' => 'date_added', 'value' => $row->date_added, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_added'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project month</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_month', 'name' => 'project_month', 'value' => $row->project_month, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_month'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity reach</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_reach', 'name' => 'activity_reach', 'value' => $row->activity_reach, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity_reach'));
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

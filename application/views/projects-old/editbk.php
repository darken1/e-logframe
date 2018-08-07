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
							<a href="<?php echo base_url() ?>projects">projects</a>
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
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-column form-striped form-validate');?>
					<?php echo form_open('projects/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project no</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_no', 'name' => 'project_no', 'value' => $row->project_no, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_no'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_title', 'name' => 'project_title', 'value' => $row->project_title, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project agreement number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_agreement_number', 'name' => 'project_agreement_number', 'value' => $row->project_agreement_number, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_agreement_number'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of fund eligibility <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_fund_eligibility', 'name' => 'date_of_fund_eligibility', 'value' => $row->date_of_fund_eligibility, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_fund_eligibility'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of agreement <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_agreement', 'name' => 'date_of_agreement', 'value' => $row->date_of_agreement, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_agreement'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project objective</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_objective', 'name' => 'project_objective', 'value' => $row->project_objective, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('project_objective'));
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
				<label for="textfield" class="control-label col-sm-2">Project start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_start_date', 'name' => 'project_start_date', 'value' => $row->project_start_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project end date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_end_date', 'name' => 'project_end_date', 'value' => $row->project_end_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_end_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Currency</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'currency', 'name' => 'currency', 'value' => $row->currency, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('currency'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project budget</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_budget', 'name' => 'project_budget', 'value' => $row->project_budget, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_budget'));
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

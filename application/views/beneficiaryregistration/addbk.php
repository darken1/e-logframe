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
							<a href="<?php echo base_url() ?>beneficiaryregistration">beneficiaryregistration</a>
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
					<?php echo form_open('beneficiaryregistration/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Id no</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'id_no', 'name' => 'id_no','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('id_no'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Name of beneficiary</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'name_of_beneficiary', 'name' => 'name_of_beneficiary','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('name_of_beneficiary'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Mothers name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'mothers_name', 'name' => 'mothers_name','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('mothers_name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Next of kin</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'next_of_kin', 'name' => 'next_of_kin','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('next_of_kin'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sex</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sex', 'name' => 'sex','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sex'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'district', 'name' => 'district','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('district'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Settlement</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'settlement', 'name' => 'settlement','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('settlement'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Telephone number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'telephone_number', 'name' => 'telephone_number','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('telephone_number'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Zero to four female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'zero_to_four_female', 'name' => 'zero_to_four_female','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('zero_to_four_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Zero to four male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'zero_to_four_male', 'name' => 'zero_to_four_male','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('zero_to_four_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'five_to_seventeen_female', 'name' => 'five_to_seventeen_female','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('five_to_seventeen_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'five_to_seventeen_male', 'name' => 'five_to_seventeen_male','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('five_to_seventeen_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'eighteen_to_fifty_nine_female', 'name' => 'eighteen_to_fifty_nine_female','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('eighteen_to_fifty_nine_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'eighteen_to_fifty_nine_male', 'name' => 'eighteen_to_fifty_nine_male','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('eighteen_to_fifty_nine_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sixty_above_female', 'name' => 'sixty_above_female','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sixty_above_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sixty_above_male', 'name' => 'sixty_above_male','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sixty_above_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total family size</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'total_family_size', 'name' => 'total_family_size','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('total_family_size'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Programme area</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'programme_area', 'name' => 'programme_area','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('programme_area'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Donor</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'donor', 'name' => 'donor','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('donor'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Registration month</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'registration_month', 'name' => 'registration_month','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('registration_month'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Registration date</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'registration_date', 'name' => 'registration_date','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('registration_date'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_number', 'name' => 'project_number','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_number'));
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

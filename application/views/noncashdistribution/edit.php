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
							<a href="<?php echo base_url() ?>noncashdistribution">noncashdistribution</a>
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
					<?php echo form_open('noncashdistribution/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Program area</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'program_area', 'name' => 'program_area', 'value' => $row->program_area, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('program_area'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'district', 'name' => 'district', 'value' => $row->district, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('district'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Settlement</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'settlement', 'name' => 'settlement', 'value' => $row->settlement, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('settlement'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date added</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_added', 'name' => 'date_added', 'value' => $row->date_added, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('date_added'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sn</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sn', 'name' => 'sn', 'value' => $row->sn, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sn'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Name of beneficiary</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'name_of_beneficiary', 'name' => 'name_of_beneficiary', 'value' => $row->name_of_beneficiary, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('name_of_beneficiary'));
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
				<label for="textfield" class="control-label col-sm-2">Telephone number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'telephone_number', 'name' => 'telephone_number', 'value' => $row->telephone_number, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('telephone_number'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Under five female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'under_five_female', 'name' => 'under_five_female', 'value' => $row->under_five_female, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('under_five_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Under five male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'under_five_male', 'name' => 'under_five_male', 'value' => $row->under_five_male, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('under_five_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'five_to_seventeen_female', 'name' => 'five_to_seventeen_female', 'value' => $row->five_to_seventeen_female, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('five_to_seventeen_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'five_to_seventeen_male', 'name' => 'five_to_seventeen_male', 'value' => $row->five_to_seventeen_male, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('five_to_seventeen_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'eighteen_to_fifty_nine_female', 'name' => 'eighteen_to_fifty_nine_female', 'value' => $row->eighteen_to_fifty_nine_female, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('eighteen_to_fifty_nine_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'eighteen_to_fifty_nine_male', 'name' => 'eighteen_to_fifty_nine_male', 'value' => $row->eighteen_to_fifty_nine_male, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('eighteen_to_fifty_nine_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above female</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sixty_above_female', 'name' => 'sixty_above_female', 'value' => $row->sixty_above_female, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sixty_above_female'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above male</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sixty_above_male', 'name' => 'sixty_above_male', 'value' => $row->sixty_above_male, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sixty_above_male'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total family size</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'total_family_size', 'name' => 'total_family_size', 'value' => $row->total_family_size, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('total_family_size'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Familly head</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'familly_head', 'name' => 'familly_head', 'value' => $row->familly_head, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('familly_head'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Diversity</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'diversity', 'name' => 'diversity', 'value' => $row->diversity, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('diversity'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Selection criteria</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'selection_criteria', 'name' => 'selection_criteria', 'value' => $row->selection_criteria, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('selection_criteria'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Id no</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'id_no', 'name' => 'id_no', 'value' => $row->id_no, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('id_no'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Support given</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'support_given', 'name' => 'support_given', 'value' => $row->support_given, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('support_given'));
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

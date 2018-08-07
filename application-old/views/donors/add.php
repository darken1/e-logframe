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
							<a href="<?php echo base_url() ?>index.php/donors">Donors</a>
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
					<?php echo form_open('donors/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Donor name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'donor_name', 'name' => 'donor_name','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('donor_name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Email</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'email', 'name' => 'email', 'type'=>'email','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('email'));
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
				<label for="textfield" class="control-label col-sm-2">Contact person</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'contact_person', 'name' => 'contact_person','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('contact_person'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Contact email</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'contact_email', 'name' => 'contact_email', 'type'=>'email','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('contact_email'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Contact number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'contact_number', 'name' => 'contact_number','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('contact_number'));
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

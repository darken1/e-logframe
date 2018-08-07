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
							<a href="<?php echo base_url() ?>cashforwork">cashforwork</a>
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
					<?php echo form_open('cashforwork/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Payment date</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'payment_date', 'name' => 'payment_date','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('payment_date'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Funded by</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'funded_by', 'name' => 'funded_by','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('funded_by'));
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
				<label for="textfield" class="control-label col-sm-2">Sn</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'sn', 'name' => 'sn','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('sn'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Location</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'location', 'name' => 'location','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('location'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiary name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'beneficiary_name', 'name' => 'beneficiary_name','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('beneficiary_name'));
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
				<label for="textfield" class="control-label col-sm-2">Next of keen</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'next_of_keen', 'name' => 'next_of_keen','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('next_of_keen'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Mobile cash transfer</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'mobile_cash_transfer', 'name' => 'mobile_cash_transfer','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('mobile_cash_transfer'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Amount</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'amount', 'name' => 'amount','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('amount'));
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

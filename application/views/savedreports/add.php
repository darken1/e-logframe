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
							<a href="<?php echo base_url() ?>savedreports">savedreports</a>
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
					<?php echo form_open('savedreports/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Searchparameter</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'searchparameter', 'name' => 'searchparameter','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('searchparameter'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Searchvalue</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'searchvalue', 'name' => 'searchvalue','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('searchvalue'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">From year</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'from_year', 'name' => 'from_year','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('from_year'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">From month</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'from_month', 'name' => 'from_month','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('from_month'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">To year</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'to_year', 'name' => 'to_year','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('to_year'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">To month</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'to_month', 'name' => 'to_month','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('to_month'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Reportmethod</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'reportmethod', 'name' => 'reportmethod','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('reportmethod'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">User id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'user_id', 'name' => 'user_id','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('user_id'));
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

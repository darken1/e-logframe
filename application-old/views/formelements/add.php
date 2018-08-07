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
							<a href="<?php echo base_url() ?>index.php/formelements">formelements</a>
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
					<?php echo form_open('formelements/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Form id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'form_id', 'name' => 'form_id','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('form_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Type</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'type', 'name' => 'type','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('type'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Label</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'label', 'name' => 'label','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('label'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Default value</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'default_value', 'name' => 'default_value','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('default_value'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Tool tip</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'tool_tip', 'name' => 'tool_tip','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('tool_tip'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Size</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'size', 'name' => 'size','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('size'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Max length</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'max_length', 'name' => 'max_length','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('max_length'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Rows</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'rows', 'name' => 'rows','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('rows'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Cols</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'cols', 'name' => 'cols','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('cols'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Custom display format</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'custom_display_format', 'name' => 'custom_display_format','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('custom_display_format'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Folder path</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'folder_path', 'name' => 'folder_path','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('folder_path'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Folder url</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'folder_url', 'name' => 'folder_url','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('folder_url'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Permitted file types</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'permitted_file_types', 'name' => 'permitted_file_types','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('permitted_file_types'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Max file size</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'max_file_size', 'name' => 'max_file_size','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('max_file_size'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Options</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'options', 'name' => 'options','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('options'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Input type</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'input_type', 'name' => 'input_type','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('input_type'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Required</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'required', 'name' => 'required','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('required'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date time created</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_time_created', 'name' => 'date_time_created','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('date_time_created'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date time modified</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_time_modified', 'name' => 'date_time_modified','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('date_time_modified'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Listorder</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'listorder', 'name' => 'listorder','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('listorder'));
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

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
				<label for="textfield" class="control-label col-sm-2">Project</label>
				<div class="col-sm-10">
					 <select name="project_id" id="project_id" required="required" class='chosen-select form-control'>
                                            <option value="">Select Project</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>" <?php if(set_value('project_id')==$project->id){ echo 'selected="selected"';}?>><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Introduction</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'background', 'name' => 'background','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('background'));
					?>
                    <script>
						var glob10 = '';
						$(document).ready(function()
						{
						 var editorpunt = CKEDITOR.replace('background');
						 glob10 = editorpunt;
						 
						});
						
							
						</script> 
                          <span class="help-block">
                              <code>Complete this section with background details.</code>
                          </span>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Purpose of plan</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'purpose_of_plan', 'name' => 'purpose_of_plan','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('purpose_of_plan'));
					?>
                    <script>
						var glob1 = '';
						$(document).ready(function()
						{
						 var editorpunt = CKEDITOR.replace('purpose_of_plan');
						 glob1 = editorpunt;
						 
						});
						
							
						</script> 
                          <span class="help-block">
                              <code>Describe what the purpose of the monitoring and evaluation plan is, such as who prepared it, for which audience and why</code>
                          </span>
				</div>
			</div>
			
					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">SAVE & CREATE PLAN TEMPLATE</button>
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

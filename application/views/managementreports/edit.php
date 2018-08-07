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
							<a href="<?php echo base_url() ?>index.php/managementreports">management reports</a>
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
					<?php echo form_open('managementreports/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Program area</label>
				<div class="col-sm-10">
					<select name="programarea_id" id="programarea_id" class="form-control">
                		<?php
						foreach($counties as $key=>$programmearea)
						{
							?>
                            <option value="<?php echo $programmearea['id'];?>" <?php if($programmearea['id']==$row->programarea_id){ echo 'selected="selected"';} ?>><?php echo $programmearea['county'];?></option>
                            <?php
						}
						?>
                </select>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'start_date', 'name' => 'start_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','value'=>$row->start_date,'required'=>'required'); 
 					echo form_input($data, set_value('start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">End date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'end_date', 'name' => 'end_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','value'=>$row->end_date,'required'=>'required');
 					echo form_input($data, set_value('end_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Please describe below security issues in your area during the reporting period:</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'describe_security_issues', 'name' => 'describe_security_issues','value'=>$row->describe_security_issues,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('describe_security_issues'));
					?>
                      <script>
                                                    var glob1 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('describe_security_issues');
                                                     glob1 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Please describe other developments in the month e.g. political developments, IDP movements, etc.</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'describe_other_developments', 'name' => 'describe_other_developments','value'=>$row->describe_other_developments,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('describe_other_developments'));
					?>
                      <script>
                                                    var glob2 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('describe_other_developments');
                                                     glob2 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Please highlight 3 main issues related to the implementation of current projects:</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'three_main_issues', 'name' => 'three_main_issues','value'=>$row->three_main_issues,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('three_main_issues'));
					?>
                      <script>
                                                    var glob3 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('three_main_issues');
                                                     glob3 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Findings/issues discovered though TCs field monitoring visits:</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'findings_through_tc', 'name' => 'findings_through_tc','value'=>$row->findings_through_tc,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('findings_through_tc'));
					?>
                      <script>
                                                    var glob4 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('findings_through_tc');
                                                     glob4 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Which project were closed during the last month and which new projects were started:</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'which_projects_where_closed', 'name' => 'which_projects_where_closed','value'=>$row->which_projects_where_closed,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('which_projects_where_closed'));
					?>
                  <script>
                                                    var glob6 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('which_projects_where_closed');
                                                     glob6 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Which proposals are in process currently and planned for the nearer future (max 3 month from now):</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'proposals', 'name' => 'proposals','class'=>'form-control','value'=>$row->proposals,'required'=>'required');
 					echo form_textarea($data, set_value('proposals'));
					?>
                  <script>
                                                    var glob7 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('proposals');
                                                     glob7 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Please highlight 3 main issues related to admin/finance/HR:</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'issues_related_to_hr', 'name' => 'issues_related_to_hr','value'=>$row->issues_related_to_hr,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('issues_related_to_hr'));
					?>
                  <script>
                                                    var glob8 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('issues_related_to_hr');
                                                     glob8 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">What issues would you like to address to SMT/RO and to HQ that would support your programming?</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'issues_to_be_addressed_by_smt', 'name' => 'issues_to_be_addressed_by_smt','value'=>$row->issues_to_be_addressed_by_smt,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('issues_to_be_addressed_by_smt'));
					?>
                  <script>
                                                    var glob9 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('issues_to_be_addressed_by_smt');
                                                     glob9 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
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

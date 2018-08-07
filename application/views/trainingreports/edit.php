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
							<a href="<?php echo base_url() ?>index.php/trainingreports">training reports</a>
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
					<?php echo form_open('trainingreports/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training title</label>
				<div class="col-sm-10">
                
                <select name="projectactivity_id" id="projectactivity_id" class="chosen-select form-control">
                
                <?php
				foreach($projectactivities as $key=>$projectactivity)
				{
					?>
                    <option value="<?php echo $projectactivity['id'];?>" <?php if($projectactivity['id']==$row->projectactivity_id){ echo 'selected="selected"';}?>><?php echo $projectactivity['activity'];?></option>
                    <?php
				}
				?>
                </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Introduction/Opening Ceremony</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'introduction', 'name' => 'introduction','value'=>$row->introduction,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('introduction'));
					?>
                    <script>
                                                    var glob1 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('introduction');
                                                     glob1 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training induction</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_induction','value'=>$row->training_induction , 'name' => 'training_induction','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('training_induction'));
					?>
                      <script>
                                                    var glob2 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('training_induction');
                                                     glob2 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Overal objective of training</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'overal_objective_of_training','value'=>$row->overal_objective_of_training , 'name' => 'overal_objective_of_training','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('overal_objective_of_training'));
					?>
                      <script>
                                                    var glob3 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('overal_objective_of_training');
                                                     glob3 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Specific objectives</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'specific_objectives','value'=>$row->specific_objectives , 'name' => 'specific_objectives','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('specific_objectives'));
					?>
                       <script>
                                                    var glob4 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('specific_objectives');
                                                     glob4 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Methodology</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'methodology', 'name' => 'methodology','value'=>$row->methodology,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('methodology'));
					?>
                     <script>
                                                    var glob5 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('methodology');
                                                     glob5 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Expectations</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'expectations', 'name' => 'expectations','value'=>$row->expectations,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('expectations'));
					?>
                          <script>
                                                    var glob6 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('expectations');
                                                     glob6 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Work shop norms</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'work_shop_norms', 'name' => 'work_shop_norms','value'=>$row->work_shop_norms,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('work_shop_norms'));
					?>
                       <script>
                                                    var glob7 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('work_shop_norms');
                                                     glob7 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Pre assessment results</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'pre_assessment_results', 'name' => 'pre_assessment_results','value'=>$row->pre_assessment_results,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('pre_assessment_results'));
					?>
                      <script>
                                                    var glob8 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('pre_assessment_results');
                                                     glob8 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">All topics covered</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'all_topics_covered', 'name' => 'all_topics_covered','value'=>$row->all_topics_covered,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('all_topics_covered'));
					?>
                          <script>
                                                    var glob9 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('all_topics_covered');
                                                     glob9 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Key challenges</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'key_challenges', 'name' => 'key_challenges','value'=>$row->key_challenges,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('key_challenges'));
					?>
                    <script>
                                                    var glob10 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('key_challenges');
                                                     glob10 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Recommendations from participants</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'recommendations_from_participants', 'name' => 'recommendations_from_participants','value'=>$row->recommendations_from_participants,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('recommendations_from_participants'));
					?>
                      <script>
                                                    var glob11 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('recommendations_from_participants');
                                                     glob11 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Post assessment results</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'post_assessment_results', 'name' => 'post_assessment_results','value'=>$row->post_assessment_results,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('post_assessment_results'));
					?>
                        <script>
                                                    var glob12 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('post_assessment_results');
                                                     glob12 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script>
				</div>
			</div>
			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training appendix</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_appendix', 'name' => 'training_appendix','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('training_appendix'));
					?>
				</div>
			</div>-->
            			
			

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">UPDATE ENTRY</button>
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

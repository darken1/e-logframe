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
							<a href="<?php echo base_url() ?>trainingreports">trainingreports</a>
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
					<?php echo form_open('trainingreports/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_title', 'name' => 'training_title', 'value' => $row->training_title, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('training_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Introduction</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'introduction', 'name' => 'introduction', 'value' => $row->introduction, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('introduction'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training induction</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_induction', 'name' => 'training_induction', 'value' => $row->training_induction, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('training_induction'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Overal objective of training</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'overal_objective_of_training', 'name' => 'overal_objective_of_training', 'value' => $row->overal_objective_of_training, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('overal_objective_of_training'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Specific objectives</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'specific_objectives', 'name' => 'specific_objectives', 'value' => $row->specific_objectives, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('specific_objectives'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Methodology</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'methodology', 'name' => 'methodology', 'value' => $row->methodology, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('methodology'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Expectations</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'expectations', 'name' => 'expectations', 'value' => $row->expectations, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('expectations'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Work shop norms</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'work_shop_norms', 'name' => 'work_shop_norms', 'value' => $row->work_shop_norms, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('work_shop_norms'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Pre assessment results</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'pre_assessment_results', 'name' => 'pre_assessment_results', 'value' => $row->pre_assessment_results, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('pre_assessment_results'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">All topics covered</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'all_topics_covered', 'name' => 'all_topics_covered', 'value' => $row->all_topics_covered, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('all_topics_covered'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Key challenges</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'key_challenges', 'name' => 'key_challenges', 'value' => $row->key_challenges, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('key_challenges'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Recommendations from participants</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'recommendations_from_participants', 'name' => 'recommendations_from_participants', 'value' => $row->recommendations_from_participants, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('recommendations_from_participants'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Post assessment results</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'post_assessment_results', 'name' => 'post_assessment_results', 'value' => $row->post_assessment_results, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('post_assessment_results'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training appendix</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_appendix', 'name' => 'training_appendix', 'value' => $row->training_appendix, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('training_appendix'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Participant list</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'participant_list', 'name' => 'participant_list', 'value' => $row->participant_list, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('participant_list'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Pre post assessment questionnaire</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'pre_post_assessment_questionnaire', 'name' => 'pre_post_assessment_questionnaire', 'value' => $row->pre_post_assessment_questionnaire, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('pre_post_assessment_questionnaire'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Training itinerary</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'training_itinerary', 'name' => 'training_itinerary', 'value' => $row->training_itinerary, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('training_itinerary'));
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

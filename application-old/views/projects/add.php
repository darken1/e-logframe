<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
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
							<a href="<?php echo base_url() ?>index.php/projects">Projects</a>
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
					<?php echo form_open('projects/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project no</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_no', 'name' => 'project_no','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_no'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_title', 'name' => 'project_title','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project agreement number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_agreement_number', 'name' => 'project_agreement_number','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_agreement_number'));
					?>
				</div>
			</div>

			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of fund eligibility <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_fund_eligibility', 'name' => 'date_of_fund_eligibility','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_fund_eligibility'));
					?>
				</div>
			</div>-->
			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of agreement <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_agreement', 'name' => 'date_of_agreement','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_agreement'));
					?>
				</div>
			</div>-->
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project objective</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_objective', 'name' => 'project_objective','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('project_objective'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'description', 'name' => 'description','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('description'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_start_date', 'name' => 'project_start_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project end date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_end_date', 'name' => 'project_end_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_end_date'));
					?>
				</div>
			</div>
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sectors</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="sector_id" name="sector_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($sectors as $key=>$sector)
					{
						?>
                        <option value="<?php echo $sector['id'];?>" ><?php echo $sector['sector'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>
			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Currency</label>
				<div class="col-sm-10">
                <select name="currency" id="currency" class="form-control">
                	<?php
					foreach($currencies as $key=>$currency)
					{
						?>
                        <option value="<?php echo $currency['currency'];?>" <?php if(set_value('currency')==$currency['currency']){echo 'selected="selected"';}?>><?php echo $currency['currency'];?></option>
                        <?php
					}
					?>
                </select>
					
				</div>
			</div>-->

			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project budget</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_budget', 'name' => 'project_budget','class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
 					echo form_input($data, set_value('project_budget'));
					?>
				</div>
			</div>-->
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Donors</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="donos_id" name="donor_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($donors as $key=>$donor)
					{
						?>
                        <option value="<?php echo $donor['id'];?>" ><?php echo $donor['donor_name'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Partners</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="partner_id" name="partner_id[]" class='multiselect' >
                	
                	<?php
					foreach($partners as $key=>$partner)
					{
						?>
                        <option value="<?php echo $partner['id'];?>" ><?php echo $partner['partner'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>
            
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Areas of operation</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="county_id" name="county_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($counties as $key=>$county)
					{
						?>
                        <option value="<?php echo $county['id'];?>" ><?php echo $county['county'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project Status</label>
				<div class="col-sm-10">
                <select name="projectactivitystatus_id" id="projectactivitystatus_id" class="form-control">
                	<?php
					foreach($status as $key=>$projectstatus)
					{
						?>
                        <option value="<?php echo $projectstatus['id'];?>" <?php if(set_value('projectactivitystatus_id')==$projectstatus['id']){echo 'selected="selected"';}?>><?php echo $projectstatus['status'];?></option>
                        <?php
					}
					?>
                </select>
					
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

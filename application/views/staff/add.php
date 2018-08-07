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
							<a href="<?php echo base_url() ?>index.php/staff">Staff</a>
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
					<?php echo form_open('staff/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Full name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'full_name', 'name' => 'full_name','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('full_name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Email</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'email', 'name' => 'email', 'type'=>'email', 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('email'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Telephone</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'telephone', 'name' => 'telephone','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('telephone'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Department</label>
				<div class="col-sm-10">
                
                <select name="department_id" id="department_id" class="form-control">
                     
						<?php
                        foreach($departments as $key=>$department)
                        {
                            ?>
                            <option value="<?php echo $department['id']?>" <?php if(set_value('department_id')==$department['id']){ echo 'selected="selected"';}?>><?php echo $department['department']?></option>
                            <?php
                        }
                        ?>
                        
                      </select>
                      
				
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Reporting line</label>
				<div class="col-sm-10">
                
                <select name="reportingline_id" id="reportingline_id" class="form-control">
                     <option value="0">- None -</option>
						<?php
                        foreach($reportinglines as $key=>$reportingline)
                        {
                            ?>
                            <option value="<?php echo $reportingline['id']?>" <?php if(set_value('reportingline_id')==$reportingline['id']){ echo 'selected="selected"';}?>><?php echo $reportingline['title']?></option>
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

<?php include(APPPATH . 'views/common/head.php'); ?>
<script>

function openPage(val)
{
	//window.open("<?php echo base_url();?>index.php/rolefunctionpermission/add/"+ val);
	window.location = "<?php echo base_url();?>index.php/rolefunctionpermission/add/"+ val;
}
</script>
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
							<a href="<?php echo base_url() ?>index.php/roles">Role function permission</a>
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
					<?php echo form_open('rolefunctionpermission/add_validate/'.$id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Role</label>
				<div class="col-sm-10">
                
                <select name="role" id="role" class="form-control" onChange="openPage(this.value);">

				<?php
                foreach($roles as $key=>$role)
                {
                  ?>
                   <option value="<?php echo $role['id'];?>" <?php if($role['id']==$id){ echo 'selected="selected"';}?>><?php echo $role['description'];?></option> 
                    <?php
                }
                ?>
                </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Function</label>
				<div class="col-sm-10">
					<!--<select multiple="multiple" id="rolefunction" name="rolefunction[]" class='multiselect' required="required">
                   								<option value='users'>User Administration</option>
												<option value='projects'>Projects</option>
                                                <option value='donors'>Donors</option>
                                                <optgroup label="Organization Settings">
                                               	<option value='organization'>Organization</option>                                               
                                                 <option value='reportinglines'>Reporting Lines</option>
                                                 <option value='departments'>Departments</option>
                                                 <option value='staff'>Staff</option>
                                                 </optgroup>
                                                 <optgroup label="Partners Settings">
                                                 <option value='levelofoperation'>Level of Operation</option>
                                                 <option value='organizationtypes'>Organization Types</option>
                                                 <option value='partners'>Partners</option>
                                                 </optgroup>
                                                 <option value='documentcategories'>Document Categories</option>
                                                 <optgroup label="Locations Settings">
                                                 <option value='counties'>Counties</option>
                                                 <option value='subcounties'>Sub Counties</option>
                                                 <option value='wards'>Wards</option>
                                                 </optgroup>
                                                 <optgroup label='Project Settings'>
                                                 <option value='sectors'>Sectors</option>
                                                 <option value='projectstatus'>Project Status</option>
                                                 <option value='beneficiarytypes'>Beneficiary Types</option>
                                                 </optgroup>
                                               
												
											</select>-->
                                                                                     
                                            <select multiple="multiple" id="rolefunction" name="rolefunction[]" class='multiselect' required="required">
                                            <?php
											
											
											
											foreach($tables as $key=>$table)
											{
												
												$authorised = $this->rolefunctionpermissionmodel->check_function($id,$table->table_name);	
												
												if($authorised)
												{
													$selected = 'selected="selected"';
												}
												else
												{
														$selected = '';
												}
												
												
												?>
                                                <option value='<?php echo $table->table_name;?>' <?php echo $selected;?>><?php echo strtoupper($table->table_name);?></option>
                                                <?php
												
											}
											?>
                                            </select>
					<?php 
					//$data = array('id' => 'function', 'name' => 'function','class'=>'form-control','required'=>'required');
 					//echo form_input($data, set_value('function'));
		;
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Permission</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="permission" name="permission[]" class='multiselect' required="required">
                	 <?php
											foreach($permissions as $key=>$permission)
											{
												$permissionauthorised = $this->rolefunctionpermissionmodel->check_permission($id,$permission['table_name'].'_'.$permission['permission']);	
												
												if($permissionauthorised)
												{
													$selected = 'selected="selected"';
												}
												else
												{
														$selected = '';
												}
												?>
                                                <option value='<?php echo $permission['table_name'];?>_<?php echo $permission['permission'];?>' <?php echo $selected;?>><?php echo $permission['table_name'];?>_<?php echo $permission['permission'];?></option>
                                                <?php
											}
											?>
                   
                </select>
					<?php 
					//$data = array('id' => 'permission', 'name' => 'permission','class'=>'form-control','required'=>'required');
 					//echo form_input($data, set_value('permission'));
					
				
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

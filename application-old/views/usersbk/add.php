<?php include(APPPATH . 'views/common/header.php'); ?>
<script>
function validateSubmit()
{
	
	var chks = document.getElementsByName('leavetype_id[]');
	var hasChecked = false;
	for (var i = 0; i < chks.length; i++)
	{
	if (chks[i].checked)
	{
	hasChecked = true;
	break;
	}
	}
	if (!hasChecked)
	{
	alert("Please select at least one leave type");
	chks[0].focus();
	return false;
	}
	
	
			
	return true;
	
}
</script>

	<body>
		<?php include(APPPATH . 'views/common/navbar.php'); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<?php include(APPPATH . 'views/common/sidebar.php'); ?>
			
			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="<?php echo site_url('home')?>">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li class="active">Users</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
                            <div class="page-header position-relative">
						<h1>
							Management
							<small>
								<i class="icon-double-angle-right"></i>
								Users
							</small>
						</h1>
					</div><!--/.page-header-->
                  
                         	<?php
				if(validation_errors())
				{
					?>
					<p><div class="alert alert-danger"> <?php echo validation_errors(); ?></div></p>
					<?php
				}
				?>
                         <?php 
						$attributes = array('name' => 'frm', 'id' => 'frm', 'enctype' => 'multipart/form-data'); 
						 echo form_open('users/add_validate',$attributes); ?>

<div class="control-group"><label class="control-label" for="form-field-1">First Name: </label><div class="controls"><?php $data = array('id' => 'fname', 'name' => 'fname'); echo form_input($data, set_value('fname')); ?></div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Last Name: </label><div class="controls"><?php $data = array('id' => 'lname', 'name' => 'lname'); echo form_input($data, set_value('lname')); ?></div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Department: </label><div class="controls">
<select name="institution_id" id="institution_id">

<?php
foreach($departments as $key=>$department)
{
	?>
   <option value="<?php echo $department['id'];?>"><?php echo $department['department'];?></option> 
    <?php
}
?>
</select>
</div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Designation: </label><div class="controls"><?php $data = array('id' => 'designation', 'name' => 'designation'); echo form_input($data, set_value('designation')); ?></div>
</div>
<div class="control-group"><label class="control-label" for="form-field-1">Supervisor: </label><div class="controls">
<select class="chzn-select" name="supervisor_id" id="supervisor_id" data-placeholder="Select a supervisor">
<option value="" selected="selected">-Select Supervisor-</option>
<option value="0">Self</option>

<?php
foreach($users as $key=>$user)
{
	?>
   <option value="<?php echo $user['id'];?>"><?php echo $user['fname'];?> <?php echo $user['lname'];?></option> 
    <?php
}
?>
</select>
</div>
</div>
<div class="control-group"><label class="control-label" for="form-field-1">Location: </label><div class="controls">
<select name="location_id" id="location_id">

<?php
foreach($locations as $key=>$location)
{
	?>
   <option value="<?php echo $location['id'];?>"><?php echo $location['location_name'];?></option> 
    <?php
}
?>
</select>
</div>
</div>
<div class="control-group"><label class="control-label" for="form-field-1">Email: </label><div class="controls"><?php $data = array('id' => 'email', 'name' => 'email'); echo form_input($data, set_value('email')); ?></div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Contact number: </label><div class="controls"><?php $data = array('id' => 'contact_number', 'name' => 'contact_number'); echo form_input($data, set_value('contact_number')); ?></div>
</div>
<div class="control-group"><label class="control-label" for="form-field-1">Username: </label><div class="controls"><?php $data = array('id' => 'username', 'name' => 'username'); echo form_input($data, set_value('username')); ?></div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Password: </label><div class="controls"><?php $data = array('id' => 'password', 'name' => 'password', 'type' =>'password'); echo form_input($data, set_value('password')); ?></div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Role: </label><div class="controls">
<select name="role_id" id="role_id">

<?php
foreach($roles as $key=>$role)
{
	if($role['id']>2)
	{
	}
	else
	{
	?>
   <option value="<?php echo $role['id'];?>" <?php if($role['id']==2){ echo 'selected="selected"';}?>><?php echo $role['description'];?></option> 
    <?php
	}
}
?>
</select>


</div>
</div><div class="control-group"><label class="control-label" for="form-field-1">Active: </label><div class="controls">

<select name="active" id="active">

   <option value="1" selected="selected">Yes</option> 
	<option value="0" >No</option>
</select>
</div>
</div>
<div class="form-actions"><?php echo form_submit('submit', 'Add', 'class="btn btn-info "'); ?></div>
<?php echo form_close(); ?>  
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<?php include(APPPATH . 'views/common/settingscontainer.php'); ?>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<?php include(APPPATH . 'views/common/footer.php'); ?>
	</body>
</html>

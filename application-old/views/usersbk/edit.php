<?php include(APPPATH . 'views/common/header.php'); ?>

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

<?php echo form_open('users/edit_validate/'.$row->id); ?>
<div class="control-group"><label>First Name: </label><div class="controls"><?php $data = array('id' => 'fname', 'name' => 'fname', 'value' => $row->fname); echo form_input($data, set_value('fname')); ?></div>
</div><div class="control-group"><label>Last Name: </label><div class="controls"><?php $data = array('id' => 'lname', 'name' => 'lname', 'value' => $row->lname); echo form_input($data, set_value('lname')); ?></div>
</div><div class="control-group"><label>Department: </label><div class="controls">

<select name="department_id" id="department_id">

<?php
foreach($departments as $key=>$department)
{
	?>
   <option value="<?php echo $department['id'];?>" <?php if($department['id']==$row->department_id){echo 'selected="selected"';}?>><?php echo $department['department'];?></option> 
    <?php
}
?>
</select>
</div>
</div><div class="control-group"><label>Designation: </label><div class="controls"><?php $data = array('id' => 'designation', 'name' => 'designation', 'value' => $row->designation); echo form_input($data, set_value('designation')); ?></div>
</div>
<div class="control-group"><label class="control-label" for="form-field-1">Supervisor: </label><div class="controls">
<select class="chzn-select" name="supervisor_id" id="supervisor_id" >
<option value="0" <?php if($row->supervisor_id==0){echo 'selected="selected"';}?>>Self</option>

<?php
foreach($users as $key=>$user)
{
	?>
   <option value="<?php echo $user['id'];?>" <?php if($user['id']==$row->supervisor_id){echo 'selected="selected"';}?>><?php echo $user['fname'];?> <?php echo $user['lname'];?></option> 
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
   <option value="<?php echo $location['id'];?>" <?php if($location['id']==$row->location_id){echo 'selected="selected"';}?>><?php echo $location['location_name'];?></option> 
    <?php
}
?>
</select>
</div>
</div>
<div class="control-group"><label>Email: </label><div class="controls"><?php $data = array('id' => 'email', 'name' => 'email', 'value' => $row->email); echo form_input($data, set_value('email')); ?></div>
</div><div class="control-group"><label>Contact number: </label><div class="controls"><?php $data = array('id' => 'contact_number', 'name' => 'contact_number', 'value' => $row->contact_number); echo form_input($data, set_value('contact_number')); ?></div>
</div><div class="control-group"><label>Username: </label><div class="controls"><?php $data = array('id' => 'username', 'name' => 'username', 'value' => $row->username); echo form_input($data, set_value('username')); ?></div>
</div><div class="control-group"><label>Password (If changing password): </label><div class="controls">

<?php $data = array('id' => 'password', 'name' => 'password', 'type' => 'password'); echo form_input($data, set_value('password')); ?>

<input type="hidden" name="oldpassword" id="oldpassword" value="<?php echo $row->password;?>" />
</div>
</div><div class="control-group"><label>Role: </label><div class="controls">
<select name="role_id" id="role_id">

<?php
foreach($roles as $key=>$role)
{
	?>
   <option value="<?php echo $role['id'];?>" <?php if($role['id']==$row->role_id){ echo 'selected="selected"';}?>><?php echo $role['description'];?></option> 
    <?php
}
?>
</select>
</div>
</div><div class="control-group"><label>Active: </label><div class="controls">

<select name="active" id="active">

   <option value="1" <?php if($row->active==1){ echo 'selected="selected"';}?>>Yes</option> 
	<option value="0" <?php if($row->active==0){ echo 'selected="selected"';}?>>No</option>
</select>
</div>
</div><div class="form-actions"><?php echo form_submit('submit', 'Update', 'class="btn btn-info "'); ?></div>

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


<?php include(APPPATH . 'views/common/head.php'); ?>
<script>
$(document).ready(function() {

	$('input[id=password]').keyup(function() {
		// set password variable
		var pswd = $(this).val();
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
		//validate letter
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}
		
		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
		}
		
		//validate number
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
	});

});
</script>

<style>
form ul li {
    margin:10px 20px;

}
form ul li:last-child {
    text-align:center;
    margin:20px 0 25px 0;
}
#pswd_info {
    position:absolute;
    bottom:-75px;
    bottom: -115px\9; /* IE Specific */
    right:55px;
    width:250px;
    padding:15px;
    background:#fefefe;
    font-size:.875em;
    border-radius:5px;
    box-shadow:0 1px 3px #ccc;
    border:1px solid #ddd;
}

#pswd_info h4 {
    margin:0 0 10px 0;
    padding:0;
    font-weight:normal;
}

#pswd_info::before {
    content: "\25B2";
    position:absolute;
    top:-12px;
    left:45%;
    font-size:14px;
    line-height:14px;
    color:#ddd;
    text-shadow:none;
    display:block;
}

.invalid {
   
    padding-left:22px;
    line-height:24px;
    color:#ec3f41;
}
.valid {
    
    padding-left:22px;
    line-height:24px;
    color:#3a7d34;
}

#pswd_info {
    display:none;
}

</style>

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
							<a href="">User profile</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
                	<?php if(validation_errors()){?>
						<p><div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong><?php echo validation_errors(); ?>
							</div>
						</p>
					<?php } ?>
                    
                     <?php
					if(!empty($success_message))
					{
						?>
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong> <?php echo $success_message; ?>
						</div>
						<?php
					}
					?>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-user"></i>
									Edit user profile
								</h3>
							</div>
							<div class="box-content nopadding">
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#profile" data-toggle='tab'>
											<i class="fa fa-user"></i>Profile</a>
									</li>
									<li>
										<a href="#notifications" data-toggle='tab'>
											<i class="fa fa-user"></i>About Me</a>
									</li>
                                    <li>
										<a href="#security" data-toggle='tab'>
											<i class="fa fa-lock"></i>Security</a>
									</li>
									
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="profile">
										
                                          <?php     

$attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal');

echo form_open('profiles/edit_validate',$attributes); ?>
											<div class="row">
												<div class="col-sm-2">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 84px; height: 84px;">
															 <?php
														 if(!empty($row->photo))
														 {
														 ?>
                                                            <img alt="<?php echo $user->fname;?>'s Avatar" src="<?php echo base_url(); ?>profilepics/<?php echo $row->photo;?>">
                                                            <?php
														 }
														 else
														 {
															 ?>
                                                             <img src="<?php echo base_url(); ?>profilepics/one22.jpg" alt="Avatar">
                                                             <?php
														 }
														 ?>
														</div>
														<div>
															<span class="btn btn-default btn-file">
														<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="userfile" id="userfile" />
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="col-sm-10">
													<div class="form-group">
														<label for="name" class="control-label col-sm-2 right">First Name:</label>
														<div class="col-sm-10">
															<input type="text" name="fname" id="fname" class='form-control' value="<?php echo $user->fname;?>" required="required">
                                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id;?>">
                                                            <input type="hidden" name="profile_id" id="profile_id" value="<?php echo $row->id;?>">
														</div>
													</div>
                                                    <div class="form-group">
														<label for="name" class="control-label col-sm-2 right">Last Name:</label>
														<div class="col-sm-10">
															<input type="text" name="lname" id="lname" class='form-control' value="<?php echo $user->lname;?>" required="required">
														</div>
													</div>
													<div class="form-group">
														<label for="email" class="control-label col-sm-2 right">Gender:</label>
														<div class="col-sm-10">
															<select name="gender" id="gender" class='form-control'>
														<option value="M" <?php if($row->gender=='M'){ echo 'selected="selected"';}?>>Male</option>
														<option value="F" <?php if($row->gender=='F'){ echo 'selected="selected"';}?>>Female</option>
													</select>
															
														</div>
													</div>
													
                                                     <div class="form-group">
														<label for="name" class="control-label col-sm-2 right">Designation:</label>
														<div class="col-sm-10">
															<input type="text" name="designation" id="designation" class='form-control' value="<?php echo $user->designation;?>" required="required">
														</div>
													</div>
                                                    
                                                     <div class="form-group">
														<label for="name" class="control-label col-sm-2 right">Organization:</label>
														<div class="col-sm-10">
															<input type="text" name="organization" id="organization" class='form-control' value="<?php echo $user->organization;?>" required="required">
														</div>
													</div>
                                                    
                                                     <div class="form-group">
														<label for="name" class="control-label col-sm-2 right">Contact Number:</label>
														<div class="col-sm-10">
															<input type="text" name="contact_number" id="contact_number" class='form-control' value="<?php echo $user->contact_number;?>" required="required">
														</div>
													</div>
													
													<div class="form-group">
														<label for="email" class="control-label col-sm-2 right">Email:</label>
														<div class="col-sm-10">
															<input type="email" name="email" class='form-control' value="<?php echo $user->email;?>" required="required">
															
														</div>
													</div>
													
													<div class="form-actions">
														<input type="submit" class='btn btn-primary' value="Save Profile">
													</div>
												</div>
											</div>
										<?php echo form_close(); ?>
									</div>
									<div class="tab-pane" id="notifications">
										      <?php     

$attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal');

echo form_open('profiles/update_bio',$attributes); ?>
											
											<div class="form-group">
												<label for="asdf" class="control-label col-sm-2">Bio</label>
												<div class="col-sm-10">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id;?>">
                                                            <input type="hidden" name="profile_id" id="profile_id" value="<?php echo $row->id;?>">
													<textarea name="about_me" id="about_me"><?php echo $row->about_me;?></textarea>
                                                     <script>
var glob3 = '';
$(document).ready(function()
{
 var editorpunt = CKEDITOR.replace('about_me');
 glob3 = editorpunt;
 
});

	
</script> 
												</div>
											</div>
											<div class="form-actions">
												<input type="submit" class='btn btn-primary' value="Save Bio">
											</div>
										<?php echo form_close(); ?>
									</div>
									
                                   <div class="tab-pane" id="security">
										 <?php     

$attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal');

echo form_open('profiles/update_security',$attributes); ?>
											<div class="form-group">
														<label for="pw" class="control-label col-sm-2 right">New Password (If changing):</label>
														<div class="col-sm-10">
                                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id;?>">
                                                        <input type="hidden" name="date_created" id="date_created" value="<?php echo $user->date_created;?>">
                                                        <input type="hidden" name="expiry_date" id="expiry_date" value="<?php echo $user->expiry_date;?>">
                                                            <input type="hidden" name="profile_id" id="profile_id" value="<?php echo $row->id;?>">
														<?php 
					$data = array('id' => 'password', 'name' => 'password', 'class'=>'form-control','type'=>'password', 'title'=>'Password must contain at least 8 characters, including UPPER/lowercase and numbers.', 'pattern'=>'(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}', 'type'=>'password');
 					echo form_input($data, set_value('password'));
					?>
														<input type="hidden" name="oldpassword" id="oldpassword" value="<?php echo $user->password;?>" />
                    <input type="hidden" name="oldsalt" id="oldsalt" value="<?php echo $user->salt;?>" />
														</div>
													</div>
                                                    
                                                    
											<div class="form-group">
														<label for="pw" class="control-label col-sm-2 right">Confirm Password:</label>
														<div class="col-sm-10">
															<?php 
					$data = array('id' => 'pswdconf', 'name' => 'pswdconf','class'=>'form-control', 'title'=>'Please enter the same Password as above.', 'pattern'=>'(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}', 'type'=>'password');
 					echo form_input($data, set_value('pswdconf'));
					?>
														
														</div>
													</div>
                                                    
                                                    
											<div class="form-actions">
												<input type="submit" class='btn btn-primary' value="Save Password">
											</div>
										<?php echo form_close(); ?>
									</div> 
                                   
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    
  
      <div id="pswd_info">
                <h4>Password must meet the following requirements:</h4>
                <ul>
                    <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                    <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                    <li id="number" class="invalid">At least <strong>one number</strong></li>
                    <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                </ul>
                </div>
    </div>

</body>


</html>

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
<script>
function trim(str){
	return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');}
	function totalEncode(str){
	var s=escape(trim(str));
	s=s.replace(/\+/g,"+");
	s=s.replace(/@/g,"@");
	s=s.replace(/\//g,"/");
	s=s.replace(/\*/g,"*");
	return(s);
	}
	function connect(url,params)
	{
	var connection;  // The variable that makes Ajax possible!
	try{// Opera 8.0+, Firefox, Safari
	connection = new XMLHttpRequest();}
	catch (e){// Internet Explorer Browsers
	try{
	connection = new ActiveXObject("Msxml2.XMLHTTP");}
	catch (e){
	try{
	connection = new ActiveXObject("Microsoft.XMLHTTP");}
	catch (e){// Something went wrong
	return false;}}}
	connection.open("POST", url, true);
	connection.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	connection.setRequestHeader("Content-length", params.length);
	connection.setRequestHeader("connection", "close");
	connection.send(params);
	return(connection);
	}
	
	function validateForm(frm){
	var errors='';
		
	if (errors){
	alert('The following error(s) occurred:\n'+errors);
	return false; }
	return true;
	}
	
	function checkusername(frm){
	if(validateForm(frm)){
	document.getElementById('check').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/users/checkusername";
	
	var params = "username=" + totalEncode(document.frm.email.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('check').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('check').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
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
							<a href="<?php echo base_url() ?>index.php/users">users</a>
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
					<?php echo form_open('users/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">First Name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'fname', 'name' => 'fname','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('fname'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Last Name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'lname', 'name' => 'lname','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('lname'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Designation</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'designation', 'name' => 'designation','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('designation'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'organization', 'name' => 'organization','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('organization'));
					?>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Contact number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'contact_number', 'name' => 'contact_number','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('contact_number'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Email
                <small>This will be your username</small>
                </label>
                
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'email', 'name' => 'email','class'=>'form-control','required'=>'required', 'type'=>'email','onKeyPress'=>"checkusername()",'onFocus'=>"checkusername()",'onKeyUp'=>"checkusername()");
 					echo form_input($data, set_value('email'));
					?>
                    <div id="check"></div>
				</div>
			</div>

			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Username</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'username', 'name' => 'username','class'=>'form-control','required'=>'required', 'type'=>'email');
 					echo form_input($data, set_value('username'));
					?>
				</div>
			</div>-->

		  <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Password</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'password', 'name' => 'password','class'=>'form-control','required'=>'required', 'title'=>'Password must contain at least 8 characters, including UPPER/lowercase and numbers.', 'pattern'=>'(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}', 'type'=>'password');
 					echo form_input($data, set_value('password'));
					?>
                    
				</div>
                
			</div>
            
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Confirm Password</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'pswdconf', 'name' => 'pswdconf','class'=>'form-control','required'=>'required', 'title'=>'Please enter the same Password as above.', 'pattern'=>'(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}', 'type'=>'password');
 					echo form_input($data, set_value('pswdconf'));
					?>
                    
				</div>
                
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Role</label>
				<div class="col-sm-10">
               <select name="role_id" id="role_id" class="form-control">

				<?php
                foreach($roles as $key=>$role)
                {
                    ?>
                   <option value="<?php echo $role['id'];?>" <?php if($role['id']==set_value('role_id')){ echo 'selected="selected"';}?>><?php echo $role['description'];?></option> 
                    <?php
                }
                ?>
                </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Active</label>
				<div class="col-sm-10">
                <select name="active" id="active" class="form-control">

                   <option value="1" selected="selected">Yes</option> 
                    <option value="0" >No</option>
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

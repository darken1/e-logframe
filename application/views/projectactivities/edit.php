<?php include(APPPATH . 'views/common/head.php'); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function initialize() {
  var latLng = new google.maps.LatLng(<?php echo $row->lat;?>, <?php echo $row->long;?>);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 8,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function (event) {


            document.getElementById("lat").value = event.latLng.lat();
            document.getElementById("long").value = event.latLng.lng();
        });
		
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>

 <style>
  #mapCanvas {
    width: 500px;
    height: 400px;
    float: left;
  }
  #infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
  </style>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
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
	
	function Getactivities(frm){
	if(validateForm(frm)){
	document.getElementById('activities').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/rollingactionplans/getactivities";
	
	var params = "project_id=" + totalEncode(document.frm.project_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('activities').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('activities').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function GetSubsectors(frm){
	if(validateForm(frm)){
	document.getElementById('subsectors').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projectactivities/getsubsectors";
	
	var params = "sector_id=" + totalEncode(document.frm.sector_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('subsectors').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('subsectors').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function GetDistricts(frm){
	if(validateForm(frm)){
	document.getElementById('districts').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projectactivities/getdistricts";
	
	var params = "county_id=" + totalEncode(document.frm.county_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('districts').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('districts').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function Getactivitytypes(frm){
	if(validateForm(frm)){
	document.getElementById('activitytypes').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projectactivities/getactivitytypes";
	
	var params = "subsector_id=" + totalEncode(document.frm.subsector_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('activitytypes').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('activitytypes').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function getTasks(frm){
	if(validateForm(frm)){
	document.getElementById('tasks').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projectactivities/gettasks";
	
	var params =  "plannedactivity_id="+totalEncode(document.frm.plannedactivity_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('tasks').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('tasks').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function getSectors(frm){
	if(validateForm(frm)){
	document.getElementById('sectors').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projectactivities/getsectors";
	
	var params =  "organization_id="+totalEncode(document.frm.organization_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('sectors').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('sectors').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	</script>
<script>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo base_url(); ?>projectactivities/upload",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
				$("#targetLayer").html(data);
				document.uploadForm.caption.value='';
				document.uploadForm.tags.value='';
				document.uploadForm.userImage.value='';
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>

<script>

function change(that, fgcolor, bgcolor,txtcolor){
that.style.color = fgcolor;
that.style.backgroundColor = bgcolor;
}

</script>
<style>
#container { border:   #ccc; padding: 2px; }
.clear {overflow: hidden;width: 100%;
}
</style>
<script type="text/javascript">


var count = 1;
$(function(){
	$('p#add_field').click(function(){
		count += 1;
		if(count>5)
		{
			alert('Maximum types of beneficiaries is 6.');
		}else{
		$('#container').append(
				'<strong>Other Beneficiary #' + count + '</strong><br />' 
				+ '<input id="mybeneficiary_' + count + '" name="mybeneficiary[]' + '" type="text" class="form-control" placeholder="beneficiary"/> <br /><input id="unit_of_measure_' + count + '" name="unit_of_measure[]' + '" type="text" placeholder="Unit of Measure" class="form-control" /> <br /><input id="number_' + count + '" name="number[]' + '" type="text" onkeypress ="return isNumberKey(event)" maxlength="5" placeholder="Number" class="form-control" /><br />' );
		}
	
	});
});
</script>
<SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
	  
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
							<a href="<?php echo base_url() ?>index.php/projectactivities">Project activities</a>
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
					
					 <?php
				if(!empty($error_message))
				{
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Warning!</strong> <?php echo $error_message; ?>
					</div>
					<?php
				}
				?>
                    <?php if(validation_errors()){?>
                                        <p><div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Note!</strong><?php echo validation_errors(); ?>
                                            </div>
                                        </p>
                                    <?php } ?>
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#first11" data-toggle='tab'>
											<i class="fa fa-tasks"></i>Activity Details</a>
									</li>
									<li>
										<a href="#second22" data-toggle='tab'>
											<i class="fa fa-photo"></i>Photos</a>
									</li>
									
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="first11">
									
                                    <?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('projectactivities/edit_validate/'.$row->id,$attributes); ?>
                    <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization</label>
				<div class="col-sm-10">
                <select name="organization_id" id="organization_id" onChange="getSectors(this)" class="form-control" required="required"> 
                <option value="">Select organization</option>
                <?php
				foreach($organizations as $key=>$organization)
				{
					?>
                    
                    <option value="<?php echo $organization['id'];?>" <?php if($row->organization_id==$organization['id']){ echo 'selected="selected"';}?>><?php echo $organization['organization_name'];?></option>
                    <?php
				}
				?>
                </select>
					
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sector</label>
				<div class="col-sm-10">
                <div id="sectors">
					<select name="sector_id" id="sector_id" onChange="GetSubsectors(this)" class="form-control" required="required">
                    <option value="" selected="selected">Select Sector</option>
                    <?php
                    foreach($sectors as $key=>$sector)
                    {
                        ?>
                        <option value="<?php echo $sector['id'];?>" <?php if($sector['id']==$row->sector_id){ echo 'selected="selected"';}?>><?php echo $sector['sector'];?></option>
                        <?php
                    }
                    ?>
                    </select>
                    
                    </div>
                    
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sub sector </label>
				<div class="col-sm-10">
					<div id="subsectors">
					<select name="subsector_id" id="subsector_id" class="form-control" required="required" onChange="Getactivitytypes(this)">
                    <?php
					foreach($subsectors as $key=>$subsector)
					{
						?>
                        <option value="<?php echo $subsector['id'];?>"><?php echo $subsector['sub_sector'];?></option>
                        <?php
					}
					?>
                    
                    </select>
                    </div>
				</div>
			</div>
                    <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project</label>
				<div class="col-sm-10">
					  <select name="project_id" id="project_id" required="required" class='chosen-select form-control' onChange="Getactivities(this)">
                                            <option value="">Select Project</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>" <?php if($project->id==$row->project_id){ echo 'selected="selected"';}?>><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Planned activity</label>
				<div class="col-sm-10">
					 <div id="activities">
                                            <select name="plannedactivity_id" id="plannedactivity_id" class='chosen-select form-control' >
                                           <option value="0">All</option>
                                            <?php foreach($plannedactivities as $key=>$plannedactivity):?>
                                            <option value="<?php echo $plannedactivity['id'];?>" <?php if($plannedactivity['id']==$row->plannedactivity_id){ echo 'selected="selected"';}?>><?php echo $plannedactivity['activity'];?></option>
                                            <?php endforeach;?>
                                            </select>
                                            </div>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity Type</label>
				<div class="col-sm-10">
                	<!--<div id="activitytypes">
                    <select name="activity_id" id="activity_id" class="form-control" required="required">
                     <?php
					foreach($activities as $key=>$activity)
					{
						?>
                        <option value="<?php echo $activity['id'];?>"><?php echo $activity['activity'];?></option>
                        <?php
					}
					?>
                    </select>
                    </div>-->
                    <select name="activitycategory_id" id="activitycategory_id" class="chosen-select form-control" required="required">
                    <option value="">Select Activity Type</option>
                     <?php
                    foreach($activitycategories as $key=>$activitycategory)
                    {
                        ?>
                        <option value="<?php echo $activitycategory['id'];?>" <?php if($activitycategory['id']==$row->activitycategory_id){ echo 'selected="selected"';}?>><?php echo $activitycategory['activity_category'];?></option>
                        <?php
                    }
                    ?>
                    </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Task</label>
				<div class="col-sm-10">
					 <div id="tasks">
                                            <select name="rollingactionplan_id" id="rollingactionplan_id" class='chosen-select form-control' required="required" >
                                            <option value="">Select Task</option>
                                            <?php
											foreach($tasks as $key => $task)
		   									{
												?>
                                            <option value="<?php echo $task['id'];?>" <?php if($task['id']==$row->rollingactionplan_id){ echo 'selected="selected"';}?>><?php echo $task['task_name'];?></option>
                                            
                                            <?php
											}
											?>
                                            </select>
                                            </div>
				</div>
			</div>
            
            
			

			

			

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Task title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity', 'name' => 'activity', 'value' => $row->activity,'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity'));
					?>
                     <span class="help-block">
                                                                                    <code>This will be the title of the report on the task performed for the project activity.</code>
                                                                                    </span>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Description of accomplished task</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_description', 'name' => 'activity_description', 'value' => $row->activity_description ,'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('activity_description'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Region</label>
				<div class="col-sm-10">
					<select  name="county_id" id="county_id" class="form-control" onChange="GetDistricts(this)" required="required">
                    <option value="" selected="selected">Select Region</option>
                    <?php
                    foreach($counties as $key=>$county)
                    {
                    ?>
                    <option value="<?php echo $county['id'];?>" <?php if($row->county_id==$county['id']){ echo 'selected="selected"';}?>><?php echo $county['county'];?></option>
                    <?php	
                    }
                    ?>
                    </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District</label>
				<div class="col-sm-10">
                    <div id="districts">
                        <select  name="subcounty_id" id="subcounty_id" class="form-control" required="required">
                        <option value="" selected="selected">Select District</option>
                        <?php
						foreach($districts as $key=>$district)
						{
						?>
						<option value="<?php echo $district['id'];?>" <?php if($row->subcounty_id==$district['id']){ echo 'selected="selected"';}?>><?php echo $district['district'];?></option>
						<?php	
						}
						?>
                       
                        </select>
                        
                     </div>
					
				</div>
			</div>
            
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Settlement/Village/Location</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'settlement', 'name' => 'settlement', 'value' => $row->settlement,'class'=>'form-control', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('settlement'));
					?>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Lat</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'lat', 'name' => 'lat', 'value' => $row->lat, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('lat'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Long</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'long', 'name' => 'long', 'value' => $row->long, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('long'));
					?>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Map</label>
				<div class="col-sm-10">
					
                    
                    
                     <div id="mapCanvas"></div>
  <div id="infoPanel">
    <b>Marker status:</b>
    <div id="markerStatus"><i>Click and drag the marker.</i></div>
    <b>Current position:</b>
    <div id="info"></div>
    <b>Closest matching address:</b>
    <div id="address"></div>
  </div>
                    
                    
                    
				</div>
			</div>

			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity cost</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_cost', 'name' => 'activity_cost', 'value' => $row->activity_cost ,'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity_cost'));
					?>
				</div>
			</div>-->

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total beneficiaries</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'total_beneficiaries', 'name' => 'total_beneficiaries', 'value' => $row->total_beneficiaries, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('total_beneficiaries'));
					?>
				</div>
			</div>
            
            <div class="form-group">
            <label for="textfield" class="control-label col-sm-2">Beneficiary breakdown</label>
            <div class="col-sm-10">
            <table class="table table-hover table-nomargin table-bordered">
                <tr>
                    <td>
                    <table class="table table-hover table-nomargin table-bordered">
                    <tr><th>Beneficiary</th><th>Number</th></tr>
                  <?php
					foreach($beneficiaries as $key=>$beneficiary)
					{
						$activitybeneficiary = $this->projectactivitiesbeneficiariesmodel->get_by_beneficiary_project($row->project_id,$row->id,$beneficiary['id'])->row();
									
									if(empty($activitybeneficiary))
									{
										$number_reached = 0;
									}
									else
									{
										$number_reached = $activitybeneficiary->number_reached;
									}
						?>
					 <tr><td><?php echo $beneficiary['beneficiary_type'];?></td><td><input type="text" class="form-control" name="beneficiary_<?php echo $beneficiary['id'];?>" id="beneficiary_<?php echo $beneficiary['id'];?>" value="<?php echo $number_reached;?>" onFocus="change(this,'#FF0000','#FFCCFF','#000000');if(this.value  == '<?php echo $number_reached;?>') { this.value = ''; }" onBlur="change(this,'','','');if(this.value == '') { this.value = '<?php echo $number_reached;?>';}" onKeyPress="return isNumberKey(event)" ></td></tr>  
						<?php
					}
					?>
                    </table>
                    </td>
                    <td>
                    <table class="table table-hover table-nomargin table-bordered">
                      <tr><th colspan="2">Beneficiary subcategories   <span class="help-block">
                                                                                    <code>Gender, Age etc.</code>
                                                                                </span></th></tr>
                    <tr><th>Beneficiary</th><th>Number</th></tr>
                     <?php
					foreach($beneficiarysubcategories as $key=>$beneficiarysubcategory)
					{
						$activitybeneficiarycategory = $this->projectactivitiesbeneficiarycategoriesmodel->get_by_beneficiary_project($row->project_id,$row->id,$beneficiarysubcategory['id'])->row();
									
									if(empty($activitybeneficiarycategory))
									{
										$the_number_reached = 0;
										
									}
									else
									{
									
										$the_number_reached = $activitybeneficiarycategory->number_reached;
									}
									
						?>
                        <tr><td><?php echo $beneficiarysubcategory['beneficiary_category'];?></td><td><input type="text" class="form-control" name="beneficiarysub_<?php echo $beneficiarysubcategory['id'];?>" id="beneficiarysub_<?php echo $beneficiarysubcategory['id'];?>" value="<?php echo $the_number_reached; ?>" onFocus="change(this,'#FF0000','#FFCCFF','#000000');if(this.value  == '<?php echo $the_number_reached; ?>') { this.value = ''; }" onBlur="change(this,'','','');if(this.value == '') { this.value = '<?php echo $the_number_reached; ?>';}" onKeyPress="return isNumberKey(event)" ></td></tr> 
                        <?php
					}
					?>
                    
                    
                    
                    
                    </table>
                        <table class="table table-hover table-nomargin table-bordered">
                        <tr><th>If other type of beneficiary</th></tr>
                        <tr><td>
                        
                        <?php
foreach($projectdiversities as $key=>$projectdiversity)
{
	?>
    <input type="hidden" name="projectdiversity_id[]" id="projectdiversity_id" value="<?php echo $projectdiversity['id']; ?>"><input id="mybeneficiary_<?php echo $projectdiversity['id']; ?>" name="mybeneficiary[]' + '" type="text" class="form-control" placeholder="beneficiary" value="<?php echo $projectdiversity['beneficiary']; ?>"/> <br><input id="unit_of_measure_1" data-rel="tooltip" name="unit_of_measure[]' + '" type="text" placeholder="Unit of Measure" class="form-control" title="Unit of measure: Are you counting people, or organisations, or counties, or cows? etc…" data-placement="bottom" value="<?php echo $projectdiversity['unit_of_measure']; ?>" /> <br><input id="number_1" name="number[]' + '" type="text" onkeypress ="return isNumberKey(event)" maxlength="5" placeholder="Number" class="form-control" value="<?php echo $projectdiversity['number']; ?>" />
    <?php
}
?>
                        <br><div id="container">
            <p id="add_field"><a href="javascript:void(0)" class="btn btn-success"><span>Add Beneficiaries</span></a></p>
        </div></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            </div>
            </div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Status</label>
				<div class="col-sm-10">
					 <select name="projectactivitystatus_id" id="projectactivitystatus_id" class="form-control">
						<?php 
                        foreach($projectactivitystatus as $key=>$status)
                        {
                            ?>
                            <option value="<?php echo $status['id'];?>" <?php if($row->projectactivitystatus_id==$status['id']){echo 'selected="selected"';}?>><?php echo $status['status'];?></option>
                            <?php
                        }
                        ?>
                        </select>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Progress</label>
				<div class="col-sm-10">
					 <select name="progress" id="progress" class='form-control'>
                                                <option value="0" <?php if(set_value('progress')=="0"){ echo 'selected="selected"';}?>>0%</option>
                                                <option value="5" <?php if(set_value('progress')=="5"){ echo 'selected="selected"';}?>>5%</option>
                                                <option value="10" <?php if(set_value('progress')=="10"){ echo 'selected="selected"';}?>>10%</option>
                                                <option value="15" <?php if(set_value('progress')=="15"){ echo 'selected="selected"';}?>>15%</option>
                                                <option value="20" <?php if(set_value('progress')=="20"){ echo 'selected="selected"';}?>>20%</option>
                                                <option value="25" <?php if(set_value('progress')=="25"){ echo 'selected="selected"';}?>>25%</option>
                                                <option value="30" <?php if(set_value('progress')=="30"){ echo 'selected="selected"';}?>>30%</option>
                                                <option value="35" <?php if(set_value('progress')=="35"){ echo 'selected="selected"';}?>>35%</option>
                                                <option value="40" <?php if(set_value('progress')=="40"){ echo 'selected="selected"';}?>>40%</option>
                                                <option value="45" <?php if(set_value('progress')=="45"){ echo 'selected="selected"';}?>>45%</option>
                                                <option value="50" <?php if(set_value('progress')=="50"){ echo 'selected="selected"';}?>>50%</option>
                                                <option value="55" <?php if(set_value('progress')=="55"){ echo 'selected="selected"';}?>>55%</option>
                                                <option value="60" <?php if(set_value('progress')=="60"){ echo 'selected="selected"';}?>>60%</option>
                                                <option value="65" <?php if(set_value('progress')=="65"){ echo 'selected="selected"';}?>>65%</option>
                                                <option value="70" <?php if(set_value('progress')=="70"){ echo 'selected="selected"';}?>>70%</option>
                                                <option value="75" <?php if(set_value('progress')=="75"){ echo 'selected="selected"';}?>>75%</option>
                                                <option value="80" <?php if(set_value('progress')=="80"){ echo 'selected="selected"';}?>>80%</option>
                                                <option value="85" <?php if(set_value('progress')=="85"){ echo 'selected="selected"';}?>>85%</option>
                                                <option value="90" <?php if(set_value('progress')=="90"){ echo 'selected="selected"';}?>>90%</option>
                                                <option value="95" <?php if(set_value('progress')=="95"){ echo 'selected="selected"';}?>>95%</option>
                                                <option value="100" <?php if(set_value('progress')=="100"){ echo 'selected="selected"';}?>>100%</option>
                                            </select>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity Report Date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_added', 'name' => 'date_added', 'value' => $row->date_added, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_added'));
					?>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity year</label>
				<div class="col-sm-10">
                <select name="project_year" id="project_year" class="form-control">
                    <?php
     $currentYear = date('Y');
        foreach (range(2012, $currentYear) as $value) {
          ?>
           <option value="<?php echo $value;?>" <?php 
		   if($value==$row->project_year)
		   {
			   echo 'selected="selected"';
		   }
		   ?>><?php echo $value;?></option>
          <?php

        }
?>
                 </select>
					
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity month</label>
				<div class="col-sm-10">
                <select name="project_month" id="project_month" class="form-control">
                    <option>Select Month</option>
                    <option value = "1" <?php if($row->project_month==1){echo 'selected="selected"';}?>?>January</option>
                    <option value = "2" <?php if($row->project_month==2){echo 'selected="selected"';}?>>February</option>
                    <option value = "3" <?php if($row->project_month==3){echo 'selected="selected"';}?>>March</option>
                    <option value = "4" <?php if($row->project_month==4){echo 'selected="selected"';}?>>April</option>
                    <option value = "5" <?php if($row->project_month==5){echo 'selected="selected"';}?>>May</option>
                    <option value = "6" <?php if($row->project_month==6){echo 'selected="selected"';}?>>June</option>
                    <option value = "7" <?php if($row->project_month==7){echo 'selected="selected"';}?>>July</option>
                    <option value = "8" <?php if($row->project_month==8){echo 'selected="selected"';}?>>August</option>
                    <option value = "9" <?php if($row->project_month==9){echo 'selected="selected"';}?>>September</option>
                    <option value = "10" <?php if($row->project_month==10){echo 'selected="selected"';}?>>October</option>
                    <option value = "11" <?php if($row->project_month==11){echo 'selected="selected"';}?>>November</option>
                    <option value = "12" <?php if($row->project_month==12){echo 'selected="selected"';}?>>December</option> 
                 </select>
					
				</div>
			</div>

                                    
                                    <div class="form-actions col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">UPDATE CHANGES</button>
                                             <a href="<?php echo site_url('projectactivities')?>" class="btn btn-danger">CANCEL</a>
                                        </div>
                                    <?php echo form_close(); ?>
									</div>
									<div class="tab-pane" id="second22">
										
                                        <form action="<?php echo base_url() ?>index.php/projectactivities/uploadphoto" method="POST" class='form-horizontal' id="uploadForm" name="uploadForm" enctype="multipart/form-data">
										<table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Activity Photos</th></tr>
                                                                </thead>
                                                                <tbody>
                                                                 <tr><td>
                                                               <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Caption
                                                                    
                                                                    </label>
                                                                    <div class="col-sm-10">
                                                                        <?php 
                                                                        $data = array('id' => 'caption', 'name' => 'caption','class'=>'form-control','required'=>'required');
                                                                        echo form_input($data, set_value('tags'));
                                                                        ?>
                                                                        <input type="hidden" name="theprojectactivity_id" id="theprojectactivity_id" value="<?php echo $row->id;?>">
                                                                    </div>
                                                                </div>
                                                                </td></tr>
                                                                 
                                                                
                                                                 <tr><td>
                                                               <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Tags
                                                                    <small>Separate with comma (,)</small>
                                                                    </label>
                                                                    <div class="col-sm-10">
                                                                        <?php 
                                                                        $data = array('id' => 'tags', 'name' => 'tags','class'=>'tagsinput form-control','required'=>'required');
                                                                        echo form_textarea($data, set_value('tags'));
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                </td></tr>
                                                                <tr><td>
                                                                 <div class="form-group">
				
                                                                    <div class="col-sm-10">
                                                                    <label for="textfield" class="control-label col-sm-2">Upload Photo</label>
                                                                                            <div class="col-sm-10">
                                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                                    <div class="input-group">
                                                                                                        <div class="form-control" data-trigger="fileinput">
                                                                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                                                            <span class="fileinput-filename"></span>
                                                                                                        </div>
                                                                                                        <span class="input-group-addon btn btn-default btn-file">
                                                                                                            <span class="fileinput-new">Select file</span>
                                                                                                        <span class="fileinput-exists">Change</span>
                                                                                                        <input type="file" name="userImage" id="userImage" required="required">
                                                                                                        </span>
                                                                                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                </td></tr>
                                                                <tr><td>
                                                                <div class="form-actions">
                                                                <input type="submit" class="btn btn-primary" value="UPLOAD PHOTO">
                                                            </div>
                                                                </td></tr>
                                             </tbody>
                                        </table>
                                        <div id="targetLayer"><?php echo $imagetable;?></div>
                                        </form>
                                        
                                        
									</div>
									
									
								</div>
							
			

					
 			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

</body>
</html>

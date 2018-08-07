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
  var latLng = new google.maps.LatLng(-1.292066, 36.821946);
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
		if(count>10)
		{
			alert('Maximum types of beneficiaries is 10.');
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
					<?php echo form_open('projectactivities/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project</label>
				<div class="col-sm-10">
					  <select name="project_id" id="project_id" onChange="Getactivities(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Project</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>"><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
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
                                            </select>
                                            </div>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sector</label>
				<div class="col-sm-10">
					<select name="sector_id" id="sector_id" onChange="GetSubsectors(this)" class="form-control" required="required">
                    <option value="" selected="selected">Select Sector</option>
                    <?php
                    foreach($sectors as $key=>$sector)
                    {
                        ?>
                        <option value="<?php echo $sector['id'];?>" <?php if($sector['id']==set_value('sector_id')){ echo 'selected="selected"';}?>><?php echo $sector['sector'];?></option>
                        <?php
                    }
                    ?>
                    </select>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sub sector </label>
				<div class="col-sm-10">
					<div id="subsectors">
					<select name="subsector_id" id="subsector_id" class="form-control" required="required">
                    <option value="">Select Sub Sector</option>
                    </select>
                    </div>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity Type</label>
				<div class="col-sm-10">
                	<div id="activitytypes">
                    <select name="activity_id" id="activity_id" class="chosen-select form-control" required="required">
                    <option value="">Select Activity Type</option>
                    </select>
                    </div>
					
				</div>
			</div>

			

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity', 'name' => 'activity','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_description', 'name' => 'activity_description','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('activity_description'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Region</label>
				<div class="col-sm-10">
					<select  name="county_id" id="county_id" class="form-control" required="required">
                    <option value="" selected="selected">Select Region</option>
                    <?php
                    foreach($counties as $key=>$county)
                    {
                    ?>
                    <option value="<?php echo $county['id'];?>" <?php if(set_value('county_id')==$county['id']){ echo 'selected="selected"';}?>><?php echo $county['county'];?></option>
                    <?php	
                    }
                    ?>
                    </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Lat</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'lat', 'name' => 'lat','class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true', 'required'=>'required');
 					echo form_input($data, set_value('lat'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Long</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'long', 'name' => 'long','class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
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

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity cost</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'activity_cost', 'name' => 'activity_cost','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('activity_cost'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total beneficiaries</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'total_beneficiaries', 'name' => 'total_beneficiaries','class'=>'form-control','required'=>'required');
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
						?>
                        <tr><td><?php echo $beneficiary['beneficiary_type'];?></td><td><input type="text" class="form-control" name="beneficiary_<?php echo $beneficiary['id'];?>" id="beneficiary_<?php echo $beneficiary['id'];?>" value="0" onFocus="change(this,'#FF0000','#FFCCFF','#000000');if(this.value  == '0') { this.value = ''; }" onBlur="change(this,'','','');if(this.value == '') { this.value = '0';}" onKeyPress="return isNumberKey(event)" ></td></tr> 
                        <?php
					}
					?>
                    </table>
                    </td>
                    <td>
                        <table class="table table-hover table-nomargin table-bordered">
                        <tr><th>If other type of beneficiary</th></tr>
                        
                        
                        <tr><td>
                      
                        
                        <input id="mybeneficiary_1" name="mybeneficiary[]' + '" type="text" class="form-control" placeholder="beneficiary"/><br> <input id="unit_of_measure_1" data-rel="tooltip" name="unit_of_measure[]' + '" type="text" placeholder="Unit of Measure" class="form-control" title="Unit of measure: Are you counting people, or organisations, or counties, or cows? etc…" data-placement="bottom" /> <br> <input id="number_1" name="number[]' + '" type="text" onkeypress ="return isNumberKey(event)" maxlength="5" placeholder="Number" class="form-control" /><br><div id="container">
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
                            <option value="<?php echo $status['id'];?>" <?php if(set_value('projectactivitystatus_id')==$status['id']){echo 'selected="selected"';}?>><?php echo $status['status'];?></option>
                            <?php
                        }
                        ?>
                        </select>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity Report Date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_added', 'name' => 'date_added','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_added'));
					?>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity year</label>
				<div class="col-sm-10">
                <select name="project_year" id="project_year" class="form-control">
                    <option>Select Year</option>
                   <?php
     $currentYear = date('Y');
        foreach (range(2012, $currentYear) as $value) {
          ?>
           <option value="<?php echo $value;?>" <?php 
		   if($value==set_value('project_year'))
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
                    <option value = "1" <?php if(set_value('project_month')==1){echo 'selected="selected"';}?>?>January</option>
                    <option value = "2" <?php if(set_value('project_month')==2){echo 'selected="selected"';}?>>February</option>
                    <option value = "3" <?php if(set_value('project_month')==3){echo 'selected="selected"';}?>>March</option>
                    <option value = "4" <?php if(set_value('project_month')==4){echo 'selected="selected"';}?>>April</option>
                    <option value = "5" <?php if(set_value('project_month')==5){echo 'selected="selected"';}?>>May</option>
                    <option value = "6" <?php if(set_value('project_month')==6){echo 'selected="selected"';}?>>June</option>
                    <option value = "7" <?php if(set_value('project_month')==7){echo 'selected="selected"';}?>>July</option>
                    <option value = "8" <?php if(set_value('project_month')==8){echo 'selected="selected"';}?>>August</option>
                    <option value = "9" <?php if(set_value('project_month')==9){echo 'selected="selected"';}?>>September</option>
                    <option value = "10" <?php if(set_value('project_month')==10){echo 'selected="selected"';}?>>October</option>
                    <option value = "11" <?php if(set_value('project_month')==11){echo 'selected="selected"';}?>>November</option>
                    <option value = "12" <?php if(set_value('project_month')==12){echo 'selected="selected"';}?>>December</option> 
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style>
				#lasttable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#lasttable td, #lasttable th 
				{
				font-size:0.8em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#lasttable th 
				{
				font-size:0.8em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#lasttable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				
				
				#listtable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:80%;
				border-collapse:collapse;
				}
				#listtable td, #listtable th 
				{
				font-size:1.0em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#listtable th 
				{
				font-size:1.0em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#listtable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				
				/**/
				#zonlisttable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#zonlisttable td, #zonlisttable th 
				{
				font-size:1.0em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#zonlisttable th 
				{
				font-size:1.0em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#zonlisttable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				</style>
		<style type="text/css">
		
			html {
				height: 100%
			}
			
			body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			
			#map-canvas {
				height: 100%
			}
			select
{
 border: 1px solid #DDDDDD;
    font-size: 0.8em;
    padding: 3px;
    width: auto;
	float:left;
	margin:0 2px 0 0;
}
fieldset
{
  padding:15px 5px;
  border:1px dotted gray;
  border-width:1px 0;
  margin-top:-1px;
  position:relative;
  top:1px;
  background:none !important;
}
label
{
  font:normal normal normal 0.8em tahoma,sans-serif;
  display:block;
  padding-bottom:8px;
}
input[type="text"]
{
  width:13em;
  font-size:0.8em;
}

.radius-container {

    text-align: right;
    position: absolute;
    right: 200px;
    top: -2px;
    z-index: 99;
    background-color: $orange;
    color: white;
    padding: 5px;
	width:75%;}

    .select {
        width: 60px;
        font-size: 20px;
        text-align: center;
        margin: 5px 0;
    }
}

.regions{
	select {
        width: 60px;
        font-size: 20px;
        text-align: center;
        margin: 5px 0;
    }
}

    .map-container {
    position: relative;
}

#footer {
    position: absolute;
    bottom: 20px;
    right: 20px;
	z-index: 99;
	background-image: url('<?php echo base_url();?>images/tbg.png');
	background-repeat:repeat;
	color: white;
    padding: 4px;
	border:1px #000 solid;
	font-family:Verdana, Geneva, sans-serif;
	font-size:9px;
	width:550px;

}

#footer-left {
    position: absolute;
    bottom: 50px;
    left: 60px;
	z-index: 99;
	background-image: url('<?php echo base_url();?>images/tbg.png');
	background-repeat:repeat;
	color: black;
    padding: 4px;
	border:1px #000 solid;
	font-family:Verdana, Geneva, sans-serif;
	font-weight:bold;
	font-size:11px;
	width:400px;
	
}

#footer-left:hover {
	background-color:#FFF;
}

a {text-decoration:none;} 
a:link {color:#000;}      /* unvisited link */
a:visited {color:#000;}  /* visited link */
a:hover {color:#000;}  /* mouse over link */
a:active {color:#000;}  /* selected link */





		</style>
		<title>Projects Map</title>
        
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1-3-2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/animatedcollapse.js">

/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


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
	
  function GetSubsectors(frm){
	if(validateForm(frm)){
	document.getElementById('subsectors').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/activities/getsubsectors";
	
	var params = "sector_id=" + totalEncode(document.frm.sector_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('subsectors').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('subsectors').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	function GetConstituencies(frm){
	if(validateForm(frm)){
	document.getElementById('constituencies').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/subcounties/getconstituencies";
	
	var params = "county_id=" + totalEncode(document.frm.county_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('constituencies').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('constituencies').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	function GetSubcounties(frm){
	if(validateForm(frm)){
	document.getElementById('subcounties').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/sublocations/getsubcounties";
	
	var params = "constituency_id=" + totalEncode(document.frm.constituency_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('subcounties').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('subcounties').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function GetSublocations(frm){
	if(validateForm(frm)){
	document.getElementById('sublocations').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/sublocations/getsublocations";
	
	var params = "subcounty_id=" + totalEncode(document.frm.subcounty_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('sublocations').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('sublocations').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
		
	function GetSublocations(frm){
	if(validateForm(frm)){
	document.getElementById('sublocations').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/sublocations/getsublocations";
	
	var params = "subcounty_id=" + totalEncode(document.frm.subcounty_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('sublocations').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('sublocations').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
		
</script>



		
        
        <style>
		#map-canvas img {
   max-width: none;
   max-height: none;
}
		</style>


        
       
                              
	</head>
  
	<body>
    <div class="radius-container">
   <?php 
					   $attributes = array('name' => 'frm', 'id' => 'frm', 'enctype' => 'multipart/form-data','onsubmit'=>'return(validate())');
					  echo form_open('maps/getfullscreen_hfs',$attributes); ?>
  <select  name="county_id" id="county_id"  required>
                    <option value="" selected="selected">Select County</option>
                    <?php
                    foreach($counties as $key=>$county)
                    {
                    ?>
                    <option value="<?php echo $county['id'];?>" <?php if(set_value('county_id')==$county['id']){ echo 'selected="selected"';}?>><?php echo $county['county'];?></option>
                    <?php	
                    }
                    ?>
                    </select>
                                    <div id="constituencies">
                        <select name="constituency_id" id="constituency_id">
                        <option value="">Select Constituency</option>
                        </select>
                        </div>
                                    <div id="subcounties">
                        <select name="subcounty_id" id="subcounty_id">
                        <option value="">Select Sub County</option>
                        </select>
                        </div>
                               
                         <div id="sublocations">
                    
                    <select name="sublocation_id" id="sublocation_id">
                        <option value="">Select Sub County</option>
                        </select>
                    </div>
                          <select name="sector_id" id="sector_id">
                          <option value="">Select Sector</option>
                          <?php
						  
						  foreach($sectors as $key=>$sector)
						  {
							  ?>
                              <option value="<?php echo $sector['id'];?>" <?php if(set_value('sector_id')==$sector['id']){ echo 'selected="selected"';}?>><?php echo $sector['sector'];?></option>
                              <?php
						  }
						  ?>
                        
                        </select>     
                         <?php echo form_submit('submit', 'Get Map', 'class="btn btn-info "'); ?>
                               
                               <?php echo form_close(); ?>  
                          
    
</div>


 <div id="json_data" style="display:none;">
    <?php echo json_encode($points,JSON_HEX_QUOT | JSON_HEX_TAG); ?>
  </div>
  <div id="map-canvas"></div>
  
  
   <script src="<?php echo base_url(); ?>js/mapwithmarker.js"></script>
                   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                   <script src="<?php echo base_url(); ?>js/clusterer.js"></script>
                  
  <script src="<?php echo base_url(); ?>js/map.js"></script>
  
  <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

		
		
	</body>
</html>

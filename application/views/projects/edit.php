<?php include(APPPATH . 'views/common/head.php'); ?>
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
	
	function refreshList(frm){
	if(validateForm(frm)){
	document.getElementById('projimmediateobjectives').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/refreshobjectives";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('projimmediateobjectives').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('projimmediateobjectives').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function refreshObjectives(frm){
	if(validateForm(frm)){
	document.getElementById('proj_objectives').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/refresh_objectives";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('proj_objectives').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('proj_objectives').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function refreshOutcomeList(frm){
	if(validateForm(frm)){
	document.getElementById('outcomeselect').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/refreshoutcomes";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('outcomeselect').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('outcomeselect').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function refreshmyOutcomeList(frm){
	if(validateForm(frm)){
	document.getElementById('myoutcomeselect').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/refreshmyoutcomes";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('myoutcomeselect').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('myoutcomeselect').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function refreshOutputList(frm){
	if(validateForm(frm)){
	document.getElementById('outputselect').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/refreshoutputs";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('outputselect').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('outputselect').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	function refreshProjectOutputList(frm){
	if(validateForm(frm)){
	document.getElementById('myoutputselect').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/refreshmyoutputs";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('myoutputselect').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('myoutputselect').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	function addActivity(frm){
	if(validateForm(frm)){
	document.getElementById('activitylist').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/addactivity";
	
	var params =  "project_id="+totalEncode(document.myform.projectid.value )+ "&projectoutput_id="+totalEncode(document.myform.projectoutput_id.value )+ "&activity="+totalEncode(document.myform.activity.value )+ "&total_beneficiary_target="+totalEncode(document.myform.total_beneficiary_target.value )+ "&activity_start_date="+totalEncode(document.myform.activity_start_date.value )+ "&activity_end_date="+totalEncode(document.myform.activity_end_date.value );
	/**
	var params =  "project_id="+totalEncode(document.myform.projectid.value )+ "&projectoutput_id="+totalEncode(document.myform.projectoutput_id.value )+ "&activity="+totalEncode(document.myform.activity.value )+ "&resources="+totalEncode(document.myform.resources.value )+ "&cost="+totalEncode(document.myform.cost.value )+ "&activityassumptions="+totalEncode(document.myform.activityassumptions.value );
	
	**/
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('activitylist').innerHTML=connection.responseText;
		document.myform.activity.value='';
		document.myform.resources.value='';
		document.myform.cost.value='';
		document.myform.activityassumptions.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('activitylist').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function addBeneficiary(frm){
	if(validateForm(frm)){
	document.getElementById('beneficiarylist').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/addbeneficiary";
	
	var params =  "project_id="+totalEncode(document.beneficiaryform.project_id.value )+ "&beneficiary_id="+totalEncode(document.beneficiaryform.beneficiary_id.value )+ "&beneficiary_target="+totalEncode(document.beneficiaryform.beneficiary_target.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('beneficiarylist').innerHTML=connection.responseText;
		document.beneficiaryform.beneficiary_target.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('beneficiarylist').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	
	function addObjectiveIndicator(frm){
	if(validateForm(frm)){
	document.getElementById('objective_result').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/addobjectiveindicators";
	
	var params =  "project_id="+totalEncode(document.myform.project_id.value )+ "&project_objective_id="+totalEncode(document.myform.project_objective_id.value )+ "&obj_indicator="+totalEncode(document.myform.obj_indicator.value )+ "&obj_target="+totalEncode(document.myform.obj_target.value )+ "&obj_type="+totalEncode(document.myform.obj_type.value )+ "&obj_implementation_time="+totalEncode(document.myform.obj_implementation_time.value )+ "&obj_means="+totalEncode(document.myform.obj_means.value )+ "&obj_assumptions="+totalEncode(document.myform.obj_assumptions.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('objective_result').innerHTML=connection.responseText;
		document.myform.obj_indicator.value='';
		document.myform.obj_target.value='';
		document.myform.obj_implementation_time.value='';
		document.myform.obj_means.value='';
		document.myform.obj_assumptions.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('objective_result').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function addOutcomeIndicator(frm){
	if(validateForm(frm)){
	document.getElementById('outcome_result').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/addoutcomeindicators";
	
	var params =  "project_id="+totalEncode(document.myform.project_id.value )+ "&project_outcome_id="+totalEncode(document.myform.project_outcome_id.value )+ "&outcome_indicator="+totalEncode(document.myform.outcome_indicator.value )+ "&outcome_target="+totalEncode(document.myform.outcome_target.value )+ "&outcome_type="+totalEncode(document.myform.outcome_type.value )+ "&outcome_implementation_time="+totalEncode(document.myform.outcome_implementation_time.value )+ "&outcome_means="+totalEncode(document.myform.outcome_means.value )+ "&outcome_assumptions="+totalEncode(document.myform.outcome_assumptions.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('outcome_result').innerHTML=connection.responseText;
		document.myform.outcome_indicator.value='';
		document.myform.outcome_target.value='';
		document.myform.outcome_implementation_time.value='';
		document.myform.outcome_means.value='';
		document.myform.outcome_assumptions.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('outcome_result').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function addOutputIndicator(frm){
	if(validateForm(frm)){
	document.getElementById('output_result').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/addoutputindicators";
	
	var params =  "project_id="+totalEncode(document.myform.project_id.value )+ "&project_output_id="+totalEncode(document.myform.project_output_id.value )+ "&output_indicator="+totalEncode(document.myform.output_indicator.value )+ "&output_target="+totalEncode(document.myform.output_target.value )+ "&output_type="+totalEncode(document.myform.output_type.value )+ "&output_implementation_time="+totalEncode(document.myform.output_implementation_time.value )+ "&output_means="+totalEncode(document.myform.output_means.value )+ "&output_assumptions="+totalEncode(document.myform.output_assumptions.value );
	
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('output_result').innerHTML=connection.responseText;
		document.myform.output_indicator.value='';
		document.myform.output_target.value='';
		document.myform.output_implementation_time.value='';
		document.myform.output_means.value='';
		document.myform.output_assumptions.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('output_result').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	function deleteObjectiveIndicator(val){
		//if(validateForm(frm)){
			document.getElementById('objective_result').innerHTML='';
			var url = "<?php echo base_url(); ?>index.php/projectobjectiveindicators/deleteindicator";
			
			var params =  "id="+val;
			var connection=connect(url,params);
			
			connection.onreadystatechange = function(){
				if(connection.readyState == 4){
					document.getElementById('objective_result').innerHTML=connection.responseText;
					
					
				}
				if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('objective_result').innerHTML = '<span style="color:green;">Sending request....</span>';
				}
			}
		//}
	}
	
	
	function deleteOutcomeIndicator(val){
		//if(validateForm(frm)){
			document.getElementById('outcome_result').innerHTML='';
			var url = "<?php echo base_url(); ?>index.php/projectobjectiveindicators/deleteoutcomeindicator";
			
			var params =  "id="+val;
			var connection=connect(url,params);
			
			connection.onreadystatechange = function(){
				if(connection.readyState == 4){
					document.getElementById('outcome_result').innerHTML=connection.responseText;
					
					
				}
				if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('outcome_result').innerHTML = '<span style="color:green;">Sending request....</span>';
				}
			}
		//}
	}
	
	function deleteOutputIndicator(val){
		//if(validateForm(frm)){
			document.getElementById('output_result').innerHTML='';
			var url = "<?php echo base_url(); ?>index.php/projectobjectiveindicators/deleteoutputindicator";
			
			var params =  "id="+val;
			var connection=connect(url,params);
			
			connection.onreadystatechange = function(){
				if(connection.readyState == 4){
					document.getElementById('output_result').innerHTML=connection.responseText;
					
					
				}
				if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('output_result').innerHTML = '<span style="color:green;">Sending request....</span>';
				}
			}
		//}
	}
	
	
	function deleteOutputActivity(val){
		//if(validateForm(frm)){
			document.getElementById('activitylist').innerHTML='';
			var url = "<?php echo base_url(); ?>index.php/projectobjectiveindicators/deleteoutputactivity";
			
			var params =  "id="+val;
			var connection=connect(url,params);
			
			connection.onreadystatechange = function(){
				if(connection.readyState == 4){
					document.getElementById('activitylist').innerHTML=connection.responseText;
					
					
				}
				if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('activitylist').innerHTML = '<span style="color:green;">Sending request....</span>';
				}
			}
		//}
	}
	
	
	
	
	
</script>

<script type="text/javascript">
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo base_url(); ?>index.php/projects/upload",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
				$("#targetLayer").html(data);
				document.uploadForm.document_title.value='';
				document.uploadForm.description.value='';
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
   </SCRIPT>
<style>

.add_objective_indicators{color:#fff;background-color:#428bca;border-color:#357ebd}
.add_objective_indicators:hover,.add_objective_indicators:focus,.add_objective_indicators:active,.add_objective_indicators.active,.open>.dropdown-toggle.add_objective_indicators{color:#fff;background-color:#3071a9;border-color:#285e8e}

.add_objective{color:#fff;background-color:#428bca;border-color:#357ebd}
.add_objective:hover,.add_objective:focus,.add_objective:active,.add_objective.active,.open>.dropdown-toggle.add_objective{color:#fff;background-color:#3071a9;border-color:#285e8e}

.add_outcome{color:#fff;background-color:#428bca;border-color:#357ebd}
.add_outcome:hover,.add_outcome:focus,.add_outcome:active,.add_outcome.active,.open>.dropdown-toggle.add_outcome{color:#fff;background-color:#3071a9;border-color:#285e8e}

.add_output{color:#fff;background-color:#428bca;border-color:#357ebd}
.add_output:hover,.add_output:focus,.add_output:active,.add_output.active,.open>.dropdown-toggle.add_output{color:#fff;background-color:#3071a9;border-color:#285e8e}

</style>


<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/editobjective",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		function showTheEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToTheDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/editindicator",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		function DeleteTheIndicator(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/deleteindicator",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		
		function editRecord(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveRecord(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/editoutcome",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		function editIndicatorRecord(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveIndicatorRecord(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/updateoutcomeindicator",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		
		function editOutputRecord(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveOutputRecord(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/editoutput",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		function editOutputIndicator(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveOutputIndicator(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/saveoutputindicator",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		function editActivity(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveActivity(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/saveplannedactivity",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		function editBeneficiaryRecord(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveBeneficiaryRecord(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/projectobjectiveindicators/savebeneficiary",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
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
							<a href="<?php echo base_url() ?>index.php/projects">projects</a>
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
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#first11" data-toggle='tab'>
											<i class="fa fa-tasks"></i>Project Information</a>
									</li>
									<li>
										<a href="#second22" data-toggle='tab'>
											<i class="fa fa-file"></i>Logical Framework</a>
									</li>
									<li>
										<a href="#thirds3322" data-toggle='tab'>
											<i class="fa fa-user"></i>Beneficiaries</a>
									</li>
									<li>
										<a href="#thirds33" data-toggle='tab'>
											<i class="fa fa-folder-open"></i>Documents</a>
									</li>
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="first11">
										<!-- Tab content begins-->
                                        <div class="box-content nopadding">
					<?php if(validation_errors()){?>
						<p><div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong><?php echo validation_errors(); ?>
							</div>
						</p>
					<?php } ?>
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-column form-striped form-validate');?>
					<?php echo form_open('projects/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project no</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_no', 'name' => 'project_no', 'value' => $row->project_no, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_no'));
					?>
                    <input type="hidden" name="projectid" id="projectid" value="<?php echo $row->id;?>">
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_title', 'name' => 'project_title', 'value' => $row->project_title, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project agreement number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_agreement_number', 'name' => 'project_agreement_number', 'value' => $row->project_agreement_number, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_agreement_number'));
					?>
				</div>
			</div>

			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of fund eligibility <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_fund_eligibility', 'name' => 'date_of_fund_eligibility', 'value' => $row->date_of_fund_eligibility, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_fund_eligibility'));
					?>
				</div>
			</div>-->
			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of agreement <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_agreement', 'name' => 'date_of_agreement', 'value' => $row->date_of_agreement, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_agreement'));
					?>
				</div>
			</div>-->
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project objective</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_objective', 'name' => 'project_objective', 'value' => $row->project_objective, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('project_objective'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'description', 'name' => 'description', 'value' => $row->description, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('description'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_start_date', 'name' => 'project_start_date', 'value' => $row->project_start_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project end date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
                
					<?php 
					$data = array('id' => 'project_end_date', 'name' => 'project_end_date', 'value' => $row->project_end_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_end_date'));
					?>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization</label>
				<div class="col-sm-10">
                <select name="organization_id" id="organization_id" class="form-control" required="required">
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
				<label for="textfield" class="control-label col-sm-2">Sectors</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="sector_id" name="sector_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($sectors as $key=>$sector)
					{
						$projectsector = $this->projectsectorsmodel->get_by_sector_project($row->id,$sector['id'])->row();
														
							if(empty($projectsector))
							{
								$sectorselected = '';
							}
							else
							{
								$sectorselected = 'selected="selected"';
							}														
													
						?>
                        <option value="<?php echo $sector['id'];?>" <?php echo $sectorselected;?>><?php echo $sector['sector'];?></option>
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
                        <option value="<?php echo $currency['currency'];?>" <?php if($row->currency==$currency['currency']){echo 'selected="selected"';}?>><?php echo $currency['currency'];?></option>
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
					$data = array('id' => 'project_budget', 'name' => 'project_budget', 'value' => $row->project_budget, 'class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
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
						$projectdonor = $this->projectdonorsmodel->get_by_project_donor($row->id,$donor['id'])->row();
														
						if(empty($projectdonor))
						{
							$donorselected = '';
						}
						else
						{
							$donorselected = 'selected="selected"';
						}
						?>
                        <option value="<?php echo $donor['id'];?>"<?php echo $donorselected;?> ><?php echo $donor['donor_name'];?></option>
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
						$projectpartner = $this->projectpartnersmodel->get_by_project_partner($row->id,$partner['id'])->row();
														
						if(empty($projectpartner))
						{
							$partnerselected = '';
						}
						else
						{
							$partnerselected = 'selected="selected"';
						}
						?>
                        <option value="<?php echo $partner['id'];?>" <?php echo $partnerselected;?> ><?php echo $partner['partner'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>
            
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Regions</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="county_id" name="county_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($counties as $key=>$county)
					{
						$projectcounty = $this->projectscountiesmodel->get_by_project_county($row->id,$county['id'])->row();
														
						if(empty($projectcounty))
						{
						$countyselected = '';
						}
						else
						{
						$countyselected = 'selected="selected"';
						}
						?>
                        <option value="<?php echo $county['id'];?>" <?php echo $countyselected;?> ><?php echo $county['county'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>
            
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Districts</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="district_id" name="district_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($districts as $key=>$district)
					{
						$projectdistrict = $this->projectsdistrictsmodel->get_by_project_district($row->id,$district->id)->row();
														
						if(empty($projectdistrict))
						{
						 $districtselect = '';
						}
						else
						{
						 $districtselect = 'selected="selected"';
						}
						?>
                        <option value="<?php echo $district->id;?>" <?php echo $districtselect;?> ><?php echo $district->district;?></option>
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
                        <option value="<?php echo $projectstatus['id'];?>" <?php if($row->projectactivitystatus_id==$projectstatus['id']){echo 'selected="selected"';}?>><?php echo $projectstatus['status'];?></option>
                        <?php
					}
					?>
                </select>
					
				</div>
			</div>

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">UPDATE CHANGES</button>
                        <a href="<?php echo site_url('projects')?>" class="btn btn-danger">CANCEL</a>
					</div>
				<?php echo form_close(); ?>
 			</div>
                                        
                                        <!-- Tab content ends-->
									</div>
									<div class="tab-pane" id="second22">
                                     <!-- Tab content starts-->
                                     
                                     <!--<a href="<?php echo base_url() ?>index.php/projects/logframe/<?php echo $row->id;?>" title="" class="btn btn-success" style="margin: 5px;" target="_blank" >DOWNLOAD LOGFRAME <i class="fa fa-download"></i></a>-->
                                     
                                     <a href="<?php echo base_url() ?>index.php/projects/downloadlogicalframework/<?php echo $row->id; ?>" class="btn btn-success" target="_blank">DOWNLOAD LOGICAL FRAMEWORK <i class="fa fa-file-word-o"></i> </a>
										
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="box box-color box-bordered">
                                                    <div class="box-title">
                                                        <h3>
                                                            <i class="fa fa-magic"></i>
                                                           Logical Framework Wizard
                                                        </h3>
                                                    </div>
                                                    <div class="box-content nopadding">
                                                        <form action="" method="POST" class='form-horizontal form-wizard' id="myform" name="myform">
                                                        <input type="hidden" name="project_id" id="project_id" value="<?php echo $row->id;?>">
                                                            <div class="step" id="firstStep">
                                                                <ul class="wizard-steps steps-3">
                                                                    <li class='active'>
                                                                        <div class="single-step">
                                                                            <span class="title">1</span>
                                                                            <span class="circle">
                                                                                <span class="active"></span>
                                                                            </span>
                                                                            <span class="description">
                                                                               Goal/Principal Objective
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="single-step">
                                                                            <span class="title">2</span>
                                                                            <span class="circle">
                                                                            </span>
                                                                            <span class="description">
                                                                                Outcome/Specific Objective
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="single-step">
                                                                            <span class="title">3</span>
                                                                            <span class="circle">
                                                                            </span>
                                                                            <span class="description">
                                                                               Output/Results
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                
                                                                <table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Objectives</th></tr>
                                                                </thead>
                                                                <tr><td>
                                                                <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Objective</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <input type="text" name="objective[]" id="objective"  class="form-control">
                                                                            <input type="hidden" name="projectid[]" id="projectid" value="<?php echo $row->id;?>">
                                                                            <input type="hidden" name="specific_objective[]" id="specific_objective" value="1">
                                                                            
                                                                            <span class="help-block">
                                                                                <code>Enter Objective/Goal (What you want to achieve)</code>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Type Of Objective</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                        <select name="specific_objective[]" id="specific_objective" class="form-control">
                                                                        <option value="1">Principal</option>
                                                                        <option value="0" selected>Specific</option>
                                                                        </select>
                                                                           
                                                                         
                                                                            <span class="help-block">
                                                                                <code>Select if this is principal or specific objective</code>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                                </td></tr>
                                                                <tr><td>
                                                                <p> 
					<input type="button" value="Add Indicator" onClick="addRow('dataTable')" class="btn btn-success"/> 
					<input type="button" value="Remove Indicator" onClick="deleteRow('dataTable')" class="btn btn-danger"  /> 
                    <p><span class="help-block">
                         <code>For the objective entered above, add indicator(s)</code>
                        </span></p>
					<p><small>(All actions apply only to entries with check marked check boxes only.)</small></p>
                                                                </td></tr>
                                                                <tr><td>
                                                                 <table id="dataTable" class="table table-hover table-nomargin table-bordered">
                                                                      <tbody>
                                                                        <tr>
                                                                          <p>
                                                                            <td><input type="checkbox" required="required" name="chk[]" id="indicheck" checked="checked" /></td>
                                                                            <td>
                                                                                <label>Indicator</label>
                                                                              
                                                                                <textarea name="indicator[]" id="indicator"></textarea>
                                                                                <span class="help-block">
                                                                                    <code>How to measure change</code>
                                                                                </span>
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_age">Target</label>
                                                                                <input type="text"  class="small" id="target"  name="target[]">
                                                                                 <span class="help-block">
                                                                                    <code>Specific target to be reached. (If qualitative or without definite target enter 1) </code>
                                                                                    </span>
                                                                                 <select id="type" name="type[]" class="form-control">
                                                                                    <option value="Quantitative">Quantitative</option>
                                                                                    <option value="Qualitative">Qualitative</option>
                                                                                </select>
                                                                                 <span class="help-block">
                                                                                    <code> Quantitative data have numeric variables while qualitative data have categorical variables</code>
                                                                                </span>
                                                                             </td>
                                                                              <td>
                                                                                <label for="BX_gender">Implementation Time</label><br>
                                                                              <input type="text" name="implementation_time[]" id="implementation_time" onKeyPress="return isNumberKey(event);" class="small">
                                                                                 <span class="help-block">
                                                                                    <code>Time to implement in months (From project start date)</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_gender">Means of verification</label><br>
                                                                                <textarea name="means[]" id="means"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>Where and how to get information</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_birth">Assumptions</label><br>
                                                                                <textarea name="assumptions[]" id="assumptions"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>What else to be aware of</code>
                                                                                </span>
                                                                             </td>
                                                                                </p>
                                                                        </tr>
                                                                      </tbody>
                                                                  </table>	
                                                                </td></tr>
                                                                
                                                           <tr><td>&nbsp;</td></tr>
                                                           
                                                            
                                                           <tr><td>
                                                          
                                                           <button type="button" name="add_objective" id="add_objective" class="add_objective">SAVE OBJECTIVE &amp; INDICATOR(S)</button>
                                                           </td></tr>
                                                           
                                                           <tr><td><div align="right"><button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Add Indicators to Existing Objectives</button></div>
  <div id="demo" class="collapse">
   <table class="table table-hover table-nomargin">
   <tr><td>Objective  <span class="help-block">
                                                                                    <code>Select the objective to which you are adding the indicator</code>
                                                                                </span></td><td> <div id="proj_objectives">
                                                                           <?php 
																			echo $proj_objselect;
																			?>
                                                                            
                                                                            </div>
                                                                             <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='refreshObjectives(this)'>Refresh List <i class="fa fa-refresh"></i></a></td></tr>
    <!-- <tr><td colspan="2">
     <p> 
					<input type="button" value="Add Indicator" onClick="addRow('MydataTable')" class="btn btn-success"/> 
					<input type="button" value="Remove Indicator" onClick="deleteRow('MydataTable')" class="btn btn-danger"  /> 
                    <p><span class="help-block">
                         <code>For the objective selected above, add indicator(s)</code>
                        </span></p>
					<p><small>(All actions apply only to entries with check marked check boxes only.)</small></p>
     </td>
     </tr>-->
     
     <tr><td colspan="2">
     
     <table id="MydataTable" class="table table-hover table-nomargin table-bordered">
                                                                      <tbody>
                                                                        <tr>
                                                                          <p>
                                                                            <!--<td><input type="checkbox" required="required" name="chk[]" id="myindicheck" checked="checked" /></td>-->
                                                                            <td>
                                                                                <label>Indicator</label>
                                                                              
                                                                                <textarea name="obj_indicator" id="obj_indicator"></textarea>
                                                                                <span class="help-block">
                                                                                    <code>How to measure change</code>
                                                                                </span>
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_age">Target</label>
                                                                                <input type="text"  class="small" id="obj_target"  name="obj_target">
                                                                                 <span class="help-block">
                                                                                    <code>Specific target to be reached. (If qualitative or without definite target enter 1) </code>
                                                                                    </span>
                                                                                 <select id="obj_type" name="obj_type" class="form-control">
                                                                                    <option value="Quantitative">Quantitative</option>
                                                                                    <option value="Qualitative">Qualitative</option>
                                                                                </select>
                                                                                 <span class="help-block">
                                                                                    <code> Quantitative data have numeric variables while qualitative data have categorical variables</code>
                                                                                </span>
                                                                             </td>
                                                                              <td>
                                                                                <label for="BX_gender">Implementation Time</label><br>
                                                                              <input type="text" name="obj_implementation_time" id="obj_implementation_time" onKeyPress="return isNumberKey(event);" class="small">
                                                                                 <span class="help-block">
                                                                                    <code>Time to implement in months (From project start date)</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_gender">Means of verification</label><br>
                                                                                <textarea name="obj_means" id="obj_means"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>Where and how to get information</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_birth">Assumptions</label><br>
                                                                                <textarea name="obj_assumptions" id="obj_assumptions"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>What else to be aware of</code>
                                                                                </span>
                                                                             </td>
                                                                                </p>
                                                                        </tr>
                                                                      </tbody>
                                                                  </table>
     
     
     </td>
     </tr>
     
     <tr><td colspan="2"> <!--<button type="button" name="add_objective_indicators" id="add_objective_indicators" class="add_objective_indicators">SAVE INDICATOR</button>-->
     <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addObjectiveIndicator(this)'>SAVE INDICATOR <i class="fa fa-plus"></i></a>
     </td></tr>
   
   </table>
  </div></td></tr>
                                                           
                                                              </table>
                                                               <div id="objective_result">
                                                                    <?php echo $table; ?>
                                                                  
                                                                </div> 
                                                                
                                                                
                                                                
                                                                
                                                                
                                                            </div>
                                                            <div class="step" id="secondStep">
                                                                <ul class="wizard-steps steps-3">
                                                                    <li>
                                                                        <div class="single-step">
                                                                            <span class="title">1</span>
                                                                            <span class="circle">
                                                                            </span>
                                                                            <span class="description">
                                                                                Goal/Principal Objective.
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class='active'>
                                                                        <div class="single-step">
                                                                            <span class="title">
                                                                                2</span>
                                                                            <span class="circle">
                                                                                <span class="active"></span>
                                                                            </span>
                                                                            <span class="description">
                                                                                Outcome/Specific Objective
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="single-step">
                                                                            <span class="title">
                                                                                3</span>
                                                                            <span class="circle">
                                                                            </span>
                                                                            <span class="description">
                                                                                Output/Results
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                               
                                                                <table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Project Outcomes</th></tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                <td>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Objective</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <div id="projimmediateobjectives">
                                                                           <?php 
																			echo $projobjselect;
																			?>
                                                                            
                                                                            </div>
                                                                             <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='refreshList(this)'>Refresh List <i class="fa fa-refresh"></i></a>
                                                                            <input type="hidden" name="outcomeproject_id[]" id="outcomeproject_id" value="<?php echo $row->id;?>">
                                                                          
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Outcome</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <input type="text" name="outcome[]" id="outcome"  class="form-control">
                                                                            
                                                                            <span class="help-block">
                                                                                <code>The primary result(s) that an intervention seeks to achieve</code>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                </td>
                                                                </tr>
                                                                
                                                                <tr><td>
                                                                <p> 
					<input type="button" value="Add Indicator" onClick="addRow('outcomeTable')" class="btn btn-success"/> 
					<input type="button" value="Remove Indicator" onClick="deleteRow('outcomeTable')" class="btn btn-danger"  /> 
                    <p><span class="help-block">
                         <code>For the outcome entered above, add indicator(s)</code>
                        </span></p>
					<p><small>(All actions apply only to entries with check marked check boxes only.)</small></p>
                                                                </td></tr>
                                                                <tr><td>
                                                                 <table id="outcomeTable" class="table table-hover table-nomargin table-bordered">
                                                                      <tbody>
                                                                        <tr>
                                                                          <p>
                                                                            <td><input type="checkbox" required="required" name="chk[]" id="outcheck" checked="checked" /></td>
                                                                            <td>
                                                                                <label>Indicator</label>
                                                                                 <textarea name="outcomeindicator[]" id="outcomeindicator"></textarea>
                                                                                
                                                                                <span class="help-block">
                                                                                    <code>How to measure change</code>
                                                                                </span>
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_age">Target</label>
                                                                                <input type="text"  class="small" id="outcometarget"  name="outcometarget[]">
                                                                                <span class="help-block">
                                                                                    <code>Specific target to be reached. (If qualitative or without definite target enter 1)</code>
                                                                                </span>
                                                                                <select id="type" name="outcometype[]">
                                                                                    <option value="Quantitative">Quantitative</option>
                                                                                    <option value="Qualitative">Qualitative</option>
                                                                                </select>
                                                                                 
                                                                             </td>
                                                                              <td>
                                                                                <label for="BX_gender">Implementation Time</label><br>
                                                                                <input type="text" name="outcomeimplementation_time[]" id="outcomeimplementation_time" onKeyPress="return isNumberKey(event);" class="small">
                                                                                 <span class="help-block">
                                                                                    <code>Implementation time in months (From project start date)</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_gender">Means of verification</label><br>
                                                                                <textarea name="outcomemeans[]" id="outcomemeans"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>Where and how to get information</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_birth">Assumptions</label><br>
                                                                                <textarea name="outcomeassumptions[]" id="outcomeassumptions"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>What else to be aware of</code>
                                                                                </span>
                                                                             </td>
                                                                                </p>
                                                                        </tr>
                                                                      </tbody>
                                                                  </table>	
                                                                </td></tr>
                                                                
                                                           <tr><td>&nbsp;</td></tr>
                                                           <tr><td>
                                                          
                                                           <button type="button" name="add_outcome" id="add_outcome" class="add_outcome">SAVE OUTCOME &amp; INDICATOR(S)</button>
                                                           </td></tr>
                                                           
                                                           <tr><td>
                                                           
                                                           <div align="right"><button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#outcomeaddition">Add Indicators to Existing Outcomes</button></div>
  <div id="outcomeaddition" class="collapse">
  <table class="table table-hover table-nomargin">
  <tr><td>Outcome <span class="help-block">
                                                                                    <code>Select the outcome to which you are adding the indicator</code>
                                                                                </span></td><td><div id="myoutcomeselect">
                                                                           <?php 
																			echo $myoutcomeselect;
																			?>
                                                                            
                                                                            </div>
                                                                              <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='refreshmyOutcomeList(this)'>Refresh List <i class="fa fa-refresh"></i></a>
                                                                            
                                                                            </td>
                                                                            </tr>
  <tr>
  <td colspan="2">
  
  <table id="MyoutcomeTable" class="table table-hover table-nomargin table-bordered">
                                                                      <tbody>
                                                                        <tr>
                                                                          <p>
                                                                           
                                                                            <td>
                                                                                <label>Indicator</label>
                                                                                 <textarea name="outcome_indicator" id="outcome_indicator"></textarea>
                                                                                
                                                                                <span class="help-block">
                                                                                    <code>How to measure change</code>
                                                                                </span>
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_age">Target</label>
                                                                                <input type="text"  class="small" id="outcome_target"  name="outcome_target">
                                                                                <span class="help-block">
                                                                                    <code>Specific target to be reached. (If qualitative or without definite target enter 1)</code>
                                                                                </span>
                                                                                <select id="outcome_type" name="outcome_type">
                                                                                    <option value="Quantitative">Quantitative</option>
                                                                                    <option value="Qualitative">Qualitative</option>
                                                                                </select>
                                                                                 
                                                                             </td>
                                                                              <td>
                                                                                <label for="BX_gender">Implementation Time</label><br>
                                                                                <input type="text" name="outcome_implementation_time" id="outcome_implementation_time" onKeyPress="return isNumberKey(event);" class="small">
                                                                                 <span class="help-block">
                                                                                    <code>Implementation time in months (From project start date)</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_gender">Means of verification</label><br>
                                                                                <textarea name="outcome_means" id="outcome_means"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>Where and how to get information</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_birth">Assumptions</label><br>
                                                                                <textarea name="outcome_assumptions" id="outcome_assumptions"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>What else to be aware of</code>
                                                                                </span>
                                                                             </td>
                                                                                </p>
                                                                        </tr>
                                                                      </tbody>
                                                                  </table>
  
  </td>
  
  </tr>
   <tr><td colspan="2"> 
     <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addOutcomeIndicator(this)'>SAVE INDICATOR <i class="fa fa-plus"></i></a>
     </td></tr>
  
  </table>
  
  
  </div>
                                                           </td></tr>
                                                                
                                                                </tbody>
                                                                
                                                                </table>
                                                                
                                                                  <div id="outcome_result">
                                                                    <?php echo $outcometable; ?>
                                                                  
                                                                </div> 
                                                               
                                                            </div>
                                                            <div class="step" id="thirdStep">
                                                                <ul class="wizard-steps steps-3">
                                                                    <li>
                                                                        <div class="single-step">
                                                                            <span class="title">
                                                                                1</span>
                                                                            <span class="circle">
                                                                            </span>
                                                                            <span class="description">
                                                                                Goal/Principal Objective
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="single-step">
                                                                            <span class="title">
                                                                                2</span>
                                                                            <span class="circle">
                                                                            </span>
                                                                            <span class="description">
                                                                                Outcome/Specific Objective
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class='active'>
                                                                        <div class="single-step">
                                                                            <span class="title">
                                                                                3</span>
                                                                            <span class="circle">
                                                                                <span class="active"></span>
                                                                            </span>
                                                                            <span class="description">
                                                                            Output/Results</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                               
								<div class="tabs-container">
									<ul class="tabs tabs-inline tabs-left">
										<li class='active'>
											<a href="#first" data-toggle='tab'>
												<i class="fa fa-sign-out"></i>Output/Results</a>
										</li>
										<li>
											<a href="#second" data-toggle='tab'>
												<i class="fa fa-wrench"></i>Activities</a>
										</li>
										
									</ul>
								</div>
								<div class="tab-content padding tab-content-inline">
									<div class="tab-pane active" id="first">
										<table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Project Outputs</th></tr>
                                                                </thead>
                                                                <tbody>
                                                                
                                                                <tr>
                                                                <td>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Outcome</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <div id="outcomeselect">
                                                                           <?php 
																			echo $outcomeselect;
																			?>
                                                                            
                                                                            </div>
                                                                             <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='refreshOutcomeList(this)'>Refresh List <i class="fa fa-refresh"></i></a>
                                                                            <input type="hidden" name="outputproject_id[]" id="outputproject_id" value="<?php echo $row->id;?>">
                                                                          
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Output</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <input type="text" name="output[]" id="output"  class="form-control">
                                                                            
                                                                             <input type="hidden" name="outputproject_id[]" id="outputproject_id" value="<?php echo $row->id;?>">
                                                                            
                                                                            <span class="help-block">
                                                                                <code>The tangible products, goods and services and other immediate results that lead to the achievement of outcomes</code>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                </td>
                                                                </tr>
                                                                
                                                                <tr><td>
                                                                <p> 
					<input type="button" value="Add Indicator" onClick="addRow('outputTable')" class="btn btn-success"/> 
					<input type="button" value="Remove Indicator" onClick="deleteRow('outputTable')" class="btn btn-danger"  /> 
                    <p><span class="help-block">
                         <code>For the output entered above, add indicator(s)</code>
                        </span></p>
					<p><small>(All actions apply only to entries with check marked check boxes only.)</small></p>
                                                                </td></tr>
                                                                <tr><td>
                                                                 <table id="outputTable" class="table table-hover table-nomargin table-bordered">
                                                                      <tbody>
                                                                        <tr>
                                                                          <p>
                                                                            <td><input type="checkbox" required="required" name="chk[]" id="outputcheck" checked="checked" /></td>
                                                                            <td>
                                                                                <label>Indicator</label>
                                                                                 <textarea name="outputindicator[]" id="outputindicator"></textarea>
                                                                               
                                                                                <span class="help-block">
                                                                                    <code>How to measure change</code>
                                                                                </span>
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_age">Target</label>
                                                                                <input type="text"  class="small" id="outputtarget"  name="outputtarget[]">
                                                                                 <span class="help-block">
                                                                                    <code>Specific target to be reached. (If qualitative or without definite target enter 1)</code>
                                                                                </span>
                                                                                <select id="type" name="outputtype[]">
                                                                                    <option value="Quantitative">Quantitative</option>
                                                                                    <option value="Qualitative">Qualitative</option>
                                                                                </select>
                                                                                
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_gender">Implementation Time</label><br>
                                                                                <input type="text" name="outputimplementation_time[]" id="outputimplementation_time" onKeyPress="return isNumberKey(event);" class="small">
                                                                                 <span class="help-block">
                                                                                    <code>Implementation time in months (From project start date)</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_gender">Means of verification</label><br>
                                                                                <textarea name="outputmeans[]" id="outputmeans"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>Where and how to get information</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_birth">Assumptions</label><br>
                                                                                <textarea name="outputassumptions[]" id="outputassumptions"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>What else to be aware of</code>
                                                                                </span>
                                                                             </td>
                                                                                </p>
                                                                        </tr>
                                                                      </tbody>
                                                                  </table>	
                                                                </td></tr>
                                                                
                                                           <tr><td>&nbsp;</td></tr>
                                                           <tr><td>
                                                          
                                                           <button type="button" name="add_output" id="add_output" class="add_output">SAVE OUTPUT &amp; INDICATOR(S)</button>
                                                           </td></tr>
                                                           
                                                           <tr><td>
                                                          <div align="right"> <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#outdemo">Add Indicators to Existing Outputs</button></div>
  <div id="outdemo" class="collapse">
  <table class="table table-hover table-nomargin">
  <tr><td>Output</td><td><div id="myoutputselect">
                                                                           <?php 
																			echo $myoutputselect;
																			?>
                                                                            
                                                                            </div>
                                                                             <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='refreshProjectOutputList(this)'>Refresh List <i class="fa fa-refresh"></i></a></td>
                                                                             </tr>
      <tr><td colspan="2">
      
      <table id="myoutputTable" class="table table-hover table-nomargin table-bordered">
                                                                      <tbody>
                                                                        <tr>
                                                                          <p>
                                                                           
                                                                            <td>
                                                                                <label>Indicator</label>
                                                                                 <textarea name="output_indicator" id="output_indicator"></textarea>
                                                                               
                                                                                <span class="help-block">
                                                                                    <code>How to measure change</code>
                                                                                </span>
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_age">Target</label>
                                                                                <input type="text"  class="small" id="output_target"  name="output_target">
                                                                                 <span class="help-block">
                                                                                    <code>Specific target to be reached. (If qualitative or without definite target enter 1)</code>
                                                                                </span>
                                                                                <select id="output_type" name="output_type">
                                                                                    <option value="Quantitative">Quantitative</option>
                                                                                    <option value="Qualitative">Qualitative</option>
                                                                                </select>
                                                                                
                                                                             </td>
                                                                             <td>
                                                                                <label for="BX_gender">Implementation Time</label><br>
                                                                                <input type="text" name="output_implementation_time" id="output_implementation_time" onKeyPress="return isNumberKey(event);" class="small">
                                                                                 <span class="help-block">
                                                                                    <code>Implementation time in months (From project start date)</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_gender">Means of verification</label><br>
                                                                                <textarea name="output_means" id="output_means"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>Where and how to get information</code>
                                                                                </span>                                                                            </td>
                                                                             <td>
                                                                                <label for="BX_birth">Assumptions</label><br>
                                                                                <textarea name="output_assumptions" id="output_assumptions"></textarea> 
                                                                                 <span class="help-block">
                                                                                    <code>What else to be aware of</code>
                                                                                </span>
                                                                             </td>
                                                                                </p>
                                                                        </tr>
                                                                      </tbody>
                                                                  </table>
      </td></tr>
      
      <tr>
      <td colspan="2"><a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addOutputIndicator(this)'>SAVE INDICATOR <i class="fa fa-plus"></i></a></td>
      </tr>
  </table>
  
  </div>
                                                           
                                                           </td></tr>
                                                                </tbody>
                                                                
                                        </table>
                                        
                                         <div id="output_result">
                                           <?php echo $outputtable; ?>
                                                                  
                                          </div> 
									</div>
									<div class="tab-pane" id="second">
										<table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Project Planned Activities</th></tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                <td>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Output</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <div id="outputselect">
                                                                           <?php 
																			echo $outputselect;
																			?>
                                                                            
                                                                            </div>
                                                                             <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='refreshOutputList(this)'>Refresh List <i class="fa fa-refresh"></i></a>
                                                                            <input type="hidden" name="activityproject_id" id="activityproject_id" value="<?php echo $row->id;?>">
                                                                          
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                <td>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Activity</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <input type="text" name="activity" id="activity"  class="form-control">
                                                                            
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Total Beneficiary Target</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                          <input type="text" name="total_beneficiary_target" id="total_beneficiary_target"  onKeyPress="return isNumberKey(event);"  class="form-control">
                                                                                                                                                       
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Start Date</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            
                                                                                                                                                     <?php 
					$data = array('id' => 'activity_start_date', 'name' => 'activity_start_date', 'value'=>$row->project_start_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('activity_start_date'));
					?>
                                                                            
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">End Date</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            
                                                                             
                                                                               <?php 
					$data = array('id' => 'activity_end_date', 'name' => 'activity_end_date', 'value'=>$row->project_end_date,'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('activity_end_date'));
					?>
                                                                            
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 
                                                                <!-- <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Input/Resources</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <textarea name="resources" id="resources"  class="form-control"></textarea>
                                                                            
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Costs &amp; Sources</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <textarea name="cost" id="cost"  class="form-control"></textarea>
                                                                            
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="textfield" class="control-label col-sm-2">Assumptions</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="col-xs-5">
                                                                            <textarea name="activityassumptions" id="activityassumptions"  class="form-control"></textarea>
                                                                            
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                                </td>
                                                                </tr>
                                                                <tr><td> <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addActivity(this)'>Add Activity <i class="fa fa-plus"></i></a></td></tr>
                                                                </tbody>
                                                                
                                        </table>
                                        <div id="activitylist">
                                        <?php echo $activitytable;?>
                                        </div>
                                        
                                        
									</div>
									
								</div>
							
                                                            </div>
                                                            <div class="form-actions">
                                                                <input type="reset" class="btn" value="Back" id="back">
                                                                <input type="submit" class="btn btn-primary" value="Submit" id="next">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                     <!-- Tab content ends-->
									</div>
									<div class="tab-pane" id="thirds3322">
                                     <form action="" method="POST" class='form-horizontal' id="beneficiaryform" name="beneficiaryform">
                                    <table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Project Beneficiaries</th></tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr><td>
										 <div class="form-group">
                                                                    <label for="text" class="control-label col-sm-2">Beneficiary</label>
Type                                                                    
<div class="col-sm-10">
                                                                        <select name="beneficiary_id" id="beneficiary_id" class="form-control">
                                                                        <?php 
																		foreach($beneficiaries as $key=>$beneficiary)
																		{
																			?>
                                                                            <option value="<?php echo $beneficiary['id'];?>"><?php echo $beneficiary['beneficiary_type'];?></option>
                                                                            <?php
																		}
																		?>
                                                                        
                                                                        </select>
                                                                        
                                                                        <input type="hidden" name="project_id" id="project_id" value="<?php echo $row->id;?>">
                                                                    </div>
                                                                </div>
                                                                </td></tr>
                                                                <tr><td>
                                                                 <div class="form-group">
                                                                    <label for="text" class="control-label col-sm-2">Beneficiary Targeted No</label>
                                                                   
                                                                    <div class="col-xs-5">
                                                                        <input type="text" value="" name="beneficiary_target" id="beneficiary_target" onKeyPress="return isNumberKey(event);" class="form-control">
                                                                        
                                                                      </div>  
                                                                   
                                                                </div>
                                                                </td></tr>
                                                                <tr><td>
                                                                <div class="form-actions">
                                                                <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addBeneficiary(this)'>ADD BENEFICIARY <i class="fa fa-plus"></i></a>
                                                                
                                                            </div>
                                                                </td></tr>
                                             </tbody>
                                        </table>
                                        
                                        <div id="beneficiarylist">
                                        <?php echo $beneficiarytable;?>
                                        </div>
                                        </form>
									</div>
									<div class="tab-pane" id="thirds33">
                                    
 								<form action="" method="POST" class='form-horizontal' id="uploadForm" name="uploadForm">
										<table class="table table-hover table-nomargin">
                                                                <thead>
                                                                	<tr><th>Project Documents</th></tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr><td>
										 <div class="form-group">
                                                                    <label for="text" class="control-label col-sm-2">Category</label>
                                                                    <div class="col-sm-10">
                                                                    <div class="col-xs-5">
                                                                        <select name="documentcategory_id" id="documentcategory_id" class="form-control">
                                                                        <?php 
																		foreach($documentcategories as $key=>$documentcategory)
																		{
																			?>
                                                                            <option value="<?php echo $documentcategory['id'];?>"><?php echo $documentcategory['category'];?></option>
                                                                            <?php
																		}
																		?>
                                                                        
                                                                        </select>
                                                                        <input type="hidden" name="project_id" id="project_id" value="<?php echo $row->id;?>">
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                </td></tr>
                                                                 <tr><td>
                                                                 <div class="form-group">
                                                                    <label for="text" class="control-label col-sm-2">Title</label>
                                                                   
                                                                    <div class="col-xs-5">
                                                                        <input type="text" value="" name="document_title" id="document_title" class="form-control" required="required">
                                                                        
                                                                      </div>  
                                                                   
                                                                </div>
                                                                </td></tr>
                                                                <tr><td>
                                                                 <div class="form-group">
                                                                    <label for="text" class="control-label col-sm-2">Description</label>
                                                                   
                                                                    <div class="col-xs-5">
                                                                        <textarea name="description" id="description" class="form-control" required="required"></textarea>
                                                                        
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
                                                                    <label for="textfield" class="control-label col-sm-2">Upload Document</label>
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
                                                                <input type="submit" class="btn btn-primary" value="UPLOAD DOCUMENT">
                                                            </div>
                                                                </td></tr>
                                             </tbody>
                                        </table>
                                        <div id="targetLayer"><?php echo $documentstable;?></div>
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


 <script>

		
        $(function() {

            $('.add_objective').click(function() {

                // Get data as array, ['Jon', 'Mike']
				var project_id = $('input[name="projectid[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var objective = $('input[name="objective[]"]').map(function(){ 
                    return this.value; 
                }).get();
				var specific_objective = $('select[name="specific_objective[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var indicator = $('textarea[name="indicator[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var target = $('input[name="target[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var type = $('select[name="type[]"]').map(function(){ 
                    return this.value; 
                }).get();
				var implementation_time = $('input[name="implementation_time[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var means = $('textarea[name="means[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var assumptions = $('textarea[name="assumptions[]"]').map(function(){ 
                    return this.value; 
                }).get();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>index.php/projects/objectivelogframe',
                    data: {
						'project_id[]': project_id,
                        'objective[]': objective,
						'specific_objective[]': specific_objective,
						'indicator[]': indicator,
						'target[]': target,
						'type[]': type,
						'implementation_time[]': implementation_time,
						'means[]': means,
						'assumptions[]': assumptions,
                        // other data
                    },
                    success: function(data) {
							$("#objective_result").html(data);
							$(document).ready(function() {
								document.getElementById('indicheck').checked=false;
								deleteRow('dataTable');
								clearText();
								
							});
							
						
		
                    }
                });

            });

        });
		
		
		

    </script>
    
    
    <script>
/**
		
        $(function() {

            $('.add_objective_indicators').click(function() {

                // Get data as array, ['Jon', 'Mike']
				var project_id = $('input[name="project_id[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var project_objective_id = $('select[name="project_objective_id[]"]').map(function(){ 
                    return this.value; 
                }).get();
				var obj_indicator = $('textarea[name="obj_indicator[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var obj_target = $('input[name="obj_target[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var obj_type = $('select[name="obj_type[]"]').map(function(){ 
                    return this.value; 
                }).get();
				var obj_implementation_time = $('input[name="obj_implementation_time[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var obj_means = $('textarea[name="obj_means[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var obj_assumptions = $('textarea[name="obj_assumptions[]"]').map(function(){ 
                    return this.value; 
                }).get();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>index.php/projects/objectiveindicators',
                    data: {
						'project_id[]': project_id,
                        'project_objective_id[]': project_objective_id,
						'obj_indicator[]': obj_indicator,
						'obj_target[]': obj_target,
						'obj_type[]': obj_type,
						'obj_implementation_time[]': obj_implementation_time,
						'obj_means[]': obj_means,
						'obj_assumptions[]': obj_assumptions,
                        // other data
                    },
                    success: function(data) {
							$("#objective_result").html(data);
							$(document).ready(function() {
								document.getElementById('myindicheck').checked=false;
								deleteRow('MydataTable');
								clearText();
								
							});
							
						
		
                    }
                });

            });

        });
		
		
		**/

    </script>
    
    <script>
    $(function() {

            $('.add_outcome').click(function() {

                // Get data as array, ['Jon', 'Mike']
				var outcomeproject_id = $('input[name="outcomeproject_id[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var projectobjective_id = $('select[name="projectobjective_id[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outcome = $('input[name="outcome[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outcomeindicator = $('textarea[name="outcomeindicator[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outcometarget = $('input[name="outcometarget[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outcometype = $('select[name="outcometype[]"]').map(function(){ 
                    return this.value; 
                }).get();
				var outcomeimplementation_time = $('input[name="outcomeimplementation_time[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outcomemeans = $('textarea[name="outcomemeans[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outcomeassumptions = $('textarea[name="outcomeassumptions[]"]').map(function(){ 
                    return this.value; 
                }).get();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>index.php/projects/outcomelogframe',
                    data: {
						'project_id[]': outcomeproject_id,
                        'projectobjective_id[]': projectobjective_id,
						'outcome[]': outcome,
						'outcomeindicator[]': outcomeindicator,
						'outcometarget[]': outcometarget,
						'outcometype[]': outcometype,
						'outcomeimplementation_time[]': outcomeimplementation_time,
						'outcomemeans[]': outcomemeans,
						'outcomeassumptions[]': outcomeassumptions,
                        // other data
                    },
                    success: function(data) {
							$("#outcome_result").html(data);
							$(document).ready(function() {
								document.getElementById('outcheck').checked=false;
								deleteRow('outcomeTable');
								clearoutputText();
								
							});
							
						
		
                    }
                });

            });

        });
    </script>
    
    <script>
    $(function() {

            $('.add_output').click(function() {

                // Get data as array, ['Jon', 'Mike']
				var outputproject_id = $('input[name="outputproject_id[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var projectoutcome_id = $('select[name="projectoutcome_id[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var output = $('input[name="output[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outputindicator = $('textarea[name="outputindicator[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outputtarget = $('input[name="outputtarget[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outputtype = $('select[name="outputtype[]"]').map(function(){ 
                    return this.value; 
                }).get();
				var outputimplementation_time = $('input[name="outputimplementation_time[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outputmeans = $('textarea[name="outputmeans[]"]').map(function(){ 
                    return this.value; 
                }).get();
				 var outputassumptions = $('textarea[name="outputassumptions[]"]').map(function(){ 
                    return this.value; 
                }).get();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>index.php/projects/outputlogframe',
                    data: {
						'project_id[]': outputproject_id,
                        'projectoutcome_id[]': projectoutcome_id,
						'output[]': output,
						'outputindicator[]': outputindicator,
						'outputtarget[]': outputtarget,
						'outputtype[]': outputtype,
						'outputimplementation_time[]': outputimplementation_time,
						'outputmeans[]': outputmeans,
						'outputassumptions[]': outputassumptions,
                        // other data
                    },
                    success: function(data) {
							$("#output_result").html(data);
							$(document).ready(function() {
								document.getElementById('outputcheck').checked=false;
								deleteRow('outputTable');
								clearoutText();
								
							});
							
						
		
                    }
                });

            });

        });
    </script>
    
    <script>
	
	function clearText()
	{
			document.getElementById('objective').value='';
			document.getElementById('indicator').value='';
			document.getElementById('target').value='';
			document.getElementById('implementation_time').value='';
			document.getElementById('means').value='';
			document.getElementById('assumptions').value='';
			document.getElementById('indicheck').checked=true;
	}
	
	
	function clearoutputText()
	{
			document.getElementById('outcome').value='';
			document.getElementById('outcomeindicator').value='';
			document.getElementById('outcometarget').value='';
			document.getElementById('outcomeimplementation_time').value='';
			document.getElementById('outcomemeans').value='';
			document.getElementById('outcomeassumptions').value='';
			document.getElementById('outcheck').checked=true;
	}
	
	function clearoutText()
	{
			document.getElementById('output').value='';
			document.getElementById('outputindicator').value='';
			document.getElementById('outputtarget').value='';
			document.getElementById('outputimplementation_time').value='';
			document.getElementById('outputmeans').value='';
			document.getElementById('outputassumptions').value='';
			document.getElementById('outputcheck').checked=true;
	}
	
	
	</script>
    
</body>
</html>

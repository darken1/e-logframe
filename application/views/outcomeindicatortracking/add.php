<?php include(APPPATH . 'views/common/head.php'); ?>
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
	
	function GetIndicators(frm){
	if(validateForm(frm)){
	document.getElementById('indicators').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/outcomeindicatortracking/getindicators";
	
	var params = "project_id=" + totalEncode(document.frm.project_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('indicators').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('indicators').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	
	function GetOutcomes(frm){
	if(validateForm(frm)){
	document.getElementById('outcomes').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/outcomeindicatortracking/getoutcomes";
	
	var params = "project_id=" + totalEncode(document.frm.project_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('outcomes').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('outcomes').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function GetOutcomeIndicators(frm){
	if(validateForm(frm)){
	document.getElementById('indicators').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/outcomeindicatortracking/getoutcomeindicators";
	
	var params = "projectoutcome_id=" + totalEncode(document.frm.projectoutcome_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('indicators').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('indicators').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function GetTargets(frm){
	if(validateForm(frm)){
	document.getElementById('targets').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/outcomeindicatortracking/gettargets";
	
	var params = "projectoutcomeindicator_id=" + totalEncode(document.frm.projectoutcomeindicator_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('targets').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('targets').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function addReach(frm){
	if(validateForm(frm)){
	document.getElementById('historylist').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/outcomeindicatortracking/addreach";
	
	var params =  "projectoutcomeindicator_id="+totalEncode(document.frm.projectoutcomeindicator_id.value )+ "&reached="+totalEncode(document.frm.reached.value )+ "&report_month="+totalEncode(document.frm.report_month.value )+ "&report_year="+totalEncode(document.frm.report_year.value )+ "&project_id="+totalEncode(document.frm.project_id.value )+ "&comments="+totalEncode(document.frm.comments.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('historylist').innerHTML=connection.responseText;
		document.frm.comments.value='';
		document.frm.reached.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('historylist').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	function addHistory(frm){
	if(validateForm(frm)){
	document.getElementById('historylist').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/outcomeindicatortracking/addhistory";
	
	var params =  "projectoutcomeindicator_id="+totalEncode(document.frm.projectoutcomeindicator_id.value )+ "&reached="+totalEncode(document.frm.reached.value )+ "&report_month="+totalEncode(document.frm.report_month.value )+ "&report_year="+totalEncode(document.frm.report_year.value )+ "&project_id="+totalEncode(document.frm.project_id.value )+ "&comments="+totalEncode(document.frm.comments.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('historylist').innerHTML=connection.responseText;
		document.frm.comments.value='';
		document.frm.reached.value='';
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('historylist').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
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
   
   <script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/outcomeindicatortracking/editreached",
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
				url: "<?php echo base_url(); ?>index.php/outcomeindicatortracking/editcomment",
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
							<a href="<?php echo base_url() ?>index.php/outcomeindicatortracking/add">Outcome indicators tracking</a>
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
					<?php echo form_open('outcomeindicatortracking/add_validate',$attributes); ?>
                    <table class="table table-nomargin" width="100%">
                                                                <thead>
                                                                	<tr><th colspan="2">INDICATOR TRACKING</th></tr>
                                                                </thead>
                                                                <tbody>
              <tr><td width="50%">
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project</label>
				<div class="col-sm-10">
                
					  <select name="project_id" id="project_id" onChange="GetOutcomes(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Project</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>"><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Outcome</label>
				<div class="col-sm-10">
					 <div id="outcomes">
                                            <select name="projectoutcome_id" id="projectoutcome_id" class='chosen-select form-control' required="required">
                                            <option value="">Select Outcome</option>
                                            </select>
                                            </div>
				</div>
			</div>

			
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Indicator</label>
				<div class="col-sm-10">
					 <div id="indicators">
                                            <select name="projectoutputindicator_id" id="projectoutputindicator_id" class='chosen-select form-control' required="required">
                                            <option value="">Select Indicator</option>
                                            </select>
                                            </div>
				</div>
			</div>
            
            

			

					<!--<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">SAVE ENTRY</button>
					</div>-->
                    </td>
                    <td width="50%">
                    
                    <table class="table table-nomargin">
                    <tr><td>Report Month</td>
                    <td><select name="report_month" id="report_month" class='form-control' required="required">
                                            <option value="01" <?php if(set_value('report_month')==01){echo 'selected="selected"';}?>>January</option>
                  <option value="02" <?php if(set_value('report_month')==02){echo 'selected="selected"';}?>>February</option>
                  <option value="03" <?php if(set_value('report_month')==03){echo 'selected="selected"';}?>>March</option>
                  <option value="04" <?php if(set_value('report_month')==04){echo 'selected="selected"';}?>>April</option>
                  <option value="05" <?php if(set_value('report_month')==05){echo 'selected="selected"';}?>>May</option>
                  <option value="06" <?php if(set_value('report_month')==06){echo 'selected="selected"';}?>>June</option>
                  <option value="07" <?php if(set_value('report_month')==07){echo 'selected="selected"';}?>>July</option>
                  <option value="08" <?php if(set_value('report_month')==08){echo 'selected="selected"';}?>>August</option>
                  <option value="09" <?php if(set_value('report_month')==09){echo 'selected="selected"';}?>>September</option>
                  <option value="10" <?php if(set_value('report_month')==10){echo 'selected="selected"';}?>>October</option>
                  <option value="11" <?php if(set_value('report_month')==11){echo 'selected="selected"';}?>>November</option>
                  <option value="12" <?php if(set_value('report_month')==12){echo 'selected="selected"';}?>>December</option>
                                            </select>
                     </td></tr>
                     <tr><td>Report Year</td>
                    <td><select name="report_year" id="report_year" class='form-control' required="required">
                                          
					<?php
                    $y = date('Y');
                    $d = ($y-1);
                    $limit = ($y+1);
                    for($x=$d;$x<=$limit;$x++)
                    {
                    ?>
                      <option value="<?php echo $x;?>" <?php if(set_value('to_year')==$x){echo 'selected="selected"';}?>><?php echo $x;?></option>
                      <?php
                      }
                      
                      ?>
                                            </select>
                     </td></tr>
                     <tr><td colspan="2">
                     <div id="targets">
                     
                     
                     </div>
                     </td>
                     </tr>
                    
                     <tr><th colspan="2">TRACKING HISTORY</th></tr>
                     
                     <tr>
                     <td colspan="2">
                     
                     <div id="historylist">
                     
                     
                     </div>
                     </td>
                     </tr>
                    
                    </table>
                    
                    
                    </td>
                    </tr>
                    </tbody>
                    </table>
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

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
	
	</script>
    
<script type="text/javascript">
$(document).ready(function() {
 
 var myCounter = 0;
 $(".myDate").datepicker();
  
 $("#moreDates").click(function(){
   
  $('.myTemplate')
   .clone()
   .removeClass("myTemplate")
   .addClass("additionalDate")
   .show()
   .appendTo('#importantDates');
   
  myCounter++;
  $('.additionalDate input[name=inputDate]').each(function(index) {
   $(this).addClass("myDate");
   //$(this).attr("name",$(this).attr("name") + myCounter);
  });
   
  $(".myDate").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker();
       $this.datepicker("show");
      }
  });
   
 });
  
});
</script>		


<style> 
 .myDate { 
    border: 1px solid #999; 
    outline:0; 
    height:35px; 
    width: 275px; 
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
							<a href="<?php echo base_url() ?>rollingactionplans">Rolling action plans</a>
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
					<?php if(validation_errors()){?>
						<p><div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong><?php echo validation_errors(); ?>
							</div>
						</p>
					<?php } ?>
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('rollingactionplans/edit_validate/'.$row->id,$attributes); ?>
                                       
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_id', 'name' => 'project_id', 'value' => $row->project_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Plannedactivity id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'plannedactivity_id', 'name' => 'plannedactivity_id', 'value' => $row->plannedactivity_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('plannedactivity_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Task name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'task_name', 'name' => 'task_name', 'value' => $row->task_name, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('task_name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Status</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'status', 'name' => 'status', 'value' => $row->status, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('status'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Progress</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'progress', 'name' => 'progress', 'value' => $row->progress, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('progress'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Priority</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'priority', 'name' => 'priority', 'value' => $row->priority, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('priority'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Task owner id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'task_owner_id', 'name' => 'task_owner_id', 'value' => $row->task_owner_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('task_owner_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Task type</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'task_type', 'name' => 'task_type', 'value' => $row->task_type, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('task_type'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Parent id</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'parent_id', 'name' => 'parent_id', 'value' => $row->parent_id, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('parent_id'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Target budget</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'target_budget', 'name' => 'target_budget', 'value' => $row->target_budget, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('target_budget'));
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
				<label for="textfield" class="control-label col-sm-2">Start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'start_date', 'name' => 'start_date', 'value' => $row->start_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Start time</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'start_time', 'name' => 'start_time', 'value' => $row->start_time, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('start_time'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">End date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'end_date', 'name' => 'end_date', 'value' => $row->end_date, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('end_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">End time</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'end_time', 'name' => 'end_time', 'value' => $row->end_time, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('end_time'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date created <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_created', 'name' => 'date_created', 'value' => $row->date_created, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_created'));
					?>
				</div>
			</div>
					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">UPDATE CHANGES</button>
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

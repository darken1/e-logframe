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
							<a href="<?php echo base_url() ?>index.php/forms">Forms</a>
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
					<?php echo form_open('forms/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Form name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'form_name', 'name' => 'form_name','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('form_name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Form type</label>
				<div class="col-sm-10">
                <select name="form_type" id="form_type" required="required" class='chosen-select form-control'>
                                          
                                           <?php foreach ($formcategories->result() as $formcategory): ?>
                                           <option value="<?php echo $formcategory->id;?>"> <?php echo $formcategory->form_category;?></option>
                                           <?php endforeach; ?>
                                            </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Status</label>
				<div class="col-sm-10">
                <select name="status" id="status" required="required" class='chosen-select form-control'>
                                          
                                          
                                           <option value="Published" <?php if(set_value('status')=='Published'){ echo 'selected="selected"';}?>> Published</option>
                                            <option value="Unpublished" <?php if(set_value('status')=='Unpublished'){ echo 'selected="selected"';}?>> Unpublished</option>
                                          
                                            </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project</label>
				<div class="col-sm-10">
					<select name="project_id" id="project_id" onChange="Getactivities(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Project</option>
                                            <option value="0">All</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>"><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Activity</label>
				<div class="col-sm-10">
					<div id="activities">
                                            <select name="plannedactivity_id" id="plannedactivity_id" class='chosen-select form-control' >
                                            <option value="0">All</option>
                                            </select>
                                            </div>
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

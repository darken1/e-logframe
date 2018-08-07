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
	
	
	function getTasks(frm){
	if(validateForm(frm)){
	document.getElementById('tasks').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/rollingactionplans/gettasks";
	
	var params =  "plannedactivity_id="+totalEncode(document.frm.plannedactivity_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('tasks').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('tasks').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	function refreshList(frm){
	if(validateForm(frm)){
	document.getElementById('dependancies').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/rollingactionplans/getdependancies";
	
	var params =  "plannedactivity_id="+totalEncode(document.frm.plannedactivity_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('dependancies').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('dependancies').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	
	
	
	function GetProjects(frm){
	if(validateForm(frm)){
	document.getElementById('projects').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/getprojects";
	
	var params = "organization_id=" + totalEncode(document.frm.organization_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('projects').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('projects').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
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
							<a href="<?php echo base_url() ?>index.php/documents">documents</a>
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
					<?php 
					}
					 
					if(!empty($error))
					{
						foreach($error as $key=>$err)
						{
							?>
                            <p><div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong><?php echo $err; ?>
							</div>
						</p>
                            <?php
                            
						}
					}
					
					 $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('documents/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Document title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'document_title', 'name' => 'document_title','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('document_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'description', 'name' => 'description','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('description'));
					?>
				</div>
			</div>
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
													<input type="file" name="userfile" id="userfile" required="required">
													</span>
													<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>
										</div>
					
				</div>
			</div>

			
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Document category</label>
				<div class="col-sm-10">
                <select name="documentcategory_id" id="documentcategory_id" class="form-control">
				<?php
                foreach($doccategories as $key=>$doccategory)
                {
                    ?>
                    <option value="<?php echo $doccategory['id'];?>" <?php if($doccategory['id']==set_value('doccategory_id')){ echo 'selected="selected"';}?>><?php echo $doccategory['category'];?></option>
                    <?php
                }
                ?>
                </select>
				
				</div>
			</div>
            
            <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Organization</label>
                                            <div class="col-sm-10">
                                            <select name="organization_id" id="organization_id" onChange="GetProjects(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Organization</option>
                                           <?php foreach ($organizations->result() as $organization): ?>
                                           <option value="<?php echo $organization->id;?>"><?php echo $organization->organization_name;?> </option>
                                           <?php endforeach; ?>
                                            </select>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Project</label>
                                            <div class="col-sm-10">
                                            <div id="projects">
                                            <select name="project_id" id="project_id" onChange="Getactivities(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Project</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>"><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
                                            </div>
                                                
                                            </div>
                                        </div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date added <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_added', 'name' => 'date_added','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_added'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Author</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'author', 'name' => 'author','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('author'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Year published</label>
				<div class="col-sm-10">
					<select name="year_published" id="year_published" class="form-control" required="required">
                               <option value="">Select Year</option>
                               <?php
								 $currentYear = date('Y')+1;
									foreach (range(1992, $currentYear) as $value) {
									  ?>
									   <option value="<?php echo $value;?>" <?php 
									   if($value==set_value('year_published'))
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
				<label for="textfield" class="control-label col-sm-2">Published</label>
				<div class="col-sm-10">
                <select name="published" id="published" class="form-control" required="required">
                <option value="1" selected="selected">Yes</option>
                <option value="0">No</option>
                </select>
					
				</div>
			</div>

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
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Public</label>
				<div class="col-sm-10">
					<select name="public" id="public" class="form-control" required="required">
                <option value="1" selected="selected">Yes</option>
                <option value="0">No</option>
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

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
	var url = "<?php echo base_url(); ?>index.php/indicatorstracking/getindicators";
	
	var params = "project_id=" + totalEncode(document.frm.project_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('indicators').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('indicators').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
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
							<a href="<?php echo base_url() ?>index.php/indicatorstracking">indicators tracking</a>
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
					<?php echo form_open('indicatorstracking/add_validate',$attributes); ?>
                    <table class="table table-nomargin">
                                                                <thead>
                                                                	<tr><th>INDICATOR TRACKING</th></tr>
                                                                </thead>
                                                                <tbody>
              <tr><td>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project</label>
				<div class="col-sm-10">
					  <select name="project_id" id="project_id" onChange="GetIndicators(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Project</option>
                                           <?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>"><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
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
            
            

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Report month</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'report_month', 'name' => 'report_month','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('report_month'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Report year</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'report_year', 'name' => 'report_year','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('report_year'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Reached</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'reached', 'name' => 'reached','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('reached'));
					?>
				</div>
			</div>

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">SAVE ENTRY</button>
					</div>
                    </td>
                    <td>
                    
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

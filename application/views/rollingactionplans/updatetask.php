<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jsgantt.css"/>
<script language="javascript" src="<?php echo base_url(); ?>js/jsgantt.js"></script>
<script language="javascript" src="<?php echo base_url(); ?>js/graphics.js"></script>
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
	
	function addLog(frm){
	if(validateForm(frm)){
	document.getElementById('tasklogs').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/ganttchart/addtasklogs";
	
	var params =  "rollingactionplan_id="+totalEncode(document.myform.rollingactionplan_id.value ) + "&tasklog_date="+totalEncode(document.myform.tasklog_date.value )+ "&progress="+totalEncode(document.myform.progress.value ) + "&hours_worked="+totalEncode(document.myform.hours_worked.value ) + "&description="+totalEncode(document.myform.description.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('tasklogs').innerHTML=connection.responseText;
		document.myform.hours_worked.value='';
		document.myform.description.value='';
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('tasklogs').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
	}
	
	</script>
<style>
  div.demo {
    background: #ccc none repeat scroll 0 0;
    border: 3px solid #666;
    margin: 5px;
    padding: 5px;
    position: relative;
    width: 100%;
    height: 400px;
    overflow: auto;
  }
  p {
    margin: 10px;
    padding: 5px;
    border: 2px solid #666;
    width: 1000px;
    height: 1000px;
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
							<a href="<?php echo base_url() ?>index.php/rollingactionplans">Rolling action plans</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div id="row">
                    <div class="col-sm-12">
                            <div class="box box-bordered box-color satblue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-bars"></i>Rolling Action Plan</h3>
                                </div>
                                <div class="box-content nopadding">
                                    <ul class="tabs tabs-inline tabs-top">
                                        <li class='active'>
                                            <a href="#first11" data-toggle='tab'>
                                                <i class="fa fa-tasks"></i>Plan Details</a>
                                        </li>
                                        <li>
                                            <a href="#second22" data-toggle='tab'>
                                                <i class="fa fa-bars"></i>Gantt</a>
                                        </li>
                                         <li>
                                            <a href="#third33" data-toggle='tab'>
                                                <i class="fa fa-ellipsis-v"></i>Task Logs</a>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content padding tab-content-inline tab-content-bottom">
                                        <div class="tab-pane active" id="first11">
                                        <?php
										$datetime1 = date_create($row->start_date);
										$datetime2 = date_create($row->end_date);
										$interval = date_diff($datetime1, $datetime2);
										
										$today = date('Y-m-d');
										
										if($row->start_date < $today)
										{
											if($row->end_date<$today)
											{
												if($row->progress!=100)
												{
													$progress_bar = 'progress-bar-danger';
												}
												else
												{
													$progress_bar = 'progress-bar-success';
												}
											}
											else
											{
												$first_date = date_create($today);
												$second_date = date_create($row->end_date);
												$days_to_end = date_diff($first_date, $second_date);
												
												if($days_to_end->days <=15)
												{
													if($row->progress<90)
													{
														$progress_bar = 'progress-bar-warning';
													}
													else
													{
														$progress_bar = 'progress-bar-success';
													}
												}
												else
												{
													$progress_bar = 'progress-bar-success';
												}
											}
										}
										else
										{
											$progress_bar = 'progress-bar-info';
										}
										
										?>
                                            <table class="table table-hover table-nomargin">
                                            <tr><td><strong>Project</strong></td><td>
                                            <?php
											$project = $this->projectsmodel->get_by_id($row->project_id)->row();
											echo $project->project_title;
											?>
                                            </td></tr>
                                            <tr><td><strong>Activity</strong></td><td>
                                            <?php
											$plannedactivity = $this->projectplannedactivitiesmodel->get_by_id($row->plannedactivity_id)->row();
											echo $plannedactivity->activity;
											?>
                                            </td></tr>
                                            <tr><td><strong>Task</strong></td><td><?php echo $row->task_name;?></td></tr>
                                            <tr><td><strong>Status</strong></td><td><?php echo $row->status;?></td></tr>
                                            <tr><td><strong>Progress</strong></td><td><?php echo $row->progress;?>%  <div class="progress">
											<div class="progress-bar <?php echo $progress_bar;?>" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->progress;?>%">
												<span class="sr-only"><?php echo $row->progress;?>% Complete </span>
											</div>
										</div></td></tr>
                                            <tr><td><strong>Priority</strong></td><td><?php echo $row->priority;?></td></tr>
                                            <tr><td><strong>Task Ownder</strong></td><td><?php
                                            $user = $this->usersmodel->get_by_id($row->task_owner_id)->row();
											echo $user->fname.' '.$user->lname;
											?></td></tr>
                                            <tr><td><strong>Start Date</strong></td><td><?php echo $row->start_date;?> <?php echo $row->start_time;?></td></tr>
                                            <tr><td><strong>End Date</strong></td><td><?php echo $row->end_date;?> <?php echo $row->end_time;?></td></tr>
                                            <tr><td><strong>Days</strong></td><td><?php echo $interval->days;?></td></tr>
                                            <tr><td><strong>Target Budget</strong></td><td><?php echo $row->target_budget;?></td></tr>
                                            <tr><td><strong>Description</strong></td><td><?php echo $row->description;?></td></tr>
                                             <tr><td><strong>Dependancies</strong></td><td>
											 <?php
                                            foreach($rollingactionplans as $key=>$rollingactionplan)
                                            {
												$plandependancy = $this->rollingactionplandependanciesmodel->get_by_plan_dependancy($row->id,$rollingactionplan['id'])->row();
														
												if(empty($plandependancy))
												{
													echo '';
												}
												else
												{
													echo $rollingactionplan['task_name'].',';
												}	
                                                
                                            }
                                            ?>
                                             </td></tr>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="second22">
                                        
                                        
                                        
                                        <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
								<script>
                                
                                
                                  // here's all the html code neccessary to display the chart object
                                
                                  // Future idea would be to allow XML file name to be passed in and chart tasks built from file.
                                
                                  var g = new JSGantt.GanttChart('g',document.getElementById('GanttChartDIV'), 'day');
                                
                                    g.setShowRes(1); // Show/Hide Responsible (0/1)
                                    g.setShowDur(1); // Show/Hide Duration (0/1)
                                    g.setShowComp(1); // Show/Hide % Complete(0/1)
                                   g.setCaptionType('Resource');  // Set to Show Caption (None,Caption,Resource,Duration,Complete)
                                
                                
                                  //var gr = new Graphics();
                                
                                  if( g ) {
                                
                                    // Parameters             (pID, pName,                  pStart,      pEnd,        pColor,   pLink,          pMile, pRes,  pComp, pGroup, pParent, pOpen, pDepend, pCaption)
                                    
                                    JSGantt.parseXML('<?php echo base_url(); ?>xml/file_plandetail<?php echo $row->id;?>.xml',g)
                                
                                    g.Draw();	
                                    g.DrawDependencies();
                                
                                  }
                                
                                  else
                                
                                  {
                                
                                    alert("not defined");
                                
                                  }
                                
                                </script>
                                           <!-- <div class="demo">
                                            <?php //echo $gantt;?>
                                            </div>  -->                                        
                                          <script>
											//$( "div.demo" ).scrollLeft( 300 );
										  </script>
                                        </div>
                                        
                                        <div class="tab-pane" id="third33">
                                        <?php 
										$attributes = array('name' => 'myform', 'id'=>'myform','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');
										 echo form_open('',$attributes);
										 ?>
                                           <table class="table table-hover table-nomargin">
                                            <tr><td><strong>Date</strong></td><td>
                                            <?php 
					$data = array('id' => 'tasklog_date', 'name' => 'tasklog_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd', 'value'=>date('Y-m-d'),'required'=>'required');
 					echo form_input($data, set_value('date_of_fund_eligibility'));
					?>
                    <input type="hidden" id="rollingactionplan_id" name="rollingactionplan_id" value="<?php echo $row->id;?>">
                                            </td></tr>
                                              <tr><td><strong>Progress</strong></td><td>
                                              <?php
											  if($row->primary_activity==1)
											  {
												  if(empty($activities_for_task))
												  {
													  ?>
													  <select name="progress" id="progress" class='form-control'>
													  <option value="">- Update activity first -</option>
													  
													  </select>
													  <?php
												  }
												  else
												  {
												  ?>
											   <select name="progress" id="progress" class='form-control'>
													<option value="0" <?php if($row->progress=="0"){ echo 'selected="selected"';}?>>0%</option>
													<option value="5" <?php if($row->progress=="5"){ echo 'selected="selected"';}?>>5%</option>
													<option value="10" <?php if($row->progress=="10"){ echo 'selected="selected"';}?>>10%</option>
													<option value="15" <?php if($row->progress=="15"){ echo 'selected="selected"';}?>>15%</option>
													<option value="20" <?php if($row->progress=="20"){ echo 'selected="selected"';}?>>20%</option>
													<option value="25" <?php if($row->progress=="25"){ echo 'selected="selected"';}?>>25%</option>
													<option value="30" <?php if($row->progress=="30"){ echo 'selected="selected"';}?>>30%</option>
													<option value="35" <?php if($row->progress=="35"){ echo 'selected="selected"';}?>>35%</option>
													<option value="40" <?php if($row->progress=="40"){ echo 'selected="selected"';}?>>40%</option>
													<option value="45" <?php if($row->progress=="45"){ echo 'selected="selected"';}?>>45%</option>
													<option value="50" <?php if($row->progress=="50"){ echo 'selected="selected"';}?>>50%</option>
													<option value="55" <?php if($row->progress=="55"){ echo 'selected="selected"';}?>>55%</option>
													<option value="60" <?php if($row->progress=="60"){ echo 'selected="selected"';}?>>60%</option>
													<option value="65" <?php if($row->progress=="65"){ echo 'selected="selected"';}?>>65%</option>
													<option value="70" <?php if($row->progress=="70"){ echo 'selected="selected"';}?>>70%</option>
													<option value="75" <?php if($row->progress=="75"){ echo 'selected="selected"';}?>>75%</option>
													<option value="80" <?php if($row->progress=="80"){ echo 'selected="selected"';}?>>80%</option>
													<option value="85" <?php if($row->progress=="85"){ echo 'selected="selected"';}?>>85%</option>
													<option value="90" <?php if($row->progress=="90"){ echo 'selected="selected"';}?>>90%</option>
													<option value="95" <?php if($row->progress=="95"){ echo 'selected="selected"';}?>>95%</option>
													<option value="100" <?php if($row->progress=="100"){ echo 'selected="selected"';}?>>100%</option>
												</select>
												<?php
												  }
											  
											  }
											  else
											  {
												  ?>
                                                  <select name="progress" id="progress" class='form-control'>
													<option value="0" <?php if($row->progress=="0"){ echo 'selected="selected"';}?>>0%</option>
													<option value="5" <?php if($row->progress=="5"){ echo 'selected="selected"';}?>>5%</option>
													<option value="10" <?php if($row->progress=="10"){ echo 'selected="selected"';}?>>10%</option>
													<option value="15" <?php if($row->progress=="15"){ echo 'selected="selected"';}?>>15%</option>
													<option value="20" <?php if($row->progress=="20"){ echo 'selected="selected"';}?>>20%</option>
													<option value="25" <?php if($row->progress=="25"){ echo 'selected="selected"';}?>>25%</option>
													<option value="30" <?php if($row->progress=="30"){ echo 'selected="selected"';}?>>30%</option>
													<option value="35" <?php if($row->progress=="35"){ echo 'selected="selected"';}?>>35%</option>
													<option value="40" <?php if($row->progress=="40"){ echo 'selected="selected"';}?>>40%</option>
													<option value="45" <?php if($row->progress=="45"){ echo 'selected="selected"';}?>>45%</option>
													<option value="50" <?php if($row->progress=="50"){ echo 'selected="selected"';}?>>50%</option>
													<option value="55" <?php if($row->progress=="55"){ echo 'selected="selected"';}?>>55%</option>
													<option value="60" <?php if($row->progress=="60"){ echo 'selected="selected"';}?>>60%</option>
													<option value="65" <?php if($row->progress=="65"){ echo 'selected="selected"';}?>>65%</option>
													<option value="70" <?php if($row->progress=="70"){ echo 'selected="selected"';}?>>70%</option>
													<option value="75" <?php if($row->progress=="75"){ echo 'selected="selected"';}?>>75%</option>
													<option value="80" <?php if($row->progress=="80"){ echo 'selected="selected"';}?>>80%</option>
													<option value="85" <?php if($row->progress=="85"){ echo 'selected="selected"';}?>>85%</option>
													<option value="90" <?php if($row->progress=="90"){ echo 'selected="selected"';}?>>90%</option>
													<option value="95" <?php if($row->progress=="95"){ echo 'selected="selected"';}?>>95%</option>
													<option value="100" <?php if($row->progress=="100"){ echo 'selected="selected"';}?>>100%</option>
												</select>
                                                  <?php
											  }
											  ?>
                                            </td></tr>
                                             <tr><td><strong>Hours Worked</strong></td><td>
                                            <?php 
					$data = array('id' => 'hours_worked', 'name' => 'hours_worked','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('hours_worked'));
					?>
                                            </td></tr>
                                              <tr><td><strong>Description</strong></td><td>
                                          <textarea name="description" id="description" class='form-control'></textarea>
                                            </td></tr>
                                            <tr><td colspan="2">
                                             <?php
											 if($row->primary_activity==1)
											  {
												  if(empty($activities_for_task))
												  {
													  ?>
													  <div class="alert alert-danger alert-dismissable">
				  
				  <strong>Warning!</strong> Please update this task in the activities update before reporting on the task progress.
				   </div>
													  <?php
												  }
												  else
												  {
													  ?>
													  <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addLog(this)'>ADD TASK LOG</a>
													  <?php
												  }
											  }
											  else
											  {
												  ?>
                                                   <a href="javascript:void(0)" title="" class="btn btn-success" style="margin: 5px;" onclick='addLog(this)'>ADD TASK LOG</a>
                                                  <?php
											  }
											  ?>
                                                  
                                            </td></tr>
                                            </table>
                                            <?php echo form_close(); ?>
                                            <div id="tasklogs">
                                            	<?php echo $logstable; ?>
                                            </div>
                                            
                                            
                                        </div>
                                       
                                    </div>
                                    
                                    
                                    <div class="form-actions col-sm-offset-2 col-sm-10">
                                         <a href="<?php echo site_url('ganttchart/mytasks')?>" class="btn btn-danger" >Back to My Tasks <i class="fa fa-backward"></i></a>
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

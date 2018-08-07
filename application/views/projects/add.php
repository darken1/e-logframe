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
	
	function getSectors(frm){
	if(validateForm(frm)){
	document.getElementById('sectors').innerHTML='';
	var url = "<?php echo base_url(); ?>index.php/projects/getsectors";
	
	var params =  "organization_id="+totalEncode(document.frm.organization_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('sectors').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('sectors').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
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
   <script type="text/javascript"><!--
var lastDiv = "";
function showDiv(divName) {
	// hide last div
	if (lastDiv) {
		document.getElementById(lastDiv).className = "hiddenDiv";
	}
	//if value of the box is not nothing and an object with that name exists, then change the class
	if (divName && document.getElementById(divName)) {
		document.getElementById(divName).className = "visibleDiv";
		lastDiv = divName;
	}
}
//-->
</script>
		<style type="text/css" media="screen"><!--
.hiddenDiv {
	display: none;
	}
.visibleDiv {
	display: block;
	
	}

--></style>
   
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
							<a href="<?php echo base_url() ?>index.php/projects">Projects</a>
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
					<?php echo form_open('projects/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project no</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_no', 'name' => 'project_no','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_no'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_title', 'name' => 'project_title','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project agreement number</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_agreement_number', 'name' => 'project_agreement_number','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('project_agreement_number'));
					?>
				</div>
			</div>

			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of fund eligibility <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_fund_eligibility', 'name' => 'date_of_fund_eligibility','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_fund_eligibility'));
					?>
				</div>
			</div>-->
			<!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date of agreement <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_of_agreement', 'name' => 'date_of_agreement','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_of_agreement'));
					?>
				</div>
			</div>-->
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project objective</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_objective', 'name' => 'project_objective','class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('project_objective'));
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
				<label for="textfield" class="control-label col-sm-2">Project start date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_start_date', 'name' => 'project_start_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('project_start_date'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project end date <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'project_end_date', 'name' => 'project_end_date','class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
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
                    
                    <option value="<?php echo $organization['id'];?>" <?php if(set_value('organization_id')==$organization['id']){ echo 'selected="selected"';}?>><?php echo $organization['organization_name'];?></option>
                    <?php
				}
				?>
                </select>
					
				</div>
			</div>
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sectors</label>
				<div class="col-sm-10">
                <div id="sectors">
                <select multiple="multiple" id="sector_id" name="sector_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($sectors as $key=>$sector)
					{
						?>
                        <option value="<?php echo $sector['id'];?>" ><?php echo $sector['sector'];?></option>
                        <?php
					}
					?>
                
                </select>
                </div>
					
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
                        <option value="<?php echo $currency['currency'];?>" <?php if(set_value('currency')==$currency['currency']){echo 'selected="selected"';}?>><?php echo $currency['currency'];?></option>
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
					$data = array('id' => 'project_budget', 'name' => 'project_budget','class'=>'form-control', 'data-rule-number'=>'true', 'data-rule-required'=>'true','required'=>'required');
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
						?>
                        <option value="<?php echo $donor['id'];?>" ><?php echo $donor['donor_name'];?></option>
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
						?>
                        <option value="<?php echo $partner['id'];?>" ><?php echo $partner['partner'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Country</label>
				<div class="col-sm-10">
                <select name="country_id" id="country_id" class="form-control" required="required" onChange="showDiv(this.value);">
                <option value="">Select Country</option>
                    <?php
					foreach($countries as $key=>$country)
					{
						?>
                        <option value="<?php echo $country['id'];?>" <?php if(set_value('country_id')==$country['id']){ echo 'selected="selected"';}?>><?php echo $country['country'];?></option>
                        <?php
					}
					?>
                    
                    </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Regions/Districts <span class="help-block">
                                                                                    <code>Select the country to get the regions and districts</code>
                                                                                </span></label>
				<div class="col-sm-10">
                <?php
				foreach($countries as $key=>$country)
				{
					?>
                    
                    <div id="<?php echo $country['id'];?>" class="hiddenDiv">
                    
                   
                    <span class="help-block">
                                                                                    <code>Region(s)</code>
                                                                                </span>
                    <select multiple="multiple" id="county_id" name="county_id[]" class='multiselect' required="required">
                   
                   <?php
				   $thecounties = $this->countiesmodel->get_list_by_country($country['id']);
				   foreach($thecounties as $key=>$thecounty)
					{
						?>
                        <option value="<?php echo $thecounty['id'];?>" ><?php echo $thecounty['county'];?></option>
                        <?php
					}
				   ?>
                   </select>
                   <span class="help-block">
                                                                                    <code>District(s)</code>
                                                                                </span>
                   <select multiple="multiple" id="district_id" name="district_id[]" class='multiselect' required="required">
                	
                	<?php
					$districts = $this->districtsmodel->get_by_country($country['id']);
					foreach($districts as $key=>$district)
					{
						?>
                        <option value="<?php echo $district->id;?>" ><?php echo $district->district;?></option>
                        <?php
					}
					?>
                
                </select>
                   
                    </div>
                    <?php
				}
				?>
                
					
				</div>
			</div>
            
            <!-- <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Region</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="county_id" name="county_id[]" class='multiselect' required="required">
                	
                	<?php
					foreach($counties as $key=>$county)
					{
						?>
                        <option value="<?php echo $county['id'];?>" ><?php echo $county['county'];?></option>
                        <?php
					}
					?>
                
                </select>
					
				</div>
			</div>-->
            
            <!--<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District</label>
				<div class="col-sm-10">
                <select multiple="multiple" id="district_id" name="district_id[]" class='multiselect' required="required">
                	
                	<?php
					//foreach($districts as $key=>$district)
					//{
						?>
                        <option value="<?php //echo $district['id'];?>" ><?php //echo $district['district'];?></option>
                        <?php
					//}
					?>
                
                </select>
					
				</div>
			</div>-->

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project Status</label>
				<div class="col-sm-10">
                <select name="projectactivitystatus_id" id="projectactivitystatus_id" class="form-control">
                	<?php
					foreach($status as $key=>$projectstatus)
					{
						?>
                        <option value="<?php echo $projectstatus['id'];?>" <?php if(set_value('projectactivitystatus_id')==$projectstatus['id']){echo 'selected="selected"';}?>><?php echo $projectstatus['status'];?></option>
                        <?php
					}
					?>
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

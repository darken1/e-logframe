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
	var url = "<?php echo base_url(); ?>index.php/projectactivities/getsectors";
	
	var params =  "organization_id="+totalEncode(document.frm.organization_id.value );
	var connection=connect(url,params);
	
	connection.onreadystatechange = function(){
	if(connection.readyState == 4){
		document.getElementById('sectors').innerHTML=connection.responseText;
		
		
	}
	if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('sectors').innerHTML = '<span style="color:green;">Sending request....</span>';}}}
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
							<a href="<?php echo base_url() ?>index.php/reports">Reports</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-3">
					<p>&nbsp;</p>
					
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Beneficiaries by Sector
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
					<?php echo form_open('reports/benficiariesbysectorreport',$attributes); ?>
                    
                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Organization</label>
                                            <div class="col-sm-10">
                                            <select name="organization_id" id="organization_id" onChange="getSectors(this)" required="required" class='chosen-select form-control'>
                                            <option value="">Select Organization</option>
                                           <?php foreach ($organizations->result() as $organization): ?>
                                           <option value="<?php echo $organization->id;?>"><?php echo $organization->organization_name;?> </option>
                                           <?php endforeach; ?>
                                            </select>
                                                
                                            </div>
                                        </div>
                    <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sector</label>
				<div class="col-sm-10">
                	<div id="sectors">
					<select name="sector_id" id="sector_id" class="form-control" required="required">
                    <option value="">Select Sector</option>
						<?php 
                        foreach ($rows->result() as $row):
                        ?>
                        <option value="<?php echo $row->id;?>"><?php echo $row->sector;?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">From</label>
				<div class="col-sm-10">
					<span class="help-block">
                      <code>Select the period from which you want to generate the report</code>
                     </span>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Year</label>
				<div class="col-sm-10">
                <select name="from_year" id="from_year" class="form-control">
					<?php
                    $y = date('Y');
                    $d = ($y-1);
                    $limit = ($y+1);
                    for($x=$d;$x<=$limit;$x++)
                    {
                    ?>
                      <option value="<?php echo $x;?>" <?php if(set_value('from_year')==$x){echo 'selected="selected"';}?>><?php echo $x;?></option>
                      <?php
                      }
                      
                      ?>
                    </select>
					
				</div>
			</div>
             <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Month</label>
				<div class="col-sm-10">
                <select name="from_month" id="from_month" class="form-control">
                  <option value="01" <?php if(set_value('from_month')==01){echo 'selected="selected"';}?>>January</option>
                  <option value="02" <?php if(set_value('from_month')==02){echo 'selected="selected"';}?>>February</option>
                  <option value="03" <?php if(set_value('from_month')==03){echo 'selected="selected"';}?>>March</option>
                  <option value="04" <?php if(set_value('from_month')==04){echo 'selected="selected"';}?>>April</option>
                  <option value="05" <?php if(set_value('from_month')==05){echo 'selected="selected"';}?>>May</option>
                  <option value="06" <?php if(set_value('from_month')==06){echo 'selected="selected"';}?>>June</option>
                  <option value="07" <?php if(set_value('from_month')==07){echo 'selected="selected"';}?>>July</option>
                  <option value="08" <?php if(set_value('from_month')==08){echo 'selected="selected"';}?>>August</option>
                  <option value="09" <?php if(set_value('from_month')==09){echo 'selected="selected"';}?>>September</option>
                  <option value="10" <?php if(set_value('from_month')==10){echo 'selected="selected"';}?>>October</option>
                  <option value="11" <?php if(set_value('from_month')==11){echo 'selected="selected"';}?>>November</option>
                  <option value="12" <?php if(set_value('from_month')==12){echo 'selected="selected"';}?>>December</option>
              </select>
					
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">To</label>
				<div class="col-sm-10">
					<span class="help-block">
                      <code>Select the period to which you want to generate the report</code>
                     </span>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Year</label>
				<div class="col-sm-10">
					<select name="to_year" id="to_year" class="form-control">
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
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Month</label>
				<div class="col-sm-10">
					<select name="to_month" id="to_month" class="form-control">
                      <option value="01" <?php if(set_value('to_month')==01){echo 'selected="selected"';}?>>January</option>
                      <option value="02" <?php if(set_value('to_month')==02){echo 'selected="selected"';}?>>February</option>
                      <option value="03" <?php if(set_value('to_month')==03){echo 'selected="selected"';}?>>March</option>
                      <option value="04" <?php if(set_value('to_month')==04){echo 'selected="selected"';}?>>April</option>
                      <option value="05" <?php if(set_value('to_month')==05){echo 'selected="selected"';}?>>May</option>
                      <option value="06" <?php if(set_value('to_month')==06){echo 'selected="selected"';}?>>June</option>
                      <option value="07" <?php if(set_value('to_month')==07){echo 'selected="selected"';}?>>July</option>
                      <option value="08" <?php if(set_value('to_month')==08){echo 'selected="selected"';}?>>August</option>
                      <option value="09" <?php if(set_value('to_month')==09){echo 'selected="selected"';}?>>September</option>
                      <option value="10" <?php if(set_value('to_month')==10){echo 'selected="selected"';}?>>October</option>
                      <option value="11" <?php if(set_value('to_month')==11){echo 'selected="selected"';}?>>November</option>
                      <option value="12" <?php if(set_value('to_month')==12){echo 'selected="selected"';}?>>December</option>
                      </select>
				</div>
			</div>
            
            
                    
                    </div>

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">GENERATE REPORT</button>
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

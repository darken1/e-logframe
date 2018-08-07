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
	
	
	function createNew() {
		$("#add-more").hide();
		var data = '<tr class="table-row" id="new_row_ajax">' +
		'<td contenteditable="true" id="project_no" onBlur="addToHiddenField(this,\'project_no\')" onClick="editRow(this);"><?php echo $project->project_no;?></td>' +
		'<td contenteditable="true" id="activity" onBlur="addToHiddenField(this,\'activity\')" onClick="editRow(this);"><?php echo $activity->activity;?></td>' + 
		'<td contenteditable="true" id="payment_date" onBlur="addToHiddenField(this,\'payment_date\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="funded_by" onBlur="addToHiddenField(this,\'funded_by\')" onClick="editRow(this);"></td>' + 
				
		'<td contenteditable="true" id="district" onBlur="addToHiddenField(this,\'district\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="sn" onBlur="addToHiddenField(this,\'sn\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="location" onBlur="addToHiddenField(this,\'location\')" onClick="editRow(this);"></td>' +
		
		'<td><?php //echo $beneficiary_select;?><select name="beneficiaryregistration_id" id="beneficiaryregistration_id"><?php foreach ($registrations->result() as $registration){?><option value="<?php echo $registration->id;?>"><?php echo $registration->name_of_beneficiary;?></option><?php }?></select></td>' +
		
		'<td contenteditable="true" id="mobile_cash_transfer" onBlur="addToHiddenField(this,\'mobile_cash_transfer\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="amount" onBlur="addToHiddenField(this,\'amount\')" onClick="editRow(this);"></td>' +
		
		'<td><input type="hidden" id="project_id" name="project_id" value="<?php echo $project->id;?>" /><input type="hidden" id="projectaactivity_id" name="projectaactivity_id" value="<?php echo $activity->id;?>" /><span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links">Save</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancel</a></span></td>' +	
		'</tr>';
	  $("#table-body").prepend(data);
	}
	
	function editRow(editableObj) {
	  $(editableObj).css("background","#FFF");
	}

	function cancelAdd() {
		$("#add-more").show();
		$("#new_row_ajax").remove();
	}
	
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(<?php echo base_url(); ?>/img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/cashforwork/editcolumn",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		
		function addToDatabase() {
		  
		  var project_no = $("#project_no").val();
			var activity = $("#activity").val();
			var payment_date = $("#payment_date").val();
			var funded_by = $("#funded_by").val();
			var district = $("#district").val();
			var sn = $("#sn").val();
			var location = $("#location").val();
			var beneficiaryregistration_id = $("#beneficiaryregistration_id").val();
			var mobile_cash_transfer = $("#mobile_cash_transfer").val();
			var amount = $("#amount").val();
			var project_id = $("#project_id").val();
			var projectaactivity_id = $("#projectaactivity_id").val();
		  
			  $("#confirmAdd").html('<img src="<?php echo base_url(); ?>/img/loaderIcon.gif" />');
			  $.ajax({
				url: "<?php echo base_url(); ?>index.php/cashforwork/addrecord",
				type: "POST",
				data:'project_no='+project_no+'&activity='+activity+'&payment_date='+payment_date+'&funded_by='+funded_by+'&district='+district+'&sn='+sn+'&location='+location+'&beneficiaryregistration_id='+beneficiaryregistration_id+'&mobile_cash_transfer='+mobile_cash_transfer+'&amount='+amount+'&project_id='+project_id+'&projectaactivity_id='+projectaactivity_id,
				success: function(data){
				  $("#new_row_ajax").remove();
				  $("#add-more").show();		  
				  //$("#table-body").prepend(data);
				}
			  });
		}
		
	function addToHiddenField(addColumn,hiddenField) {
		var columnValue = $(addColumn).text();
		$("#"+hiddenField).val(columnValue);
	}
	function deleteRecord(id) {
	if(confirm("Are you sure you want to delete this row?")) {
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/cashforwork/delete_record",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}
		

		</script>
<style>
.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}
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
							<a href="<?php echo base_url() ?>index.php/cashforwork">cash for work</a>
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
                
                
                <div class="box box-color box-bordered red">
<div class="box-title">
	<h3>
		<i class="fa fa-table"></i>
        <?php
		 $distribution_project = $this->projectsmodel->get_by_id($project_id)->row();
		?>
		Cash for Work Payment Form for <?php echo $distribution_project->project_no;?>/<?php echo $distribution_project->project_title;?> - <?php echo $activity->activity;?>
	</h3>
</div>
<div class="box-content nopadding">

<span class="help-block">
                                                                                <code>Click on the specific field on the row to edit</code>
                                                                            </span>

<div id="registrations">
<?php
echo $registrationrow;
?>
</div>
<div class="form-actions col-sm-offset-2 col-sm-10">
	<div class="btn btn-primary" id="add-more" onClick="createNew();">Add More</div>
</div>


</div>
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

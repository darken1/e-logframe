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
		'<td contenteditable="true" id="id_no" onBlur="addToHiddenField(this,\'id_no\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="name_of_beneficiary" onBlur="addToHiddenField(this,\'name_of_beneficiary\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="mothers_name" onBlur="addToHiddenField(this,\'mothers_name\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="next_of_kin" onBlur="addToHiddenField(this,\'next_of_kin\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="sex" onBlur="addToHiddenField(this,\'sex\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="district" onBlur="addToHiddenField(this,\'district\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="settlement" onBlur="addToHiddenField(this,\'settlement\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="telephone_number" onBlur="addToHiddenField(this,\'telephone_number\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="zero_to_four_female" onBlur="addToHiddenField(this,\'zero_to_four_female\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="zero_to_four_male" onBlur="addToHiddenField(this,\'zero_to_four_male\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="five_to_seventeen_female" onBlur="addToHiddenField(this,\'five_to_seventeen_female\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="five_to_seventeen_male" onBlur="addToHiddenField(this,\'five_to_seventeen_male\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="eighteen_to_fifty_nine_female" onBlur="addToHiddenField(this,\'eighteen_to_fifty_nine_female\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="eighteen_to_fifty_nine_male" onBlur="addToHiddenField(this,\'eighteen_to_fifty_nine_male\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="sixty_above_female" onBlur="addToHiddenField(this,\'sixty_above_female\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="sixty_above_male" onBlur="addToHiddenField(this,\'sixty_above_male\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="total_family_size" onBlur="addToHiddenField(this,\'total_family_size\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="programme_area" onBlur="addToHiddenField(this,\'programme_area\')" onClick="editRow(this);"></td>' +		
		'<td contenteditable="true" id="donor" onBlur="addToHiddenField(this,\'donor\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="registration_month" onBlur="addToHiddenField(this,\'registration_month\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="registration_date" onBlur="addToHiddenField(this,\'registration_date\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="project_number" onBlur="addToHiddenField(this,\'project_number\')" onClick="editRow(this);"></td>' +
		'<td><input type="hidden" id="title" /><input type="hidden" id="description" /><span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links">Save</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancel</a></span></td>' +	
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
				url: "<?php echo base_url(); ?>index.php/beneficiaryregistration/editcolumn",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		
		function addToDatabase() {
		  
		  var id_no = $("#id_no").val();
			var name_of_beneficiary = $("#name_of_beneficiary").val();
			var mothers_name = $("#mothers_name").val();
			var next_of_kin = $("#next_of_kin").val();
			var sex = $("#sex").val();
			var district = $("#district").val();
			var settlement = $("#settlement").val();
			var telephone_number = $("#telephone_number").val();
			var zero_to_four_female = $("#zero_to_four_female").val();
			var zero_to_four_male = $("#zero_to_four_male").val();
			var five_to_seventeen_female = $("#five_to_seventeen_female").val();
			var five_to_seventeen_male = $("#five_to_seventeen_male").val();
			var eighteen_to_fifty_nine_female = $("#eighteen_to_fifty_nine_female").val();
			var eighteen_to_fifty_nine_male = $("#eighteen_to_fifty_nine_male").val();
			var sixty_above_female = $("#sixty_above_female").val();
			var sixty_above_male = $("#sixty_above_male").val();
			var total_family_size = $("#total_family_size").val();
			var programme_area = $("#programme_area").val();
			var donor = $("#donor").val();
			var registration_month = $("#registration_month").val();
			var registration_date = $("#registration_date").val();
			var project_number = $("#project_number").val();
		  
			  $("#confirmAdd").html('<img src="<?php echo base_url(); ?>/img/loaderIcon.gif" />');
			  $.ajax({
				url: "<?php echo base_url(); ?>index.php/beneficiaryregistration/addrecord",
				type: "POST",
				data:'id_no='+id_no+'&name_of_beneficiary='+name_of_beneficiary+'&mothers_name='+mothers_name+'&next_of_kin='+next_of_kin+'&sex='+sex+'&district='+district+'&settlement='+settlement+'&telephone_number='+telephone_number+'&zero_to_four_female='+zero_to_four_female+'&zero_to_four_male='+zero_to_four_male+'&five_to_seventeen_female='+five_to_seventeen_female+'&five_to_seventeen_male='+five_to_seventeen_male+'&eighteen_to_fifty_nine_female='+eighteen_to_fifty_nine_female+'&eighteen_to_fifty_nine_male='+eighteen_to_fifty_nine_male+'&sixty_above_female='+sixty_above_female+'&sixty_above_male='+sixty_above_male+'&total_family_size='+total_family_size+'&programme_area='+programme_area+'&donor='+donor+'&registration_month='+registration_month+'&registration_date='+registration_date+'&project_number='+project_number,
				success: function(data){
				  $("#new_row_ajax").remove();
				  $("#add-more").show();		  
				  $("#table-body").prepend(data);
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
			url: "<?php echo base_url(); ?>index.php/beneficiaryregistration/delete_record",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}
		
		function deleteObject(val){
		//if(validateForm(frm)){
			document.getElementById('registrations').innerHTML='';
			var url = "<?php echo base_url(); ?>index.php/beneficiaryregistration/deleterecord";
			
			var params =  "id="+val;
			var connection=connect(url,params);
			
			connection.onreadystatechange = function(){
				if(connection.readyState == 4){
					document.getElementById('registrations').innerHTML=connection.responseText;
					reloadStylesheets();
					
					
				}
				if((connection.readyState == 2)||(connection.readyState == 3)){document.getElementById('registrations').innerHTML = '<span style="color:green;">Sending request....</span>';
				}
			}
		//}
	}
	
	
	function reloadStylesheets() {
    var queryString = '?reload=' + new Date().getTime();
    $('link[rel="stylesheet"]').each(function () {
        this.href = this.href.replace(/\?.*|$/, queryString);
    });
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
							<a href="<?php echo base_url() ?>index.php/beneficiaryregistration/index.php/form">Beneficiary Registration</a>
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
		Cash For Work Beneficiary Registration Form
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
<?php //foreach ($rows->result() as $row): ?>

<!--<tr>
<td><?php echo $row->id_no; ?></td>
<td><?php echo $row->name_of_beneficiary; ?></td>
<td><?php echo $row->mothers_name; ?></td>
<td><?php echo $row->next_of_kin; ?></td>
<td><?php echo $row->sex; ?></td>
<td><?php echo $row->district; ?></td>
<td><?php echo $row->settlement; ?></td>
<td><?php echo $row->telephone_number; ?></td>
<td><?php echo $row->zero_to_four_female; ?></td>
<td><?php echo $row->zero_to_four_male; ?></td>
<td><?php echo $row->five_to_seventeen_female; ?></td>
<td><?php echo $row->five_to_seventeen_male; ?></td>
<td><?php echo $row->eighteen_to_fifty_nine_female; ?></td>
<td><?php echo $row->eighteen_to_fifty_nine_male; ?></td>
<td><?php echo $row->sixty_above_female; ?></td>
<td><?php echo $row->sixty_above_male; ?></td>
<td><?php echo $row->total_family_size; ?></td>
<td><?php echo $row->programme_area; ?></td>
<td><?php echo $row->donor; ?></td>
<td><?php echo $row->registration_month; ?></td>
<td><?php echo $row->registration_date; ?></td>
<td><?php echo $row->project_number; ?></td>
<td>
<a href="<?php echo base_url() ?>beneficiaryregistration/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

			<i class="fa fa-times"></i>
</a>
Delete
</td>
</tr>-->
<?php //endforeach; ?>

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

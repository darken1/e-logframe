<?php include(APPPATH . 'views/common/head.php'); ?>
<script>

function createNew() {
		$("#add-more").hide();
		var data = '<tr class="table-row" id="new_row_ajax">' +
		'<td contenteditable="true" id="district" onBlur="addToHiddenField(this,\'district\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="project_no" onBlur="addToHiddenField(this,\'project_no\')" onClick="editRow(this);"><?php echo $project->project_no;?></td>' +
		'<td contenteditable="true" id="activity" onBlur="addToHiddenField(this,\'activity\')" onClick="editRow(this);"><?php echo $activity->activity;?></td>' + 
		'<td contenteditable="true" id="training_date" onBlur="addToHiddenField(this,\'training_date\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="name" onBlur="addToHiddenField(this,\'name\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="sex" onBlur="addToHiddenField(this,\'sex\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="age" onBlur="addToHiddenField(this,\'age\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="contact" onBlur="addToHiddenField(this,\'contact\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="area_of_settlement" onBlur="addToHiddenField(this,\'area_of_settlement\')" onClick="editRow(this);"></td>' +
				
		'<td contenteditable="true" id="organization" onBlur="addToHiddenField(this,\'organization\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="occupation" onBlur="addToHiddenField(this,\'occupation\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="comments" onBlur="addToHiddenField(this,\'comments\')" onClick="editRow(this);"></td>' +
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
				url: "<?php echo base_url(); ?>index.php/attendancelist/editcolumn",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		
		function addToDatabase() {
		  
		  var district = $("#district").val();
			var training_date = $("#training_date").val();
			var name = $("#name").val();
			var sex = $("#sex").val();
			var age = $("#afe").val();
			var contact = $("#contact").val();
			var area_of_settlement = $("#area_of_settlement").val();
			var organization = $("#organization").val();
			var occupation = $("#occupation").val();
			var comments = $("#comments").val();
			var project_id = $("#project_id").val();
			var projectaactivity_id = $("#projectaactivity_id").val();
		  
			  $("#confirmAdd").html('<img src="<?php echo base_url(); ?>/img/loaderIcon.gif" />');
			  $.ajax({
				url: "<?php echo base_url(); ?>index.php/attendancelist/addrecord",
				type: "POST",
				data:'district='+district+'&training_date='+training_date+'&name='+name+'&sex='+sex+'&contact='+contact+'&area_of_settlement='+area_of_settlement+'&organization='+organization+'&occupation='+occupation+'&comments='+comments+'&project_id='+project_id+'&projectaactivity_id='+projectaactivity_id,
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
			url: "<?php echo base_url(); ?>index.php/attendancelist/delete_record",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
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
							<a href="<?php echo base_url() ?>index.php/attendancelist">Attendance list</a>
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
		Training attendance list for <?php echo $distribution_project->project_no;?>/<?php echo $distribution_project->project_title;?> - <?php echo $activity->activity;?>
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

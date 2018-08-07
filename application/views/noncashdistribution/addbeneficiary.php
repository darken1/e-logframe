<?php include(APPPATH . 'views/common/head.php'); ?>
<script>

function createNew() {
		$("#add-more").hide();
		var data = '<tr class="table-row" id="new_row_ajax">' +
		'<td contenteditable="true" id="district" onBlur="addToHiddenField(this,\'district\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="project_no" onBlur="addToHiddenField(this,\'project_no\')" onClick="editRow(this);"><?php echo $project->project_no;?></td>' +
		'<td contenteditable="true" id="activity" onBlur="addToHiddenField(this,\'activity\')" onClick="editRow(this);"><?php echo $activity->activity;?></td>' + 
		'<td contenteditable="true" id="settlement" onBlur="addToHiddenField(this,\'settlement\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="date_added" onBlur="addToHiddenField(this,\'date_added\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="sn" onBlur="addToHiddenField(this,\'sn\')" onClick="editRow(this);"></td>' + 
		'<td contenteditable="true" id="name_of_beneficiary" onBlur="addToHiddenField(this,\'name_of_beneficiary\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="sex" onBlur="addToHiddenField(this,\'sex\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="telephone_number" onBlur="addToHiddenField(this,\'telephone_number\')" onClick="editRow(this);"></td>' +
				
		'<td contenteditable="true" id="under_five_female" onBlur="addToHiddenField(this,\'under_five_female\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="under_five_male" onBlur="addToHiddenField(this,\'under_five_male\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="five_to_seventeen_female" onBlur="addToHiddenField(this,\'five_to_seventeen_female\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="five_to_seventeen_male" onBlur="addToHiddenField(this,\'five_to_seventeen_male\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="eighteen_to_fifty_nine_female" onBlur="addToHiddenField(this,\'eighteen_to_fifty_nine_female\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="eighteen_to_fifty_nine_male" onBlur="addToHiddenField(this,\'eighteen_to_fifty_nine_male\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="sixty_above_female" onBlur="addToHiddenField(this,\'sixty_above_female\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="sixty_above_male" onBlur="addToHiddenField(this,\'sixty_above_male\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="total_family_size" onBlur="addToHiddenField(this,\'total_family_size\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="familly_head" onBlur="addToHiddenField(this,\'familly_head\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="diversity" onBlur="addToHiddenField(this,\'diversity\')" onClick="editRow(this);"></td>' +		
		'<td contenteditable="true" id="selection_criteria" onBlur="addToHiddenField(this,\'selection_criteria\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="id_no" onBlur="addToHiddenField(this,\'id_no\')" onClick="editRow(this);"></td>' +
		
		'<td contenteditable="true" id="support_given" onBlur="addToHiddenField(this,\'support_given\')" onClick="editRow(this);"></td>' +
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
				url: "<?php echo base_url(); ?>index.php/noncashdistribution/editcolumn",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		
		
		function addToDatabase() {
		  
		  var district = $("#district").val();
			var settlement = $("#settlement").val();
			var date_added = $("#date_added").val();
			var sn = $("#sn").val();
			var name_of_beneficiary = $("#name_of_beneficiary").val();
			var sex = $("#sex").val();
			var telephone_number = $("#telephone_number").val();
			var under_five_female = $("#under_five_female").val();
			var under_five_male = $("#under_five_male").val();
			var five_to_seventeen_female = $("#five_to_seventeen_female").val();
			var five_to_seventeen_male = $("#five_to_seventeen_male").val();
			var eighteen_to_fifty_nine_female = $("#eighteen_to_fifty_nine_female").val();
			var eighteen_to_fifty_nine_male = $("#eighteen_to_fifty_nine_male").val();
			var sixty_above_female = $("#sixty_above_female").val();
			var sixty_above_male = $("#sixty_above_male").val();
			var total_family_size = $("#total_family_size").val();
			var familly_head = $("#familly_head").val();
			var diversity = $("#diversity").val();
			var selection_criteria = $("#selection_criteria").val();
			var id_no = $("#id_no").val();			
			var support_given = $("#support_given").val();
			var project_id = $("#project_id").val();
			var projectaactivity_id = $("#projectaactivity_id").val();
		  
			  $("#confirmAdd").html('<img src="<?php echo base_url(); ?>/img/loaderIcon.gif" />');
			  $.ajax({
				url: "<?php echo base_url(); ?>index.php/noncashdistribution/addrecord",
				type: "POST",
				data:'district='+district+'&settlement='+settlement+'&date_added='+date_added+'&sn='+sn+'&name_of_beneficiary='+name_of_beneficiary+'&sex='+sex+'&telephone_number='+telephone_number+'&under_five_female='+under_five_female+'&under_five_male='+under_five_male+'&five_to_seventeen_female='+five_to_seventeen_female+'&five_to_seventeen_male='+five_to_seventeen_male+'&eighteen_to_fifty_nine_female='+eighteen_to_fifty_nine_female+'&eighteen_to_fifty_nine_male='+eighteen_to_fifty_nine_male+'&sixty_above_female='+sixty_above_female+'&sixty_above_male='+sixty_above_male+'&total_family_size='+total_family_size+'&familly_head='+familly_head+'&diversity='+diversity+'&selection_criteria='+selection_criteria+'&id_no='+id_no+'&support_given='+support_given+'&project_id='+project_id+'&projectaactivity_id='+projectaactivity_id,
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
			url: "<?php echo base_url(); ?>index.php/noncashdistribution/delete_record",
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
							<a href="<?php echo base_url() ?>index.php/noncashdistribution">non cash distribution</a>
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
		Non Cash Distribution Form for <?php echo $distribution_project->project_no;?>/<?php echo $distribution_project->project_title;?> - <?php echo $activity->activity;?>
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

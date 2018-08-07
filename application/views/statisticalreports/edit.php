<?php include(APPPATH . 'views/common/head.php'); ?>
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
							<a href="<?php echo base_url() ?>index.php/statisticalreports">Statistical Reports</a>
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
						<i class="fa fa-th-list"></i>Edit Form
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
					<?php echo form_open('statisticalreports/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Overall status of projects </label>
				<div class="col-sm-10">
                
                <textarea name="overal_status" id="overal_status"><?php echo $row->overal_status; ?></textarea>
                <script>
				var glob2 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('overal_status');
				 glob2 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Status of Sub Activity Implementation  </label>
				<div class="col-sm-10">
                
                <textarea name="status_of_activity" id="status_of_activity"><?php echo $row->status_of_activity; ?></textarea>
                <script>
				var glob3 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('status_of_activity');
				 glob3 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Distribution of activities implemented by type vs status of
implementation </label>
				<div class="col-sm-10">
                
                <textarea name="activity_table" id="activity_table"><?php echo $row->activity_table; ?></textarea>
                <script>
				var glob4 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('activity_table');
				 glob4 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiaries Reached </label>
				<div class="col-sm-10">
                
                <textarea name="beneficiaries_reached" id="beneficiaries_reached"><?php echo $row->beneficiaries_reached; ?></textarea>
                <script>
				var glob5 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('beneficiaries_reached');
				 glob5 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiaries reached by sector disaggrigated by age & gender
</label>
				<div class="col-sm-10">
                
                <textarea name="beneficiaries_by_sector" id="beneficiaries_by_sector"><?php echo $row->beneficiaries_by_sector; ?></textarea>
                <script>
				var glob6 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('beneficiaries_by_sector');
				 glob6 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiaries reached versus the target number 
</label>
				<div class="col-sm-10">
                
                <textarea name="target_vs_reached" id="target_vs_reached"><?php echo $row->target_vs_reached; ?></textarea>
                <script>
				var glob7 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('target_vs_reached');
				 glob7 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiaries reached by region disaggrigated by age &amp; gender

</label>
				<div class="col-sm-10">
                
                <textarea name="beneficiaries_by_district" id="beneficiaries_by_district"><?php echo $row->beneficiaries_by_district; ?></textarea>
                <script>
				var glob8 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('beneficiaries_by_district');
				 glob8 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sub Activities and beneficiaries

</label>
				<div class="col-sm-10">
                
                <textarea name="activities_beneficiaries" id="activities_beneficiaries"><?php echo $row->activities_beneficiaries; ?></textarea>
                <script>
				var glob9 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('activities_beneficiaries');
				 glob9 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Projects and beneficiaries

</label>
				<div class="col-sm-10">
                
                <textarea name="projects_beneficiaries" id="projects_beneficiaries"><?php echo $row->projects_beneficiaries; ?></textarea>
                <script>
				var glob10 = '';
				$(document).ready(function()
				{
				 var editorpunt = CKEDITOR.replace('projects_beneficiaries');
				 glob10 = editorpunt;
				 
				});
				
					
				</script> 
					
				</div>
			</div>
            
            

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">UPDATE CHANGES</button>
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

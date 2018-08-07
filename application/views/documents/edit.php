<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
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
					<?php echo form_open('documents/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Document title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'document_title', 'name' => 'document_title', 'value' => $row->document_title, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('document_title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Description</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'description', 'name' => 'description', 'value' => $row->description, 'class'=>'form-control','required'=>'required');
 					echo form_textarea($data, set_value('description'));
					?>
				</div>
			</div>
           <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Document</label>
				<div class="col-sm-10">
					
				<a href="<?php echo base_url();?>documents/<?php echo $row->file_name?>" target="_blank" class="btn btn-success"> <i class="fa fa-book"></i> View uploaded document (<?php echo $row->file_name?>)</a>
<input type="hidden" name="docname" id="docname" value="<?php echo $row->file_name?>" />
					
				</div>
			</div>
            
			<div class="form-group">
				
				<div class="col-sm-10">
                <label for="textfield" class="control-label col-sm-2">Change Document</label>
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
													<input type="file" name="userfile" id="userfile" >
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
                            <option value="<?php echo $doccategory['id'];?>" <?php if($doccategory['id']==$row->documentcategory_id){ echo 'selected="selected"';}?>><?php echo $doccategory['category'];?></option>
                            <?php
                        }
                        ?>
                </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Date added <small>yyyy-mm-dd</small></label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'date_added', 'name' => 'date_added', 'value' => $row->date_added, 'class'=>'form-control datepick','data-inputmask'=>"'mask': '9999-99-99'",'data-date-format'=>'yyyy-mm-dd','required'=>'required');
 					echo form_input($data, set_value('date_added'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Author</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'author', 'name' => 'author', 'value' => $row->author, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('author'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Year published</label>
				<div class="col-sm-10">
                <select name="year_published" id="year_published" class="form-control">
                 <option value="">Select Year</option>
                               <?php
								 $currentYear = date('Y')+1;
									foreach (range(1992, $currentYear) as $value) {
									  ?>
									   <option value="<?php echo $value;?>" <?php 
									   if($value==$row->year_published)
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
                    <option value="1" <?php if($row->published==1){ echo 'selected="selected"';}?>>Yes</option>
                    <option value="0" <?php if($row->published==0){ echo 'selected="selected"';}?>>No</option>
                </select>
                
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Tags
                 <small>Separate with comma (,)</small>
                </label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'tags', 'name' => 'tags', 'value' => $row->tags, 'class'=>'tagsinput form-control','required'=>'required');
 					echo form_textarea($data, set_value('tags'));
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Public</label>
				<div class="col-sm-10">
                	 <select name="public" id="public" class="form-control" required="required">
                        <option value="1" <?php if($row->public==1){ echo 'selected="selected"';}?>>Yes</option>
                        <option value="0" <?php if($row->public==0){ echo 'selected="selected"';}?>>No</option>
                	</select>
				
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

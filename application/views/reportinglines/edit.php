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
							<a href="<?php echo base_url() ?>reportinglines">reportinglines</a>
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
					<?php echo form_open('reportinglines/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization</label>
				<div class="col-sm-10">
					<select name="organization_id" id="organization_id" class="form-control">
						<?php
                        foreach($organizations as $key=>$organization)
                        {
                            ?>
                            <option value="<?php echo $organization['id']?>" <?php if($row->organization_id==$organization['id']){ echo 'selected="selected"';}?>><?php echo $organization['organization_name']?></option>
                            <?php
                        }
                        ?>
                        
                    </select>
				
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Title</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'title', 'name' => 'title', 'value' => $row->title, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('title'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Reports To</label>
				<div class="col-sm-10">
					<select name="parent_id" id="parent_id" class="form-control">
                     <option value="0" <?php if($row->parent_id==0){ echo 'selected="selected"';} ?>>- None -</option>
						<?php
                        foreach($reportinglines as $key=>$reportingline)
                        {
                            ?>
                            <option value="<?php echo $reportingline['id']?>" <?php if($row->parent_id==$reportingline['id']){ echo 'selected="selected"';}?>><?php echo $reportingline['title']?></option>
                            <?php
                        }
                        ?>
                        
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

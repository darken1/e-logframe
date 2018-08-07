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
							<a href="<?php echo base_url() ?>index.php/beneficiarysubcategories">beneficiary sub categories</a>
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
					<?php echo form_open('beneficiarysubcategories/edit_validate/'.$row->id,$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiary type</label>
				<div class="col-sm-10">
                
                <select name="beneficiarytype_id" id="beneficiarytype_id" class="form-control">
                <option value="0" <?php if($row->beneficiarytype_id==0){ echo 'selected="selected"';}?>>All</option>
                                                                        <?php 
																		foreach($beneficiaries as $key=>$beneficiary)
																		{
																			?>
                                                                            <option value="<?php echo $beneficiary['id'];?>" <?php if($row->beneficiarytype_id==$beneficiary['id']){ echo 'selected="selected"';}?>><?php echo $beneficiary['beneficiary_type'];?></option>
                                                                            <?php
																		}
																		?>
                                                                        
                                                                        </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiary category</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'beneficiary_category', 'name' => 'beneficiary_category', 'value' => $row->beneficiary_category, 'class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('beneficiary_category'));
					?>
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Aggregation type</label>
				<div class="col-sm-10">
                <select name="aggregationtype_id" id="aggregationtype_id" class="form-control">
        
                                                                        <?php 
																		foreach($aggregationtypes as $key=>$aggregationtype)
																		{
																			?>
                                                                            <option value="<?php echo $aggregationtype['id'];?>" <?php if($row->aggregationtype_id==$aggregationtype['id']){ echo 'selected="selected"';}?>><?php echo $aggregationtype['type'];?></option>
                                                                            <?php
																		}
																		?>
                                                                        
                                                                        </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Beneficiary Gender Classification</label>
				<div class="col-sm-10">
                <select name="gender" id="gender" class="form-control">
        
                   <option value="1" <?php if($row->gender==1){ echo 'selected="selected"';}?>>Male</option>
                   <option value="2" <?php if($row->gender==2){ echo 'selected="selected"';}?>>Female</option>
              
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

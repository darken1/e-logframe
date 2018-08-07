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
							<a href="<?php echo base_url() ?>organizations">organizations</a>
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
					<?php echo form_open('organizations/add_validate',$attributes); ?>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization name</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'organization_name', 'name' => 'organization_name','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('organization_name'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Address</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'address', 'name' => 'address','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('address'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Postal address</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'postal_address', 'name' => 'postal_address','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('postal_address'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Postal code</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'postal_code', 'name' => 'postal_code','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('postal_code'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">City</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'city', 'name' => 'city','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('city'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Country</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'country', 'name' => 'country','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('country'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Telephone</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'telephone', 'name' => 'telephone','class'=>'form-control','required'=>'required');
 					echo form_input($data, set_value('telephone'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Email</label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'email', 'name' => 'email','class'=>'form-control', 'type'=>'email','required'=>'required');
 					echo form_input($data, set_value('email'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Web address
                <small>with http://</small>
                </label>
				<div class="col-sm-10">
					<?php 
					$data = array('id' => 'web_address', 'name' => 'web_address','class'=>'form-control','data-rule-url'=>'true','required'=>'required');
 					echo form_input($data, set_value('web_address'));
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Organization type</label>
				<div class="col-sm-10">
                <select name="organizationtype_id" id="organizationtype_id" class="form-control">
                                                    <?php
                                                        foreach($organizationtypes as $key=>$organizationtype)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $organizationtype['id'];?>" <?php if(set_value('organizationtype_id')==$organizationtype['id']){echo 'selected="selected"';}?>><?php echo $organizationtype['organization_type'];?></option>
                                                            <?php
                                                        }
                                                        ?>
               </select>
					
				</div>
			</div>
            
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Level of operations</label>
				<div class="col-sm-10">
             <select name="levelofoperation_id" id="levelofoperation_id" class="form-control">
                                                    <?php
                                                        foreach($levelsofoperation as $key=>$levelofoperation)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $levelofoperation['id'];?>" <?php if(set_value('levelofoperation_id')==$levelofoperation['id']){echo 'selected="selected"';}?>><?php echo $levelofoperation['level_of_operation'];?></option>
                                                            <?php
                                                        }
                                                        ?>
               </select>
					
				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Logo</label>
				<div class="col-sm-10">
                
               <label for="textfield" class="control-label col-sm-2"></label>
										<div class="col-sm-10">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="userfile" id="userfile">
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>
										</div>
				
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

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
			<a href="">Projects</a>
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
									<i class="fa fa-th-list"></i>Striped form</h3>
							</div>
							<div class="box-content nopadding">
								
                                <?php     

$attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped');

echo form_open('',$attributes); ?>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Text input</label>
										<div class="col-sm-10">
											<input type="text" name="textfield" id="textfield" placeholder="Text input" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-2">Checkboxes
											<small>More information here</small>
										</label>
										<div class="col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="checkbox">Lorem ipsum dolor.
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="checkbox">Lorem ipsum dolor sit.
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="textarea" class="control-label col-sm-2">Textarea</label>
										<div class="col-sm-10">
											<textarea name="textarea" id="textarea" rows="5" class="form-control">Lorem ipsum mollit minim fugiat tempor dolore sit officia ut dolore.</textarea>
										</div>
									</div>
									<div class="form-actions col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button type="button" class="btn">Cancel</button>
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
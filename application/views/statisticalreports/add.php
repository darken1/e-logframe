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
							<a href="<?php echo base_url() ?>index.php/statisticalreports">Statistical reports</a>
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
						<i class="fa fa-th-list"></i>Generate Report
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
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate', 'target'=>'_blank');?>
					<?php echo form_open('statisticalreports/monthlyreport',$attributes); ?>
                    
                    <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Country</label>
				<div class="col-sm-10">
					<select name="country_id" id="country_id" class="form-control">
					<?php
                    foreach($countries as $key=>$country)
                    {
						if($country['id']==2)
						{
                    ?>
                      <option value="<?php echo $country['id'];?>"><?php echo $country['country'];?></option>
                      <?php
						}
                      }
                      
                      ?>
                    </select>
				</div>
			</div>
			
					<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Year</label>
				<div class="col-sm-10">
					<select name="year" id="year" class="form-control">
					<?php
                    $y = date('Y');
                    $d = ($y-1);
                    $limit = ($y+1);
                    for($x=$d;$x<=$limit;$x++)
                    {
                    ?>
                      <option value="<?php echo $x;?>" <?php if($y==$x){echo 'selected="selected"';}?>><?php echo $x;?></option>
                      <?php
                      }
                      
                      ?>
                    </select>
				</div>
			</div>
            <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Month</label>
                <?php
				$month = date('m');
				?>
				<div class="col-sm-10">
					<select name="month" id="month" class="form-control">
                      <option value="01" <?php if($month==01){echo 'selected="selected"';}?>>January</option>
                      <option value="02" <?php if($month==02){echo 'selected="selected"';}?>>February</option>
                      <option value="03" <?php if($month==03){echo 'selected="selected"';}?>>March</option>
                      <option value="04" <?php if($month==04){echo 'selected="selected"';}?>>April</option>
                      <option value="05" <?php if($month==05){echo 'selected="selected"';}?>>May</option>
                      <option value="06" <?php if($month==06){echo 'selected="selected"';}?>>June</option>
                      <option value="07" <?php if($month==07){echo 'selected="selected"';}?>>July</option>
                      <option value="08" <?php if($month==08){echo 'selected="selected"';}?>>August</option>
                      <option value="09" <?php if($month==09){echo 'selected="selected"';}?>>September</option>
                      <option value="10" <?php if($month==10){echo 'selected="selected"';}?>>October</option>
                      <option value="11" <?php if($month==11){echo 'selected="selected"';}?>>November</option>
                      <option value="12" <?php if($month==12){echo 'selected="selected"';}?>>December</option>
                      </select>
				</div>
			</div>

			

					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">GENERATE REPORT</button>
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

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
							<a href="<?php echo base_url() ?>savedreports">Saved reports</a>
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
						<i class="fa fa-th-list"></i>Saved Report
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
					<?php echo form_open('reports/'.$row->reportmethod.'',$attributes); ?>
			
					<table width="100%" id="" class="table table-hover table-nomargin">
                    <tr><th>Report title</th><td><?php echo $row->reporttitle;?></td></tr>
                    <tr><th>From</th><td><?php echo $row->from_year;?>/<?php echo $row->from_month;?></td></tr>
                    <tr><th>To</th><td><?php echo $row->to_year;?>/<?php echo $row->to_month;?></td></tr>
                     <tr><td colspan="2">
                     
                     <input type="hidden" name="<?php echo $row->searchparameter;?>" id="<?php echo $row->searchparameter;?>" value="<?php echo $row->searchvalue;?>">
                     <input type="hidden" name="from_year" id="from_year" value="<?php echo $row->from_year;?>">
                     <input type="hidden" name="from_month" id="from_month" value="<?php echo $row->from_month;?>">
                     <input type="hidden" name="to_year" id="to_year" value="<?php echo $row->to_year;?>">
                     <input type="hidden" name="to_month" id="to_month" value="<?php echo $row->to_month;?>">
                     <input type="hidden" name="reportmethod" id="reportmethod" value="<?php echo $row->reportmethod;?>">
                     <input type="hidden" name="reporttitle" id="reporttitle" value="<?php echo $row->reporttitle;?>"></td></tr>
                     </table>
					<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">VIEW REPORT</button>
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

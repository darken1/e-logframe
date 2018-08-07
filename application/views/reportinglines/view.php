<?php include(APPPATH . 'views/common/head.php'); ?>
<style>
.wrapper         {width:100%;height:100%;margin:0 auto;background:#ffffff}
.h_iframe        {position:relative;}
.h_iframe .ratio {display:block;width:100%;height:auto;}
.h_iframe iframe {position:absolute;top:0;left:0;width:100%; height:100%;}
</style>
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
							<a href="<?php echo base_url() ?>reportinglines">Reporting lines</a>
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
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Reporting Lines
					</h3>
				</div>
				<div class="box-content nopadding">
                <div class="wrapper">
    <div class="h_iframe">
        <!-- a transparent image is preferable -->
        <img class="ratio" src="<?php echo base_url();?>img/placeholder300.png"/>
      <iframe src="<?php echo base_url();?>/index.php/reportinglines/graphical" width="1100" height="500" allowfullscreen="" frameborder="0"></iframe>
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

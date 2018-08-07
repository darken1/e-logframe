<?php include(APPPATH . 'views/common/head.php'); ?>
<style>
				.tagcloud {
	font-size: 19px;
	text-align: center;
	padding: 15px;
	border: 1px solid #eeeeee;
	background-color: #f2f2f2;
}

a.t10 {
	color: #FF3300;
    font-size: 115%;
    font-weight: bold;
}

a.t10:hover {
	background-color: #FF3300;
	color: #FFFFFF;
}

a.t9 {
	color: #FF3300;
	font-size: 110%;
}

a.t9:hover {
	background-color: #FF3300;
	color: #FFFFFF;
}

a.t8 {
	color: #FF9933;
    font-size: 105%;
    font-weight: bold;
}

a.t8:hover {
	background-color: #FF9933;
	color: #FFFFFF;
}

a.t7 {
	color: #FF9933;
	font-size: 100%;
}

a.t7:hover {
	background-color: #FF9933;
	color: #FFFFFF;
}

a.t6 {
	color: #99CC33;
    font-size: 95%;
    font-weight: bold;
}

a.t6:hover {
	background-color: #99CC33;
	color: #FFFFFF;
}

a.t5 {
	color: #339933;
	font-size: 90%;
}

a.t5:hover {
	background-color: #339933;
	color: #FFFFFF;
}

a.t4 {
	color: #339933;
	font-size: 80%;
    font-weight: bold;
}

a.t4:hover {
	background-color: #339933;
	color: #FFFFFF;
}

a.t3 {
	color: #339999;
	font-size: 75%;
}

a.t3:hover {
	background-color: #339999;
	color: #FFFFFF;
}

a.t2 {
	color: #3399FF;
	font-size: 65%;
    font-weight: bold;
}

a.t2:hover
{
	background-color: #3399FF;
	color: #FFFFFF;
}

a.t1 {
	color: #888888;
	font-size: 60%;
}

a.t1:hover {
	background-color: #888888;
	color: #FFFFFF;
}
</style>
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
							<a href="<?php echo base_url() ?>documents">documents</a>
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
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-table"></i>
									Details for <?php echo $row->document_title;?>
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr><th>Property</th><th>Value</th></tr>
									</thead>
									<tbody>
										<tr><td valign="top" class="alt">Name</td><td><?php echo $row->document_title;?></td></tr>
                                        <tr><td valign="top" class="alt">Category</td><td><?php echo $category->category;?></td></tr>
                                        <tr><td valign="top" class="alt">Description</td><td><?php echo $row->description;?></td></tr>
                                        <tr><td valign="top" class="alt">Year Published</td><td><?php echo $row->year_published;?></td></tr>
                                        <tr><td valign="top" class="alt">Date Added</td><td><?php echo $row->date_added;?></td></tr>
                                        <tr><td valign="top" class="alt">File Name</td><td><?php echo $row->file_name;?></td></tr>
                                        <tr><td valign="top" class="alt">File Type</td><td><?php echo $row->file_type;?></td></tr>
                                        <tr><td valign="top" class="alt">File Size</td><td><?php echo $row->file_size;?></td></tr>
                                        <tr><td valign="top" class="alt">Created by</td><td><?php echo $user->fname;?> <?php echo $user->lname;?></td></tr>
                                        <tr><td valign="top" class="alt">Tags</td><td><?php 
                                        $words = $row->tags;
                                        $words = explode(',',$words);
                                        //t3, t4, t5, t7, t10
                                         
                                            foreach($words as $word)
                                            {
                                                $min=1;
                                                $max=10;
                                                $number = rand($min,$max);
                                               echo '<a href="#" class="t'.$number.'">'.$word.'</a>&nbsp;';
                                            }?></td></tr>
										
										
									</tbody>
								</table>
                                <p>
                                <a href="<?php echo base_url();?>documents/<?php echo $row->file_name?>" class="btn btn-info" target="_blank">Download <i class="fa fa-arrow-circle-down"></i></a>
                                <a href="<?php echo site_url('documents')?>" class="btn btn-danger" >Back to Documents <i class="fa fa-backward"></i></a>
                                
                                </p>

							</div>
						</div>
					</div>
</div>
</div>
</div>
</div>

</body>
</html>

<?php include(APPPATH . 'views/common/head.php'); ?>
<style>
				#lasttable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#lasttable td, #lasttable th 
				{
				font-size:0.8em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#lasttable th 
				{
				font-size:0.8em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#lasttable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				
				
				#listtable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:80%;
				border-collapse:collapse;
				}
				#listtable td, #listtable th 
				{
				font-size:1.0em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#listtable th 
				{
				font-size:1.0em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#listtable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				
				/**/
				#zonlisttable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#zonlisttable td, #zonlisttable th 
				{
				font-size:1.0em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#zonlisttable th 
				{
				font-size:1.0em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#zonlisttable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				</style>
                
                 <style>
        #customers
        {
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        width:100%;
        border-collapse:collapse;
        }
        #customers td, #customers th 
        {
        font-size:0.9em;
        border:2px  solid #fff;
		border:1px solid #999999;
        padding:3px 7px 2px 7px;
        }
        #customers th 
        {
        font-size:1.0em;
        text-align:left;
        padding-top:5px;
        padding-bottom:4px;
        background-color:#cccccc;
        color:#fff;
        }
        #customers tr.alt td 
        {
        color:#000;
        background-color:#cccfff;
        }
        </style>
        
        <style>
				#alertstable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#alertstable td, #alertstable th 
				{
				font-size:0.8em;
				border:1px solid #1F7EB8;
				padding:3px 7px 2px 7px;
				}
				#alertstable th 
				{
				font-size:0.8em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#1F7EB8;
				color:#fff;
				}
				#alertstable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
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
							<a href="<?php echo base_url() ?>statisticalreports">Statistical reports</a>
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
                  <table width="100%" id="" class="table table-hover table-nomargin">
                <thead>
                <tr>
                  <th colspan="2">BI-MONTHLY STATISTICAL REPORT <?php echo $to_month;?>/<?php echo $to_year;?></th></tr>
                </thead>
                
                </table>
					
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('statisticalreports/generatereport',$attributes); ?>
			<table id="customers">
                    <tr>
                    <td bgcolor="#e31c43"><font color="#FFFFFF"><strong>1.	Overall Status of Projects and Programs </strong></font>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    
                    <table width="100%" id="" class="table table-hover table-nomargin">
                     <thead>
                        <tr>
                          <th colspan="4">1.1	List of Closed Projects per sector </th></tr>
                           <th>Project Code</th><th>Project Name</th><th>Start Date</th><th>End Date</th></tr>
                           <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        </thead>
                    
                    </table>
                     <table width="100%" id="" class="table table-hover table-nomargin">
                     <thead>
                        <tr>
                          <th colspan="4">1.2	List of New Projects per sector </th></tr>
                           <th>Project Code</th><th>Project Name</th><th>Start Date</th><th>End Date</th></tr>
                           <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        </thead>
                    
                    </table>
                    <table width="100%" id="" class="table table-hover table-nomargin">
                     <thead>
                        <tr>
                          <th colspan="4">1.3	Total No. of ongoing (plus new) projects</th></tr>
                           <th>Project Code</th><th>Project Name</th><th>Start Date</th><th>End Date</th></tr>
                           <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        </thead>
                    
                    </table>
                    
                    </td>
                    </tr>
                    
                    
             </table>
			<table id="customers">
                    <tr>
                    <td bgcolor="#e31c43"><font color="#FFFFFF"><strong>2.	Status of Activity Implementation  </strong></font>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <table width="100%" id="" class="table table-hover table-nomargin">
                    <tr><th colspan="3">2.1	Overall Status of activities implemented </th></tr>
                    <tr><th><strong>Activity</strong></th><th><strong>Location</strong></th><th><strong>Status</strong></th></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                    </table>
                    </td>
                    
                    </tr>
             </table>		
            

			

					
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

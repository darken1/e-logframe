<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
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
							<a href="<?php echo base_url() ?>reports">Reports</a>
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
						Beneficiaries by Project
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
					<?php echo form_open('reports/savereport',$attributes); ?>
                     <table width="100%" id="" class="table table-hover table-nomargin">
                     <tr><td>
                     <input type="hidden" name="searchparameter" id="searchparameter" value="project_id">
                     <input type="hidden" name="searchvalue" id="searchvalue" value="<?php echo $project_id;?>">
                     <input type="hidden" name="start_date" id="start_date" value="<?php echo $start_date;?>">
                     <input type="hidden" name="end_date" id="end_date" value="<?php echo $end_date;?>">
                   '<input type="hidden" name="reportmethod" id="reportmethod" value="benficiariesprojectreport">
                     <input type="hidden" name="reporttitle" id="reporttitle" value="<?php echo $reporttitle;?>">
                      <input type="hidden" name="from_year" id="from_year" value="<?php echo $from_year;?>">
                     <input type="hidden" name="from_month" id="from_month" value="<?php echo $from_month;?>">
                     <input type="hidden" name="to_year" id="to_year" value="<?php echo $to_year;?>">
                     <input type="hidden" name="to_month" id="to_month" value="<?php echo $to_month;?>">
                     
                     <button type="submit" class="btn btn-primary">SAVE REPORT</button></td></tr>
                     </table>
                    <table width="100%" id="" class="table table-hover table-nomargin">
                <thead>
                <tr>
                  <th colspan="2">Report on beneficiaries reached by the project <?php echo $theproject;?> from <?php echo date("d F Y",strtotime($start_date));?> to <?php echo date("d F Y",strtotime($end_date));?></th></tr>
                </thead>
                
                <tr><td>
                    
                    <table id="customers">
                    <tr>
                    <td bgcolor="#e31c43"><font color="#FFFFFF"><strong>Beneficiaries reached by project <?php echo $theproject;?> </strong></font>
                    </td>
                    </tr>
                    <tr><td valign="top">
                    <p>
               <?php echo $reachtable; ?>
               </p>
            
                    
                    </td></tr>
                    </table>

                    </td>
                    
                    </tr>
             
                    <tr><td>
                    
                    <table id="customers">
                    <tr>
                    <td bgcolor="#e31c43"><font color="#FFFFFF"><strong>Beneficiaries target vs reached by project <?php echo $theproject;?> </strong></font>
                    </td>
                    </tr>
                    <tr><td valign="top">
                    <p>
               <?php echo $numberstable; ?>
               </p>
            
                    
                    </td></tr>
                    </table>

                    </td>
                    
                    </tr>
                    
                    
                    <tr>
                    <td>
                    <table id="customers">
                    <tr>
                    <td bgcolor="#e31c43"><font color="#FFFFFF"><strong>Beneficiaries target vs reached by <?php echo $theproject;?> </strong></font>
                    </td>
                    </tr>
                    <tr><td valign="top">
                    
              <script type="text/javascript">
$(function () {
    // On document ready, call visualize on the datatable.
    $(document).ready(function() {
        /**
         * Visualize an HTML table using Highcharts. The top (horizontal) header
         * is used for series names, and the left (vertical) header is used
         * for category names. This function is based on jQuery.
         * @param {Object} table The reference to the HTML table to visualize
         * @param {Object} options Highcharts options
         */
        Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });
    
            // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });
    
            var chart = new Highcharts.Chart(options);
        }
    
        var table = document.getElementById('datatable'),
        options = {
            chart: {
                renderTo: 'tablecontainer',
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Number Reached vs Target'
                }
            }, plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                      
                    },
                    enableMouseTracking: false
                }
            },
			credits: {
      enabled: false
  },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        };
    
        Highcharts.visualize(table, options);
    });
    
});
		</script>
        
         <script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>
        
        <div id="tablecontainer" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                    
                    </td></tr>
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

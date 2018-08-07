<?php include(APPPATH . 'views/common/header.php'); ?>
<?php
function reduce_str($text, $size)
{
   
  $length = strlen($text);
  
	if($length>$size)
	 {
		  $length_fin = substr($text, 0, $size);
		 
		  $text = $length_fin."........"; 
	  
	  }
	  
	  return($text);
  
}
?>
<style>
				#listtable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#listtable td, #listtable th 
				{
				font-size:1.0em;
				border:1px solid #0099FF;
				background-color:#FFFFCC;
				padding:3px 7px 2px 7px;
				}
				
				#listtable td.alt 
				{
				background-color:#EAF2D3;
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
				
				
				  #customers
        {
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        width:50%;
        border-collapse:collapse;
        }
        #customers td, #customers th 
        {
        font-size:1.0em;
        border:1px  #999999;
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
	<body>
		<?php include(APPPATH . 'views/common/navbar.php'); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<?php include(APPPATH . 'views/common/sidebar.php'); ?>
			
			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="<?php echo site_url('home')?>">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li class="active">Dashboard</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
                           <div class="page-header position-relative">
						<h1>
							Dashboard
							<small>
								<i class="icon-double-angle-right"></i>
								Overview
							</small>
						</h1>
					</div><!--/.page-header-->
                           <div class="row-fluid">
								<div class="span6 widget-container-span">
									<div class="widget-box">
										<div class="widget-header">
											<h5>Proforma Invoices by gender in the month of <?php echo date('F');?> (%)</h5>

											<div class="widget-toolbar">
												<!--<a href="#" data-action="settings">
													<i class="icon-cog"></i>
												</a>-->

												<a href="#" data-action="reload">
													<i class="icon-refresh"></i>
												</a>

												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!--<a href="#" data-action="close">
													<i class="icon-remove"></i>
												</a>-->
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
				
                <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			 credits: {
      enabled: false
  },
            title: {
                text: 'Proforma Invoices Requested By Gender'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(0) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Invoice request by gender',
                data: [
                    <?php echo $piedata;?>
                ]
            }]
        });
    });
    
});
		</script>
        
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>

<div id="container" style="min-width: 200px; height: 200px; margin: 0 auto"></div>
                
                				</div>
										</div>
									</div>
								</div>

								<div class="span6 widget-container-span">
									<div class="widget-box">
										<div class="widget-header">
											<h5>Proforma Invoices by health plan in <?php echo date('F');?> (%)</h5>

											<div class="widget-toolbar">
												<!--<a href="#" data-action="settings">
													<i class="icon-cog"></i>
												</a>

												<a href="#" data-action="reload">
													<i class="icon-refresh"></i>
												</a>-->

												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!--<a href="#" data-action="close">
													<i class="icon-remove"></i>
												</a>-->
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												
                         <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'cont',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			 credits: {
      enabled: false
  },
            title: {
                text: 'Proforma Invoices Requested By Health Plan'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(0) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Invoice request by health plan',
                data: [
                    <?php echo $plandata;?>
                ]
            }]
        });
    });
    
});
		</script>
        
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>

<div id="cont" style="min-width: 200px; height: 200px; margin: 0 auto"></div>
											</div>
										</div>
									</div>
								</div>
							</div><!--/row-->

							<div class="space-24"></div>

							
                          <div class="hr hr32 hr-dotted"></div>
                          
                          <div class="row-fluid">
								<div class="span6 widget-container-span">
									<div class="widget-box">
										<div class="widget-header">
											<h5>Proforma Invoices by individual or family in <?php echo date('F');?> (%)</h5>

											<div class="widget-toolbar">
												<!--<a href="#" data-action="settings">
													<i class="icon-cog"></i>
												</a>-->

												<a href="#" data-action="reload">
													<i class="icon-refresh"></i>
												</a>

												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!--<a href="#" data-action="close">
													<i class="icon-remove"></i>
												</a>-->
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												
                                                 <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'premcont',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			 credits: {
      enabled: false
  },
            title: {
                text: 'Proforma Invoices Requested By Individual or Family'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(0) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Invoice request by individual or family',
                data: [
                    <?php echo $premiumfordata;?>
                ]
            }]
        });
    });
    
});
		</script>
        
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>

<div id="premcont" style="min-width: 200px; height: 200px; margin: 0 auto"></div>
											</div>
										</div>
									</div>
								</div>

								<div class="span6 widget-container-span">
									<div class="widget-box">
										<div class="widget-header">
											<h5>Proforma Invoices by age in <?php echo date('F');?> (%)</h5>

											<div class="widget-toolbar">
												<!--<a href="#" data-action="settings">
													<i class="icon-cog"></i>
												</a>

												<a href="#" data-action="reload">
													<i class="icon-refresh"></i>
												</a>-->

												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!--<a href="#" data-action="close">
													<i class="icon-remove"></i>
												</a>-->
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												
                                             <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'agecont',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			 credits: {
      enabled: false
  },
            title: {
                text: 'Proforma Invoices Requested By Age Groups'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(0) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Invoice request by age groups',
                data: [
                    <?php echo $agedata;?>
                ]
            }]
        });
    });
    
});
		</script>
        
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>

<div id="agecont" style="min-width: 200px; height: 200px; margin: 0 auto">
											</div>
										</div>
									</div>
								</div>
							</div><!--/row-->

							<div class="space-24"></div>
                            
                            <div class="hr hr32 hr-dotted"></div>
                          
                          <div class="row-fluid">
								<div class="span6 widget-container-span">
									<div class="widget-box">
										<div class="widget-header">
											<h5>Proforma Invoices requested today (<?php echo date("d F Y", strtotime(date('Y-m-d')));?>)</h5>

											<div class="widget-toolbar">
												<!--<a href="#" data-action="settings">
													<i class="icon-cog"></i>
												</a>-->

												<a href="#" data-action="reload">
													<i class="icon-refresh"></i>
												</a>

												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!--<a href="#" data-action="close">
													<i class="icon-remove"></i>
												</a>-->
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												
                                                <table id="listtable">
                                                <tr><th>Name</th><th>Email</th><th>Invoice Date</th><th>Invoice Number</th></tr>
                                                <?php
												foreach($todaysinvoices as $key=>$todaysinvoice):
												?>
                                                <tr><td><?php echo $todaysinvoice->name; ?></td><td><?php echo $todaysinvoice->email; ?></td><td><?php echo $todaysinvoice->invoice_date; ?></td><td>
												<?php
if($todaysinvoice->premiumfor==1)
{
	?>
    <a href="<?php echo base_url() ?>index.php/profomainvoices/invoice/<?php echo $todaysinvoice->id; ?>/<?php echo $todaysinvoice->trackcode; ?>" target="_blank"><?php echo $todaysinvoice->invoice_number; ?></a>
    <?php
}
else
{
	?>
    <a href="<?php echo base_url() ?>index.php/profomainvoices/familyinvoice/<?php echo $todaysinvoice->id; ?>/<?php echo $todaysinvoice->trackcode; ?>" target="_blank"><?php echo $todaysinvoice->invoice_number; ?></a>
    <?php
}
?>
												
												</td></tr>
                                                <?php
												endforeach;
												?>
                                                </table>
											</div>
										</div>
									</div>
								</div>

								
							</div><!--/row-->

                         
                          
                          
                          
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<?php include(APPPATH . 'views/common/settingscontainer.php'); ?>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<?php include(APPPATH . 'views/common/footer.php'); ?>
	</body>
</html>

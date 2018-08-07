<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/jquery-1-3-2.min.js"></script>
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
							<a href="<?php echo base_url() ?>index.php/reports">Reports</a>
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
						Donors by Sector
					</h3>
				</div>
				<div class="box-content nopadding">
              
              <table width="100%" id="listtable">
<thead>
<tr>
  <th colspan="2">Report on funding by <?php echo $donor->name;?> to all sectors from <?php echo $from_year;?>/<?php echo $from_month;?> to <?php echo $to_year;?>/<?php echo $to_month;?></th></tr>
</thead>
<tr><td>
<table id="customers">
<tr>
<td bgcolor="#e31c43"><font color="#FFFFFF"><strong>Funding by <?php echo $donor->name;?> to all sectors Table</strong></font>
</td>
</tr>
<tr><td valign="top">

<?php echo $fundingtable; ?>

</td></tr>
</table>



</td></tr>

<tr>
  <td>
<table id="customers">
<tr>
  <td bgcolor="#e31c43"><font color="#FFFFFF"><strong>Funding by <?php echo $donor->name;?> to all sectors Graph Amounts</strong></font></td>
</tr>
<tr><td valign="top">
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                zoomType: 'xy'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: [{
                categories: [<?php echo $categories;?>],
				labels: {
                rotation: 270,
                y:40
                
            	}
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    formatter: function() {
                        return this.value +'';
                    },
                    style: {
                        color: '#89A54E'
                    }
                },
                title: {
                    text: '',
                    style: {
                        color: '#89A54E'
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Amount in USD',
                    style: {
                        color: '#4572A7'
                    }
                },
                labels: {
                    formatter: function() {
                        return this.value +' ';
                    },
                    style: {
                        color: '#4572A7'
                    }
                },
                opposite: true
            }],
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +
                        (this.series.name == 'Amount' ? ' ' : '');
                }
            },/**
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: '#FFFFFF'
            },**/
			 credits: {
      enabled: false
  },
            series: [{
                name: 'Amount Funded',
                color: '#4572A7',
                type: 'column',
                yAxis: 1,
                data: [<?php echo $amountfunded;?>]
    
            }]
        });
    });
    
});
		</script>
        
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

</td></tr>

</table>

<table id="customers">
<tr>
<td bgcolor="#e31c43" width="50%"><font color="#FFFFFF"><strong>Funding by <?php echo $donor->name;?> to all sectors  pie chart %</strong></font></td>
</tr>
<tr><td>


<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'piecontainer',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
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
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(1) +' %';
                        }
                    }
                }
            },credits: {
      enabled: false
  },
            series: [{
                type: 'pie',
                name: 'Percentage Funding',
                data: [
                    <?php echo $piedata; ?>
                ]
            }]
        });
    });
    
});
		</script>
        
        <div id="piecontainer" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</td></tr>
</table>

</td></tr>
<tr><td>
<table id="customers">
<tr>

  <td bgcolor="#e31c43" width="50%"><font color="#FFFFFF"><strong>Funding by <?php echo $donor->name;?> to all sectors (Amount &amp; %)</strong></font>
</td>

</tr>
<tr>
<td><script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'plannedcontainer',
                zoomType: 'xy'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: [{
                categories: [<?php echo $categories; ?>],
				labels: {
                 rotation: 270,
                y:40
                
            	}
            }],
            yAxis: [{ // Primary yAxis
			min: 0,
                labels: {
                    formatter: function() {
                        return this.value +'%';
                    },
                    style: {
                        color: '#e31c43'
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: '#e31c43'
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Amount Funded',
                    style: {
                        color: '#4572A7'
                    }
                },
                labels: {
                    formatter: function() {
                        return this.value +' ';
                    },
                    style: {
                        color: '#4572A7'
                    }
                },
                opposite: true
            }],
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +
                        (this.series.name == 'Amount' ? ' ' : '');
                }
            },/**
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: '#FFFFFF'
            },**/credits: {
      enabled: false
  },
            series: [{
                name: 'Amount Funded',
                color: '#4572A7',
                type: 'column',
                yAxis: 1,
                data: [<?php echo $amountfunded;?>]
    
            }, {
                name: 'Percentage',
                color: '#e31c43',
                type: 'spline',
                data: [<?php echo $percentagedata;?>]
            }]
        });
    });
    
});
		</script>
        
        <div id="plannedcontainer" style="min-width: 400px; height: 400px; margin: 0 auto"></div></td>
</tr>
</table>

</td></tr>

</table>
              
              
              
              
                </div>
</div>
</div>
</div>
</div>
</div>
</div>
	</body>
</html>

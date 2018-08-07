<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width">
<title>Statistical Report</title>
<style type="text/css">
@media print{
  body{ background-color:#FFFFFF; background-image:none; color:#000000 }
  #ad{ display:none;}
  #leftbar{ display:none;}
  #contentarea{ width:100%;}
}
</style>
<style>
				#lasttable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#lasttable td, #lasttable th 
				{
				font-size:1.0em;
				border:1px solid #999999;
				padding:3px 7px 2px 7px;
				}
				#lasttable th 
				{
				font-size:1.0em;
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
                
                <style>
				#disttable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#disttable td, #disttable th 
				{
				font-size:0.8em;
				border:1px solid #892A24;
				padding:3px 7px 2px 7px;
				}
				#disttable th 
				{
				font-size:0.8em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#892A24;
				color:#fff;
				}
				#disttable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				</style>
                
                
                <style>
				#datatable
				{
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				width:100%;
				border-collapse:collapse;
				}
				#datatable td, #listtable th 
				{
				font-size:0.9em;
				border:1px solid #892A24;
				padding:3px 7px 2px 7px;
				}
				#datatable th 
				{
				font-size:0.9em;
				text-align:left;
				padding-top:5px;
				padding-bottom:4px;
				background-color:#892A24;
				color:#fff;
				}
				#datatable tr.alt td 
				{
				color:#000;
				background-color:#EAF2D3;
				}
				</style>
                
                 <script src="<?php echo base_url(); ?>js/jquery-2.1.1.min.js"></script>
        
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colorpicker.css" />
        
         <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>media/js/jquery.dataTables.js"></script>
    <style>
    #map-canvas{
      width: 100%;
      height: 100%;
	    padding: 6px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc #ccc #999 #ccc;
        -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
    }
	
	img { max-width:none; }
  </style>
  
<style>
p.mybreak { page-break-before: always; }
</style>
<style>
    #map-canvas{
      width: 100%;
      height: 500px;
	    padding: 6px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc #ccc #999 #ccc;
        -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
    }
	
	img { max-width:none; }
  </style>
</head>

<body>

<center>

<table width="100%" id="listtable">
<tr><td><img src="<?php echo base_url(); ?>img/drc_logo.png" alt="" class='retina-ready' width="98" height="36">&nbsp;&nbsp;&nbsp; <img src="<?php echo base_url(); ?>img/ddg_logo.png" alt="" class='retina-ready' width="105" height="36"></td></tr>
<tr><th><center>
MONTHLY STATISTICAL REPORT <?php echo strtoupper($country);?> - <?php echo strtoupper($monthName);?> <?php echo $year;?> 
</center></th></tr>
<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Overall status of projects </strong></font></td><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Map of projects in <?php echo $country;?> </strong></font></td></tr>
<tr><td valign="top">
<?php echo $overal_status; ?>


</td><td valign="top">
    <div id="json_data" style="display:none;">
	<?php
                                    
       //echo json_encode($points,JSON_HEX_QUOT | JSON_HEX_TAG);
	   
	   echo $points;
                                     
    ?>
    </div>
    <div id="map-canvas"></div>
    <script src="<?php echo base_url(); ?>js/mapwithmarker.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/markerclusterer.js"></script>
                  
  <script src="<?php echo base_url(); ?>js/map.js"></script>


</td></tr>
        
        
          
</table>
</td></tr>

<tr><td>
<table id="customers">
<tr>
  <td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Status of Sub Activity Implementation   </strong></font></td><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Distribution of activities implemented by type vs status of implementation</strong></font></td></tr>
<tr><td valign="top">
<?php echo $status_of_activity; ?>


</td><td valign="top">
<?php echo $activity_table; ?>
<hr />
<!--<p><center><font size="-1" color="#1F7EB8">Implementation status of the tasks</font></center></p>-->
 <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'tasks_container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			 credits: {
      enabled: false
  },
            title: {
                text: 'Implementation status of the sub activities'
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
                name: 'Implementation Status of Sub Activities',
                data: [
                    <?php echo $pie_data;?>
                ]
            }]
        });
    });
    
});
		</script>
        

<div id="tasks_container" style="min-width: 100%; height: 250px; margin: 0 auto"></div></td></tr>
        
        
          
</table>
</td></tr>
<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24"><font color="#FFFFFF"><strong>Distribution of activities in regions implemented by type </strong></font></td></tr>
<tr><td>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'type_container',
                type: 'column'
            },
			 credits: {
      enabled: false
  },
            title: {
                text: ''
            },
            xAxis: {
                categories: [<?php echo $series_category;?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No. of activities'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            /**legend: {
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },**/
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [<?php echo $series;?>]
        });
    });
    
});
		</script>
<div id="type_container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries Reached    </strong></font></td>
<td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries reached by sector disaggregated by age &amp; gender</strong></font></td></tr>
<tr><td valign="top">
<?php echo $beneficiaries_reached; ?>


</td><td valign="top">
<?php echo $beneficiaries_by_sector; ?>

</td></tr>
        
        
          
</table>
</td></tr>
<tr><td>
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
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'No. Reached'
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
        
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                            <script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>

</td></tr>
<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries reached versus the target number    </strong></font></td>
<td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries reached by region disaggrigated by age &amp; gender</strong></font></td></tr>
<tr><td valign="top">
<?php echo $target_vs_reached; ?>

</td>
<td valign="top">

<?php echo $beneficiaries_by_district; ?>

</td></tr>
        
        
          
</table>
</td></tr>

<tr>
  <td>
<table id="customers">
<tr>
  <td bgcolor="#892A24"><font color="#FFFFFF"><strong>Sub Activities and beneficiaries</strong></font></td>
</tr>
<tr>
<td valign="top">
<p>The table below gives a brief summary of all the activities conducted and the beneficiaries reached.</p>
<?php echo $activities_beneficiaries; ?>



</td>
</tr>
        
        
          
</table>
</td></tr>


<tr>
  <td>
<table id="customers">
<tr>
  <td bgcolor="#892A24"><font color="#FFFFFF"><strong>Projects and beneficiaries</strong></font></td>
</tr>
<tr>
<td valign="top">
<?php echo $projects_beneficiaries;?>



</td>
</tr>
        
        
          
</table>
</td></tr>

</table>


</center>
</body>
</html>
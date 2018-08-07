<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<input type="text" name="myurl" id="myurl" />

<input type="hidden" name="country" id="country" value="<?php echo $country;?>">
<input type="hidden" name="month" id="month" value="<?php echo $month;?>">
<input type="hidden" name="year" id="year" value="<?php echo $year;?>">

<?php echo $beneficiaries_by_sector; ?>


<img id="mychart" style="width: 600px;" />
<img id="graph" style="width: 600px;" />

<img id="sectorgraph" style="width: 600px;" />


<script>
// Regular chart options
// Just never rendered with "new Highcharts.Chart" or "$('#container').highcharts()"
var options = {
    credits: {
      enabled: false
  },
            title: {
                text: 'Implementation status of the tasks'
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
                name: 'Implementation Status of Tasks',
                data: [
                    <?php echo $pie_data;?>
                ]
            }]
};


// URL to Highcharts export server
var exportUrl = 'http://export.highcharts.com/';

// POST parameter for Highcharts export server
var object = {
    options: JSON.stringify(options),
    type: 'image/png',
    async: true
};

// Ajax request
$.ajax({
    type: 'post',
    url: exportUrl,
    data: object,
    success: function (data) {
        // Update "src" attribute with received image URL
        $('#mychart').attr('src', exportUrl + data);
		
    }
}).done(function(data){
		
		var country = $('#country').val();
		var month = $('#month').val();
		var year = $('#year').val();
        $.ajax({
			type: 'post',
			url: '<?php echo base_url();?>index.php/statisticalreports/download',
			data: {'url':exportUrl,'object':data,'country':country,'month':month,'year':year,},
			success: function (data) {
				// Update "src" attribute with received image URL
			   
				
			}
		});
    });


</script>



<script>
// Regular chart options
// Just never rendered with "new Highcharts.Chart" or "$('#container').highcharts()"
var options = {
	 chart: {
             
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
};


// URL to Highcharts export server
var exportUrl = 'http://export.highcharts.com/';

// POST parameter for Highcharts export server
var object = {
    options: JSON.stringify(options),
    type: 'image/png',
    async: true
};

// Ajax request
$.ajax({
    type: 'post',
    url: exportUrl,
    data: object,
    success: function (data) {
        // Update "src" attribute with received image URL
        $('#graph').attr('src', exportUrl + data);
		
    }
}).done(function(data){
		
		var country = $('#country').val();
		var month = $('#month').val();
		var year = $('#year').val();
        $.ajax({
			type: 'post',
			url: '<?php echo base_url();?>index.php/statisticalreports/downloadgraph',
			data: {'url':exportUrl,'object':data,'country':country,'month':month,'year':year,},
			success: function (data) {
				// Update "src" attribute with received image URL
			   
				
			}
		});
    });


</script>


<script>
// Regular chart options
// Just never rendered with "new Highcharts.Chart" or "$('#container').highcharts()"

var options = {
	
	chart: {
              
                type: 'column'
            },
			 credits: {
      enabled: false
  },
            title: {
                text: 'Beneficiaries reached by sector disaggrigated by age & gender'
            },
            
            xAxis: {
                categories: [
                   <?php echo $graphcategories;?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No. Reached'
                }
            },/**
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },**/
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' mm';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [<?php echo $graphseries;?>]
    
};


// URL to Highcharts export server
var exportUrl = 'http://export.highcharts.com/';

// POST parameter for Highcharts export server
var object = {
    options: JSON.stringify(options),
    type: 'image/png',
    async: true
};

// Ajax request
$.ajax({
    type: 'post',
    url: exportUrl,
    data: object,
    success: function (data) {
        // Update "src" attribute with received image URL
        $('#sectorgraph').attr('src', exportUrl + data);
		
    }
}).done(function(data){
		
		var country = $('#country').val();
		var month = $('#month').val();
		var year = $('#year').val();
        $.ajax({
			type: 'post',
			url: '<?php echo base_url();?>index.php/statisticalreports/sectorgraph',
			data: {'url':exportUrl,'object':data,'country':country,'month':month,'year':year,},
			success: function (data) {
				// Update "src" attribute with received image URL
			   
				
			}
		});
    });


</script>

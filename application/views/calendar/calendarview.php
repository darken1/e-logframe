<?php include(APPPATH . 'views/common/head.php'); ?>
<style>
.responsive-calendar .controls {
  text-align: center;
}
.responsive-calendar .controls a {
  cursor: pointer;
}
.responsive-calendar .controls h4 {
  display: inline;
}
.responsive-calendar .day-headers,
.responsive-calendar .days {
  font-size: 0;
}
.responsive-calendar .day {
  display: inline-block;
  position: relative;
  font-size: 14px;
  width: 14.285714285714286%;
  text-align: center;
}
.responsive-calendar .day a {
  color: #000000;
  display: block;
  cursor: pointer;
  padding: 20% 0 20% 0;
}
.responsive-calendar .day a:hover {
  background-color: #eee;
  text-decoration: none;
}
.responsive-calendar .day.header {
  border-bottom: 1px gray solid;
}
.responsive-calendar .day.active a {
  background-color: #1d86c8;
  color: #ffffff;
}
.responsive-calendar .day.active a:hover {
  background-color: #36a0e2;
}
.responsive-calendar .day.active .not-current {
  background-color: #8fcaef;
  color: #ffffff;
}
.responsive-calendar .day.active .not-current:hover {
  background-color: #bcdff5;
}
.responsive-calendar .day.not-current a {
  color: #ddd;
}
.responsive-calendar .day .badge {
  position: absolute;
  top: 2px;
  right: 2px;
  z-index: 1;
}

/* Event Calendar */

.event-calendar{
	overflow:visible;
}

.calendar-header{
	margin-top:50px;
}

.calendar-header .filter-dropdown{
	text-align:left;
	margin-right:0;
}

.calendar-header label{
	color:#95999e;
	font-size:13px;
	margin-right:5px;
	position:relative;
	top:2px;
}

.calendar-header h3{
	margin:0;
	position:relative;
	top:5px;
}

.event-calendar{
	margin:15px 0 30px;
}

.event-calendar,
.event-calendar tr,
.event-calendar td,
.event-calendar th,
.event-calendar tr:hover{
	background:none;
}

.event-calendar tr:hover>th{
	background:#e2eaf2;
}

.event-calendar{
	border:none;
	table-layout: fixed;
}

.event-calendar th{
	background:#e2eaf2;
	font-weight:400;
	padding:18px 20px;
	font-size:16px;
	border:2px solid #f2f4f9;
	border-radius:6px;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	overflow:hidden;
	text-align:center;
}

.event-calendar td{
	border:2px solid #f2f4f9;
	background:#fafbfd;
	height:150px;
	vertical-align:top;
	padding:10px 5px 10px 15px;
	border-radius:6px;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	transition:background 0.3s;
	-webkit-transition:background 0.3s;
	-moz-transition:background 0.3s;
}

.event-calendar td>span.day{
	font-size:18px;
	font-weight:700;
	display:block;
	transition:color 0.3s;
	-webkit-transition:color 0.3s;
	-moz-transition:color 0.3s;
}

.event-calendar td.no-events>span.day{
	color:#dee0e5;
}

.event-calendar td .events{
	list-style:none;
	margin:0;
	padding:0;
	font-size:13px;
}

.event-calendar td .events li{
	border-bottom:1px solid #ecedf1;
	padding:5px 0;
	transition:border 0.3s;
	-webkit-transition:border 0.3s;
	-moz-transition:border 0.3s;
	position:relative;
}

.event-calendar td .events li:last-child{
	padding-bottom:0;
	border:none;
}

.event-calendar td:hover{
	background:#63b2f5;
}

.event-calendar td:hover .events li{
	border-color:#81c7f8;
}

.event-calendar td:hover .events>li>a{
	color:#fff;
}

.event-calendar td:hover>span.day{
	color:#fff;
}

.event-calendar td.not-this-month{
	opacity:0;
}

.event-popover{
	position:absolute;
	bottom:130px;
	background:#fff;
	display:none;
	width:320px;
	vertical-align:top;
	padding:15px 10px;
	transition:all 0.4s;
	-webkit-transition:all 0.4s;
	-moz-transition:all 0.4s;
	border-radius:3px;
	-webkit-border-radius:3px;
	-moz-border-radius:3px;
	z-index:100;
	box-shadow:0 1px 1px rgba(0,0,0,.1);
	-webkit-box-shadow:0 1px 1px rgba(0,0,0,.1);
	-moz-box-shadow:0 1px 1px rgba(0,0,0,.1);
}

.event-calendar td:last-child .event-popover,
.event-calendar td:nth-child(6) .event-popover{
	right:0;
}

.event-calendar td:last-child .event-popover:after,
.event-calendar td:nth-child(6) .event-popover:after{
	left:auto;
	right:20px;
}

.csstransforms .event-popover{
	display:block;
	opacity:0;
	transform:scale(0);
	-webkit-transform:scale(0);
	-moz-transform:scale(0);
	-ms-transform:scale(0);
	-o-transform:scale(0);
}

.event-popover:after{
	content:'';
	display:block;
	width:15px;
	height:15px;
	position:absolute;
	border-left:10px solid transparent;
	border-right:10px solid transparent;
	border-top:8px solid #fff;
	bottom:-15px;
	left:20px;
}

.event-popover h6{
	margin:5px 0 10px;
}

.event-popover .event-meta{
	list-style:none;
	margin:0;
	padding:0;
	margin-bottom:10px;
}

.event-popover img.align-left{
	margin-bottom:10px;
}

.event-popover .event-meta li{
	border:none!important;
	padding:0!important;
	color:#95999e;
	font-size:13px;
}

.event-popover p{
	font-size:13px;
	line-height:22px;
}

.event-calendar td .events li:hover .event-popover{
	display:block;
	bottom:120%;
	opacity:1;
	transform:scale(1);
	-webkit-transform:scale(1);
	-moz-transform:scale(1);
	-ms-transform:scale(1);
	-o-transform:scale(1);
}



</style>

   <style>

   @import url(http://fonts.googleapis.com/css?family=Roboto);


.wrapper {
  width: 800px;
  padding: 4px;
}

table {
  width: 100%;
  font-size: 14px;
  border-left: 1px solid #d6d6d6;
}

td {
  border-right: 1px solid #d6d6d6;
}

#header-table tr:first-child {
  text-align: center;
  color: #0055ff;
  border-top: 1px solid #d6d6d6;
  text-shadow: 1px 1px 3px rgba(0, 85, 255, 0.3);
}

#header-table tr:nth-child(2) {
  background-color: #A4C739;
  color: white;
  border: 1px solid #d6c1d6;
  text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.3);
}

#header-table td {
  padding: 4px;
}

#day-names {
  text-align: center;
  border-bottom: 1px solid #d6d6d6;
}

#day-names td {
  width: 14.2857%;
  height: 22px;
}

table.week {
  font-size: 75%;
}

table.week {
  height: 80px;
  border-bottom: 1px solid #d6d6d6;
}

table.week td {
  width: 14.2857%;
  padding: 2px 3px;
}

td.today {
  font-weight: bold;
  background-color: rgba(181, 228, 206, .4);
}

td.today.date {
  font-size: 110%;
  text-shadow: 1px 1px 3px rgba(25,25,25, 0.3);
}

table.week tr:first-child {
  height: 25%;
}

table.week tr:nth-child(2) {
  height: 75%;
}

.event.holiday {
  background-color: #c5c5ee;
}

td.event.important {
  background-color: #A4C739;
  font-weight: bold;
  color: #fff;
  text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.3);
}

@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px) {
  .wrapper {
    width: inherit;
    min-width: 220px;
  }
  #day-names {
    display: none;
  }
  table.week{
    height: 30px;
  }
  .week td {
    padding: auto;
    text-align: center;
  }
  .week tr:nth-child(2) {
    display: none;
  }
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
							<a href="<?php echo base_url() ?>calendar">Calendar</a>
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
									<i class="fa fa-calendar"></i>
									Calendar
								</h3>
							</div>
				<div class="box-content nopadding">
                
                <?php 
						$attributes = array('name' => 'frm', 'id' => 'frm', 'enctype' => 'multipart/form-data'); 
						 echo form_open('calendar/searchcalendar',$attributes); ?>
                         
                                        
                    <table class="table table-hover table-nomargin table-condensed">
                    <tr><td colspan="5"><ul class="pager">
										<li class="previous">
											 <?php echo $previous_month_link;?>
										</li>

										<li class="next">
											<?php echo $next_month_link;?>
										</li>
									</ul></td></tr>
                                     
                         <td>Month</td><td>
                         <?php
						 echo $select_month_control;						 
						 ?>
                       </td>
                         <td>Year</td><td>
                         
                         <?php
						 echo $select_year_control;
						 
						 ?>
                         </td>
                         <td><?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?></td>
                         </tr>
                    </table>
                   <?php echo form_close(); ?>
                <div class="events-calendar">
               
                 <?php echo $calendar;?>
                
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

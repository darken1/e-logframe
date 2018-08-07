<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width">
<title>Statistical Report</title>
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
      width: 500px;
      height: 360px;
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
</head>

<body>
<center>
<table width="100%" id="listtable">
<tr><td><img src="<?php echo base_url(); ?>img/drc_logo.png" alt="" class='retina-ready' width="98" height="36">&nbsp;&nbsp;&nbsp; <img src="<?php echo base_url(); ?>img/ddg_logo.png" alt="" class='retina-ready' width="105" height="36"></td></tr>
<tr><th><center>
BI-MONTHLY STATISTICAL REPORT SOMALIA- March 2017 
</center></th></tr>
<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Overall status of projects </strong></font></td><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Map of projects in Somalia </strong></font></td></tr>
<tr><td valign="top">
<ul>
<li>In the month of March 2017, (8/10) 80% of projects were ongoing in {x} regions in Somalia, covering {x} sectors.</li>
<li>WASH covered the most projects with a total of {x} projects implemented by the sector</li>
<li>ECHO remains the leading donor with 9 projects funded accounting for 40% of all the projects supported by donors.</li>
</ul>
<p>The table below gives a summary of the status of projects in Somalia.</p>
<table id="disttable">
<tr><th width="50%">Sector</th><th>Closed</th><th>New</th><th>Ongoing</th></tr>
<tr><td>WASH</td><td>10</td><td>10</td><td>10</td></tr>
<tr><td>Food Security and Livelihood</td><td>10</td><td>10</td><td>10</td></tr>
<tr><td>NFI/Shelter</td><td>10</td><td>10</td><td>10</td></tr>
<tr><th width="50%">Total Projects</th><th>30</th><th>30</th><th>30</th></tr>
</table>
</td><td valign="top">

MAP</td></tr>
        
        
          
</table>
</td></tr>

<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Status of Activity Implementation   </strong></font></td><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Distribution of tasks implemented by type vs status of implementation</strong></font></td></tr>
<tr><td valign="top">
<ul>
<li>A total of {x} activities were implemented in this month</li>
<li>Gedo region accounted for the highest number of activities reported, with a total of 10 out of the 30 activities implemented.</li>
<li>Trainings accounted for majority of the activities implemented at (60%), with distributions (10%) and conditional/cash distributions (8%) being the second and third most implemented activities respectively.</li>
</ul>

<table id="disttable">
<tr><th width="50%">Region</th><th># of Activities</th><th>Completed</th><th>Warning</th><th>Overdue</th></tr>
<tr><td width="50%">Gedo</td><td>10</td><td>10</td><td>0</td><td>0</td></tr>
<tr><td width="50%">Bari</td><td>5</td><td>3</td><td>1</td><td>1</td></tr>
<tr><th width="50%">Total</th><th>15</th><th>13</th><th>1</th><th>1</th></tr>
</table>
</td><td valign="top">

BAR 1
<hr />
<p><center><font size="-1" color="#1F7EB8">Implementation status of the tasks</font></center></p>
BAR 2</td></tr>
        
        
          
</table>
</td></tr>

<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries Reached    </strong></font></td>
<td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries reached by sector disaggrigated by age &amp; gender</strong></font></td></tr>
<tr><td valign="top">
<ul>
<li>A total of {x} beneficiaries were reached in {x} regions.</li>
<li>The highest number of beneficiaries reached were IDPs accounting for 50% of the total, followed by Host Community (10%) and Female headed households (5%)</li>

</ul>
<table id="disttable">
<tr><th width="50%">Beneficiary Type</th><th># Reached</th><th>%</th></tr>
<tr><td width="50%">IDPs</td><td>10</td><td>66%</td></tr>
<tr><td width="50%">FHH</td><td>5</td><td>44%</td></tr>
<tr><th width="50%">Total</th><th>15</th><th>&nbsp;</th></tr>
</table>

</td><td valign="top">

<table id="disttable">
<tr><th width="50%">Sector</th>
  <th>0-4 M</th>
  <th>0 - 4 F</th>
  <th>5-17 M</th>
  <th>5 - 17 F</th>
  <th>18-59 M</th>
  <th>18 - 59 F</th>
  <th>60 &amp; &gt; M</th>
  <th>60 &amp; > F</th></tr>
<tr><td width="50%">WASH</td>
  <td>5</td>
  <td>10</td>
  <td>10</td>
  <td>10</td>
  <td>5</td>
  <td>10</td>
  <td>5</td>
  <td>0</td></tr>
<tr><td width="50%">Food Security and Livelihood</td>
  <td>5</td>
  <td>5</td>
  <td>10</td>
  <td>10</td>
  <td>5</td>
  <td>10</td>
  <td>5</td>
  <td>10</td></tr>
<tr><th width="50%">Total</th>
  <th>10</th>
  <th>15</th>
  <th>20</th>
  <th>20</th>
  <th>10</th>
  <th>20</th>
  <th>10</th>
  <th>10</th></tr>
</table></td></tr>
        
        
          
</table>
</td></tr>

<tr><td>
<table id="customers">
<tr><td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries reached versus the target number    </strong></font></td>
<td bgcolor="#892A24" width="50%"><font color="#FFFFFF"><strong>Beneficiaries reached by district disaggrigated by age &amp; gender</strong></font></td></tr>
<tr><td valign="top">
<table id="disttable">
<tr><th width="50%">Beneficiary Type</th><th>Target</th><th>Reached</th></tr>
<tr><td width="50%">IDP</td><td>1000</td><td>300</td></tr>
<tr><td width="50%">FHH</td><td>500</td><td>200</td></tr>
<tr><th width="50%">Total</th><th>1500</th><th>&nbsp;</th></tr>
</table>

</td>
<td valign="top">

<table id="disttable">
<tr>
  <th width="50%">District</th>
  <th>0-4 M</th>
  <th>0 - 4 F</th>
  <th>5-17 M</th>
  <th>5 - 17 F</th>
  <th>18-59 M</th>
  <th>18 - 59 F</th>
  <th>60 &amp; &gt; M</th>
  <th>60 &amp; > F</th></tr>
<tr><td width="50%">Gedo</td>
  <td>5</td>
  <td>10</td>
  <td>10</td>
  <td>10</td>
  <td>5</td>
  <td>10</td>
  <td>5</td>
  <td>0</td></tr>
<tr><td width="50%">Bari</td>
  <td>5</td>
  <td>5</td>
  <td>10</td>
  <td>10</td>
  <td>5</td>
  <td>10</td>
  <td>5</td>
  <td>10</td></tr>
<tr><th width="50%">Total</th>
  <th>10</th>
  <th>15</th>
  <th>20</th>
  <th>20</th>
  <th>10</th>
  <th>20</th>
  <th>10</th>
  <th>10</th></tr>
</table>

</td></tr>
        
        
          
</table>
</td></tr>

<tr>
  <td>
<table id="customers">
<tr><td bgcolor="#892A24"><font color="#FFFFFF"><strong>Activities and beneficiaries</strong></font></td>
</tr>
<tr>
<td valign="top">
<p>The table below gives a brief summary of all the activities conducted and the beneficiaries reached.</p>
<table id="disttable">
	<tbody>
		<tr>
			<th>
				<strong>Project Code</strong></th>
			<th>
				<strong>Sector</strong></th>
			<th>
				<strong>Task</strong></th>
			<th>
				<strong>Task description</strong></th>
			<th>
				<strong>status</strong></th>
			
			<th colspan="3">
				<strong>Beneficiaries</strong></th>
		</tr>
		<tr>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			
			<td>
				<strong>Male</strong></td>
			<td>
				<strong>Female</strong></td>
			<td>
				<strong>Total</strong></td>
		</tr>
		<tr>
			<td>
				515-708</td>
			<td>
				Advocacy and Protection</td>
			<td>
				Community Entry Activity by CS 1 Harfo Team</td>
			<td>
				This was a community entry activity done by the CS 1 Harfo team in Mudug region, Harfo District and Harfo Community</td>
			<td>
				Completed</td>
			
			<td>
				23</td>
			<td>
				7</td>
			<td>
				30</td>
		</tr>
		<tr>
			<td colspan="5">
				TOTAL BENEFICIARIES TARGETED DURING THE MONTH</td>
			<td>
				<strong>23</strong></td>
			<td>
				<strong>7</strong></td>
			<td>
				<strong>30</strong></td>
		</tr>
	</tbody>
</table>



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
<table id="disttable">
	<tbody>
		<tr>
			<th width="9%">
				<strong>Project Code</strong></th>
			<th width="25%">
				<strong>Project</strong></th>
			<th width="15%">
				<strong>Start Date</strong></th>
			<th width="17%">
				<strong>End Date</strong></th>
			<th width="10%">
				<strong>status</strong></th>
			
			<th colspan="3">
				<strong>Beneficiaries</strong></th>
		</tr>
		<tr>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			<td>&nbsp;
				</td>
			
			<td width="6%">
				<strong>Male</strong></td>
			<td width="8%">
				<strong>Female</strong></td>
			<td width="10%">
				<strong>Total</strong></td>
		</tr>
		<tr>
			<td>
				515-708</td>
			<td>
				Police-Community Dialogue and Community Safety in Puntland</td>
			<td>
				2015-06-16</td>
			<td>
				2016-06-15</td>
			<td>
				Ongoing</td>
			
			<td>
				23</td>
			<td>
				7</td>
			<td>
				30</td>
		</tr>
		<tr>
			<td colspan="5">
				TOTAL BENEFICIARIES TARGETED DURING THE MONTH</td>
			<td>
				<strong>23</strong></td>
			<td>
				<strong>7</strong></td>
			<td>
				<strong>30</strong></td>
		</tr>
	</tbody>
</table>



</td>
</tr>
        
        
          
</table>
</td></tr>

</table>


</center>
</body>
</html>
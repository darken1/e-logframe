<style type="text/css">
    #progressbar div
    {
      background-color: #99cc66;
       width: 50%; 
       height: 20px;
       border-radius: 10px;

    }
    </style>
    
    <?php
$date1 = strtotime("2016-09-05 11:44:01");
$date2 = strtotime("2017-09-07 12:44:01");
$today = time();


$num = $today - $date1;
$den = $date2 - $date1;
$percentage = ($today - $date1) / ($date2 - $date1) * 100;
?>
<?php if($percentage<100 && $percentage>=0){ ?>
<div id="progressbar" style="border: 1px solid ; border-radius: 10px;">
<div style="width: <?php echo $percentage; ?>%;"><span><?php echo round($percentage,2); ?>%</span></div>
</div>
<?php } ?>

<?php
$date1=date_create("2016-09-05");
$date2=date_create("2017-09-05");
$diff=date_diff($date1,$date2);
?>
<table border="1" width="100%">
<thead>
<tr><th>Activity</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>&nbsp;</th></tr>
</thead>
<tr><td width="30%">Activity One</td> <td width="10%">2016-09-05</td><td width="10%">2017-09-05</td><td width="5%"><?php echo $diff->days;?> days</td>
<td width="45%">
<table bgcolor="#00FF00"><tr><td><div id="progressbar" style="border: 1px solid ; border-radius: 10px;">
<div style="width: <?php echo $diff->days;?>px;"></div>
</div></td></tr>
</table>
</td></tr>

</table>
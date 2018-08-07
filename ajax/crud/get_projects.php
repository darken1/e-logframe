<?php

include 'conn.php';
$rs = mysql_query('select id,project_no from projects');
$result = array();
//while($row = mysql_fetch_object($rs)){
	//array_push($result, $row);
//}

//echo json_encode($result);
$choices = '[';

while($row = mysql_fetch_array($rs))
{
	
	
	$choices .= '{ProjectID:\''.$row['id'].'\',ProjectCode:\''.$row['project_no'].'\'},';
}

$choices .= ']';

echo $choices;

?>
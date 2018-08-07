<?php

include 'conn.php';
$rs = mysql_query('select id,county from counties');
$result = array();
//while($row = mysql_fetch_object($rs)){
	//array_push($result, $row);
//}

//echo json_encode($result);
$choices = '[';

while($row = mysql_fetch_array($rs))
{
	
	
	$choices .= '{countyID:\''.$row['id'].'\',County:\''.$row['county'].'\'},';
}

$choices .= ']';

echo $choices;

?>
<?php

include 'conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$itemid = isset($_POST['id_no']) ? mysql_real_escape_string($_POST['id_no']) : '';
	$name_of_beneficiary = isset($_POST['name_of_beneficiary']) ? mysql_real_escape_string($_POST['name_of_beneficiary']) : '';
	$project_number = isset($_POST['project_number']) ? mysql_real_escape_string($_POST['project_number']) : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = "id_no = '$id_no' AND name_of_beneficiary LIKE '$name_of_beneficiary%' AND project_number = '$project_number'";
	$rs = mysql_query("SELECT COUNT(*) FROM beneficiaryregistration WHERE " . $where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("SELECT * FROM beneficiaryregistration WHERE " . $where . " LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>
<?php

$id = $_REQUEST['id'];

$name_of_beneficiary = $_REQUEST['name_of_beneficiary'];
$mothers_name = $_REQUEST['mothers_name'];
$sex = $_REQUEST['sex'];

include 'conn.php';

$sql = "UPDATE `beneficiaryregistration` SET  `name_of_beneficiary` =  '$name_of_beneficiary',
`mothers_name` =  '$mothers_name',
`sex` =  '$sex' WHERE  `beneficiaryregistration`.`id` =$id;";

@mysql_query($sql);
echo json_encode(array(
	'id' => $id,
'name_of_beneficiary' => $name_of_beneficiary,
'mothers_name' => $mothers_name,
'sex' => $sex
));


?>
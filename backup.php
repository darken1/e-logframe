<?php

$mysqli = mysqli_connect("23.229.204.67", "drc_crddusr", "P@ss7EVEN");
if (!$mysqli) {
		die('Could not connect: ' . mysqli_error());
			}
			else{
				;
				}
$db_select = mysqli_select_db("drc_crdb",$mysqli);

echo show_inserts($mysqli,'beneficiarysubcategories', $where=null);

//echo makeRecoverySQL('beneficiarysubcategories', 2);


function show_inserts($mysqli,$table, $where=null) {
    $sql="SELECT * FROM `{$table}`".(is_null($where) ? "" : " WHERE ".$where).";";
    $result=$mysqli->query($sql);

    $fields=array();
    foreach ($result->fetch_fields() as $key=>$value) {
        $fields[$key]="`{$value->name}`";
    }

    $values=array();
    while ($row=$result->fetch_row()) {
        $temp=array();
        foreach ($row as $key=>$value) {
            $temp[$key]=($value===null ? 'NULL' : "'".$mysqli->real_escape_string($value)."'");
        }
        $values[]="(".implode(",",$temp).")";
    }
    $num=$result->num_rows;
    return "INSERT `{$table}` (".implode(",",$fields).") VALUES \n".implode(",\n",$values).";";
}


 function makeRecoverySQL($table, $id)
  {
    // get the record          
    $selectSQL = "SELECT * FROM `" . $table . "` WHERE `id` = " . $id . ';';

    $result = mysql_query($selectSQL, $YourDbHandle);
    $row = mysql_fetch_assoc($result); 

    $insertSQL = "INSERT INTO `" . $table . "` SET ";
    foreach ($row as $field => $value) {
        $insertSQL .= " `" . $field . "` = '" . $value . "', ";
    }
    $insertSQL = trim($insertSQL, ", ");

    return $insertSQL;
 }
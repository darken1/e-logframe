<?php

$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('drcdbase', $conn);

/**
$conn = @mysql_connect('23.229.204.67','drc_crddusr','P@ss7EVEN');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('drc_crdb', $conn);
**/
?>
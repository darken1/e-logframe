<?php

$thedate = '2008-09-19';

echo convert_date($thedate);


function convert_date($date)
{
	$timestamp = strtotime($date);
	
	$day = date('d', $timestamp);
	$month = date('m', $timestamp);
	$year = date('Y', $timestamp);
	//var_dump($day);
	
	$converted_date = $month.'/'.$day.'/'.$year;
	
	return $converted_date;
}

?>
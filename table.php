<?php
$month = 03;

$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F'); 
		
		echo $monthName;
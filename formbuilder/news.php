<?php
header('Content-Type: application/json');
$aRequest = json_decode($_POST);

echo json_encode($aRequest);

?>
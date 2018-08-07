<?php
    $myfileName = "newForm.json";
    $myfile = fopen($myfileName, "r") or die("Unable to open file!");
    $contents = fread($myfile, filesize($myfileName));
    $strlength = strlen($contents) - 2;
    $contents = substr ($contents, 10);
    echo "<script>\$(function(){
      fb = new Formbuilder({
        selector: '.fb-main',
        bootstrapData:";
    echo $contents;
    echo ");});</script>"; 
    fclose($myfile);
  ?>
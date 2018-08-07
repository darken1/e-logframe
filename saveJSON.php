<?php
    $myfile = fopen("newForm.json", "w") or die("Unable to open file!");
    fwrite($myfile, $_POST["content"]);
    fclose($myfile);
    echo "xkcd";
?>
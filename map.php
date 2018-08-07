<?php
/**
$image = file_get_contents('http://maps.googleapis.com/maps/api/staticmap?center=15719%20OAKLEAF%20RUN%20DRIVE,LITHIA,FL,33547,US&zoom=8&size=150x100&markers=color%3ablue%7Clabel%3aS%7C11211&sensor=false'); 
**/
$image = file_get_contents('http://maps.google.com/maps/api/staticmap?center=Somalia&zoom=5&size=412x412&maptype=roadmap
&markers=color:blue|label:MAL|9.936009,43.184402&markers=color:green|label:SPR|10.006753,43.363254
&markers=color:red|color:red|label:OAD|10.685262,43.946063&sensor=false'); 

$fp  = fopen('ae2.png', 'w+'); 



fputs($fp, $image); 
fclose($fp); 
unset($image);
?>
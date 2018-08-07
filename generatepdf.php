<?php
// Set parameters
$apikey = 'b7e10bee-5570-43b4-b3c1-2035ee932398';
$value = 'http://drcdatabase.org/index.php/statisticalreports/pdf/1'; // can aso be a url, starting with http..
 
// Convert the HTML string to a PDF using those parameters.  Note if you have a very long HTML string use POST rather than get.  See example #5
$result = file_get_contents("http://api.html2pdfrocket.com/pdf?apikey=" . urlencode($apikey) . "&value=" . urlencode($value));
 
// Save to root folder in website
file_put_contents('mypdf-1.pdf', $result);

?>
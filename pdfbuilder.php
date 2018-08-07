<?php
/**
//include "wkhtml/wkhtmltopdf/";
$out = array();
shell_exec('C:/xampp/htdocs/drcdbase/wkhtml/wkhtmltopdf http://google.com form1.pdf');

echo "PDF Created Successfully";
//print_r($out);
**/
/**
// Include WKPDF class.
require_once('wkhtml/wkhtmltopdf-bindings-master/php/wkhtmltopdf.php');

// Create PDF object.
$pdf = new WKPDF();
// Set PDF's HTML
$pdf->set_html('http://www.google.com');
// Convert HTML to PDF
$pdf->render();
// Output PDF. The file name is suggested to the browser.
$pdf->output(WKPDF::$PDF_EMBEDDED, 'sample.pdf');
**/

//shell_exec("C:/xampp/htdocs/drcdbase/wkhtml/wkhtmltopdf.exe http://www.google.com google.pdf");


$myCmd = "C:/xampp/htdocs/drcdbase/wkhtml/wkhtmltopdf.exe http://www.google.com C:/xampp/htdocs/drcdbase/jonnny.pdf";	
$result = exec($myCmd,$output,$var);
var_dump($output);
var_dump($var);
?>

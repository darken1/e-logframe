<?php 
header("Content-type: text/xml");
$doc = new DOMDocument('1.0');
// we want a nice output
$doc->formatOutput = true;

$root = $doc->createElement('project');
$root = $doc->appendChild($root);

$task = $doc->createElement('task');
$task = $root->appendChild($task);

$pID = $doc->createElement('pID');
$pID = $task->appendChild($pID);

$text = $doc->createTextNode('10');
$text = $pID->appendChild($text);

$pName = $doc->createElement('pName');
$pName = $task->appendChild($pName);

$text = $doc->createTextNode('Preparaatory activities');
$text = $pName->appendChild($text);

$pStart = $doc->createElement('pStart');
$pStart = $task->appendChild($pStart);

$text = $doc->createTextNode('09/11/2008');
$text = $pStart->appendChild($text);

$pEnd = $doc->createElement('pEnd');
$pEnd = $task->appendChild($pEnd);

$text = $doc->createTextNode('09/22/2008');
$text = $pEnd->appendChild($text);

//echo "Saving all the document:\n";
echo $doc->saveXML();
?>
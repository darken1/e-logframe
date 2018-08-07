<?php
//header("Content-type: text/xml");
$xml = new xmlWriter();
$xml->openMemory();
$xml->startElement('project');
$xml->startElement('task');

$xml->startElement('pID');
$xml->text('10');
$xml->endElement();

$xml->startElement('pName');
$xml->text('Preparaatory activities');
$xml->endElement();

$xml->startElement('pStart');
$xml->text('09/11/2008');
$xml->endElement();

$xml->startElement('pEnd');
$xml->text('09/22/2008');
$xml->endElement();

$xml->startElement('pColor');
$xml->text('0000ff');
$xml->endElement();

$xml->startElement('pLink');
$xml->text('0');
$xml->endElement();

$xml->startElement('pMile');
$xml->text('0');
$xml->endElement();

$xml->startElement('pRes');
$xml->text('Joash');
$xml->endElement();

$xml->startElement('pComp');
$xml->text('30');
$xml->endElement();

$xml->startElement('pGroup');
$xml->text('0');
$xml->endElement();

$xml->startElement('pParent');
$xml->text('0');
$xml->endElement();

$xml->startElement('pOpen');
$xml->text('1');
$xml->endElement();

$xml->startElement('pDepend');
$xml->text('');
$xml->endElement();

$xml->startElement('pCaption');
$xml->text('Joash');
$xml->endElement();

$xml->endElement();
$xml->endElement();
//echo $xml->outputMemory(true);
file_put_contents('file.xml',$xml->outputMemory(true));
?>
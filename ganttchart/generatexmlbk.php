<?php

$employees = array(
    '0'=> array(
         'name' =>'abin',
          'age' => '23',
      ),
    '1' => array(
        'name' => 'savin',
        'age'  => '24',
    )
);
//$file = fopen('file.xml','w');
$xml = new SimpleXMLElement('<employees></employees>');
foreach($employees as $employ):
$xml->addChild('name',$employ['name']);
$xml->addChild('age',$employ['age']);
endforeach;
file_put_contents('file.xml',$xml->saveXML());


?>
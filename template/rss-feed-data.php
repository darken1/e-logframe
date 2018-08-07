<?php
$feed_url = 'http://blogoola.com/blog/feed/';
$content = file_get_contents($feed_url);
$x = new SimpleXmlElement($content);
$feedData = '';
$date = date("Y-m-d H:i:s");
 
//output
$feedData .=  "<ul>";
foreach($x->channel->item as $entry) {
    $feedData .= "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
}
$feedData .= "";
$feedData .= "<p>Data current as at: ".$date."</p>";
 
echo $feedData;
?>
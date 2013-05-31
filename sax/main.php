<?php
require_once("rssParser.php");

//Create a new object of custom parser
$customRSSParser = new RSSParser();

//Instantiate in built parser
$builtInParser = xml_parser_create();

//Use XML parser within the object
xml_set_object($builtInParser, $customRSSParser);

//Set start and end tags event handlers
xml_set_element_handler($builtInParser, "startElement", "endElement");

//Set character data event handler
xml_set_character_data_handler($builtInParser, "characterData");

//Fetch "The Age" feed
$fp = fopen("http://rss.feedsportal.com/c/34696/fe.ed/feeds.theage.com.au/rssheadlines/top.rss", "r") or die("Error reading RSS feed");

while($data = fread($fp, 4096)){
   //Parse the data
   xml_parse($builtInParser, $data, feof($fp));
}
fclose($fp);

xml_parser_free($builtInParser);

$headlines = $customRSSParser->getHeadlines();

foreach ($headlines as $headline){
   print_r($headline);
}
?>
<?php
$doc = new DOMDocument;
$doc->load('quotes.xml');
//Passed element from commandline
$passedString = $argv[1];

$passedElements = $doc->getElementsByTagName($passedString);

foreach($passedElements as $passedElement){
   $parent = $passedElement->parentNode;
   
   while($parent->nodeType != XML_DOCUMENT_NODE){
      echo $parent->tagName." ";
      $parent = $parent->parentNode;
   }   
}

?>
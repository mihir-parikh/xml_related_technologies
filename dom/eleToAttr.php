<?php
$domDocument = new DOMDocument();
$domDocument->load("elements.xml");

$nameElements = $domDocument->getElementsByTagName("name");

foreach($nameElements as $nameElement){
   $nameChildren = $nameElement->childNodes;
   
   //Set attributes
   foreach($nameChildren as $nameChild){
      if($nameChild->nodeType == XML_ELEMENT_NODE){
         $nameElement->setAttribute($nameChild->tagName, $nameChild->textContent);
      }
   }
   
   //Remove elements
   while($nameElement->hasChildNodes()){
      $nameElement->removeChild($nameElement->firstChild);
   }
}

$domDocument->save("attributes.xml");
?>
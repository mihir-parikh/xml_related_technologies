<?php
$sites = array();
$sites[] = array('name'=>'Google','url'=>'http://google.com');
$sites[] = array('name'=>'Yahoo','url'=>'http://yahoo.com');

//DOMDocument represents an entire xml document as an object
$document = new DOMDocument();
$document->formatOutput = true;
$root = $document->createElement("searchEngines");
$document->appendChild($root);

foreach( $sites as $site ){
	$siteNode = $document->createElement("site");
	//Append the site node to searchEngines node	
	
	$nameNode = $document->createElement("name");	
	$nameNode->appendChild($document->createTextNode($site["name"]));
	$siteNode->appendChild($nameNode);

	$urlNode = $document->createElement("url");		
	$urlNode->appendChild($document->createTextNode($site["url"]));
	$siteNode->appendChild($urlNode);
	
	$root->appendChild($siteNode);
}

//Dump the internal XML tree to a string
echo $document->saveXML();
//Dump the internal XML tree to a file
$document->save("./linksp.xml");

?>
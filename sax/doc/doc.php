<?php
$parser = xml_parser_create();

//Don't convert characters in uppercase
xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, FALSE);

xml_set_element_handler($parser, "startIt", "endIt");
xml_set_character_data_handler($parser, "cdata");

//xml_parse($parser, file_get_contents("doc.xml"), true);
$fileName = $argv[1];
if(!($fp = fopen($fileName, "r"))){
	die("Cannot open the XML file: ".$fileName);
}
echo $fileName."\n";

while($data = fread($fp, 4096)){
	//This is not the last chunk of data
	$parsedOk = xml_parse($parser, $data);
	
	if(!$parsedOk){
		echo "There was an error parsing the data.";
		break;
	}
}

xml_parser_free($parser);

function startIt($parser, $name, $attributes){
	global $level;
	$level++;	
	for($i=0; $i<$level; $i++){
		echo "  |";
	}
	echo "+-$name\n";
}

function cdata($parser, $data){}

function endIt($parser, $name){
	global $level;
	$level--;
}
?>
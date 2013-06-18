<?php
//An example ot PHP XML SAX processing

$parser = xml_parser_create();
xml_set_element_handler($parser, "startIt", "endIt");
xml_set_character_data_handler($parser, "cdata");
xml_parse($parser, file_get_contents("quotes.xml"), true);
xml_parser_free($parser);

function startIt($parser, $name, $attributes){
   echo "(".$name;
}

function cdata($parser, $data){
   echo "[".$data."]";
}

function endIt($parser, $name){
   echo ")";
}
?>
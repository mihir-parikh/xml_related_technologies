<?php
class RSSParser{
   private $isInsideItem = false;
   private $headline = ""; 
   private $itemCount = 0;
   private $headlines = array();
   private $tag = "";
   
   //Start tag event handler
   public function startElement($parser, $tagName){
      if($this->isInsideItem){
         $this->tag = $tagName;
      }
      else if($tagName == "ITEM" || $tagName == "item"){
         //If tag is item then set inside flag to true
         $this->isInsideItem = true;
      }
   }
   
   //Character data event handler
   public function characterData($parser, $data){
      //If we are inside item element
      if($this->isInsideItem){
         //When the current tag is title
         if($this->tag == "TITLE" || $this->tag == "title"){
            $this->headline = $data;
         }
      }
   }

   //End tag event handler
   public function endElement($parser, $tagName){
      if($tagName == "ITEM" || $tagName == "item"){
         //Cleanup the data
         $this->headline = strip_tags(trim($this->headline));
         
         //Assignin processed element to the array
         $this->headlines['headline'] = $this->headline;
         
         //Reset variables and tags
         $this->isInsideItem = false;         
         $this->headline = "";
      }
   }
   
   public function getHeadlines(){
      return $this->headlines;
   }
}
?>
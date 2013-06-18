<?php
class RSSParser{
   private $isInsideItem;
   private $headline; 
   private $itemCount;
   private $headlines;
   private $tag;
   
   public function __construct(){
      $this->isInsideItem = false;
      $this->headline = "";
      $this->itemCount = 0;
      $this->headlines = array();
      $this->tag = "";
   }
   
   //Start tag event handler
   public function startElement($parser, $tagName){
      if($this->isInsideItem){
         //Assign element name inside <item> to the variable
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
         
         //Assigning processed element to the array
         $this->headlines[$this->itemCount]['headline'] = $this->headline;
         
         $this->itemCount++;
         
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
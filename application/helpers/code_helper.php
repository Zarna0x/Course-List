<?php
defined('BASEPATH') or die;


function parr($data) {
  echo "<pre>",print_r($data,1),"</pre>";
}

function is_logged () {
  return  isset($_SESSION['user']) ? true: false;
}

function get_lang() {
   return  isset($_SESSION['site_lang']) ? $_SESSION['site_lang']: null;	
}

function is_space ($string) {
   $space = false;
   for ($i = 0; $i < strlen($string); $i++) {
        
        if (ctype_space($string[$i])) {
           $space = true;
           break;
        }
   }

   return $space;
}

function str_clean($string) {
     $offset = 17;
     $words = explode(" ",$string);
     foreach ($words as $key => $word) {
       if (strlen($word) >= $offset) {
          $words[$key] = chunk_split($word,$offset," ");
       }

     } 

     return implode(" ", $words);

}

?>
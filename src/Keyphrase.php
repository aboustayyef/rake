<?php namespace Aboustayyef;


/**
 *  Return Keywords from body of text
 *  Based on: https://github.com/aboustayyef/RAKE-PHP/blob/master/rake.php
 */

 class Keyphrase {
    public $keyphrase;
    public $id;

    public function __construct($id, $keyphrase){
      $this->id = $id;
      $this->keyphrase = $keyphrase;
    }

    public function words(){
      $words = preg_split('#\s+#', $this->keyphrase);
      return $words;
    }

    public function hasWord($word){
      return in_array($word, $this->words());
    }

 }
?>

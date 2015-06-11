<?php namespace Aboustayyef;

// This is a collection class of the Keyphrase class;

class WordsCollection extends \SplQueue{

public function toArray(){
  $words = [];
  foreach ($this as $key => $word) {
    $words[] = $word->word;
  }
  return $words;
}

}

?>

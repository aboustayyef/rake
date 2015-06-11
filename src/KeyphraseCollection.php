<?php namespace Aboustayyef;

// This is a collection class of the Keyphrase class;

class KeyphraseCollection extends \SplQueue{

  // returns all the unique words in the keyphrase collection
  public function uniqueWords(){
    $allWords = [];
    foreach($this as $keyphrase){
      foreach($keyphrase->words() as $word){
        array_push($allWords, $word);
      }
    }
    $uniqueWords = array_unique($allWords);
    $words = new WordsCollection();
    foreach ($uniqueWords as $id => $word) {
      $words->enqueue(New Word($id, $word));
    }
    return $words;
  }
}

?>

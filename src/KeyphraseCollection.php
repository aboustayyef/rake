<?php namespace Aboustayyef;

// This is a collection class of the Keyphrase class;

class KeyphraseCollection extends \SplQueue{

  private $words = [];
  private $scored = false;

  // returns all the unique words in the keyphrase collection
  private function ExtractUniqueWords(){
    $this->words = [];
    foreach($this as $keyphrase){
      foreach($keyphrase->words() as $word){
        array_push($this->words, $word);
      }
    }
    $this->words = array_unique($this->words);
  }

  public function getWords(){
    if (count($this->words == 0)) {
      $this->ExtractUniqueWords();
    };
    return $this->words;
  }

  public function orderBy($order){
    if (!in_array($order, ['degree', 'frequency', 'ratio'])) {
      return false;
    }
    $result = [];

    // calculate scores if not calculated
    if (!$this->scored) {
      $this->getScores();
    }

    foreach ($this as $keyphrase) {
      $result[$keyphrase->keyphrase ] = $keyphrase->score[$order];
    }
    array_multisort($result);
    $result = array_reverse($result);
    return $result;
  }

  public function getScores(){

    // If no words are extracted, do it
    $this->getWords();

    // Score Keyword Combinations
    
    $combination = array();
      foreach ($this->words as $key1 => $word1) {
        foreach ($this->words as $key2 => $word2) {
          $combination[$word1][$word2] = 0;
          foreach ($this as $keyphrase) {
            if ((@strpos($keyphrase->keyphrase, $word1) !== false) && (@strpos($keyphrase->keyphrase,$word2) !== false)) {
              $combination[$word1][$word2] += 1;
            }
          }
        }
    }

    // calculate degree and frequency
    foreach ($this->words as $key1 => $word1) {
      $frequency[$word1] = 1;
      $degree[$word1]=0;
      foreach ($this->words as $key2 => $word2) {
        $degree[$word1] += $combination[$word1][$word2];
        if ($frequency[$word1] < $combination[$word1][$word2]) {
          $frequency[$word1] = $combination[$word1][$word2];
        }
      }
      $ratio[$word1]= $degree[$word1] / $frequency[$word1];
      # code...
     } 

     // Assign scores to keyphrases containing the words
     
    foreach ($this as $keyphrase) {
      $words = explode(" ", $keyphrase->keyphrase);
      $keyphrase->score['degree'] = 0;
      $keyphrase->score['frequency'] = 0;
      $keyphrase->score['ratio'] = 0;
      foreach ($words as $word) {
        //make sure the word has a score
        if (isset($frequency[$word])) {
          $keyphrase->score['degree'] += $degree[$word] ;
          $keyphrase->score['frequency'] += $frequency[$word] ;
          $keyphrase->score['ratio'] += $ratio[$word] ;
        }
      }
     }

     // mark as scored;
     $this->scored = true;
  }

}

?>

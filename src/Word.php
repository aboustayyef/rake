<?php

namespace Aboustayyef;

class Word{
  public $id;
  public $word;
  public $frequency;
  public $degree;
  public $ratio;
  function __construct($id, $word){
    $this->id = $id;
    $this->word = $word;
  }

  function isInKeyphrase($keyphrase){ // Keyphrase Class
    return $keyphrase->hasWord($this->word);
  }

}

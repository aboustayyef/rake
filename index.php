<?php

require_once('vendor/autoload.php');

$document = new Aboustayyef\Document;

$keyphraseCollection = $document->keyphrases();
$wordsCollection = $keyphraseCollection->uniqueWords();

var_dump($wordsCollection);
var_dump($wordsCollection->toArray());

$words1 = $wordsCollection->toArray();
$words2 = $words1;

foreach ($words1 as $key1 => $word1) {
  foreach ($words2 as $key2 => $word2) {

    foreach ($keyphraseCollection as $key => $keyphrase) {
      $combination=0;
      echo $keyphrase->keyphrase;
      if ($keyphrase->hasWord($word1) && $keyphrase->hasWord($word2)) {
        echo "\n($keyphrase->keyphrase) has both words $word1 and $word2\n";
        $combination = $combination + 1;
      }
      echo ", $word1, $word2: $combination\n";
    }

  }
}

?>

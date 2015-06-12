<?php

require_once('vendor/autoload.php');

$document = new Aboustayyef\Document;

$keyphraseCollection = $document->keyphrases();

var_dump($keyphraseCollection->orderBy('ratio'));

?>

<?php

require_once('vendor/autoload.php');

$document = new Aboustayyef\Document("fromUrl", "http://stateofmind13.com/2015/06/11/lebanese-policeman-physically-assaults-a-woman-for-stopping-at-a-red-light-ends-up-innocent-anyway/");
echo $document->text . "\n";
$keyphraseCollection = $document->keyphrases();

var_dump($keyphraseCollection->orderBy('frequency'));

?>

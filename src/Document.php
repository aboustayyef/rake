<?php namespace Aboustayyef;
/**
 *  Extracts the content
 */
class Document
{
  public $text;
  function __construct($instantiationMethod = "fromText", $argument= "This is the text. class instantiates, with by default") {
    if ($instantiationMethod == "fromText") {
      $this->text = $argument;
      return true;
    }
    // To Do: Instantiation from URL
    return false;
  }

  public function keyphrases($stopwords = [ "a" , "to", "the", "for", "from", "is", "by" ]){

      // Returns a collection of Keyphrases;

      // split by punctuation delimiters into sentences
      $pattern =  '/[.!?,;:\t\-\"\(\)\']/';
      $sentences = preg_split( $pattern, $this->text );

      // split sentences by stopwords into phrases
      $stopwordsRegex = '/\b(' . trim(implode('|', $stopwords)) . ')\b/i';
      $keyphrases = [];
      foreach ($sentences as $key => $sentence) {
        $tmp = preg_replace( $stopwordsRegex, '|', $sentence );
  			$phrases = explode( '|', $tmp );
  			foreach( $phrases as $phrase ) {
  				$phrase = strtolower( trim( $phrase ) );
  				if ( $phrase != "" ) {
  					array_push( $keyphrases , $phrase );
  				}
  			}
      }

      // instantiate KeyphraseCollection
      $keyphraseCollection = new KeyphraseCollection;

      // enqueue all Keyphrase Classes;
      foreach ($keyphrases as $id => $keyphrase) {
        $keyphraseCollection->enqueue(new Keyphrase($id, $keyphrase));
      }
      return $keyphraseCollection;
  }
}

?>

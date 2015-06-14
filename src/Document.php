<?php namespace Aboustayyef;
/**
 *  Extracts the content
 *  (A wrapper around Readability)
 */
class Document
{
  public $text;

  function __construct($instantiationMethod = "fromText", $argument= "Lawyer Rania Ghaith was stuck at a red light on Monday in front of one of those convoys at the Qantari intersection that leads up to Hamra.When the light turned green, she let the convoy pass and would have been on her way hadn’t that policeman, who was NOT a traffic policeman and as such had no place to regulate traffic, pulled her over.  Of course, this shouldn’t come as a shock in a country of no law, misogyny, and in the presence of people who think they are always above the law and who have no problem in making sure you know it at every single second of every day.Let me take this a step further: how horrifying is it that this policeman not only assaulted that woman for not breaking the law, but has been declared innocent and is back on the streets, ready to attack other women, and other people on a whim?You should not accept for Rania Ghaith to become yet another victim of abuse by those who are above the law, and who have the political backing to spit in her face during her trial: “If I were in my friend’s place, I would’ve torn you to pieces.” This is not a country, this is a jungle.") {
    if ($instantiationMethod == "fromText") {
      $this->text = $argument;
      $this->text = html_entity_decode($this->text);
      return true;
    } else if ($instantiationMethod == "fromUrl"){
      $doc = new Extractor($argument);
      $this->text = $doc->getTitle() . $doc->getText();
      $this->text = html_entity_decode($this->text);
      return true;
    }
    // To Do: Instantiation from URL
    return false;
  }

  public function keyphrases($stopwords = null){
      // Returns a collection of Keyphrases;

      if (!$stopwords) {
        $stopwords = (new Stoplist)->get();
      }
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

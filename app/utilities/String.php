<?php namespace LebaneseTweets\Utilities;

class String 
{
	
	public static function isMostlyArabic($string){
	  
	  $length = strlen($string) + 0.001; //to avoid division by zero errors
	  $latinCharacters = preg_match_all("/([ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz])/", $string);
	  $ratioOfLatinCharacters = $latinCharacters / $length;
	  
	  if ($ratioOfLatinCharacters < 0.5){
        return true;
      } 
      return false;
	}
}

?>
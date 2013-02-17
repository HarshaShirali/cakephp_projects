<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of string_utils
 *
 * @author jacobom
 */
class StringUtils {

    protected $validCharacters = "abcdefghjkmpqrstuxyvwz123456789ABCDEFGHJKLMNPQRSTUXYVWZ";

    public function getValidCharacters(){
        return $this->validCharacters;
    }

    public static function getRandomString($length = 40){
        $validCharacters = "abcdefghjkmpqrstuxyvwz123456789ABCDEFGHJKLMNPQRSTUXYVWZ"; //$characters = $this->getValidCharacters();

        $validCharNumber = strlen($validCharacters);

        $result = "";

        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }

        return $result;
    }

    public static function makeSlug($text) {
      $sluggedText= strtolower($text);
      $sluggedText = str_replace(' ', '-', $sluggedText);

      return $sluggedText;
    }
}
?>

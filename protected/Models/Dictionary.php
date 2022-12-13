<?php
namespace App\Models;

use App\Model;
use App\Db;

class Dictionary 
    extends Model
{
    protected static $table = 'dictionary';
    public $id;
    public $wordId; 
    public $articleId;
    public $countOccurrences;
    
    /**
     * fillDictionary
     *
     * @param array $processedWords
     * @param Article $article
     */
    public static function fillDictionary(array $processedWords, Article $article )
    {
        $newDictionaries = [];
        if(!empty($processedWords)){ 
            $db = new Db();
            foreach ($processedWords as $word) {
                $dictionary = new Dictionary;

                $sql = 'SELECT words.id FROM words WHERE words.word LIKE \'' . $word . '\'';

                $wordObj = $db->query($sql, 'App\Models\Word');

                $dictionary->wordId = $wordObj[0]->id;
                $dictionary->articleId = $article->id;
                $flagPlus = false;

                if ( mb_substr($word, 0, 1) == '+' ) {
                    $word = '\\' . $word;
                    $flagPlus = true;
                }
                if (preg_match('~[0-9]+~m', $word)) {
                    $dictionary->countOccurrences = preg_match_all('~' . $word . '\s~m', $article->content);
                    
                } else {
                    if ( !$flagPlus ) {
                        $substrWord = mb_substr($word, 1);
                    } 
                        

                    $dictionary->countOccurrences = preg_match_all('~[A-z-А-я]' . $substrWord . '\s~m', $article->content);
                }
                
                $newDictionaries[] = $dictionary;
            }
        }
        if ( !empty ($newDictionaries) ){
            static::insertAll($newDictionaries);
        }   
    }
}

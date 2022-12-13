<?php
namespace App\Models;

use App\Model;
use App\Db;

class Coincidence
    extends Model
{   
    public $articleId;
    public $title;
    public $content;
    public $countOccurrences;
        
    /**
     * @param string $keyword
     * @return array $coincidences
     */
    public static function findCoincidenceByKeyword(string $keyword) : array
    {
        $sql = "SELECT articles.title, articles.id AS articleId, articles.content, dictionary.countOccurrences FROM words JOIN dictionary ON words.id = dictionary.wordId JOIN articles ON dictionary.articleId = articles.id WHERE words.word LIKE '" . $keyword . "' ORDER BY dictionary.countOccurrences DESC";

        $db = new Db();  
        
        $coincidences = $db->query($sql, 'App\Models\Coincidence');
        
        foreach ($coincidences as $coincidence) {
            if ( preg_match( '~[0-9]+~', $keyword ) ) {
                $processedContent = preg_replace( "~(" . $keyword . ")\s~mu", "<mark>$1</mark> ", $coincidence->content ); //Mark keyword
            } else {
                
                if ( mb_substr($keyword, 0, 1) == '+' ) {
                    $processedKeyword = '\\' . $keyword;
                } else {
                    $processedKeyword = mb_substr($keyword, 1);
                }
                $processedContent = preg_replace( "~([A-z-А-я]" . $processedKeyword . ")\s~mu", "<mark>$1</mark> ", $coincidence->content ); //Mark keyword
                
            }

            $processedContent = preg_replace( "~\s(\.|\,)~mu", "$1", $processedContent ); //Remove extra space
            $coincidence->content = $processedContent;
        }

        return $coincidences;
    }
}
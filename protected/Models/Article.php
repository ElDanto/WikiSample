<?php
namespace App\Models;

use App\Model;
use App\Db;
use App\ApiWiki;

class Article 
    extends Model
{
    protected static $table = 'articles';
    public $id;
    public $title;
    public $content;
    public $link;
    public $size;
    public $wordcount;
    
    /**
     * @param  string $keyword
     * @return array Article
     */
    public static function getAll(string $keyword) : array
    {
        $params = [
            "action" => "query",
            "format" => "json",
            "list" => "search",
            "srsearch" => $keyword,
            "srlimit" => "1",
        ];

        $api = new ApiWiki();
        $data = $api->query($params);

        if( is_array($data) ){
            if(array_key_exists('search', $data['query'])) {
                $data = $data['query']['search'];
                
                $collection = [];

                foreach ($data as $values) {

                    $article = new Article;

                    foreach ($values as $key => $value) {
                        if(!array_key_exists($key, get_object_vars($article))){
                            continue;
                        }
                        $article->$key = $value;
                        
                    }

                    $article->id = $values['pageid'];
                    $article->link = 'https://ru.wikipedia.org/wiki/' . preg_replace('~/s~mu',"_", $values['title']) ;
                    $article->content = $article->getContentById($article->id);
                    $article->size = round(($values['size'] / 1024 ), 2 ) . 'Kb';

                    $collection[] = $article; 
                }

                return $collection;
            }
        }
    }
    
    /**
     * @param string $id
     * @return string $content
     */

    public function getContentById(string $id)
    {
        $params = [
            "action" => "query",
            "format" => "json",
            "prop" => "extracts",
            "pageids" => $id,
            "formatversion" => "2",
            "explaintext" => 1
        ];

        $api = new ApiWiki();

        $data = $api->query($params);

        if(array_key_exists('pages', $data['query'])) {
            $data = $data['query']['pages'];
            return $this->processingContent($data[0]['extract']);
        }

    }

    /**
     * @param string $content
     * @return string $processedContent
     */
    public function processingContent(string $content)
    {;
        $processedContent = preg_replace('~\s(=){1,5}\s~m', " ", $content); //Remove header's decoration
        $processedContent = preg_replace('~\n~m', " ", $processedContent); //Remove lines brake
        $processedContent = preg_replace('~(\(|\)|\"|\«|\»|\.|\,)~m', " $1 ", $processedContent); //Add important space
        $processedContent = preg_replace('~\s(\s)+\s~m', " ", $processedContent); //Remove extra space
        $processedContent = preg_replace('~([0-9])(?= [0-9]) ~m', "$1", $processedContent); //Remove space between numbers

        return $processedContent;
    }
  
}
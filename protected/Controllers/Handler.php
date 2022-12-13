<?php
namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Article;
use App\Models\Word;
use App\Models\Dictionary;
use App\Models\Coincidence;

class Handler
    extends Controller
{
    protected $data;


    public function __construct($response)
    {
        $this->view = new View;

        $this->actionName = $response['action'];
        $this->data = $response['data'];

        $this->action($this->actionName);        
    }
    
    public function actionImport()
    {

        $findedArticle = Article::getAll($this->data);
        $findedArticle = $findedArticle[0];

        if ( Article::findByID($findedArticle->id) ) {
            die('Эта статья уже скопирована');
        }

        $findedArticle->insert();

        $processedWords = Word::processingData($findedArticle->content);

        Word::addNewWord($processedWords);
        Dictionary::fillDictionary($processedWords, $findedArticle);
        
        if ( !empty($findedArticle) ) {
            $this->view->assign('findededArctile', $findedArticle);
            $this->view->assign('savedArticles', Article::findAll());
            $this->view->display(__DIR__ . '/../../templates/findedArticles.php');
        }

        die;
    }
    
    public function actionSearch()
    {
        if ( !empty($this->data) ) {
            $coincidences = Coincidence::findCoincidenceByKeyword($this->data);

            $this->view->assign('coincidences', $coincidences);

            echo $this->view->render(__DIR__ . '/../../templates/findedCoincidence.php');
        } else {
            die ('Ошибка передачи ключевого слова');
        }
        
        die;
    }
}
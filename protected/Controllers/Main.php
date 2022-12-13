<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Article;

class Main 
    extends Controller
{    
    public function actionDefault()
    {
        $articles = Article::findAll();

        $this->view->assign('savedArticles', $articles);
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }
}
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Style -->
    <link rel="stylesheet" href="/../css/style.css">
  
    <title>I'm alive, Daddy</title>
  </head>
  <body>

    <div class="container">
        <div class="wrapper">
            <ul class="nav nav-tabs"  role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="import-tab" data-toggle="tab" data-target="#import" type="button" role="tab" aria-controls="import" aria-selected="true">Импорт статей</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="search-tab" data-toggle="tab" data-target="#search" type="button" role="tab" aria-controls="search" aria-selected="false">Поиск</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="import" role="tabpanel" aria-labelledby="import-tab">
                    <div class="search-panel">
                      <input class="search-panel_input" id="search-phrase" type="text" placeholder="Поисковая фраза">
                      <button class="search-panel_button rounded-pill" id="search-article_btn" >Скопировать</button>
                      <span class="search-panel_errors" id="search-article_errors"></span>
                    </div>
                    <div class="articles">
                      <?php if( !empty($data ['savedArticles']) ) : ?>
                          <?php $this->display(__DIR__ . '/savedArticles.php'); ?>
                      <?php endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
                    <div class="search-panel">
                      <input class="search-panel_input" id="keyword" type="text" placeholder="ключевое слово">
                      <button class="search-panel_button rounded-pill" id="search-keyword_btn">Найти</button>
                      <span class="search-panel_errors" id="search-keyword_errors"></span>
                    </div>
                    <div class="сoincidences">
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- Ajax.js -->
    <script src="/js/ajax.js"></script>
  </body>
</html>
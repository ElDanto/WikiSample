<?php
$article = $data['findededArctile'];

?>
<div class="finded-article">
    <div class="row">
        <div class="col-8">
            <div class="finded-article__info">
                <span class="wiki-artiles__title">Импорт завершен</span>
                <?php if ( !empty($article->link) ) : ?>
                    <span>
                        Найдена статья по адрессу: 
                        <a href="<?php echo $article->link?>" target="_blank" rel="noopener noreferrer">
                            https://ru.wikipedia.org/wiki/<?php echo $article->title; ?>
                        </a>
                    </span>
                <?php endif; ?>
                <?php if ( !empty($article->size) ) : ?>
                    <span>Размер статьи: <?php echo $article->size; ?></span>  
                <?php endif; ?>
                <?php if ( !empty($article->wordcount) ) : ?>
                    <span>Размер статьи: <?php echo $article->wordcount; ?></span>    
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->display(__DIR__ . '/savedArticles.php'); ?>

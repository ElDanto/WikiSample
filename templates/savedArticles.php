<?php 
    $articles = $data ['savedArticles']; 
?>
<div class="saved-artciles">
    <h2 class="wiki-artiles__title">Сохраненные записи</h2>
    <table class="wiki-artiles__table table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Название статьи</th>
                <th scope="col">Ссылка на статью</th>
                <th scope="col">Размер статьи</th>
                <th scope="col">Кол-во слов</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <?php
                $title = !empty($article->title) ? $article->title : '—';
                $size = !empty($article->size) ? $article->size : '—';
                $wordcount = !empty($article->wordcount) ? $article->wordcount : '—';
                ?>
                <tr>
                    <td>
                        <?php echo $title; ?>
                    </td>
                    <td>
                        <?php if ( !empty($article->link)  ) : ?>
                            <a href="<?php echo $article->link; ?>">
                                https://ru.wikipedia.org/wiki/<?php echo $article->title; ?>
                            </a>
                        <?php else : ?>
                            <?php echo '—'; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $size; ?>
                    </td>
                    <td>
                        <?php echo $wordcount; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>   
    </table>
</div>
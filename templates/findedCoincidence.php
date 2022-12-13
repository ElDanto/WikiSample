<?php 
$data = $data['coincidences'];
$totalCoincidences = 0;
foreach ($data as $item) {
    $totalCoincidences += $item->countOccurrences;
}
?>
<div class="row"> 
    <div class="col-6">
        <div class="coincidences-tabs">
            <span class="coincidences-tabs_title">Найдено: <?php echo $totalCoincidences; ?> совпадений</span>
            <?php foreach ($data as $item) : ?>
                <?php 
                    $title = !empty($item->title) ? $item->title : '';
                    $id = !empty($item->articleId) ? $item->articleId : '';
                    $countOccurrences = !empty($item->countOccurrences) ? $item->countOccurrences : '';
                ?> 
            
                <div class="coincidences-tabs_item">
                    <span>    
                        <a href="#" class="coincidences-tab" id="<?php echo $id; ?>">
                            <?php echo $title; ?>
                        </a>
                        (<?php echo $countOccurrences; ?> вхождений)
                    </span>
                </div>
                
            <?php endforeach; ?> 
        </div>   
    </div>
    <div class="col-6">
        <div class="coincidences-content">
            <?php foreach ($data as $item) : ?>
                <?php 
                $id = !empty($item->articleId) ? $item->articleId : '';
                $content = !empty($item->content) ? $item->content : 'Пусто';
                ?>
                <div class="coincidences-content_item" id="tab-<?php echo $id; ?>"><?php echo $content; ?></div>
            <?php endforeach; ?>
        </div>  
    </div>
</div>
<script src="/js/tabs.js"></script>

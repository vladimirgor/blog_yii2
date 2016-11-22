<?php if ( !empty($posts) ): // are there articles ?>
    <?php
        //articles quantity determining for the last page for the slider adjustment
        $items = ($pages->page+1 == $pages->pageCount) ?
        $pages->totalCount - ($pages->page)*PER_PAGE :
        PER_PAGE ;
    ?>
   <!-- ////////////-->
    <div class="row empty">
        <div class="col-md-4 empty"></div>
        <div class="col-md-4 empty">
            <div id="carousel" class="carousel slide div_car" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"><p class = "slide_number"></p></li>
                    <?php for ($i = 1; $i < $items; $i++ ) { ?>
                        <li data-target="#carousel" data-slide-to="<?=$i?>"><p class = "slide_number"></p></li>
                    <?}?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img class="image_crs" src="<?=$posts[0]['image_path']?>"  alt="Image">
                        <div class="carousel-caption empty">
                            <p class = "title_crs"><?=$posts[0]['title']?></p>
                        </div>
                    </div>

                    <?php for ($i = 1; $i < $items; $i++ ) { ?>
                        <div class="item">
                            <img class="image_crs" src="<?=$posts[$i]['image_path']?>"  alt="Image">
                            <div class="carousel-caption empty">
                                <p class = "title_crs"><?=$posts[$i]['title']?></p>
                            </div>
                        </div>
                    <?}?>

                </div>
            </div>
        </div>
        <div class="col-md-4 empty"></div>
    </div>
    <!-- ////////////-->
    <?php foreach ( $posts as $post ):?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><a href ="
                <?= yii\helpers\Url::to(['post/view','id'=>$post['id'],
                        'page' => $pages->page+1 ])?>
                "><?=$post['title']?></a></h3>
            </div>
            <div class="panel-body">
                <?= articles_intro($post['content'], 100)?>
            </div>
            <div class="panel-footer">Views:
                <?=$post['view']?>, Comments:<?=$post['comment']?>
            </div>
        </div>
    <?php endforeach;?>
    <?= \yii\widgets\LinkPager::widget(['pagination'=> $pages]) ?>
<?php endif;?>
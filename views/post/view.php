<?php
    use app\components\MyWidget;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $post['title'] ?></h3>
    </div>
    <? if ( !$post->image_path  == NULL ) :?>
        <p>
            <img class = "art_img" src="<?=$post->image_path?>">
        </p>
    <? endif ?>
    <div class="panel-body content">
        <?php //debug($post); ?>
        <?= $post->content ?> <!--//same with $post['content']-->
        <p class="clear"><p>
        COMMENTS:
        <?php //echo MyWidget::widget(['name' => 'Vasya']);?>
        <?php// MyWidget::begin()?>
           <!--<h1>привет, мир!</h1>-->
        <?php //MyWidget::end()?>
        <?php //debug(Yii::$app->user); ?>
        <?php //debug(Yii::$app->user->identity); ?>
        <ul>
            <?php
            foreach ( $post->comments as $comment )
            {
            ?>
            <li class="comment">
                <?=$comment['user_id']?> .  <?=$comment['date']?>
                <br>
                <blockquote>
                    <b><i><?=$comment['comment']?></i></b>
                </blockquote>

                <?php } ?>
            </li>
        </ul>
    </div>
</div>
<button type="button" class="btn btn-primary">
    <a class ="a_back" href ="<?= yii\helpers\Url::to(['post/comment',
        'id' => $post->id ,'page' => $page])?>">Leave your comment</a>
</button>
<?php if (Yii::$app->session->hasFlash('SignLogin')) :?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong><?php echo Yii::$app->session->getFlash('SignLogin');?>
    </div>
<?php endif?>
<br>
<button type="button" class="btn btn-info">
    <a class ="a_back" href ="<?= yii\helpers\Url::to(['post/index',
        'page' => $page ])?>">Back</a>
</button>


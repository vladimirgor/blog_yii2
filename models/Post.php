<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 19.09.2016
 * Time: 16:53
 */

namespace app\models;
use yii\db\ActiveRecord;


class Post extends ActiveRecord{

    public static function tableName(){
        return 'article';
    }

    public function getComments(){

        return $this->hasMany(Comment::className(),['article_id' => 'id']);

    }

}
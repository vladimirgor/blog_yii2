<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 10.10.2016
 * Time: 09:35
 */

namespace app\models;


use yii\db\ActiveRecord;

class Comment extends ActiveRecord{

    public static function tableName(){
        return 'comment';
    }

}
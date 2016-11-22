<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 12.10.2016
 * Time: 21:16
 */

namespace app\models;
use yii\base\Model;
class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            ['comment', 'required'],
            ['comment', 'trim'],
        ];
    }
}


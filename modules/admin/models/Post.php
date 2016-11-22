<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $comment
 * @property integer $view
 * @property string $image_path
 * @property string $date
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title', 'content'], 'string'],
            [['comment', 'view'], 'integer'],
            [['date'], 'safe'],
            [['image_path'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'title' => 'Title',
            'content' => 'Content',
            'comment' => 'Comment',
            'view' => 'View',
            'image_path' => 'Image Path',
            'date' => 'Date',
        ];
    }
}

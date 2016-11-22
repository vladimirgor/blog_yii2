<?php

namespace app\modules\admin;
use yii\filters\AccessControl;
use yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule,$action){
                            return  Yii::$app->user->identity->login === ADMIN ;
                        }
                    ],
                ],
            ],
        ];
    }
}

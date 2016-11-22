<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 10.10.2016
 * Time: 18:00
 */

namespace app\components;
use yii\base\Widget;

class MyWidget extends Widget {

    public $name;

    public function init(){
        parent::init();
    //    if ( $this->name === null ) $this->name = 'Guest';
        ob_start();
    }

    public function run(){
        $content = ob_get_clean();
        $content = mb_strtoupper($content,'utf-8');

        return $this->render('my', compact('content'));
        //return "<h1>{$this->name}, hello, world!</h1>";
        //return $this->render('my',['name'=>$this->name]);
    }

}
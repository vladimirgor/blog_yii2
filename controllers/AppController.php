<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 19.09.2016
 * Time: 14:59
 */

namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller{

    public  function debug($arr){
        echo '<pre>'. print_r($arr, true).'</pre>';
    }

}
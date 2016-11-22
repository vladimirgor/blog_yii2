<?php

namespace app\models;

use Yii;
use yii\base\Model;
class SigningForm extends Model
{
    public $firstname;
    public $lastname;
    public $login;
    public $password;
    public $password_repeat;
    public $verifyCode;

    public function rules()
    {
        return [
            [['firstname','lastname','login', 'password','password_repeat'], 'required'],
            [['firstname','lastname','login'],'string','length'=> [2,256]],
            ['password','string','length'=> [2,32]],
            ['password','compare'],
            //['password','compare','message' => 'Password and Password Repeat are to be same.'],
            ['login','unique','targetClass' => User::className()],
            //['login','unique','targetClass' => 'app\models\Users'], // same with previous
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'
                , 'captchaAction' => 'post/captcha'
            ],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'password_repeat' => 'Repeat Password'
        ];
    }
}

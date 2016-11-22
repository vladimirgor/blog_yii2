<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

    $this->title = 'Signing';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<h1><?= Html::encode($this->title) ?></h1>

<p>Please fill out the following fields to sign:</p>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'login') ?>
    <?if ( $message_login ) echo 'Entered login already exists. Use another login, please.';?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'post/captcha',
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
    </div>
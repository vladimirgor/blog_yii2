<?php

use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button type="submit" class="btn btn-warning">Submit</button>

<?php ActiveForm::end() ?>
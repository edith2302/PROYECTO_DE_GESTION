<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Desarrollarproyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="desarrollarproyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_proyecto')->textInput() ?>

    <?= $form->field($model, 'id_estudiante')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
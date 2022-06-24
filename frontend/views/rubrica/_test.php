<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['placeholder' => "Nombre del rol"],['maxlength' => true]) ?>

    <?= $form->field($model, 'descripción')->textarea(['placeholder' => "Descripción del rol"],['maxlength' => true]) ?>

    <div class="form-group">

    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

</p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

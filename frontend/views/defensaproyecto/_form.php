<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Defensaproyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="defensaproyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'id_proyecto')->textInput() ?>

    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

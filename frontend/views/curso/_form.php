<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'año')->textInput() ?>

    <?= $form->field($model, 'semestre')->textInput() ?>

    <?= $form->field($model, 'id_administrador')->textInput() ?>

    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

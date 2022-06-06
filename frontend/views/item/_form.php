<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'puntaje')->textInput() ?>

    <?= $form->field($model, 'id_rubrica')->textInput() ?>

    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

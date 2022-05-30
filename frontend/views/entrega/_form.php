<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrega-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'evidencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_entrega')->textInput() ?>

    <?= $form->field($model, 'hora_entrega')->textInput() ?>

    <?= $form->field($model, 'comentarios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_proyecto')->textInput() ?>

    <?= $form->field($model, 'id_hito')->textInput() ?>

    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar entrega', ['class' => 'btn btn-success']) ?>
    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

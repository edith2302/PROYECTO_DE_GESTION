<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_integrantes')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'disponibilidad')->textInput() ?>

    <?= $form->field($model, 'id_profe_guia')->textInput() ?>

    <?= $form->field($model, 'id_autor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

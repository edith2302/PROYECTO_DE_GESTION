<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dv')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_alternativo')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_alternativo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'plan')->textInput() ?>


    <?php // $form->field($model, 'habilitado_adt')->textInput() ?>

    <?php //  $form->field($model, 'habilitado_practica')->textInput() ?>

    <?php // $form->field($model, 'habilitado_ici')->textInput() ?>

    <div class="form-group">

    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </p>

    </div>

    <?php ActiveForm::end(); ?>

</div>

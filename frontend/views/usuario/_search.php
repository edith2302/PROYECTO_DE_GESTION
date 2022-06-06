<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'rut') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'telefono_alternativo') ?>

    <?= $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'dv') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'apellido') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'email_alternativo') ?>

    <?php // echo $form->field($model, 'plan') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'habilitado_adt') ?>

    <?php // echo $form->field($model, 'habilitado_practica') ?>

    <?php // echo $form->field($model, 'habilitado_ici') ?>

    <div class="form-group">

    <p align="right">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-outline-secondary']) ?>

</p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

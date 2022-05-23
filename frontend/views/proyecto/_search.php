<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'num_integrantes') ?>

    <?= $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'disponibilidad') ?>

    <?php // echo $form->field($model, 'id_profe_guia') ?>

    <?php // echo $form->field($model, 'id_autor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

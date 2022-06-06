<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RubricaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubrica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripción') ?>

    <?= $form->field($model, 'escala') ?>

    <?= $form->field($model, 'id_profe_asignatura') ?>

    <div class="form-group">

    <p align="right">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-outline-secondary']) ?>

</p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

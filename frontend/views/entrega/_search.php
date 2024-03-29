<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrega-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'evidencia') ?>

    <?= $form->field($model, 'fecha_entrega') ?>

    <?= $form->field($model, 'hora_entrega') ?>

    <?= $form->field($model, 'comentarios') ?>

    <?php // echo $form->field($model, 'id_proyecto') ?>

    <?php // echo $form->field($model, 'id_hito') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

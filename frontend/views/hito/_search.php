<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HitoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hito-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fecha_habilitacion') ?>

    <?= $form->field($model, 'hora_habilitacion') ?>

    <?php // echo $form->field($model, 'fecha_limite') ?>

    <?php // echo $form->field($model, 'hora_limite') ?>

    <?php // echo $form->field($model, 'tipo_hito') ?>

    <?php // echo $form->field($model, 'porcentaje_nota') ?>

    <?php // echo $form->field($model, 'id_rubrica') ?>

    <?php // echo $form->field($model, 'id_profe_asignatura') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

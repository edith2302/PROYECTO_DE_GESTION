<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubrica-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nombre')->textInput() ?>
    <?= $form->field($model, 'descripción')->textInput() ?>

    <?= $form->field($model, 'escala')->textInput() ?>

    <?= $form->field($model, 'id_profe_asignatura')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

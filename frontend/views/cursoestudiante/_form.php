<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cursoestudiante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cursoestudiante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_curso')->textInput() ?>

    <?= $form->field($model, 'id_estudiante')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

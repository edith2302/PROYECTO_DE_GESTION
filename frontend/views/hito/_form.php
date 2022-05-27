<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_habilitacion')->textInput() ?>

    <?= $form->field($model, 'hora_habilitacion')->textInput() ?>

    <?= $form->field($model, 'fecha_limite')->textInput() ?>

    <?= $form->field($model, 'hora_limite')->textInput() ?>

    <?= $form->field($model, 'tipo_hito')->textInput() ?>

    <?= $form->field($model, 'porcentaje_nota')->textInput() ?>

    <?= $form->field($model, 'id_rubrica')->textInput() ?>

    <?= $form->field($model, 'id_profe_asignatura')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

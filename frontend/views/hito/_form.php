<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['placeholder' => "Nombre del hito"],['maxlength' => true] )?>

    <?= $form->field($model, 'descripcion')->textInput(['placeholder' => "Descripción del hito"],['maxlength' => true]) ?>

    <div class="col-md">
        <?= $form->field($model, 'fecha_habilitacion')->textInput(['type' => 'date']) ?>
    </div>
    <div class="col-md">
        <?= $form->field($model, 'hora_habilitacion')->textInput(['type' => 'time']) ?>
    </div>

    <div class="col-md">
        <?= $form->field($model, 'fecha_limite')->textInput(['type' => 'date']) ?>
    </div>

    <div class="col-md">
        <?= $form->field($model, 'hora_limite')->textInput(['type' => 'time']) ?>
    </div>

    <div class="col-md">
            <?php
            echo $form->field($model, 'tipo_hito')->dropDownList(
                [
                    '0' => 'Informe',
                    '1' => 'Presentación',
                    '2' => 'Defesa de proyecto',
                    '3' => 'Informe final',
                ],
                ['prompt' => 'Selección tipo de hito']
            );
            ?>
    </div>

    <?= $form->field($model, 'porcentaje_nota')->textInput(['placeholder' => "100%"]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Agregar rubrica', ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

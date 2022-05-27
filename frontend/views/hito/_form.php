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

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_habilitacion')->widget(
            DatePicker::className(), [
                'inline' => false,
                'language'=>'es',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
        ]);?>

    <div class="col-md">
        <?= $form->field($model, 'hora_habilitacion')->textInput(['type' => 'time']) ?>
    </div>

    <?= $form->field($model, 'fecha_limite')->widget(
            DatePicker::className(), [
                'inline' => false,
                'language'=>'es',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
        ]);?>

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

    <?= $form->field($model, 'porcentaje_nota')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton('Agregar rubrica', ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

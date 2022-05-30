<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Rubrica;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['placeholder' => "Nombre del hito"],['maxlength' => true] )?>

    <?= $form->field($model, 'descripcion')->textInput(['placeholder' => "Descripción del hito"],['maxlength' => true]) ?>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
            <?= $form->field($model, 'fecha_habilitacion')->textInput(['type' => 'date']) ?>
            </div>
            <div class="col-lg-4">
            <?= $form->field($model, 'hora_habilitacion')->textInput(['type' => 'time']) ?>
            </div>
        </div>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
            <?= $form->field($model, 'fecha_limite')->textInput(['type' => 'date']) ?>
            </div>
            <div class="col-lg-4">
            <?= $form->field($model, 'hora_limite')->textInput(['type' => 'time']) ?>
            </div>
        </div>
    </div>

    <div class="body-content">
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

    <div class="body-content">
        <div class="row">

            <div class="col-lg-4">
                <?= $form->field($model, 'id_rubrica')->dropDownList(\yii\helpers\ArrayHelper::map(Rubrica::find()->all(),'id', 'nombre'),['prompt' => 'Seleccionar rubrica']);?>
            </div>   

            <div class="col-lg-4">
                <?= Html::a('Agregar Rubrica', ['rubrica/create'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    
    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

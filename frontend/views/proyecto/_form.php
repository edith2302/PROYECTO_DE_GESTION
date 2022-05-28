<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['placeholder' => "Nombre del proyecto"],['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['placeholder' => "Descripción del proyecto"],['maxlength' => true]) ?>

    
    <div class="col-md">
            <?php
            echo $form->field($model, 'num_integrantes')->dropDownList(
                [
                    '1' => '1',
                    '2' => '2',
                ],
                ['prompt' => 'Cantidad integrantes']
            );
            ?>
    </div>

    <div class="col-md">
            <?php
            echo $form->field($model, 'tipo')->dropDownList(
                [
                    '1' => 'Desarrollo',
                    '2' => 'Investigación',
                ],
                ['prompt' => 'Selección de tipo']
            );
            ?>
    </div>

    <div class="col-md">
            <?php
            echo $form->field($model, 'area')->dropDownList(
                [
                    '1' => 'Inteligencia Artificial',
                    '2' => 'Sistemas de información',
                ],
                ['prompt' => 'Selección de área']
            );
            ?>
    </div>

    <div class="col-md">
            <?php
            echo $form->field($model, 'estado')->dropDownList(
                [
                    '1' => 'Aprobado',
                    '2' => 'Rechazado',
                ],
                ['prompt' => 'Cambiar estado']
            );
            ?>
    </div>

    <?= $form->field($model, 'disponibilidad')->textInput() ?>

    <?= $form->field($model, 'id_profe_guia')->textInput() ?>

    <?= $form->field($model, 'id_autor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

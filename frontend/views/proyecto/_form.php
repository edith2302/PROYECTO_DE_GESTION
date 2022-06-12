<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;
use app\models\Profesorguia;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['placeholder' => "Nombre del proyecto"],['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['placeholder' => "Descripción del proyecto"],['maxlength' => true]) ?>


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
                    '3' => 'Estructura de datos',

                ],
                ['prompt' => 'Selección de área']
            );
            ?>
    </div>

    <div class="col-md">
            <?php
            echo $form->field($model, 'disponibilidad')->dropDownList(
                [
                    '1' => 'Disponible',
                    '2' => 'Ocupado',
                    

                ],
                ['prompt' => 'Selección disponibilidad']
            );
            ?>
    </div>

    <!--?= $form->field($model, 'disponibilidad')->textInput() ?>-->


    <!--?= $form->field($model, 'id_autor')->textInput() ?>-->

    <!--div class="col-md">
            <?= $form->field($model, 'id_profe_guia')->dropDownList(
                ArrayHelper::map(Profesorguia::find()->all(),'id',
                        function ($query) {
                            return $query->usuario->nombre;
                        },),['prompt' => 'Seleccione profesor guía'])?>
    </div>-->
    
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    <p>

    <?php ActiveForm::end(); ?>

</div>

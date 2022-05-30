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


    <?= $form->field($model, 'id_profe_guia')->dropDownList(\yii\helpers\ArrayHelper::map(Usuario::find()->all(),'id', 'nombre'),['prompt' => 'Seleccionar profesor guía']);?>


        <div class="col-md">
            <?= $form->field($model, 'id_profe_guia')
                ->dropDownList(
                    ArrayHelper::map(
                        Profesorguia::find()->all(),
                        'id',
                        function ($query) {
                            return $query->usuario->nombre;
                        },
                        
                    ),
                    ['prompt' => 'Seleccione ptofesor guía'])?>
         </div>
      

   


    
    <div class="form-group">

    <p align="right">
        <?= Html::submitButton('Subir propuesta', ['class' => 'btn btn-success']) ?>

        <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

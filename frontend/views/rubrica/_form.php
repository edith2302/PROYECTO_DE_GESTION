<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubrica-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nombre')->textInput() ?>
    <?= $form->field($model, 'descripción')->textarea() ?>

    <?= $form->field($model, 'escala')->textInput() ?>

    <?= $form->field($model, 'id_profe_asignatura')->textInput() ?>



    <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i></h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsItem[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'descrocion',
                    'puntaje',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsItem as $i => $modelItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Items</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelItem, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelItem, "[{$i}]descripcion")->textarea(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelItem, "[{$i}]puntaje")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
        </div><!-- -->

    </div>



    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

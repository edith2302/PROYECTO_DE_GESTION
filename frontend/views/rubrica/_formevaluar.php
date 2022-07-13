<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Entrega;


use yii\helpers\Url;
use yii\grid\ActionColumn;
use app\models\Item;



/* @var $this yii\web\View */
/* @var $modelRubrica app\models\Rubrica */
/* @var $modelItem app\models\Item */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-item").each(function(index) {
        jQuery(this).html("Item: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-item").each(function(index) {
        jQuery(this).html("Item: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="rubrica-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

            
   
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsItem[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'descripcion',
            'puntaje',
            'puntaje_obtenido',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsItem as $index => $modelItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-item">Item: <?= ($index + 1) ?></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelItem, "[{$index}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                            
                            <?php echo  ($modelItem-> descripcion) ?>

                            </div>
                            <div class="col-sm-2">
                            
                            <?php echo  ($modelItem-> puntaje.' pts') ?>

                            </div>
                            
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$index}]puntaje_obtenido")->textInput(['placeholder' => "0"],['maxlength' => true]) ?>
                            </div>
                           

                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    
    <?php DynamicFormWidget::end(); ?>
   
    <?php $ide = $modelentrega->id ?>

    <?= $form->field($modelRubrica, 'observaciones')->textarea(['placeholder' => "Observaciones de la evaluación"],['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($modelItem->isNewRecord ? 'Create' : 'Guardar',['ide' => $ide], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

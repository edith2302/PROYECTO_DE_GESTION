<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Item;

/* @var $this yii\web\View */
/* @var $model app\modules\yii2extensions\models\Rubrica */
/* @var $modelsItem app\modules\yii2extensions\models\Item */
//$modelsItem = Item::find()->where(['id_rubrica' => $id]);
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-items").each(function(index) {
        jQuery(this).html("Item: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-items").each(function(index) {
        jQuery(this).html("Item: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="rubrica-form">

    <?php $form = ActiveForm::begin(['id' => 'ISSUE-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'descripción')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <div class="panel panel-info">
    <div class="panel-body">

    <?php  DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class

        'model' => $modelsItem[0],
        //'formId' => 'dynamic-form',
        'formId' => 'ISSUE-form', //same as your ActiveForm id  
        'formFields' => [
            'descripcion',
            'puntaje',
            'puntaje_obtenido',
            
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i>Items
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>Agregar item</button>
            <div class="clearfix"></div>
        </div>
       
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsItem as $index => $modelItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-items">Item: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelItem, "[{$index}]id");
                            }
                        ?>
                        <?= $form->field($modelItem, "[{$index}]descripcion")->textInput(['maxlength' => true]) ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelItem, "[{$index}]puntaje")->textInput(['maxlength' => true]) ?>
                            </div>
                    
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelItem, "[{$index}]puntaje_obtenido")->textInput(['maxlength' => true]) ?>
                            </div>
                           
                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>
 </div>
</div>
    <div class="form-group">
        <?= Html::submitButton($modelItem->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<link rel="stylesheet" href="https://wbraganca.com/assets/6b720680/css/bootstrap.css">
<script src="https://wbraganca.com/assets/6b720680/js/bootstrap.js"></script>
<link rel="stylesheet" href="https://wbraganca.com/css/site.css">
<link rel="stylesheet" href="https://wbraganca.com/css/base.css">
<script src="https://wbraganca.com/js/jquery.scrollUp.js"></script>
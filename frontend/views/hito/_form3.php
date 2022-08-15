<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $modelHito app\models\Hito */
/* @var $modelEvaluador app\models\Evaluador */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-item").each(function(index) {
        jQuery(this).html("Evaluador: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-item").each(function(index) {
        jQuery(this).html("Evaluador: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="hito-form3">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
   
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 100, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsEvaluador[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id_hito', 
            'rol',

        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-user-circle-o "></i>  Evaluador
            <a  class="pull-right add-item btn btn-success btn-sm"><i class="fa fa-plus"></i> Agregar evaluador</a>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsEvaluador as $index => $modelEvaluador): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-item">Evaluador: <?= ($index + 1) ?></span>
                        <a  class="pull-right remove-item btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if ($modelEvaluador->isNewRecord) {
                                echo Html::activeHiddenInput($modelEvaluador, "[{$index}]id");
                            }
                        ?>
                        
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="body-content">
                                    <?php echo $form->field($modelEvaluador, "[{$index}]rol")->dropDownList(
                                        [
                                            
                                            '1' => 'Profesor de asignatura',
                                            '5' => 'Profesor Guía',
                                            '3' => 'Profesor ICINF',
                                            '4' => 'Comisión Evaluadora',
                                        ],
                                        ['prompt' => 'Seleccionar Evaluador']
                                    );
                                    ?>
                                </div>
                            </div>

                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($modelEvaluador->isNewRecord ? 'Guardar' : 'Guardar', ['class' => 'btn btn-primaryy']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

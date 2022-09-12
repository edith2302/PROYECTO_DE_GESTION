<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Profesoricinf;
use yii\widgets\DetailView;


use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use app\models\Hito;
use app\models\Proyecto;
use app\models\Evaluarf;
use app\models\Usuario;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $modelEntrega app\models\Entrega */
/* @var $modelEvaluador app\models\Profesoricinf */
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

<div class="entrega-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

        
    <?= DetailView::widget([
        'model' => $modelEntrega,
        'attributes' => [
            //'id',
            //'evidencia',
            [
                'label'  => 'Proyecto',
                'value'  => function ($model) {
                    return $model->proyecto->nombre;
                },
            ],

            [
                'label'  => 'Área Proyecto',
                'value'  => function ($model) {
                    $proyectoo = Proyecto::findOne(['id'=>$model->id_proyecto]);

                    if ($proyectoo->area == 1) {
                        return 'Inteligencia artificial';
                    };
                    if ($proyectoo->area == 2) {
                        return 'Sistemas de información';
                    };

                    if ($proyectoo->area == 3) {
                        return 'Estructura de datos';
                    };
                    //return $proyectoo->area;
                },
            ],
            
            //'fecha_entrega',
            //'hora_entrega',
            //'comentarios',
            //'id_proyecto',
            [
                'label'=>'Fecha entrega',
                'value'=>function ($model) { return $model->fecha_entrega; },
                //'filter'=>false,
                'format'=>'date',
            ],
  
            [
                'label'=>'Hora entrega',
                'value'=>function ($model) { return $model->hora_entrega." hrs"; },
            ],
            
            'comentarios',
            //'id_hito',
            /*[
                'label'  => 'Archivo adjunto',
                'value'  => function ($model) {
                    return (($model->evidencia != '') ? Html::a('     <img src="images/iconos/archivos.png" width="32" height="32">', $model->evidencia, ['target' => '_blank']) : '');
                },
            ],*/
        ],

        

    ]) ?><br>


    <!--<p align="right">
        <?php $archivoo =  $model->evidencia; ?>
    <a class="btn btn-primary" href="archivos/ "$archivoo target="_blank">Ver adjunto </a></p><br>-->
    

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
            'id_entrega', 
            'id_profesor',

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
                                    <?php echo $form->field($modelEvaluador, "[{$index}]id_profesor")->dropDownList(
                                       ArrayHelper::map(Profesoricinf::find()->all(),'id',
                                            function ($query) {
                                             
                                                $usuario = Usuario::findOne($query['id_usuario']);   
                                                $profe = Profesoricinf::findOne(['id_usuario'=>$usuario->id_usuario]);           
                                                         
                                                return $usuario->nombre." ".$usuario->apellido."  -  ".$profe->area;
                                            },),['prompt' => 'Seleccione profesor'])
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

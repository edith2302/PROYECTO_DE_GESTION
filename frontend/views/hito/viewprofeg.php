<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

use app\models\Entrega;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Entrega de proyectos guiados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hito-viewprofeg">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'nombre',
            [
                'label'  => 'Nombre de hito',
                'value'  => function ($model) {
                    return $model->nombre;
                },
            ],
            //'descripcion',
            //'fecha_habilitacion',
            //'hora_habilitacion',
            //'fecha_limite',
            //'hora_limite',

            [
                'attribute'=>'descripcion',
                'value'=>function ($model) { return $model->descripcion; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
            //'fecha_habilitacion:date',
            [
                'label'=>'Fecha habilitación',
                'value'=>function ($model) { return $model['fecha_habilitacion']; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],
           // 'hora_habilitacion',
            [
                'label'=>'Hora habilitación',
                'value'=>function ($model) { return $model['hora_habilitacion']." hrs"; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],
            //'fecha_limite:date',
            //'hora_limite',

            [
                'label'=>'Fecha límite',
                'value'=>function ($model) { return $model['fecha_limite']; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            [
                'label'=>'Hora límite',
                'value'=>function ($model) { return $model['hora_limite']." hrs"; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: left !important;'],
                //'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],
           // 'tipo_hito',
            [
                'label'  => 'Tipo de hito',
                'value'  => function ($model) {
                    switch ($model->tipo_hito) {
                        case 0:
                            return "Informe (Avance)";
                            break;
                        case 1:
                            return "Presentación";
                            break;
                        case 2:
                             return "Defesa de proyecto";
                                break;
                        case 3:
                         return "Informe final";
                            break;
                            
                    }
                },
            ],
            //'porcentaje_nota',
            [
                'label'  => 'Porcentaje nota',
                'value'  => function ($model) {
                    return $model->porcentaje_nota.'%';
                },
            ],
            //'id_rubrica',

            /*[
                'label'  => 'Rúbrica',
                'value'  => function ($model) {
                    return $model->rubrica->nombre;
                },
            ],*/
            //'id_profe_asignatura',


        ],
    ]) ?>
</div>


    <?= GridView::widget([
        'dataProvider' => $modelentregahito,
        //'dataProvider' => $modelnota,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'header'=>"Archivo",
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model['evidencia'] != '') ? Html::a('     <img src="images/iconos/archivos.png" width="50" height="50">', "archivos/".$model['evidencia'], ['target' => '_blank']) : '';
                    },
                ],
                'headerOptions' => ['width' => '200px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 10px 0px;text-align: center;'],
            ],

            /*[
                'attribute'=>'id',
                'value'=>function ($model) { return $model['id']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/

            [
                'attribute'=>'fecha_entrega',
                'value'=>function ($model) { return $model['fecha_entrega']; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],
  
            [
                'attribute'=>'hora_entrega',
                'value'=>function ($model) { return $model['hora_entrega']." hrs"; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],
            
           
            /*[
                'attribute'=>'nota',
                'value'=>function ($model) {
                    if($model['nota'] !=null){
                        return "con nota";
                    }
                    //return $model['hora_entrega']; 
                    return "sin nota";
                },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ], */  


            [
                'header'=>"Acciones",
                'headerOptions' => ['width' => '100px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
                'class' => ActionColumn::className(),
                'template'=>'{view}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    //return Url::toRoute([$action, 'id' => $model['id']]);
                    
                    
                    //$url ='index.php?r=entrega%2Fview2&id='.$model['id'];
                    $url ='index.php?r=entrega%2Fview&id='.$model['id'];
                    return $url;
                }
            ],  
        ],
    ]); ?>


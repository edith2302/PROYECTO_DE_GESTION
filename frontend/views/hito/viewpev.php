<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

use app\models\Proyecto;
use app\models\Entrega;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hito-viewpev">

    <h1><?= Html::encode($this->title) ?></h1>

   <!-- <p align="right">
        <?= Html::a('Ver entrega', ['entrega/entregashito', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de que deseas eliminar éste elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'nombre',
            //'descripcion',
            //'fecha_habilitacion',
            //'hora_habilitacion',
            //'fecha_limite',
            //'hora_limite',
            [
                'label'=>'Nombre hito',
                'value'=>function ($model) { return $model['nombre']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

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

            [
                'label'  => 'Rúbrica',
                'value'  => function ($model) {
                    return $model->rubrica->nombre;
                },
            ],
            //'id_profe_asignatura',


        ],
    ]) ?>
    <!--<p align="right">
        <?= Html::a('Ver entrega', ['entrega/entregashito', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de que deseas eliminar éste elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
   
</div>
<div>
    <br><h2><p align="center"><?= ("Entregas del hito") ?></p></h2></br>
</div>
<?= GridView::widget([
        'dataProvider' => $modelhito,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header'=>"Archivo adjunto",
                'headerOptions' => ['width' => '105px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:5px 0px 0px 0px;text-align: center;'],
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model['evidencia'] != '') ? Html::a('     <img src="images/iconos/archivos.png" width="25" height="25">', 'archivos/'.$model['evidencia'], ['target' => '_blank']) : '';
                    },
                ],
            ],


            [
                //'attribute'=>'fecha_entrega',
                'header'=>"Fecha y hora de entrega",
                'value'=>function ($model) { return $model['fecha_entrega']; },
                'format'=>'date',
                'headerOptions' => ['width' => '200px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],
  
            [
                'attribute'=>'hora_entrega',
                'value'=>function ($model) { return $model['hora_entrega']." hrs"; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '100px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],

            [
                //'attribute'=>'id_proyecto',
                'header'=>"Proyecto",
                'value'=>function ($model) {
                    $proyecto = Proyecto::findOne(['id' => $model['id_proyecto']]);
                    return $proyecto->nombre;
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '350px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],

            [
                'header'=>"Acciones",
                'headerOptions' => ['width' => '80px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
                'class' => ActionColumn::className(),
                'template'=>'{view}, {delete}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    //return Url::toRoute([$action, 'id' => $model['id']]);
                    $url ='index.php?r=entrega%2Fview&id='.$model['id'];
                    return $url;
                }
            ],
            [
                'header'=>"Evaluar",
                'headerOptions' => ['width' => '70px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
                'class' => ActionColumn::className(),
                'template'=>'{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ('index.php?r=rubrica%2Fevaluar&ide='.$model['id']) ? Html::a('<img src="images/iconos/evaluar.PNG" width="20" height="20">', 'index.php?r=rubrica%2Fevaluar&ide='.$model['id']) : '';
                    },
                ],
            ],
            
        ],
    ]); ?>


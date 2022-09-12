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
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hito-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'nombre',
            //'descripcion',
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

        ],
    ]) ?>
</div>

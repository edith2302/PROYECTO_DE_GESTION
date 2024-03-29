<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Hito;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HitoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hitos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hito-indexcomision">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $modelhitoss,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'nombre',
            //'descripcion',
            //'fecha_habilitacion',
           // 'hora_habilitacion',
            //'fecha_limite',
            //'hora_limite',
           // 'tipo_hito',
            //'porcentaje_nota',
            //'id_rubrica',
            //'id_profe_asignatura',

            [
                'label'=>'Nombre hito',
                'value'=>function ($model) { return $model['nombre']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            /*[
                'attribute'=>'descripcion',
                'value'=>function ($model) { return $model->descripcion; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/

            [
                'label'=>'Fecha habilitación',
                'value'=>function ($model) { return $model['fecha_habilitacion']; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            [
                'label'=>'Hora habilitación',
                'value'=>function ($model) { return $model['hora_habilitacion'." hrs"]; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            [
                'label'=>'Fecha límite',
                'value'=>function ($model) { return $model['fecha_limite']; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            [
                'label'=>'Hora límite',
                'value'=>function ($model) { return $model['hora_limite'." hrs"]; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

             //'tipo_hito',
            [
                'label' => 'Tipo hito',
                'value' =>

                function ($model) {
                    if ($model['tipo_hito'] == '0') {
                        return 'Informe (Avance)';
                    };
                    if ($model['tipo_hito'] == '1') {
                        return 'Presentación';
                    };
                    if ($model['tipo_hito'] == '2') {
                        return 'Defesa de proyecto';
                    };
                    if ($model['tipo_hito'] == '3') {
                        return 'Informe final';
                    };
                    return 'ERROR';

                   
                },
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],


            ],

            [
                'label'=>'Porcentaje nota',
                'value'=>function ($model) { return $model['porcentaje_nota'].'%'; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],




            [
                'class' => ActionColumn::className(),
                'template'=>'{view}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model['idh']]);
                }
            ],
        ],
    ]); ?>


</div>

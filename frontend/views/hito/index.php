<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Hito;
use yii\bootstrap4\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\HitoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hitos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hito-index">



    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?= Html::button('Agregar Hito', ['value'=>Url ::to ('index.php?r= hito/create'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
    Modal::begin([
        'title' => '<h2>Hello world</h2>',
        'toggleButton' => ['label' => 'click me'],
    ]);

        echo 'hola'; ?>
    <p></p>
    <div align="center">
    <iframe src="index.php?r=hito/create" width=100% height=550 frameborder=10 scrolling=auto></iframe>
    </div>
    <?php
    Modal::end();
     ?>
     

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'nombre',
            //'descripcion',
            //'fecha_habilitacion',
            //'hora_habilitacion',
           // 'fecha_limite',
           // 'hora_limite',
            //'tipo_hito',
            //'porcentaje_nota',
            //'id_rubrica',
            //'id_profe_asignatura',

            [
                'attribute'=>'nombre',
                'value'=>function ($model) { return $model->nombre; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
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
                'attribute'=>'fecha_habilitacion',
                'value'=>function ($model) { return $model->fecha_habilitacion; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'hora_habilitacion',
                'value'=>function ($model) { return $model->hora_habilitacion; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'fecha_limite',
                'value'=>function ($model) { return $model->fecha_limite; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'hora_limite',
                'value'=>function ($model) { return $model->hora_limite; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'tipo_hito',
                'value'=>function ($model) { return $model->tipo_hito; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'porcentaje_nota',
                'value'=>function ($model) { return $model->porcentaje_nota; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],




            [
                'class' => ActionColumn::className(),
               
                'urlCreator' => function ($action, Hito $model, $key, $index, $column) {

                   

                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    

</div>



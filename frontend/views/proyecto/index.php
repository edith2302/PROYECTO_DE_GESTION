<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Proyecto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista propuestas de proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?= Html::a('Agregar propuesta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'nombre',
            //'descripcion',
            //'num_integrantes',
            //'tipo',
            //'area',
            //'estado',
            //'disponibilidad',
            //'id_profe_guia',
            //'id_autor',

            [
                'label'=>'Nombre proyecto',
                'value'=>function ($model) { return $model->nombre; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 0px;text-align: center;'],
            ],

           /* [
                'attribute'=>'descripcion',
                'value'=>function ($model) { return $model->descripcion; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/


            [
                'label'=>'Número integrantes',
                'value'=>function ($model) { return $model->num_integrantes; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            /*[
                'attribute'=>'tipo',
                'value'=>function ($model) { return $model->tipo; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/

            [
                        'label' => 'Tipo',
                        'value' =>

                        function ($model) {
                            if ($model['tipo'] == '1') {
                                return 'Desarrollo';
                            };
                            if ($model['tipo'] == '2') {
                                return 'Investigación';
                            };
                            return 'ERROR';
                        },
                        'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
       

                    ],

                    [
                        'label' => 'Área',
                        'value' =>

                        function ($model) {
                            if ($model['area'] == '1') {
                                return 'Inteligencia artificial';
                            };
                            if ($model['area'] == '2') {
                                return 'Sistemas de información';
                            };

                            if ($model['area'] == '3') {
                                return 'Estructura de datos';
                            };
                            return 'ERROR';
                        },

                        'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],


                    ],

                    [
                        'label' => 'Disponibilidad',
                        'value' =>

                        function ($model) {
                            if ($model['disponibilidad'] == '1') {
                                return 'Disponible';
                            };
                            if ($model['disponibilidad'] == '2') {
                                return 'Ocupado';
                            };

                        
                            return 'ERROR';
                        },

                        'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
                


                    ],

            /*[
                'attribute'=>'area',
                'value'=>function ($model) { return $model->area; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/

            /*[
                'attribute'=>'disponibilidad',
                'value'=>function ($model) { return $model->disponibilidad; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/

            
            [
                'class' => ActionColumn::className(),
                'template'=>'{view}',
                'urlCreator' => function ($action, Proyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

   

</div>

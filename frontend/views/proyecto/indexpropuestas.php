<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Proyecto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis propuestas de proyecto';

$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['indexestudiante']];

/*$this->params['breadcrumbs'][] = $this->title;*/
?>

<div class="proyecto-indexpropuestas">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?= Html::a('Agregar propuesta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        //'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'dataProvider' => $modelproyectos,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'nombre',
            [
                'label'=>'Nombre proyecto',
                
                'value'=>function ($modelproyectos) { 
                    return $modelproyectos['nombre'];
                },
  
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],
            //'descripcion',
            //'num_integrantes',
            //'tipo',
            //'area',
            //'estado',
            [
                'label'=>'Estado',
                
                'value'=>function ($modelproyectos) { 
                    if($modelproyectos['estado'] == 1){
                        return "Aprobado";
                    }
                    if($modelproyectos['estado'] == 2){
                        return "Rechazado";
                    }
                    if($modelproyectos['estado'] == 3){
                        return "Pendiente";
                    }
                    return ;
                },
  
                'format'=>'raw',
                'headerOptions' => ['width' => '180px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],
            //'disponibilidad',
            //'id_profe_guia',
            //'id_autor',

            


            [
                'label'=>'Número integrantes',
                'value'=>function ($modelproyectos) { 
                    return $modelproyectos['num_integrantes']; 
                },
                
                'format'=>'raw',
                'headerOptions' => ['width' => '150px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            [
                'label' => 'Tipo',
                'value' =>

                function ($modelproyectos) {
                    if ($modelproyectos['tipo'] == '1') {
                        return 'Desarrollo';
                    };
                    if ($modelproyectos['tipo'] == '2') {
                        return 'Investigación';
                    };
                    return 'ERROR';
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '50px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: center;'],
       

            ],

            [
                'label' => 'Área',
                'value' =>

                function ($modelproyectos) {
                    if ($modelproyectos['area'] == '1') {
                        return 'Inteligencia artificial';
                    };
                    if ($modelproyectos['area'] == '2') {
                        return 'Sistemas de información';
                    };

                    if ($modelproyectos['area'] == '3') {
                        return 'Estructura de datos';
                    };
                    return 'ERROR';
                },

                'format'=>'raw',
                'headerOptions' => ['width' => '200px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: center;'],


            ],

                    
            [

                'header'=>"Acción",
                'headerOptions' => ['width' => '100px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],

                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model['id']]);
                }
            
                
                
                    /*'class' => ActionColumn::className(),
                    'template'=>'{view}',
                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                        $url ='index.php?r=proyecto%2Fview&id='.$model['id'];
                        return $url;
                    },

                'headerOptions' => ['width' => '100px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 10px 10px;text-align: center;'],*/
            ],
        ],
    ]); ?>

    


</div>

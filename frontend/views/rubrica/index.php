<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Rubrica;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RubricaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de rúbricas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubrica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <p align="right">
        <?= Html::a('Agregar Rúbrica', ['create2'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'nombre',
            //'id',
            //'descripcion',
            //'escala',
           // 'id_profe_asignatura',

            [
                'attribute'=>'nombre',
                'value'=>function ($model) { return $model->nombre; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'descripcion',
                'value'=>function ($model) { return $model->descripcion; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '400px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],




            [
                'header'=>"Acciones",
                'headerOptions' => ['width' => '120px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rubrica $model, $key, $index, $column) {
                    if($action =='update'){
                        return 'index.php?r=rubrica%2Fviewmodificar&id='.$model['id'];
                    }
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],

        ],
    ]); ?>





</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Defensaproyecto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DefensaproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de proyectos defensa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="defensaproyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar defensa de proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
       
            //'id',
            //'nombre',
            //'fecha',
            //'id_proyecto',

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
                'attribute'=>'fecha',
                'value'=>function ($model) { return $model->fecha; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
          /*  [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Defensaproyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],*/
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Comisionevaluadora;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComisionevaluadoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comisión evaluadora';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comisionevaluadora-index">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_usuario',

            [
                'attribute'=>'id',
                'value'=>function ($model) { return $model->id; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],

            [
                'attribute'=>'id_usuario',
                'value'=>function ($model) { return $model->id_usuario; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Comisionevaluadora $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


<p align="right">
        <?= Html::a('Agregar profesor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>

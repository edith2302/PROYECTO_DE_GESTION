<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Cursoestudiante;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursoestudianteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudiantes del curso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursoestudiante-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar estudiante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_curso',
            //'id_estudiante',

            [
                'attribute'=>'id_estudiante',
                'value'=>function ($model) { return $model->id_estudiante; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cursoestudiante $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

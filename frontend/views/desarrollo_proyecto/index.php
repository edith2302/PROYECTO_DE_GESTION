<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DesarrollarProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Desarrollar Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrollar-proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Desarrollar Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_proyecto',
            'id_estudiante',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\DesarrollarProyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

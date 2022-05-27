<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Desarrollarproyecto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DesarrollarproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Desarrollarproyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrollarproyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Desarrollarproyecto', ['create'], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, Desarrollarproyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

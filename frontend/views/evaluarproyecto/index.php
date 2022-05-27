<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Evaluarproyecto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EvaluarproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluarproyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluarproyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Evaluarproyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_prof_icinf',
            'id_proyecto',
            'nota',
            'comentarios',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Evaluarproyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

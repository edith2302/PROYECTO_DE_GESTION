<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EvaluarProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluar Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluar-proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Evaluar Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, \app\models\EvaluarProyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

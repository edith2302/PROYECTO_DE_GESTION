<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Defensaproyecto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DefensaproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Defensaproyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="defensaproyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Defensaproyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'fecha',
            'id_proyecto',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Defensaproyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

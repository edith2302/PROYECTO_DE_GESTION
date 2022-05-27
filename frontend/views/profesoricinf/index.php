<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Profesoricinf;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfesoricinfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profesoricinfs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesoricinf-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profesoricinf', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'area',
            'id_usuario',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Profesoricinf $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

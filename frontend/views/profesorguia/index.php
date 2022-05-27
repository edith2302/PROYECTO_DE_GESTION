<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Profesorguia;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfesorguiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profesorguias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesorguia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profesorguia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_usuario',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Profesorguia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

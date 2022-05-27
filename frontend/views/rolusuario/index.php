<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Rolusuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolusuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rolusuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolusuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rolusuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_user',
            'id_rol',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rolusuario $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

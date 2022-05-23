<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComisionEvaluadoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comision Evaluadoras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comision-evaluadora-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comision Evaluadora', ['create'], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, \app\models\ComisionEvaluadora $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

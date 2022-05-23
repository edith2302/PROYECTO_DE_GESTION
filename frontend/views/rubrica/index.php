<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RubricaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rubricas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubrica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Rubrica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripción',
            'escala',
            'id_profe_asignatura',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Rubrica $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

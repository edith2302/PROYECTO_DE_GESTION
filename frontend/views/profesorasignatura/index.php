<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Profesorasignatura;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfesorasignaturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profesor asignatura';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesorasignatura-index">

    <h1><?= Html::encode($this->title) ?></h1>

  

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
                'urlCreator' => function ($action, Profesorasignatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

<p align="right">
        <?= Html::a('Agregar profesor asignatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>

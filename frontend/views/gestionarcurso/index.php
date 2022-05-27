<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Gestionarcurso;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GestionarcursoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestionarcursos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestionarcurso-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Gestionarcurso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_curso',
            'id_profesor',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Gestionarcurso $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

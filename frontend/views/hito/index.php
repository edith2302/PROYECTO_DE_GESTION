<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Hito;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HitoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hitos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hito-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?= Html::a('Agregar Hito', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre',
            'descripcion',
            'fecha_habilitacion',
            'hora_habilitacion',
            'fecha_limite',
            'hora_limite',
            'tipo_hito',
            'porcentaje_nota',
            //'id_rubrica',
            //'id_profe_asignatura',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Hito $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Modulo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modulo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'archivo',
            [

                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model->archivo != '') ? Html::a('     <img src="images/iconos/pdf.svg" width="32" height="32">', $model->archivo, ['target' => '_blank']) : '';
                    },
                ],
            ],

            'descripcion',

        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Entrega;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entregas del hito';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-index">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [

                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model['evidencia'] != '') ? Html::a('     <img src="images/iconos/pdf.svg" width="32" height="32">', $model['evidencia'], ['target' => '_blank']) : '';
                    },
                ],
            ],


            [
                'attribute'=>'fecha_entrega',
                'value'=>function ($model) { return $model['fecha_entrega']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
  
            [
                'attribute'=>'hora_entrega',
                'value'=>function ($model) { return $model['hora_entrega']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
            
        ],
    ]); ?>



</div>

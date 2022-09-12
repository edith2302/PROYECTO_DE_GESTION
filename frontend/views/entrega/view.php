<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Hito;
use app\models\Rubrica;
use app\models\Entrega;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */

$hito = Hito::find()->where(['id' => $model->id_hito])->one();
$this->title = "Entrega de hito ".$hito->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entrega-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'evidencia',
            [
                'label'  => 'Proyecto',
                'value'  => function ($model) {
                    return $model->proyecto->nombre;
                },
            ],
            
            //'fecha_entrega',
            //'hora_entrega',
            //'comentarios',
            //'id_proyecto',
            [
                'label'=>'Fecha entrega',
                'value'=>function ($model) { return $model->fecha_entrega; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
  
            [
                'label'=>'Hora entrega',
                'value'=>function ($model) { return $model->hora_entrega." hrs"; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
            
            'comentarios',
            //'id_hito',
            [
                'label'  => 'Archivo adjunto',
                'value'  => function ($model) {
                    return (($model->evidencia != '') ? Html::a('     <img src="images/iconos/archivos.png" width="32" height="32">', $model->evidencia, ['target' => '_blank']) : '');
                },
            ],
        ],

    ]) ?>
    <?php
        $hito = Hito::find()->where(['id' => $model->id_hito])->one();
        $rubrica = Rubrica::find()->where(['id' => $hito->id_rubrica])->one(); 
        $entrega = Entrega::find()->where(['id' => $model->id])->one(); 
    ?>


    <div class="row">
        <div class="col-sm-6">
            <p align="right">
                <?= Html::a('Evaluar', ['rubrica/evaluar',/* 'idr' => $rubrica->id,*/ 'ide' => $entrega->id], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
                            
        <div class="col-sm-6">
            <p align="left">   
                <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Está seguro/a de eliminar la entrega?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div><!-- end:row -->
</div>


<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Hito;


/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
$hito=Hito::findOne(['id'=>$model->id_hito]);
$nombrehito=$hito->nombre;
$this->title = 'Entrega de '.$nombrehito;
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entrega-view2">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'evidencia',
            'fecha_entrega',
            'hora_entrega',
            'comentarios',
            //'id_proyecto',
            //'id_hito',
            /*[

                //'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model['evidencia'] != '') ? Html::a('     <img src="images/iconos/pdf.svg" width="32" height="32">', $model['evidencia'], ['target' => '_blank']) : '';
                    },
                ],
            ],*/

            
        ],
    ]) ?>



</div>


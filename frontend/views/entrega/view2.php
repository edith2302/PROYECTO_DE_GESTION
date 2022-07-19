<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

use app\models\Hito;
use app\models\Proyecto;
use app\models\Evaluar;


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

    <?php $evaluacion = Evaluar::find()->where(['id_entrega' => $model->id])->one(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'evidencia',
            'fecha_entrega',
            'hora_entrega',
            [
                'attribute'=>'id_proyecto',
                'value'=>function ($model) {
                    $proyecto = Proyecto::findOne(['id' => $model['id_proyecto']]);
                    return $proyecto->nombre;
                },
            ],
            'comentarios', 
        ],
    ]) ?>

</div>
<div>
    <br><h3><p align="left"><?= ("Evaluación") ?></p></h3></br>
</div>

<?= GridView::widget([
        'dataProvider' => $modelnota,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'nota',
                'value'=>function ($model) {
                    if($model['nota'] !=null){
                        return round($model['nota'], 1);
                    }
                    return " ";
                },

                'format'=>'raw',
                'headerOptions' => ['width' => '850px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], 
            /*[
                'attribute'=>'comentarios',
                'value'=>function ($model) {
                    return $model['comentarios'];
                },

                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], */
 
        ],

        
    ]); ?>

<?= GridView::widget([
        'dataProvider' => $modelcomentarios,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'comentarios',
                'value'=>function ($model) {
                    return $model['comentarios'];
                },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '850px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], 
 
        ],
    ]); ?>




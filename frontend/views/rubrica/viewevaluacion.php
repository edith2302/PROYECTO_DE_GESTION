<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Item;
use app\models\Entrega;
use app\models\Rubrica;
use app\models\Hito;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rubrica-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'nombre',
            'descripcion',
           // 'escala',
           // 'id_profe_asignatura',

            
        ],
    ]) ?>

   <!--p align="right">
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de eliminar la rúbrica seleccionada?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Agregar ítem', ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Evaluar', ['evaluar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'descripcion',
            //'puntaje',
        
            'puntaje_obtenido',   
        ],
    ]); ?>


    <?php if (!$dataProvider2==null){
    echo GridView::widget([
        'dataProvider' => $dataProvider2,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'descripcion',
            //'puntaje',
            //'puntajeideal',
            //'puntajeobtenido',
            //'nota',
            [
               // 'attribute'=>'puntajeideal',
                'label' => 'Puntaje ideal',
                'value'=>function ($model) { 

                    return $model['puntaje_ideal'];
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], 
            [
                //'attribute'=>'puntajeobtenido',
                'label' => 'Puntaje obtenido',
                'value'=>function ($model) { 

                    return $model['puntaje_obtenido'];
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], 
            [
                'attribute'=>'nota',
                'value'=>function ($model) { 

                    $notaa = round($model['nota'], 1);

                    return $notaa;
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],  
        ],
    ]); } ?>
</div>


<!--<div class="form-group">
    <?= Html::a('Enviar', ['evaluar/create','ide' => $modelentrega->id], ['class' => 'btn btn-primary']) ?>
</div>-->

<p align="center">
    <?= Html::a('Enviar', ['evaluar/create','ide' => $modelentrega->id], ['class' => 'btn btn-primary']) ?>
</p>


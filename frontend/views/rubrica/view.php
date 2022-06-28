<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Item;
/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Rúbricas', 'url' => ['index']];
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
            'escala',
            'id_profe_asignatura',

            
        ],
    ]) ?>

   <p align="right">
        <?= Html::a('Modificar', ['update2', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de eliminar la rúbrica seleccionada?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Agregar ítem', ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Evaluar', ['evaluar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'descripcion',
            'puntaje',
            //'puntaje_obtenido',   
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */

//$this->title = $model->id;
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
            'evidencia',
            'fecha_entrega',
            'hora_entrega',
            'comentarios',
            //'id_proyecto',
            //'id_hito',
        ],
    ]) ?>


   <p align="right">
       
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de eliminar la entrega?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>


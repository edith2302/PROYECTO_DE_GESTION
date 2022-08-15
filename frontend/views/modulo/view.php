<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
//$this->title = $model->id;
$this->title = 'Material complementario';
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Módulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="modulo-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'archivo',
            'descripcion',
            //'id_profesor',
        ],
    ]) ?>

    <p align="right">
            <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro/a de eliminar el archivo?',
                    'method' => 'post',
                ],
            ]) ?>
    </p>
</div>

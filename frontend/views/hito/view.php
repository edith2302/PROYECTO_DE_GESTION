<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hito-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nombre',
            'descripcion',
            'fecha_habilitacion',
            'hora_habilitacion',
            'fecha_limite',
            'hora_limite',
            'tipo_hito',
            'porcentaje_nota',
            'id_rubrica',
            'id_profe_asignatura',
        ],
    ]) ?>
    <p align="right">
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de que deseas eliminar éste elemento?',
                'method' => 'post',
            ],
        ]) ?>


        <?= Html::a('Ver entregas', ['entrega/entregashito'], ['class' => 'btn btn-primary']) ?>
       
        
    </p>
    

</div>

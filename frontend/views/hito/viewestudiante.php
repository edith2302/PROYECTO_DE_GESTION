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
            //'id_rubrica',
            //'id_profe_asignatura',
        ],
    ]) ?>

            <p align="center">
                <?= Html::a('Agregar entrega', ['entrega/create'], ['class' => 'btn btn-primary']) ?> </p>
            </div>
    
</div>

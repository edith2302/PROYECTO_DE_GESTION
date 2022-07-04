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
            //'tipo_hito',

            [
                'label'  => 'Tipo de hito',
                'value'  => function ($model) {
                    switch ($model->tipo_hito) {
                        case 0:
                            return "Informe (Avance)";
                            break;
                        case 1:
                            return "Presentación";
                            break;
                        case 2:
                             return "Defesa de proyecto";
                                break;
                        case 3:
                         return "Informe final";
                            break;
                            
                    }
                },
            ],
            //'porcentaje_nota',
            [
                'label'  => 'Porcentaje nota',
                'value'  => function ($model) {
                    return $model->porcentaje_nota.'%';
                },
            ],
            
            //'id_rubrica',
            //'id_profe_asignatura',
        ],
    ]) ?>

            <p align="center">
                <?= Html::a('Agregar entrega', ['entrega/create','id' => $model->id], ['class' => 'btn btn-primary']) ?> </p>
            </div>

            <!--<p align="right">
                <?= Html::a('Entrega de mi proyecto', ['viewentregaestudiante','id'=>$model->id], ['class' => 'btn btn-success']) ?>
            </p>-->

           
</div>

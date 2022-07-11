<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Hito;
use app\models\Rubrica;

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
            'evidencia',
            'fecha_entrega',
            'hora_entrega',
            'comentarios',
            //'id_proyecto',
            //'id_hito',
        ],
    ]) ?>
    <?php
        $hito = Hito::find()->where(['id' => $model->id_hito])->one();
        $rubrica = Rubrica::find()->where(['id' => $hito->id_rubrica])->one(); 
    ?>
    <div class="row">
        <div class="col-sm-6">
            <p align="right">
                <?= Html::a('Evaluar', ['rubrica/evaluar', 'id' => $rubrica->id], ['class' => 'btn btn-primary']) ?>
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


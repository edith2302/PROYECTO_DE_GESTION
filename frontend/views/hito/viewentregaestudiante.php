<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Hitos', 'url' => ['index']];
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
           // 'tipo_hito',
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

            [
                'label'  => 'Rúbrica',
                'value'  => function ($model) {
                    return $model->rubrica->nombre;
                },
            ],
            //'id_profe_asignatura',


        ],
    ]) ?>
    <p align="right">
        

        <?= Html::a('<a class="btn btn-primary" href="index.php?r=entrega/entregashito&id=' . $model->id . '">Ver Entregas</a>')?>
       
        
    </p>
    

</div>

<?= GridView::widget([
        'dataProvider' => $modelhito,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [

                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model['evidencia'] != '') ? Html::a('     <img src="images/iconos/archivos.png" width="50" height="50">', 'archivos/'.$model['evidencia'], ['target' => '_blank']) : '';
                    },
                ],
            ],


            [
                'attribute'=>'fecha_entrega',
                'value'=>function ($model) { return $model['fecha_entrega']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
  
            [
                'attribute'=>'hora_entrega',
                'value'=>function ($model) { return $model['hora_entrega']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],


            
        ],
    ]); ?>


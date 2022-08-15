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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'descripcion',
            'puntaje',
        
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
            'puntajeideal',
            'puntajeobtenido',
            //'nota',
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
            //'puntaje_obtenido',   
        ],
    ]); } ?>
</div>



<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nombre',
            'descripcion',
            'num_integrantes',
            //'tipo',

            [
                'label'  => 'Tipo',
                'value'  => function ($model) {
                    switch ($model->tipo) {
                        case 1:
                            return "Desarrollo";
                            break;
                        case 2:
                            return "Investigación";
                            break;
                        
                    }
                },
            ],
            //'area',
            [
                'label'  => 'Área',
                'value'  => function ($model) {
                    switch ($model->area) {
                        case 1:
                            return "Inteligencia Artificial";
                            break;
                        case 2:
                            return "Sistemas de información";
                            break;
                        case 3:
                            return "Estructura de datos";
                            break;
                        
                    }
                },
            ],
            //'estado',

            /*[
                'label'  => 'Estado',
                'value'  => function ($model) {
                    switch ($model->estado) {
                        case 1:
                            return "Aprobado";
                            break;
                        case 2:
                            return "Rechazado";
                            break;
                        
                        
                    }
                },
            ],*/
            //'disponibilidad',

            [
                'label'  => 'Disponibilidad',
                'value'  => function ($model) {
                    switch ($model->disponibilidad) {
                        case 1:
                            return "Disponible";
                            break;
                        case 2:
                            return "Ocupado";
                            break;
                        
                        
                    }
                },
            ],
            //'id_profe_guia',

            [
                'label'  => 'Profesor guía',
                

                'value'  => function ($model) {

                    if ($model->id_profe_guia==null){
                        return "Sin profesor Guía" ;
                     }
                   if ($model->id_profe_guia=!null){

                      return  $model->profeGuia->usuario->nombre;
                   }
                   
                },
            ],

            
            //'id_autor',
            [
                'label'  => 'Autor',
                'value'  => function ($model) {
                    return $model->autor->nombre;
                },
            ],

           
        ],
    ]) ?>


    
</div>

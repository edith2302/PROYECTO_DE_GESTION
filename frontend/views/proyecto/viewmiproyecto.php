<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ProfesorIcinf;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['viewmiproyecto']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-viewmiproyecto">
    
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
           
           // 'area',

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

            [
                'label'  => 'Profesor guía',
                

                'value'  => function ($model) {

                    if ($model->id_profe_guia==null){
                        return "Sin profesor Guía" ;
                     }
                     $idp =$model->id_profe_guia;
                    if ($model->id_profe_guia=!null){
      
                    $profIci = Profesoricinf::findOne($idp);
                   
                    return  $profIci->usuario->nombre." ".$profIci->usuario->apellido;
                   }
                   
                },
            ],

            //'id_autor',
            [
                'label'  => 'Autor',
                'value'  => function ($model) {
                    return $model->autor->nombre." ".$model->autor->apellido;
                },
            ],

        ],
    ]) ?>

</div>

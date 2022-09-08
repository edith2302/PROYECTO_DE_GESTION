<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ProfesorIcinf;
use app\models\Proyecto;
use app\models\Usuario;
use app\models\Desarrollarproyecto;
use app\models\Estudiante;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-viewprofesor">

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
           
           /* [
                'label'  => 'Estado',
                'value'  => function ($model) {
                    switch ($model->estado) {
                        case 1:
                            return "Aprobado";
                            break;
                        case 2:
                            return "Rechazado";
                            break;
                        case 3:
                            return "Pendiente";
                            break;
                        
                    }
                },
            ],*/

            
            //'disponibilidad',
            //'id_profe_guia',

            /*[
                'label'  => 'Profesor guía',
                
                'value'  => function ($model) {

                    if ($model->id_profe_guia==null){
                        return "Sin profesor Guía" ;
                    }
                    $idp =$model->id_profe_guia;
                    if ($model->id_profe_guia=!null){
                        $profIci = ProfesorIcinf::findOne($idp);
                       
                        return  $profIci->usuario->nombre." ".$profIci->usuario->apellido;
                    }
                   
                },
            ],*/

            //'id_autor',

           /* [
                'label'  => 'Desarrollado por',
                'value'  => function ($model) {
                    $desarrollap = Desarrollarproyecto::find()->where(['id_proyecto' => $model->id])->one();
                    if($desarrollap != null){
                        $estudiante = Estudiante::find()->where(['id' => $desarrollap->id_estudiante])->one();
                        $usuario = Usuario::find()->where(['id_usuario' => $estudiante->id_usuario])->one();

                        return $usuario->nombre." ".$usuario->apellido;
                    }
                    return " ";
                    
                },
            ],*/

            [
                'label'  => 'Autor',
                'value'  => function ($model) {
                    return $model->autor->nombre." ".$model->autor->apellido;
                },
            ],

        ],
    ]) ?>
</div>

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
<div class="proyecto-viewocupado2">

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
           // 'id_profe_guia',

            [
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
            ],

            
            //'id_autor',
            [
                'label'  => 'Autor',
                'value'  => function ($model) {
                    return $model->autor->nombre." ".$model->autor->apellido;
                },
            ],

           /* [
                'label'  => 'Desarrollado por',
                'value'  => function ($model) {
                    $desarrollap = Desarrollarproyecto::find()->where(['id_proyecto' => $model->id])->one();
                    $estudiante = Estudiante::find()->where(['id' => $desarrollap->id_estudiante])->one();
                    $usuario = Usuario::find()->where(['id_usuario' => $estudiante->id_usuario])->one();

                    return $usuario->nombre." ".$usuario->apellido;
                },
            ],*/
            [
                'label'  => 'Desarrollado por',
                'value'  => function ($model) {
                    //$proyecto = Proyecto::findOne(['id' => $model->id]);
                    $desarrollap = Desarrollarproyecto::find()->where(['id_proyecto' => $model->id])->one();

                    //-----------------conexion bdd----------------------
                    $bd_name = "yii2advanced";
                    $bd_table = "item";
                    $bd_location = "localhost";
                    $bd_user = "root";
                    $bd_pass = "";

                    // conectarse a la bd
                    $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
                    if(mysqli_connect_errno()){
                        die("Connection failed: ".mysqli_connect_error());
                    }

                    $datos = $conn->query("SELECT * from desarrollarproyecto WHERE desarrollarproyecto.id_proyecto = ".$model->id);

                    $nombres = "";


                    while($students = mysqli_fetch_array($datos )){
                        $estudiante = Estudiante::find()->where(['id' => $students['id_estudiante']])->one();
                        $usuario = Usuario::find()->where(['id_usuario' => $estudiante->id_usuario])->one();
                        $nombres = $nombres."  -- ".$usuario->nombre." ".$usuario->apellido." ";
                    } 
                    //-------------------------------------------------------------------
                    

                    return $nombres;
                },
            ],

           
        ],
    ]) ?>

      <!--<p align="right">
    <?= Html::a('Asignar profesor guía', ['create2', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>-->
    
</div>

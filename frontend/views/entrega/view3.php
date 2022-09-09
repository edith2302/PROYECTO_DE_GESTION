<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

use app\models\Hito;
use app\models\Proyecto;
use app\models\Evaluar;
use app\models\Estudiante;
use app\models\Desarrollarproyecto;
use app\models\Usuario;


/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
$hito=Hito::findOne(['id'=>$model->id_hito]);
$nombrehito=$hito->nombre;
$this->title = 'Entrega de '.$nombrehito;
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entrega-view3">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $evaluacion = Evaluar::find()->where(['id_entrega' => $model->id])->one(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'evidencia',
            //'fecha_entrega',
            [
                'attribute'=>'fecha_entrega',
                'value'=>function ($model) {
                    return $model->fecha_entrega." / ".$model->hora_entrega." hrs";
                },
            ],
            //'hora_entrega',
            [
                'attribute'=>'id_proyecto',
                'value'=>function ($model) {
                    $proyecto = Proyecto::findOne(['id' => $model['id_proyecto']]);
                    return $proyecto->nombre;
                },
            ],
            [
                'label'  => 'Estudiantes',
                'value'  => function ($model) {
                    $proyecto = Proyecto::findOne(['id' => $model['id_proyecto']]);
                    $desarrollap = Desarrollarproyecto::find()->where(['id_proyecto' => $proyecto->id])->one();

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

                    $datos = $conn->query("SELECT * from desarrollarproyecto WHERE desarrollarproyecto.id_proyecto = ".$proyecto->id);

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
            'comentarios', 
            [
                'attribute'=>'nota',
                'value'=>function ($model) {
                    if($model->nota == null){
                        return " ";
                    }
                    return $model->nota;
                },
            ],

            [
                'label'  => 'Comentarios de la evaluación',
                'value'=>function ($model) {
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

                    $datos = $conn->query("SELECT evaluar.comentarios FROM evaluar WHERE evaluar.id_entrega = ".$model->id);

                    $comentario = "";


                    while($comments = mysqli_fetch_array($datos )){

                        $comentario = $comentario."  --  ".$comments['comentarios']." ";
                    } 
                    //-------------------------------------------------------------------
                    return $comentario;
                },
            ],
        ],
    ]) ?>

</div>


<?= GridView::widget([
        'dataProvider' => $modelhito,
        'columns' => [
            
            [
                'header'=>"Archivo adjunto",
                'headerOptions' => ['width' => '105px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:5px 0px 0px 0px;text-align: center;'],
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url, $model, $key) {
                        return ($model['evidencia'] != '') ? Html::a('     <img src="images/iconos/archivos.png" width="50" height="50">', 'archivos/'.$model['evidencia'], ['target' => '_blank']) : '';
                    },
                ],
            ],


            
            
        ],
    ]); ?>





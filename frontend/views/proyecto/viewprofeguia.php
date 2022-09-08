<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ProfesorIcinf;
use app\models\Proyecto;
use app\models\Usuario;
use app\models\Desarrollarproyecto;
use app\models\Estudiante;

use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Hito;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-viewprofeguia">

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

            /*[
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


            [
                'label'  => 'Autor',
                'value'  => function ($model) {
                    return $model->autor->nombre." ".$model->autor->apellido;
                },
            ],

        ],
    ]) ?>


   <!-- <?= GridView::widget([
        'dataProvider' => $modelp,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'label'=>'Nombre hito',
                'value'=>function ($modelp) { return $modelp['nombre']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],


            [
                'label'=>'Fecha habilitación',
                'value'=>function ($modelp) { return $modelp['fecha_habilitacion'].' / '.$modelp['hora_habilitacion']; },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            /*[
                'label'=>'Hora habilitación',
                'value'=>function ($modelp) { return $modelp['hora_habilitacion']; },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],*/

            [
                'label'=>'Fecha límite',
                'value'=>function ($modelp) { return $modelp['fecha_limite'].' / '.$modelp['hora_limite']; },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

           /* [
                'label'=>'Hora límite',
                'value'=>function ($modelp) { return $modelp['hora_limite']; },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],*/

             //'tipo_hito',
            [
                'label' => 'Tipo hito',
                'value' =>

                function ($modelp) {
                    if ($modelp['tipo_hito'] == '0') {
                        return 'Informe (Avance)';
                    };
                    if ($modelp['tipo_hito'] == '1') {
                        return 'Presentación';
                    };
                    if ($modelp['tipo_hito'] == '2') {
                        return 'Defesa de proyecto';
                    };
                    if ($modelp['tipo_hito'] == '3') {
                        return 'Informe final';
                    };
                    return 'ERROR';

                   
                },
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '180px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],


            ],

            [
                'label'=>'Porcentaje nota',
                'value'=>function ($modelp) { return $modelp['porcentaje_nota'].'%'; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '150px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],


           

            [

                'header'=>"Acción",
                'headerOptions' => ['width' => '100px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
                'class' => ActionColumn::className(),
                'template'=>'{view}',

                'urlCreator' => function ($action, $modelp, $key, $index, $column) {
                    $proy = Proyecto::find()->where(['id' => $idpro])->one();
                    //$url ='index.php?r=proyecto%2Fviewentregapg&id='.$model['id'];
                    $url ='index.php?r=hito%2Fviewentregapg&id='.$modelp['id'].'&idp='.$model->id;
                    return $url;
                }
            ],
        ],
    ]); ?> -->
</div>

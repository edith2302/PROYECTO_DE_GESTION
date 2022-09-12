<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Item;

use app\models\Profesoricinf;
use app\models\Usuario;
use app\models\Hito;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */

$hito = Hito::findOne(['id'=>$model->id_hito]);
$this->title = "Entrega de Hito ".$hito->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entrega-viewf">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'evidencia',
            [
                'label'  => 'Proyecto',
                'value'  => function ($model) {
                    return $model->proyecto->nombre;
                },
            ],
            
            //'fecha_entrega',
            //'hora_entrega',
            //'comentarios',
            //'id_proyecto',
            [
                'label'=>'Fecha entrega',
                'value'=>function ($model) { return $model->fecha_entrega; },
                //'filter'=>false,
                'format'=>'date',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
  
            [
                'label'=>'Hora entrega',
                'value'=>function ($model) { return $model->hora_entrega." hrs"; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],
            
            'comentarios',
            //'id_hito',
            [
                'label'  => 'Evaluador',
                'value'  => function ($model) {

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

                    $datos = $conn->query("SELECT * from evaluadorf WHERE id_entrega = ".$model['id']);

                    $evaluador = "";

                    //return $model['id'];
                    while($evaluadores = mysqli_fetch_array($datos )){
                        $ev = $evaluadores['id_profesor'];
                        $profeicii = Profesoricinf::find()->where(['id' => $ev])->one();
                        $usuario = Usuario::find()->where(['id_usuario' => $profeicii->id_usuario])->one();
                        $nombres = $nombres."  -- ".$usuario->nombre." ".$usuario->apellido." ";
                    } 
                    //-------------------------------------------------------------------
                    

                    return $nombres;
                },
            ],

          /*  [
                'label'  => 'Archivo adjunto',
                'value'  => function ($model) {
                    return (($model->evidencia != '') ? Html::a('     <img src="images/iconos/archivos.png" width="32" height="32">', $model->evidencia, ['target' => '_blank']) : '');
                },
            ],*/
        ],

    ]) ?>

   
    
</div>

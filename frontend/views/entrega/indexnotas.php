<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Entrega;
use app\models\Proyecto;
use app\models\Hito;
use yii\widgets\DetailView;
use app\models\Desarrollarproyecto;
use app\models\Estudiante;
//use Yii;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-indexnotas">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $modelentregas,
        'columns' => [

            [
                //'attribute'=>'id_proyecto',
                'label'=>"Hito",
                'value'=>function ($model) {
                    $hito = Hito::findOne(['id' => $model['id_hito']]);
                    return $hito->nombre;
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '350px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],
            [
                'label'=>'Porcentaje de nota',
                'value'=>function ($model) {
                    $hito = Hito::findOne(['id' => $model['id_hito']]);
                    return $hito->porcentaje_nota."%";
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '350px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],
            [
                'label'=>'Nota',
                'value'=>function ($model) {
                    return $model['nota'];
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '350px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:15px 0px 0px 0px;text-align: center;'],
            ],
           //'nota',
            
        ],
    ]); ?>

</div>

<?php

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

    $usuario = Yii::$app->user->identity->id_usuarioo;
    $estudiante = Estudiante::findOne(['id_usuario'=>$usuario]);
    $desarrollar = Desarrollarproyecto::findOne(['id_estudiante'=>$estudiante]);
    $proyecto = Proyecto::findOne(['id'=>$desarrollar->id_proyecto]);
    $idpro = $proyecto->id;

    $datos = $conn->query("select entrega.nota, entrega.id_hito, hito.porcentaje_nota from entrega JOIN hito ON entrega.id_hito = hito.id where id_proyecto = ".$idpro);

    $prom = 0;

    while($notass = mysqli_fetch_array($datos )){
        $notaa = $notass['nota'];
        $porcent = $notass['porcentaje_nota'];
        $prom = $prom + ($notaa * ($porcent/100));
    } 
    //-------------------------------------------------------------------
    

?>
<b><?= "Promedio: "?></b><?=$prom  ?>

<h4><?= "Promedio: ".$prom ?></h4>


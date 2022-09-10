<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Item;
use app\models\Entrega;
use app\models\Rubrica;
use app\models\Hito;

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

   <!--p align="right">
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de eliminar la rúbrica seleccionada?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Agregar ítem', ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Evaluar', ['evaluar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'descripcion',
            //'puntaje',
        
            'puntaje_obtenido',   
        ],
    ]); ?>


<!--<?php if (!$dataProvider2==null){
    echo GridView::widget([
        'dataProvider' => $dataProvider2,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'descripcion',
            //'puntaje',
            //'puntajeideal',
            //'puntajeobtenido',
            //'nota',
            [
               // 'attribute'=>'puntajeideal',
                'label' => 'Puntaje ideal',
                'value'=>function ($model) { 


                   // $entrega = Entrega::find()->where(['id' => $ide])->one();
                   // $hito = Hito::find()->where(['id' => $entrega->id_hito])->one();
                   // $rubrica = Rubrica::find()->where(['id' => $hito->id_rubrica])->one();
                   // $idr = $rubrica->id;
        
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
                       // $datos =$conn->query("SELECT * FROM item");

        
                        $total_items = $conn->query("select COUNT(*) as total from item where item.id_rubrica = ".$model['id_rubrica']);
                    
                        while($items = mysqli_fetch_array($total_items)){
                            $total_it = $items['total'];
                            
                        } 
                        $puntaje_ideal = $total_it*7;
            
                    return $puntaje_ideal; 
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], 
            [
                //'attribute'=>'puntajeobtenido',
                'label' => 'Puntaje ontenido',
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
                        $datos =$conn->query("SELECT * FROM item");
    
        
                        $puntaje = $conn->query("select SUM(puntaje_obtenido) as puntaje_obtenido from item where item.id_rubrica = ".$model['id_rubrica']);
        
                        while($calificacion = mysqli_fetch_array($puntaje)){
        
                            $puntajeobt = $calificacion['puntaje_obtenido'];
        
                        } 

                    return $puntajeobt; 
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ], 
            [
                'attribute'=>'nota',
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

                    $total_items = $conn->query("select COUNT(*) as total from item where item.id_rubrica = ".$model['id_rubrica']);
                
                    while($items = mysqli_fetch_array($total_items)){
                        $total_it = $items['total'];
                        
                    } 
                    $puntaje_ideal = $total_it*7;
        
                    $puntaje = $conn->query("select SUM(puntaje_obtenido) as puntaje_obtenido from item where item.id_rubrica = ".$model['id_rubrica']);

                    while($calificacion = mysqli_fetch_array($puntaje)){

                        $puntajeobt = $calificacion['puntaje_obtenido'];

                    } 
                    $calificac = $puntajeobt/$total_it;
                    $notaa = round($calificac, 1);
                    
                    return $notaa; 
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],  
        ],
    ]); } ?>-->
</div>

<div >
    <table border="1">
        <thead>
            <tr>  
                <td style="width: 170px; text-align:center">Puntaje Ideal</td>
                <td style="width: 170px; text-align:center">Puntaje Obtenido</td>
                <td style="width: 170px; text-align:center">Nota</td>
            </tr>
        </thead>

        
        <?php

            echo "<tr>\n";

            echo '<td style="width: 100px; text-align:center">';
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
           // $datos =$conn->query("SELECT * FROM item");


            $total_items = $conn->query("select COUNT(*) as total from item where item.id_rubrica = ".$model['id']);
        
            while($items = mysqli_fetch_array($total_items)){
                $total_it = $items['total'];
                
            } 
            $puntaje_ideal = $total_it*7;
            echo  $puntaje_ideal;
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
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
            $datos =$conn->query("SELECT * FROM item");


            $puntaje = $conn->query("select SUM(puntaje_obtenido) as puntaje_obtenido from item where item.id_rubrica = ".$model['id']);

            while($calificacion = mysqli_fetch_array($puntaje)){

                $puntajeobt = $calificacion['puntaje_obtenido'];

            } 

            echo $puntajeobt;
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
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

                    $total_items = $conn->query("select COUNT(*) as total from item where item.id_rubrica = ".$model['id']);
                
                    while($items = mysqli_fetch_array($total_items)){
                        $total_it = $items['total'];
                        
                    } 
                    $puntaje_ideal = $total_it*7;
        
                    $puntaje = $conn->query("select SUM(puntaje_obtenido) as puntaje_obtenido from item where item.id_rubrica = ".$model['id']);

                    while($calificacion = mysqli_fetch_array($puntaje)){

                        $puntajeobt = $calificacion['puntaje_obtenido'];

                    } 
                    $calificac = $puntajeobt/$total_it;
                    $notaa = round($calificac, 1);    
            echo $notaa;
            echo "</td>\n";

            echo "</tr>";

        ?>
    </table>
</div>


<div class="form-group">
    <?= Html::a('Enviar', ['evaluar/create','ide' => $modelentrega->id], ['class' => 'btn btn-primary']) ?>
</div>


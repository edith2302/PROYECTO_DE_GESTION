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
use app\models\Usuario;
//use Yii;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>

<table >
    <!--<thead>-->
        <table border="1">
            <tr>
                <th>N°</th>
                <th>Estudiante</th>
            
                <?php


                //-----------------conexion bdd----------------------
                $bd_name = "yii2advanced";
                $bd_location = "localhost";
                $bd_user = "root";
                $bd_pass = "";

                // conectarse a la bd
                $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
                if(mysqli_connect_errno()){
                    die("Connection failed: ".mysqli_connect_error());
                }
                $datos = $conn->query("SELECT hito.nombre, hito.porcentaje_nota as porcentaje, hito.id as id_hito, entrega.id as id_entrega, entrega.nota, entrega.id_proyecto, entrega.id_hito from entrega JOIN hito ON entrega.id_hito = hito.id");

                while($hitos = mysqli_fetch_array( $datos )){
                    $id_proyecto = $hitos['id_proyecto'];
                    $desarrolaP = Desarrollarproyecto::findOne(['id_proyecto' => $id_proyecto]);

                    $hitoo = $hitos['nombre']." (".$hitos['porcentaje']."%)";
                    ?> 
                    <th> <?php echo $hitoo ?>  </th>

                    <?php
                }

            ?>
            <th>Promedio</th>
        </tr>
<!--    </thead>-->

    <?php

        //-----------------conexion bdd----------------------
        $bd_name = "yii2advanced";
        $bd_location = "localhost";
        $bd_user = "root";
        $bd_pass = "";

        // conectarse a la bd
        $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
        if(mysqli_connect_errno()){
            die("Connection failed: ".mysqli_connect_error());
        }
        $estudiantes = $conn->query("SELECT usuario.id_usuario, usuario.nombre, usuario.apellido, estudiante.id as id_estudi FROM usuario JOIN estudiante on usuario.id_usuario = estudiante.id_usuario");
        

        $num =0;
        while($estudiante = mysqli_fetch_array( $estudiantes )){
            $num= $num+1;
            echo "<tr>\n";
            echo "<td>";
            echo $num;
            echo "</td>\n";

            $nombree = $estudiante['nombre']." ".$estudiante['apellido'];
            echo "<td>";
            echo  $nombree;
            echo "</td>\n";

            echo "</tr>\n";

        }

    //-----------------conexion bdd----------------------
    
    /*while($profesores = mysqli_fetch_array( $losprofesores )){
      
       $num= $num+1;
        echo "<tr>\n";

        echo "<td>";
        echo $num;
        echo "</td>\n";

        
        $formatRut = $profesores['rut'];
        $rutt = "";
        
        
        
    
        echo "<td>";
        echo $rutt;
        echo "</td>\n";

        echo "<td>";
        echo $profesores['nombre']." ".$profesores['apellido'] ;
        echo "</td>\n";

        echo "<td>";
        echo $profesores['email'];
        echo "</td>\n";

        echo "<td>";
        echo $profesores['area'];
        echo "</td>\n";
        echo "</tr>";
    } */
    //-------------------------------------------------------------------

?>
</table>
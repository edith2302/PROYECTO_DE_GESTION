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
                //$datos = $conn->query("SELECT hito.nombre, hito.porcentaje_nota as porcentaje, hito.id as id_hito, entrega.id as id_entrega, entrega.nota, entrega.id_proyecto, entrega.id_hito from entrega JOIN hito ON entrega.id_hito = hito.id");
                $datos = $conn->query("SELECT hito.nombre, hito.porcentaje_nota as porcentaje, hito.id as id_hito from hito");

                $num =0;
               

                while($hitos = mysqli_fetch_array( $datos )){
                   
                    $id_proyecto = $hitos['id_proyecto'];
                    $desarrolaP = Desarrollarproyecto::findOne(['id_proyecto' => $id_proyecto]);

                    $hitoo = $hitos['nombre']." (".$hitos['porcentaje']."%)";
                    //$num++;
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
        $estudiantes = $conn->query("SELECT usuario.id_usuario, usuario.nombre, usuario.apellido, estudiante.id as id_estudi FROM usuario JOIN estudiante on usuario.id_usuario = estudiante.id_usuario ORDER BY usuario.apellido ASC");
        
        $cont =0;
        $id_Est="";
        
        
        while($estudiante = mysqli_fetch_array( $estudiantes )){
            $id_Est= $estudiante['id_estudi'];
            $prom = 0;
            $num= $num+1;
            echo "<tr>\n";
            echo "<td>";
            echo $num;
            echo "</td>\n";

            $nombree = $estudiante['nombre']." ".$estudiante['apellido'];
            echo "<td>";
            echo  $nombree;
            echo "</td>\n";


            $notas_estudiantes = $conn->query("SELECT entrega.id as id_entrega, entrega.nota, entrega.id_proyecto as idpro, entrega.id_hito as idhito, estudiante.id as idestudiant, estudiante.id_usuario, usuario.nombre, hito.porcentaje_nota as porcentaje FROM entrega join hito on entrega.id_hito = hito.id join desarrollarproyecto on entrega.id_proyecto=desarrollarproyecto.id_proyecto join estudiante on desarrollarproyecto.id_estudiante = estudiante.id join usuario on estudiante.id_usuario = usuario.id_usuario WHERE desarrollarproyecto.id_estudiante = ".$id_Est);

            while($notass_e = mysqli_fetch_array( $notas_estudiantes )){
                echo "<td>";
                echo  $notass_e['nota'];
                echo "</td>\n";

                $prom = $prom +($notass_e['nota'] * $notass_e['porcentaje'] / 100);
            }

           /* echo "<td>";
            echo  " ";
            echo "</td>\n";*/

            echo "<td>";

            $porcent = $conn->query("SELECT SUM(hito.porcentaje_nota) as total_porcent from hito");

            while($porc = mysqli_fetch_array($porcent )){
                $porcentajee = $porc['total_porcent'];
            } 
            if($porcentajee == 100){
                echo  round($prom, 1);
            }
            echo  "0";
            echo "</td>\n";

            echo "</tr>\n";

        }

?>
</table>
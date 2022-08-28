<?php
    use app\models\Usuario;
?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaHitos.css'?>">


<table  style="width:100%">
   <tr>
     <th>
     <img src="<?= Yii::$app->request->baseUrl.'/images/logo3.png'?>"width="200" heigth="150">
     </th>
      <td style="text-align: right">

        <!--<br><h4><?php echo $titulo;?></h4></br>-->
      </td>
 </tr>
</table>


<p align="center">
    <br><h4><?php echo $titulo;?></h4></br><br>
</p>
      


<table class ="blueTable">
    <thead>
        <tr>
            <!--<td><b>N°</b></td>-->
            <td><b>Nombre Hito</b></td>
            <td><b>Fecha habilitación</b></td>
            <td><b>Fecha límite</b></td>
            <td><b>Tipo de hito</b></td>
            <td><b>Porcentaje nota</b></td>
        </tr>
    </thead>

    <?php
   foreach ($hitos as $hito){

    /*$num= $num+1;
    echo "<tr>\n";
    echo "<td>";
    echo $hito['num'];
    echo "</td>\n";*/

        echo "<td>";
        echo $hito['nombre'] ;
        echo "</td>\n";

        echo "<td>";
        echo $hito['fecha_habilitacion'];
        echo "</td>\n";

        echo "<td>";
        echo $hito['fecha_limite'];
        echo "</td>\n";
        echo "</tr>";

        echo "<td>";
        echo $hito['tipo_hito'];
        echo "</td>\n";
        echo "</tr>";

        echo "<td>";
        echo $hito['porcentaje_nota'];
        echo "</td>\n";
        echo "</tr>";
  
   }
?>
</table>

<br> <i><?php  echo "Reporte generado con fecha: ".$fecha;?> </i> </br>
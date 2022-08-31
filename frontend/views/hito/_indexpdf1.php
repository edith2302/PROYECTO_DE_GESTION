<?php
    use app\models\Usuario;
?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaHito.css'?>">


<table  style="width:100%">
   <tr>
     <th>
     <img src="<?= Yii::$app->request->baseUrl.'/images/logo3.png'?>"width="200" heigth="150">
     </th>
      <td style="text-align: center">

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
         
            <td style="width: 170px; text-align:center"><b>Nombre hito</b></td>
            <td style="width: 170px; text-align:center"><b>Fecha habilitación</b></td>
            <td style="width: 170px; text-align:center"><b>Fecha limite</b></td>
            <!--<td><b>Tipo de hito</b></td>-->
            <td style="width: 170px; text-align:center"><b>Porcentaje nota</b></td>
          
        </tr>
    </thead>
    <!--<tbody>-->
    <?php 
        foreach ($hitos as $hito){

            echo "<tr>";
            echo '<td style="width: 170px; text-align:center">';
            echo $hito['nombre'] ;
            echo "</td>\n";

            echo '<td style="width: 170px; text-align:center">';
            echo $hito['fecha_habilitacion'];
            echo "</td>\n";

            echo '<td style="width: 170px; text-align:center">';
            echo $hito['fecha_limite'];
            echo "</td>\n";

           /* echo "<td>";
            echo $hito['tipo_hito'];
            echo "</td>\n";*/

            echo '<td style="width: 140px; text-align:center">';
            echo $hito['porcentaje_nota'];
            echo "</td>\n";
            echo "</tr>";
        } 
 
    ?>
    <!--</tbody>-->
</table>

<br> <i><?php  echo "Reporte generado con fecha: ".$fecha;?> </i> </br>
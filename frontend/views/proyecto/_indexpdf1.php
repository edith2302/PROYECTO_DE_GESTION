<?php
    use app\models\Usuario;
?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaProyectos.css'?>">


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
         
        
        <td style="width: 170px; text-align:center"><b>Nombre proyecto</b></td>
        <td style="width: 170px; text-align:center"><b>Número de integrantes</b></td>
        <td style="width: 170px; text-align:center"><b>Tipo</b></td>
        <td style="width: 170px; text-align:center"><b>Área</b></td>
          
        </tr>
    </thead>
    <!--<tbody>-->
    <?php 
        foreach ($proyectos as $proyecto){

            
            echo "<tr>";
            echo '<td style="width: 400px; text-align:center">';
            echo $proyecto['nombre'] ;
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo $proyecto['num_integrantes'];
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo $proyecto['tipo'];
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo $proyecto['area'];
            echo "</td>\n";
            echo "</tr>";
        } 
 
    ?>
    <!--</tbody>-->
</table>

<br> <i><?php  echo "Reporte generado con fecha: ".$fecha;?> </i> </br>
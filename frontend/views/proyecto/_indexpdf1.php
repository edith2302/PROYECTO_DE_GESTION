<?php
    use app\models\Usuario;
?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaProyectos.css'?>">


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
         
            <td><b>Nombre proyecto</b></td>
            <td><b>Número de integrantes</b></td>
            <td><b>Tipo</b></td>
            <td><b>Área</b></td>
          
        </tr>
    </thead>

    <?php
   foreach ($proyectos as $proyecto){

        echo "<td>";
        echo $proyecto['nombre'] ;
        echo "</td>\n";

        echo "<td>";
        echo $proyecto['num_integrantes'];
        echo "</td>\n";


        echo "<td>";
        echo $proyecto['tipo'];
        echo "</td>\n";

        echo "<td>";
        echo $proyecto['area'];
        echo "</td>\n";
        echo "</tr>";
    } 
    //-------------------------------------------------------------------

?>
</table>

<br> <i><?php  echo "Reporte generado con fecha: ".$fecha;?> </i> </br>
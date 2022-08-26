<?php

?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaEstudiantes.css'?>">


<table  style="width:100%">
   <tr>
     <th>
        <img src="<?= Yii::$app->request->baseUrl.'/images/logo3.png'?>"width="200" heigth="150">
     </th>
      <td style="text-align: center">
      <h4><?php echo $titulo;?></h4>
      </td>
 </tr>
</table>


<?php echo "Reporte generado con fecha: ".$fecha;?>  




<table class ="blueTable">
    <thead>
        <tr>
            <td><b>Nombre</b></td>
            <td><b>Rut</b></td>
            <td><b>Email</b></td>
            <td><b>Teléfono</b></td>
        </tr>
    </thead>

    <?php
    foreach ($estudiantes as $estu){

        echo "<tr>\n";
           echo "<td>";
            echo $estu->nombre;
            echo "</td>\n";
           echo "<td>";

           echo $estu->rut;
            echo "</td>\n";
           echo "<td>";

           echo $estu->email;
            echo "</td>\n";
           echo "<td>";
           echo $estu->telefono;
            echo "</td>\n";
           echo "<td>";
    }

?>
</table>
<?php
    use app\models\Usuario;
?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaEstudiantes.css'?>">


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
            <td><b>N°</b></td>
            <td><b>Rut</b></td>
            <td><b>Nombre</b></td>
            <td><b>Email</b></td>
            <td><b>Teléfono</b></td>
        </tr>
    </thead>

    <?php
   /* foreach ($estudiantes as $estu){

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
    }*/

    //-----------------conexion bdd----------------------
    $bd_name = "yii2advanced";
    $bd_table = "usuario";
    $bd_location = "localhost";
    $bd_user = "root";
    $bd_pass = "";

    // conectarse a la bd
    $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
    if(mysqli_connect_errno()){
        die("Connection failed: ".mysqli_connect_error());
    }
    $losestudiantes = $conn->query("SELECT * FROM usuario WHERE usuario.id_usuario IN (SELECT id_usuarioo FROM user WHERE user.role = 2)");
    $num =0;
    while($estudiantes = mysqli_fetch_array($losestudiantes )){
       // $lista = $estudiantes['nombre'];
       $num= $num+1;
        echo "<tr>\n";

        echo "<td>";
        echo $num;
        echo "</td>\n";

        echo "<td>";
        echo $estudiantes['rut'];
        echo "</td>\n";

        echo "<td>";
        echo $estudiantes['nombre']." ".$estudiantes['apellido'] ;
        echo "</td>\n";

        echo "<td>";
        echo $estudiantes['email'];
        echo "</td>\n";

        echo "<td>";
        echo $estudiantes['telefono'];
        echo "</td>\n";
        echo "</tr>";
    } 
    //-------------------------------------------------------------------

?>
</table>

<br> <i><?php  echo "Reporte generado con fecha: ".$fecha;?> </i> </br>
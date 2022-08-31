<?php
    use app\models\Usuario;
?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaProfesores.css'?>">


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
        <td style="width: 170px; text-align:center"><b>Rut</b></td>
        <td style="width: 170px; text-align:center"><b>Nombre</b></td>
        <td style="width: 170px; text-align:center"><b>Email</b></td>
        <td style="width: 170px; text-align:center"><b>Área</b></td>
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
    $losprofesores = $conn->query("SELECT usuario.id_usuario, usuario.nombre, usuario.apellido,usuario.rut, profesoricinf.area, user.email FROM usuario JOIN profesoricinf on usuario.id_usuario = profesoricinf.id_usuario JOIN user on user.id_usuarioo=usuario.id_usuario WHERE user.role = 3");
    $num =0;
    while($profesores = mysqli_fetch_array( $losprofesores )){
      
       $num= $num+1;
        echo "<tr>\n";

        echo "<td>";
        echo $num;
        echo "</td>\n";

        
        $formatRut = $profesores['rut'];
        $rutt = "";
        //si el rut está con formato, solo lo muestra
        if ((strpos($formatRut, ".") !== false) && (strpos($formatRut, "-") !== false)) {
            $rutt = $profesores['rut'];
                
        }else{
            //si el rut está con guión, lo formatea
            if (strpos($formatRut, '-') !== false ) {

                $splittedRut = explode('-', $formatRut);
                $number = number_format($splittedRut[0], 0, ',', '.');
                $verifier = strtoupper($splittedRut[1]);
                $rutt = $number . '-' . $verifier;
            }else{
                //si no tiene punto ni guión
                if(!((strpos($formatRut, ".") !== false) && (strpos($formatRut, "-") !== false))){
                    $largo = strlen($formatRut);
                    $resultado = substr($formatRut, 0, $largo-1 ); 
                    $verifi = substr($formatRut, $largo-1);
                    $number =  number_format($resultado, 0, ',', '.');
                    $rutt = $number."-".$verifi;
                    
                }
                //si el rut está con puntos sin guión, lo formatea
                if (strpos($formatRut, '.') !== false ) {
                    $largo = strlen($formatRut);
                    $resultado = substr($formatRut, 0, $largo-1 ); 
                    $verifi = substr($formatRut, $largo-1);
                    $rutt = $resultado."-".$verifi;
                }

            }
        }
        
    
        echo '<td style="width: 100px; text-align:center">';
        echo $rutt;
        echo "</td>\n";

        echo '<td style="width: 180px; text-align:center">';
        echo $profesores['nombre']." ".$profesores['apellido'] ;
        echo "</td>\n";

        echo '<td style="width: 180px; text-align:center">';
        echo $profesores['email'];
        echo "</td>\n";

        echo '<td style="width: 180px; text-align:center">';
        echo $profesores['area'];
        echo "</td>\n";
        echo "</tr>";
    } 
    //-------------------------------------------------------------------

?>
</table>

<br> <i><?php  echo "Reporte generado con fecha: ".$fecha;?> </i> </br>
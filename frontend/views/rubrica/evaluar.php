<?php

use yii\helpers\Html;
use app\models\Rubrica;

/* @var $this yii\web\View */
/* @var $modelRubrica app\models\Rubrica */
//$modelentrega = $this->findModel($ide);
//$this->title = $modelRubrica->nombre;
$this->title = "Evaluación";
$this->params['breadcrumbs'][] = ['label' => 'Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelRubrica->nombre, 'url' => ['view', 'id' => $modelRubrica->id]];
$this->params['breadcrumbs'][] = 'Evaluación';
?>
<div class="rubrica-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><?=($modelRubrica ->descripcion)?></br>
    
    <br><?=("*Asignar puntaje según corresponda")?></br>
    <br>
    <!--//----------------- -->


    <table border="1">
        <thead>
            <tr>  
                <td  style="width: 170px; text-align:center">7</td>
                <td style="width: 170px; text-align:center">6</td>
                <td style="width: 170px; text-align:center">5</td>
                <td style="width: 170px; text-align:center">4</td>
                <td style="width: 170px; text-align:center">3</td>
                <td style="width: 170px; text-align:center">2</td>
                <td style="width: 170px; text-align:center">1</td>
            </tr>
        </thead>

        
        <?php

            echo "<tr>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo "Excelente";
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo "Bien";
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo "Moderado";
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo "Suficiente";
            echo "</td>\n";

            echo '<td style="width: 100px; text-align:center">';
            echo "Menos que suficiente";
            echo "</td>\n";  

            echo '<td style="width: 100px; text-align:center">';
            echo "En escasa medida";
            echo "</td>\n"; 
            
            echo '<td style="width: 100px; text-align:center">';
            echo "No cumple";
            echo "</td>\n";

            echo "</tr>";

        ?>
    </table>
    <!--------------------- -->

    <?= $this->render('_formevaluar', [
        'modelentrega' =>$modelentrega,
        'modelRubrica' => $modelRubrica,
        'modelsItem'=>$modelsItem,
        'msg' => $msg,
    ]) ?>

</div>

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
    <br></br>

    <?= $this->render('_formevaluar', [
        'modelentrega' =>$modelentrega,
        'modelRubrica' => $modelRubrica,
        'modelsItem'=>$modelsItem,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelHito app\models\Hito */
/* @var $modelsEvaluador app\models\Evaluador */

$this->title = 'Agregar Evaluador al hito '.$modelHito->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hito-create3">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'modelHito' => $modelHito,
        'modelsEvaluador' =>$modelsEvaluador,
    ]) ?>
</div>

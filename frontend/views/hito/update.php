<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelHito app\models\Hito */

$this->title = 'Actualizar Hito: ' . $modelHito->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelHito->id, 'url' => ['view', 'id' => $modelHito->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="hito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelHito' => $modelHito,
        'modelsEvaluador' =>$modelsEvaluador,
    ]) ?>

</div>

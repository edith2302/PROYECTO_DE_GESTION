<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelHito app\models\Hito */
/* @var $modelsEvaluador app\models\Evaluador */

$this->title = 'Agregar Hito';
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hito-evaluadorfinal">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formevaluadorfinal', [
        'modelEntrega' => $modelEntrega,
        'modelsEvaluador' =>$modelsEvaluador,
    ]) ?>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */

$this->title = 'Agregar Hito';
$this->params['breadcrumbs'][] = ['label' => 'Hitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hito-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelHito' => $modelHito,
        'modelsEvaluador' =>$modelsEvaluador,
    ]) ?>

</div>

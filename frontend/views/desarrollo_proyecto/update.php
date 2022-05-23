<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DesarrollarProyecto */

$this->title = 'Update Desarrollar Proyecto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Desarrollar Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="desarrollar-proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

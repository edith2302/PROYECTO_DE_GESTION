<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JefaturaCarrera */

$this->title = 'Update Jefatura Carrera: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jefatura Carreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jefatura-carrera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

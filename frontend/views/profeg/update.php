<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfesorGuia */

$this->title = 'Update Profesor Guia: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profesor Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profesor-guia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

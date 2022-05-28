<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Defensaproyecto */

$this->title = 'Modificar defensa de proyecto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Modificación defensa proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="defensaproyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

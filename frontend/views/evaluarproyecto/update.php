<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluarproyecto */

$this->title = 'Update Evaluarproyecto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluarproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluarproyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

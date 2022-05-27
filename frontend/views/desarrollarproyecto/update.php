<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Desarrollarproyecto */

$this->title = 'Update Desarrollarproyecto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Desarrollarproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="desarrollarproyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

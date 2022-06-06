<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesoricinf */

$this->title = 'Modificar profesor ICINF: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profesoricinfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="profesoricinf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

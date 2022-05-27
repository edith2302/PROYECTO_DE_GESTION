<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluardefensa */

$this->title = 'Update Evaluardefensa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluardefensas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluardefensa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

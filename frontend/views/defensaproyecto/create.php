<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Defensaproyecto */

$this->title = 'Create Defensaproyecto';
$this->params['breadcrumbs'][] = ['label' => 'Defensaproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="defensaproyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
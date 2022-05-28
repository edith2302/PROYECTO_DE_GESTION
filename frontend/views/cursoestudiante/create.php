<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cursoestudiante */

$this->title = 'Agregar estudiante al curso';
$this->params['breadcrumbs'][] = ['label' => 'Agregar estudiante', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursoestudiante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

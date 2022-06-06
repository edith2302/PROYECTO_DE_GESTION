<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesorasignatura */

$this->title = 'Agregar Profesor de asignatura';
$this->params['breadcrumbs'][] = ['label' => 'Profesor asignatura', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesorasignatura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

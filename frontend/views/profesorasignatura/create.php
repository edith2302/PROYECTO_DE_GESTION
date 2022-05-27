<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesorasignatura */

$this->title = 'Create Profesorasignatura';
$this->params['breadcrumbs'][] = ['label' => 'Profesorasignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesorasignatura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JefaturaCarrera */

$this->title = 'Create Jefatura Carrera';
$this->params['breadcrumbs'][] = ['label' => 'Jefatura Carreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jefatura-carrera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

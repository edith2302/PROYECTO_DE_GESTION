<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DefensaProyecto */

$this->title = 'Create Defensa Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Defensa Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="defensa-proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

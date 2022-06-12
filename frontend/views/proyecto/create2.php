<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Asignar profesor guía a ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Asignar profesor';
?>
<div class="proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>

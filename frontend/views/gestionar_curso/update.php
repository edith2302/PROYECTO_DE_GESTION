<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GestionarCurso */

$this->title = 'Update Gestionar Curso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gestionar Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gestionar-curso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

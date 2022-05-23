<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GestionarCurso */

$this->title = 'Create Gestionar Curso';
$this->params['breadcrumbs'][] = ['label' => 'Gestionar Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestionar-curso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

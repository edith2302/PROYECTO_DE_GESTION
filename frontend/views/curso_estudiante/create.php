<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CursoEstudiante */

$this->title = 'Create Curso Estudiante';
$this->params['breadcrumbs'][] = ['label' => 'Curso Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curso-estudiante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jefaturacarrera */

$this->title = 'Modificar jefe/a de carrera: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jefatura carrera', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="jefaturacarrera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

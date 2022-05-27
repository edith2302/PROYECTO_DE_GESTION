<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gestionarcurso */

$this->title = 'Update Gestionarcurso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gestionarcursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gestionarcurso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

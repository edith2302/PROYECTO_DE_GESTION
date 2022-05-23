<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DesarrollarProyecto */

$this->title = 'Create Desarrollar Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Desarrollar Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrollar-proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

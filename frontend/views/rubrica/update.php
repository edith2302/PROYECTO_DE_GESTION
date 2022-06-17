<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */

$this->title = 'Modificar rúbrica: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar rúbrica';
?>
<div class="rubrica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
        'modelsItem'=>$modelsItem,
    ]) ?>

</div>

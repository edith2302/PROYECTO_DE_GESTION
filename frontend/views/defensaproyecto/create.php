<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Defensaproyecto */

$this->title = 'Agregar defensa de proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Defensa de proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="defensaproyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

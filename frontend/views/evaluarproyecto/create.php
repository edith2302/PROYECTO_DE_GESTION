<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluarproyecto */

$this->title = 'Create Evaluarproyecto';
$this->params['breadcrumbs'][] = ['label' => 'Evaluarproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluarproyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

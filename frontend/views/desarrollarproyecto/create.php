<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Desarrollarproyecto */

$this->title = 'Create Desarrollarproyecto';
$this->params['breadcrumbs'][] = ['label' => 'Desarrollarproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrollarproyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

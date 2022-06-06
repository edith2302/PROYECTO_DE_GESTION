<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesoricinf */

$this->title = 'Agregar profesor';
$this->params['breadcrumbs'][] = ['label' => 'Profesor ICINF', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesoricinf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

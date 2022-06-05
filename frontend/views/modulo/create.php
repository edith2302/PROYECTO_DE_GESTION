<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modulo */

$this->title = 'Agregar archivo al módulo';
$this->params['breadcrumbs'][] = ['label' => 'Módulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modulo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cursoestudiante */

$this->title = 'Create Cursoestudiante';
$this->params['breadcrumbs'][] = ['label' => 'Cursoestudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursoestudiante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

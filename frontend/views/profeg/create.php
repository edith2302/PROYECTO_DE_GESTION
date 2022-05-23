<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfesorGuia */

$this->title = 'Create Profesor Guia';
$this->params['breadcrumbs'][] = ['label' => 'Profesor Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesor-guia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

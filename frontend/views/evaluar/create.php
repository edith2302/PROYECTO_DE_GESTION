<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluar */

$this->title = 'Create Evaluar';
$this->params['breadcrumbs'][] = ['label' => 'Evaluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

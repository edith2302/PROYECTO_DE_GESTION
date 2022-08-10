<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluador */

$this->title = 'Create Evaluador';
$this->params['breadcrumbs'][] = ['label' => 'Evaluadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

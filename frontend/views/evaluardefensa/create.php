<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluardefensa */

$this->title = 'Create Evaluardefensa';
$this->params['breadcrumbs'][] = ['label' => 'Evaluardefensas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluardefensa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

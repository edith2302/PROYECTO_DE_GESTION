<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComisionEvaluadora */

$this->title = 'Create Comision Evaluadora';
$this->params['breadcrumbs'][] = ['label' => 'Comision Evaluadoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comision-evaluadora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

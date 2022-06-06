<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comisionevaluadora */

$this->title = 'Agregar profesor a comisión';
$this->params['breadcrumbs'][] = ['label' => 'Comisión evaluadora', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comisionevaluadora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

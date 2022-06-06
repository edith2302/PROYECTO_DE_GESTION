<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesorguia */

$this->title = 'Agregar profesor guía';
$this->params['breadcrumbs'][] = ['label' => 'Profesores guías', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesorguia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

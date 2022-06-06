<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jefaturacarrera */

$this->title = 'Agregar Jefe/a de carrera';
$this->params['breadcrumbs'][] = ['label' => 'Jefatura carrera', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jefaturacarrera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

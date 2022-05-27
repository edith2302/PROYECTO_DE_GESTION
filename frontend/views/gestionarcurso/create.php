<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gestionarcurso */

$this->title = 'Create Gestionarcurso';
$this->params['breadcrumbs'][] = ['label' => 'Gestionarcursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestionarcurso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rolusuario */

$this->title = 'Agregar rol usuario';
$this->params['breadcrumbs'][] = ['label' => 'Rol usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolusuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

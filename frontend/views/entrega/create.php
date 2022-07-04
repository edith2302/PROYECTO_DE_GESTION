<?php

use yii\helpers\Html;
use app\models\Hito;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */




$hito=Hito::findOne(['id'=>$model->id_hito]);
$nombrehito=$hito->nombre;
$this->title = 'Entrega de '.$nombrehito;
//$this->title = 'Entrega de hito';
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

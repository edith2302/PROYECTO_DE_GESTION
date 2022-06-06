<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rolusuario */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rol usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rolusuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

  
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_user',
            'id_rol',
        ],
    ]) ?>


<p align="right">
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro/a de eliminar el rol de usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>

<?php

use yii\helpers\Html;
use app\models\Rubrica;
/* @var $this yii\web\View */
/* @var $model app\models\Item */

//$nombre= Rubrica::find()->where(['id' => $id])->one();

$this->title = 'Agregar ítem a ';
//$this->title = 'Agregar ítem';
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

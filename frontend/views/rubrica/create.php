<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */

$this->title = 'Agregar Rúbrica';
$this->params['breadcrumbs'][] = ['label' => 'Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubrica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        //'model' => $model,
        'modelRubrica' => $modelRubrica,
        'modelsItem'=>$modelsItem,
    ]) ?>

</div>

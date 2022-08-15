<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rubrica */
/* @var $modelRubrica app\models\Rubrica */
/* @var $modelItem app\models\Item */

$this->title = 'Agregar Rúbrica';
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubrica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        //'model' => $model,
        'modelRubrica' => $modelRubrica,
        'modelsItem'=>$modelsItem,
    ]) ?>

</div>

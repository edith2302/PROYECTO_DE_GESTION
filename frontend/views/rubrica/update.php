<?php

use yii\helpers\Html;
use app\models\Rubrica;

/* @var $this yii\web\View */
/* @var $modelRubrica app\models\Rubrica */

$this->title = 'Modificar rúbrica: ' . $modelRubrica->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Rúbricas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelRubrica->nombre, 'url' => ['view', 'id' => $modelRubrica->id]];
$this->params['breadcrumbs'][] = 'Modificar rúbrica';
?>
<div class="rubrica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'modelRubrica' => $modelRubrica,
        'modelsItem'=>$modelsItem,
    ]) ?>

</div>

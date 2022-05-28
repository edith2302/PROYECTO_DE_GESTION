<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CursoestudianteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cursoestudiante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_curso') ?>

    <?= $form->field($model, 'id_estudiante') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

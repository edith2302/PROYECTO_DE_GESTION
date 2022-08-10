<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_hito')->textInput() ?>

    <?= $form->field($model, 'rol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

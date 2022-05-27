<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profesoricinf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profesoricinf-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jefaturacarrera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jefaturacarrera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <div class="form-group">
    <p align="right">

        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

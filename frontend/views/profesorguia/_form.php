<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profesorguia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profesorguia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

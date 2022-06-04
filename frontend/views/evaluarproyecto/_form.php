<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluarproyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluarproyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prof_icinf')->textInput() ?>

    <?= $form->field($model, 'id_proyecto')->textInput() ?>

    <?= $form->field($model, 'nota')->textInput() ?>

    <?= $form->field($model, 'comentarios')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

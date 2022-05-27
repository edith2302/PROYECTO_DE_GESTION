<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluardefensa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluardefensa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_comision')->textInput() ?>

    <?= $form->field($model, 'id_defensa')->textInput() ?>

    <?= $form->field($model, 'nota')->textInput() ?>

    <?= $form->field($model, 'comentarios')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

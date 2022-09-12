<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluadorf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluadorf-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_entrega')->textInput() ?>

    <?= $form->field($model, 'id_profesor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

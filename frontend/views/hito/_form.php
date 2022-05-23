<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
//use yii\jui\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Hito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <textarea name="descripcion" rows="5" cols="140">Descripción</textarea> 

    <?= $form->field($model, 'fecha_habilitacion')->widget(
            DatePicker::className(), [
                'inline' => false,
                'language'=>'es',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
        ]);?>


    <?= $form->field($model, 'hora_habilitacion')->textInput(); ?>

    
    <?= $form->field($model, 'fecha_limite')->widget(
            DatePicker::className(), [
                'inline' => false,
                'language'=>'es',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-m-yyyy'
                ]
        ]);?>
    <?= $form->field($model, 'hora_limite')->textInput()?>

    <?= $form->field($model, 'tipo_hito')->textInput() ?>

    <?= $form->field($model, 'porcentaje_nota')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Agregar rubrica', ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

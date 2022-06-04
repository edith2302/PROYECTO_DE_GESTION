<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyecto;
use app\models\Hito;
use app\models\FormUpload;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrega-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'evidencia')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comentarios')->textarea(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'id_proyecto')->dropDownList(\yii\helpers\ArrayHelper::map(Proyecto::find()->all(),'id', 'nombre'),['prompt' => 'Seleccionar proyecto']);?>

    <?= $form->field($model, 'id_hito')->dropDownList(\yii\helpers\ArrayHelper::map(Hito::find()->all(),'id', 'nombre'),['prompt' => 'Seleccionar hito']);?>

    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar entrega', ['class' => 'btn btn-success']) ?>
    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

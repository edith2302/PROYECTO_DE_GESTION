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

    
   
    <!--<?= $form->field($model, 'id_proyecto')->textInput(['maxlength' => true]) ?>-->
    <!--<?= $form->field($model, 'id_hito')->dropDownList(\yii\helpers\ArrayHelper::map(Hito::find()->all(),'id', 'nombre'),['prompt' => 'Seleccionar hito']);?>-->

    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Subir entrega', ['class' => 'btn btn-primaryy']) ?>
    <p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

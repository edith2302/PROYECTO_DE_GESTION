<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div align="center">
     <?= $msg ?>

     <h3 align="center">Entrega del hito</h3><br>

     <?php $form = ActiveForm::begin([
          "method" => "post",
          "enableClientValidation" => true,
          "options" => ["enctype" => "multipart/form-data"],
          ]);
     ?>

     <?= $form->field($model, "file[]")->fileInput(['multiple' => true]) ?>

     <?= Html::submitButton("Subir", ["class" => "btn btn-primary"]) ?>

     <?php $form->end() ?>          
</div>



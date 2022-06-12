<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;
use app\models\Profesorguia;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>


   
    <div class="col-md">
            <?= $form->field($model, 'id_profe_guia')->dropDownList(
                ArrayHelper::map(Profesorguia::find()->all(),'id',
                        function ($query) {
                            return $query->usuario->nombre;
                        },),['prompt' => 'Seleccione profesor guía'])?>
    </div>
    
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    <p>

    <?php ActiveForm::end(); ?>

</div>

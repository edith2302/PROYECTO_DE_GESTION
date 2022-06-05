<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Profesorasignatura;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Modulo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modulo-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>

    <div class="col-md">
            <?= $form->field($model, 'id_profesor')
                ->dropDownList(
                    ArrayHelper::map(
                        Profesorasignatura::find()->all(),
                        'id',
                        function ($query) {
                            return $query->usuario->nombre;
                        },
                        
                    ),
                    ['prompt' => 'Seleccione profesor'])?>
    </div>

    <?= $form->field($model, 'archivo')->fileInput(['maxlength' => true]) ?>
   
    <div class="form-group">
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

    <p>
    </div>

  

    <?php ActiveForm::end(); ?>

</div>

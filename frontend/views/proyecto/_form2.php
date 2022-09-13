<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;
use app\models\Profesorguia;
use yii\helpers\ArrayHelper;
use app\models\Profesoricinf;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>


   
    <div class="col-md">
            <?= $form->field($model, 'id_profe_guia')->dropDownList(
                ArrayHelper::map(Profesoricinf::find()->all(),'id',
                        function ($query) {
                            //return $usuario[$query''];
                            $usuario = Usuario::findOne($query['id_usuario']);                            
                            return $usuario->nombre;
                        },),['prompt' => 'Seleccione profesor guía'])?>
    </div>
    
    <p align="right">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primaryy']) ?>

    <p>

    <?php ActiveForm::end(); ?>

</div>

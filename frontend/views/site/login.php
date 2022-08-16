<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Inicio de sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor complete los siguientes campos para iniciar sesión:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <!--<div style="color:#999;margin:1em 0">
                Si olvidaste tu contraseña puedes<?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    ¿Necesita un nuevo correo de verificación? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>-->

                <div class="form-group">
                    <?= Html::submitButton('Iniciar Sesión', ['class' => 'button primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
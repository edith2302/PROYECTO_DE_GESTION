<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_usuario',
            'rut',
            'nombre',
            'apellido',
            [
                'label'=>'Rol',
                'value'=>function ($model) { 
                    $userr = User::find()->where(['id_usuarioo' => $model->id_usuario])->one();
                    if($userr->role == 1){
                        $rol = "Profesor asignatura";
                    }
                    if($userr->role == 2){
                        $rol = "Estudiante";
                    }
                    if($userr->role == 3){
                        $rol = "Profesor ICINF";
                    }
                    return $rol;
                },
                'format'=>'raw',
                //'headerOptions' => ['width' => '1000px;','style'=>'text-align: center !important;'],
                //'contentOptions' => ['style'=>'padding:10px 5px 0px 5px;text-align: center;'],
            ],
            'telefono',
            'telefono_alternativo',
            
            //'username',
            //'dv',
            //'password',
            
            'email:email',
            'email_alternativo:email',
            //'plan',
            'direccion',
            //'habilitado_adt',
            //'habilitado_practica',
            //'habilitado_ici',
            
        ],
    ]) ?>

</div>

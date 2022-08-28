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

            //'rut',
            [
                'label'=>'Rut',
                'value'=>function ($model) { 

                    $formatRut = $model['rut'];

                    $rutt = "";
                    //si el rut está con formato, solo lo muestra
                    if ((strpos($formatRut, ".") !== false) && (strpos($formatRut, "-") !== false)) {
                        $rutt = $model['rut'];
                            
                    }else{
                        //si el rut está con guión, lo formatea
                        if (strpos($formatRut, '-') !== false ) {

                            $splittedRut = explode('-', $formatRut);
                            $number = number_format($splittedRut[0], 0, ',', '.');
                            $verifier = strtoupper($splittedRut[1]);
                            $rutt = $number . '-' . $verifier;
                        }else{
                            //si no tiene punto ni guión
                            if(!((strpos($formatRut, ".") !== false) && (strpos($formatRut, "-") !== false))){
                                $largo = strlen($formatRut);
                                $resultado = substr($formatRut, 0, $largo-1 ); 
                                $verifi = substr($formatRut, $largo-1);
                                $number =  number_format($resultado, 0, ',', '.');
                                $rutt = $number."-".$verifi;
                                
                            }
                            //si el rut está con puntos sin guión, lo formatea
                            if (strpos($formatRut, '.') !== false ) {
                                $largo = strlen($formatRut);
                                $resultado = substr($formatRut, 0, $largo-1 ); 
                                $verifi = substr($formatRut, $largo-1);
                                $rutt = $resultado."-".$verifi;
                            }

                        }
                    }
                    return $rutt;
                },
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: rigth;'],
            ],
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

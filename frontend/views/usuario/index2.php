<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
    <?= Html::a('Exportar PDF', ['export-pdf1'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Exportar Excel', ['export-excel3'], ['class' => 'btn btn-primary']) ?>
    </p>
   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_usuario',
            //'rut',
            //'telefono',
            //'telefono_alternativo',
            //'nombre',


            [
                'label'=>'Nombre',
                'value'=>function ($model) { return $model['nombre'].' '.$model['apellido']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

           /* [
                'label'=>'Rut',
                'value'=>function ($model) { 

                   $formatRut = $model['rut'];

                    if (strpos($formatRut, '-') !== false ) {
            
                        $splittedRut = explode('-', $formatRut);
                        $number = number_format($splittedRut[0], 0, ',', '.');
                        $verifier = strtoupper($splittedRut[1]);
                        return $number . '-' . $verifier;
                    }
                    return number_format($formatRut, 0, ',', '.');
                    //return $model['rut'];
                },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],*/
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
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: center;'],
            ],
            [
                'label'=>'E-mail',
                'value'=>function ($model) { return $model['email']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            [
                'label'=>'Teléfono',
                'value'=>function ($model) { return $model['telefono']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],

            /*[
                'attribute'=>'telefono_alternativo',
                'value'=>function ($model) { return $model->telefono_alternativo; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
            ],*/
            //'username',
            //'dv',
            //'password',
            //'apellido',
            //'email:email',
            //'email_alternativo:email',
            //'plan',
            //'direccion',
            //'habilitado_adt',
            //'habilitado_practica',
            //'habilitado_ici',
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_usuario' => $model['id_usuario']]);
                 }
            ],*/
        ],
    ]); ?>
    




</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de profesores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
    <?= Html::a('Exportar PDF', ['export-pdf2'], ['class' => 'btn btn-primary']) ?>
    <!--<?= Html::a('Exportar Excel', ['export-excel2'], ['class' => 'btn btn-primary']) ?>-->
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




            [
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
                
                },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],
            
            [
                'label'=>'Email',
                'value'=>function ($model) { return $model['email']; },
                //'filter'=>false,
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
            ],


            [
                'label'=>'Área',
                'value'=>function ($model) { return $model['area']; },
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

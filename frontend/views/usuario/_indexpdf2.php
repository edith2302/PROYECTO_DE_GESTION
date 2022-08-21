<?php

use yii\grid\GridView;

?>
<div class="usuario-index">




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_usuario',
            //'nombre',
            // 'rut',
            //'email',
            //'telefono',
            //'telefono_alternativo',
            [
                'label'=>'Nombre',
                'value'=>function ($model) { return $model['nombre'].' '.$model['apellido']; },
                'format'=>'raw',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: left;'],
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
                'format'=>'raw',
                'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: center;'],
            ],

            [
                'label'=>'E-mail',
                'value'=>function ($model) { return $model['email']; },
                'format'=>'raw',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: left;'],
            ],

            [
                'label'=>'Teléfono',
                'value'=>function ($model) { return $model['telefono']; },
                'format'=>'raw',
                //'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 10px 0px 10px;text-align: center;'],
            ],
  
        ],
    ]); ?>


</div>

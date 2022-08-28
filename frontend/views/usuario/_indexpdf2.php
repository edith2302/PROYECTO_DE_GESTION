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
           
            /*[
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
                    /*if (strpos($formatRut, '-') !== false ) {
            
                        $splittedRut = explode('-', $formatRut);
                        $number = number_format($splittedRut[0], 0, ',', '.');
                        $verifier = strtoupper($splittedRut[1]);
                        return $number . '-' . $verifier;
                    }
                    return number_format($formatRut, 0, ',', '.');*/
                
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

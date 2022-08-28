<?php

use yii\grid\GridView;

?>

<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/tablaProyectos.css'?>">


<table  style="width:100%">
   <tr>
     <th>
     <img src="<?= Yii::$app->request->baseUrl.'/images/logo3.png'?>"width="200" heigth="150">
     </th>
      <td style="text-align: right">

        <!--<br><h4><?php echo $titulo;?></h4></br>-->
      </td>
 </tr>
</table>


<p align="center">
    <br><h4><?php echo $titulo;?></h4></br><br>
</p>

<div class="usuario-index">





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        
                    [
                        'label'=>'Nombre proyecto',
                        'value'=>function ($model) { return $model->nombre; },
                        //'filter'=>false,
                        'format'=>'raw',
                        //'label'=>'YiiLib.com',
                        'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                        'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
                    ],
        
                   /* [
                        'attribute'=>'descripcion',
                        'value'=>function ($model) { return $model->descripcion; },
                        //'filter'=>false,
                        'format'=>'raw',
                        //'label'=>'YiiLib.com',
                        'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                        'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
                    ],*/
        
        
                    [
                        'label'=>'Número integrantes',
                        'value'=>function ($model) { return $model->num_integrantes; },
                        //'filter'=>false,
                        'format'=>'raw',
                        //'label'=>'YiiLib.com',
                        'headerOptions' => ['width' => '200px;','style'=>'text-align: center !important;'],
                        'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
                    ],
        
                    /*[
                        'attribute'=>'tipo',
                        'value'=>function ($model) { return $model->tipo; },
                        //'filter'=>false,
                        'format'=>'raw',
                        //'label'=>'YiiLib.com',
                        'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                        'contentOptions' => ['style'=>'padding:0px 0px 0px 30px;text-align: center;'],
                    ],*/
        
                    [
                                'label' => 'Tipo',
                                'value' =>
        
                                function ($model) {
                                    if ($model['tipo'] == '1') {
                                        return 'Desarrollo';
                                    };
                                    if ($model['tipo'] == '2') {
                                        return 'Investigación';
                                    };
                                    return 'ERROR';
                                },
                                'format'=>'raw',
                        //'label'=>'YiiLib.com',
                        'headerOptions' => ['width' => '120px;','style'=>'text-align: center !important;'],
                        'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
               
        
                            ],
        
                            [
                                'label' => 'Área',
                                'value' =>
        
                                function ($model) {
                                    if ($model['area'] == '1') {
                                        return 'Inteligencia artificial';
                                    };
                                    if ($model['area'] == '2') {
                                        return 'Sistemas de información';
                                    };
        
                                    if ($model['area'] == '3') {
                                        return 'Estructura de datos';
                                    };
                                    return 'ERROR';
                                },
        
                                'format'=>'raw',
                        //'label'=>'YiiLib.com',
                        'headerOptions' => ['width' => '300px;','style'=>'text-align: center !important;'],
                        'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],
        
        
                            ],
        
                            

            
           
        ],
    ]); ?>


</div>

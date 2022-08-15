<?php

use yii\grid\GridView;

?>
<div class="usuario-index">




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_usuario',
            'nombre',
            'rut',
            'email',
            'telefono',
            //'telefono_alternativo',
            

            
           
        ],
    ]); ?>


</div>

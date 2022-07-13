<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Estudiante;
use app\models\Usuario;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudianteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiante-index">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'id_usuario',
            [
                'label' => 'Nombre',

                    'value'  => function ($model) {
                        //$logueado= Yii::$app->user->identity->id_usuarioo;
                        $usuario = Usuario::find()->where(['id_usuario' => $model->id_usuario])->one();
                       
                        return $usuario->nombre;
                    },
                'format'=>'raw',
                //'label'=>'YiiLib.com',
                'headerOptions' => ['width' => '120px;','style'=>'text-align: center !important;'],
                'contentOptions' => ['style'=>'padding:10px 0px 0px 0px;text-align: center;'],

            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Estudiante $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

<p align="right">
        <?= Html::a('Agregar estudiante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>

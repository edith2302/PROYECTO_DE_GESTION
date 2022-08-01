<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

  
   
    <p>
        <?= Html::a('Agendar actividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
  ));

  ?>


</div>

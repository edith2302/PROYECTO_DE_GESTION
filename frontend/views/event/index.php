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
      'options' => [
        'lang' => 'es',
        //... more options to be defined here!
      ],
      'events'=> $events,
      
    ));

  ?>
  <?php

    Modal::begin([
      'header'=>'<h4>Event</h4>',
      'id'=>'modal',
      'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";

    Modal ::end();

  ?>

</div>



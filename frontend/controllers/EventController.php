<?php

namespace frontend\controllers;

use app\models\Event;
use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Hito;
use Yii;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Event models.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $events = Event:: find()->all();
       $tasks = [];

        foreach ($events as $eve){
          //
          $event = new \yii2fullcalendar\models\Event();
          $event->id = $eve->id;
          $event->title = $eve->title;
          $event->start = $eve ->created_date;
         // $event->end = $eve ->end;
          //date('Y-m-d\Th:m:s\Z',strtotime('tomorrow 6am'));//created_date;
         // $events[] = $eve;
          $tasks[] = $event;
        }

        return $this->render('index', [
            
            'events' => $tasks,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $hito = Hito::findOne(['id' => $id]);
        $model = new Event();
        $model->title = $hito->nombre;
        $model->description = $hito->descripcion.". Hora límite: ".$hito->hora_limite. " hrs.";
        $model->created_date = $hito->fecha_limite;
        //$model->end = $hito->hora_limite;
        $model->id_hito = $id;

       /* if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }*/

        $model->save();
        Yii:: $app->session->setFlash('success','El hito ha sido creado con éxito');
        return $this->redirect(['hito/view', 'id' => $id]);

        return $this->renderPartial('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $idh)
    {
        $model = $this->findModel($id);
        $hito = Hito::findOne(['id'=>$idh]);
        $model->title = $hito->nombre;
        $model->description = $hito->descripcion.". Hora límite: ".$hito->hora_limite." hrs.";
        $model->created_date = $hito->fecha_limite;
        
        $model->id_hito = $idh;

        $model->save();
        
        /*if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii:: $app->session->setFlash('success','El hito se ha modificado con éxito');
            return $this->redirect(['hito/view', 'id' => $idh]);
        }*/
      
        Yii:: $app->session->setFlash('success','El hito se ha modificado con éxito');
        return $this->redirect(['hito/view', 'id' => $idh]);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

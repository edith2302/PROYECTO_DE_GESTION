<?php

namespace frontend\controllers;

use app\models\Hito;
use app\models\HitoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii2mod\alert\Alert;
//use common\widgets\Alert;

/**
 * HitoController implements the CRUD actions for Hito model.
 */
class HitoController extends Controller
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
     * Lists all Hito models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HitoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexcopy()
    {
        $searchModel = new HitoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('indexcopy', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewcopy($id)
    {
        return $this->render('viewcopy', [
            'model' => $this->findModel($id),
        ]);
    }

    

    /**
     * Creates a new Hito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Hito();
        //$model->id_profe_asignatura = Yii::app()->user->getId();

        if ($this->request->isPost) {
            if ($model->load(Yii:: $app->request->post()) && $model->save()) {

                Yii:: $app->session->setFlash('success','El hito ha sido creado con exito');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Hito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii:: $app->request->isPost && $model->load($this->request->post()) && $model->save()) {

            Yii:: $app->session->setFlash('success','El hito ha sido modificado con exito');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hito model.
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
     * Finds the Hito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Hito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hito::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

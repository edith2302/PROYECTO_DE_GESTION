<?php

namespace frontend\controllers;

use app\models\Modulo;
use app\models\ModuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormUpload;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

use app\models\ProfesorAsignatura;

/**
 * ModuloController implements the CRUD actions for Modulo model.
 */
class ModuloController extends Controller
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
     * Lists all Modulo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ModuloSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexestudiante()
    {
        $searchModel = new ModuloSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('indexestudiante', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Modulo model.
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

    /**
     * Creates a new Modulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Modulo();
        $horaActual = date('H_i_s');
        $logueado= Yii::$app->user->identity->id_usuarioo;
        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();
        $model->id_profesor= $profesor->id;


        if ($model->load(Yii::$app->request->post())) {

            if(UploadedFile::getInstance($model,'archivo') != '') {

                $pdfFile = UploadedFile::getInstance($model, 'archivo');
        
                if (isset($pdfFile->size)) {
                    $pdfFile->saveAs('modulos/' . $horaActual.'_'.$pdfFile->name);
                }

                $model->archivo = $horaActual.'_'.$pdfFile->name;
                $model->save(false);

            }

            $model->save(false);

            Yii:: $app->session->setFlash('success','¡Módulo generado con éxito!');
            return $this->redirect(['view', 'id' => $model->id] );  
    
            //return $this->redirect('../views/modulo');
        }

        return $this->render('create', [
            'model' => $model,
        ]);






    }

    /**
     * Updates an existing Modulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Modulo model.
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
     * Finds the Modulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Modulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Modulo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

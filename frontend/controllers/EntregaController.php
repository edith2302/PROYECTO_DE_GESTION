<?php

namespace frontend\controllers;

use app\models\Entrega;
use app\models\EntregaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormUpload;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

use yii\data\SqlDataProvider;
/**
 * EntregaController implements the CRUD actions for Entrega model.
 */
class EntregaController extends Controller
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
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Entrega models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EntregaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //se muestran todas las entregas por hito
    public function actionEntregashito($id)
    {
        $model = new SqlDataProvider([
            'sql' => 'select * from entrega 
            where id_hito = ' .$id,
        ]);

        return $this->render('entregashito', [
            'dataProvider' => $model,
        ]);
    }

    
   /* public function actionEntregasproyectohito()
    {
        /*
        SELECT * FROM hito where id in (select hito.id as id
from hito join entrega on entrega.id_hito = hito.id
join desarrollarproyecto on entrega.id_proyecto=desarrollarproyecto.id_proyecto
join estudiante on desarrollarproyecto.id_estudiante = estudiante.id
where estudiante.id_usuario = 6107)
        */
       /* $model = new SqlDataProvider([
            'sql' => 'SELECT * FROM entrega where id_hito in (select hito.id as id
            from hito join entrega on entrega.id_hito = hito.id
            join desarrollarproyecto on entrega.id_proyecto=desarrollarproyecto.id_proyecto
            join estudiante on desarrollarproyecto.id_estudiante = estudiante.id
            where estudiante.id_usuario =  ' . Yii::$app->user->identity->id_usuarioo.'
            and hito.id='.$id.')',
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('entregasproyectohito', [
            'dataProvider' => $model,
        ]);
    }*/


    
    /**
     * Displays a single Entrega model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelhito = new SqlDataProvider([
            'sql' => 'select * from entrega 
            where id_hito = ' .$id,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelhito' => $modelhito,
        ]);
    }

    /**
     * Creates a new Entrega model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Entrega();
        $model->fecha_entrega = date('Y-m-d');
        $model->hora_entrega = date('H:i:s');
        $horaActual = date('H_i_s');

        if ($model->load(Yii::$app->request->post())) {

            if(UploadedFile::getInstance($model,'evidencia') != '') {

                $pdfFile = UploadedFile::getInstance($model, 'evidencia');
        
                if (isset($pdfFile->size)) {
                    $pdfFile->saveAs('archivos/' . $model->proyecto->nombre.'_'.$model->hito->nombre .'_'.$model->fecha_entrega .'_'.$horaActual.'_' . $pdfFile->name);
                }

                $model->evidencia = $horaActual.'_'.$pdfFile->name;
                $model->save(false);

            }

            $model->save(false);

            return $this->redirect('../views/entrega');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Entrega model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->fecha_entrega = date('Y-m-d');
        $model->hora_entrega = date('H:i:s');;

        if ($model->load(Yii::$app->request->post())) {

            if(UploadedFile::getInstance($model,'evidencia') != '') {

                $pdfFile = UploadedFile::getInstance($model, 'evidencia');
        
                if (isset($pdfFile->size)) {
                    $pdfFile->saveAs('archivos/' . $model->proyecto->nombre .'----'. $model->fecha_entrega .'----'. $model->hito->nombre .'.' . $pdfFile->extension);
                }

                $model->evidencia = 'archivos/' . $model->proyecto->nombre .'----'. $model->fecha_entrega .'----'. $model->hito->nombre .'.' . $pdfFile->extension;
                $model->save(false);

            }

            $model->save(false);

            
        }


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Entrega model.
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
     * Finds the Entrega model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Entrega the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entrega::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

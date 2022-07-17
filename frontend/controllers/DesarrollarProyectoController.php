<?php

namespace frontend\controllers;

use app\models\Desarrollarproyecto;
use app\models\DesarrollarproyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
USE yii\data\SqlDataProvider;
use app\models\Estudiante;
use app\models\Proyecto;
/**
 * DesarrollarproyectoController implements the CRUD actions for Desarrollarproyecto model.
 */
class DesarrollarproyectoController extends Controller
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
     * Lists all Desarrollarproyecto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DesarrollarproyectoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Desarrollarproyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'msg'=> null,
        ]);
    }

    /**
     * Creates a new Desarrollarproyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $logueado= Yii::$app->user->identity->id_usuarioo;
        
        $estudiante = Estudiante::find()->where(['id_usuario' => $logueado])->one();
        //return $estudiante->id;

        $proyecto = Proyecto::find()->where(['id' => $id])->one();
        
        $proyectoInscritos= Desarrollarproyecto::find()->where(['id_estudiante' => $estudiante->id])->one();
        $msg = null;
        if($proyectoInscritos != null){
            return $this->render('../proyecto/viewinscripcion2', [
                'model' => $proyecto->findOne($id),
                'msg'=> "Esto ya fue inscrito",
            ]);
        }



         //return $proyecto->id;
        $model = new Desarrollarproyecto();
    
        $model->id_estudiante = $estudiante->id;

        $model->id_proyecto=$proyecto->id;

        $model->save();

        $proyectoOc= Desarrollarproyecto::find()->where(['id_proyecto' => $proyecto->id])->one();
        $ocupado = 2;
        //return $proyecto->disponibilidad;
        if($proyectoOc!=null){
            $proyecto->setDisponibilidad($ocupado);
            //$proyecto->save();
        }
        //return $proyecto->disponibilidad;
        
        //return $this->redirect(['proyecto/viewinscripcion', 'id' => $model->id]);

        return $this->render('../proyecto/viewinscripcion', [
            'model' => Proyecto::findOne($model->id_proyecto),
        ]);
        /*if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }*/

       /* return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing Desarrollarproyecto model.
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
     * Deletes an existing Desarrollarproyecto model.
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
     * Finds the Desarrollarproyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Desarrollarproyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Desarrollarproyecto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace frontend\controllers;

use app\models\Evaluar;
use app\models\EvaluarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Entrega;
use app\models\Hito;
use app\models\Rubrica;
use Yii;
USE yii\data\SqlDataProvider;

/**
 * EvaluarController implements the CRUD actions for Evaluar model.
 */
class EvaluarController extends Controller
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
     * Lists all Evaluar models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EvaluarSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evaluar model.
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
     * Creates a new Evaluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($ide)
    {
        $model = new Evaluar();
        $logueado= Yii::$app->user->identity->id_usuarioo;
        $entrega = Entrega::find()->where(['id' => $ide])->one();
        $hito = Hito::find()->where(['id' => $entrega->id_hito])->one();
        $rubrica = Rubrica::find()->where(['id' => $hito->id_rubrica])->one();
        $idr = $rubrica->id;

        //-----------------conexion bdd----------------------
            $bd_name = "yii2advanced";
            $bd_table = "item";
            $bd_location = "localhost";
            $bd_user = "root";
            $bd_pass = "";

            // conectarse a la bd
            $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
            if(mysqli_connect_errno()){
                die("Connection failed: ".mysqli_connect_error());
            }
            $datos =$conn->query("SELECT * FROM item");

            $puntaje =$conn->query("select id, puntaje, descripcion,SUM(puntaje_obtenido) as puntajeobtenido, SUM(puntaje) as puntajeideal, SUM(puntaje_obtenido)*7/SUM(puntaje) as nota from  item where item.id_rubrica = '$idr'");
            
           
            while($calificacion = mysqli_fetch_array($puntaje)){
                //echo $calificacion['nota'];
                $notaa = $calificacion['nota'];
                //return $calificacion['nota'];
            } 
            $model->nota = $notaa;
            //return $notaa;

        $model->id_usuario = $logueado;
        $model->id_entrega = $entrega->id;
        $model->comentarios = $rubrica->observaciones;

        //----------------------------------
        $model->save();
        Yii:: $app->session->setFlash('success','La evaluación ha sido enviada éxito');
        //return $this->redirect(['view', 'id' => $model->id]);

        return $this->redirect(['rubrica/viewevaluacionenviada', 'idr' => $rubrica->id] );
        /*return $this->render('../rubrica/viewevaluacion', [
            'model' => Rubrica::findOne($idr),
        ]);

        */

        /*if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        
        return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing Evaluar model.
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
     * Deletes an existing Evaluar model.
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
     * Finds the Evaluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Evaluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evaluar::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

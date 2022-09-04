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
        $proyectoInsc = Proyecto::find()->where(['id' => $id])->one();

        //si el estado del proyecto no es aprobado, no permite inscribirlo
        if($proyectoInsc->estado != 1 ){

            Yii:: $app->session->setFlash('error','Proyecto no disponible');
            return $this->redirect(['proyecto/indexestudiante']);
        }

        //si la disponibilidad del proyecto no es 1, no permite inscribirlo
        if($proyectoInsc->disponibilidad != 1 ){

            Yii:: $app->session->setFlash('error','Proyecto no disponible');
            return $this->redirect(['proyecto/indexestudiante']);
        }

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
       // -------------------------------------------------------------

        $logueado= Yii::$app->user->identity->id_usuarioo;
        $estudiante = Estudiante::find()->where(['id_usuario' => $logueado])->one();
        $proyecto = Proyecto::find()->where(['id' => $id])->one();
        $proyectoInscritos= Desarrollarproyecto::find()->where(['id_estudiante' => $estudiante->id])->one();
        $msg = null;
        
        //si el estudiante ya inscribió un proyecto, lo redirige a la vista del proyecto inscrito
        if($proyectoInscritos != null){
            Yii:: $app->session->setFlash('error','El estudiante logueado ya cuenta con un proyecto insrito.');  
            return $this->render('../proyecto/viewinscripcion2', [
                'model' => $proyecto->findOne($id),
                'msg'=> "Esto ya fue inscrito",
            ]);
        }

        $proyectoIns= Desarrollarproyecto::find()->where(['id_proyecto' => $id])->one();

        //si el proyecto ya fue inscrito consulta por cupos disponibles
        if($proyectoIns != null){

            $datospro = $conn->query("SELECT COUNT(*) as total, desarrollarproyecto.id_proyecto, proyecto.num_integrantes as integrantes, proyecto.id from desarrollarproyecto JOIN proyecto on proyecto.id = desarrollarproyecto.id_proyecto WHERE proyecto.id = ".$id." GROUP BY desarrollarproyecto.id_proyecto");

            while($proyectoss = mysqli_fetch_array($datospro)){
                $idpro = $proyectoss['id'];
                $inscritos = $proyectoss['total'];
                $integrant = $proyectoss['integrantes'];
            }

            //si los cupos del proyecto ya están ocupados, lanza un mensaje de error
            if($integrant == $inscritos){
                Yii:: $app->session->setFlash('error','Proyecto no disponible');  
                return $this->redirect(['proyecto/indexestudiante']);                  
            } 
        }

            //si quedan cupos del proyecto disponibles, permite inscribirlo
            //if($integrant > $inscritos){
        $model = new Desarrollarproyecto();
        
        $model->id_estudiante = $estudiante->id;
        $model->id_proyecto=$id;
        $model->save();
        $ocupado = 2;


        //luego de inscribir el proyecto revisa si estan los cupos ocupados, si es así cambia la disponibilidad del proyecto a "ocupado (2)"

        $datos = $conn->query("SELECT COUNT(*) as total, desarrollarproyecto.id_proyecto, proyecto.num_integrantes as integrantes, proyecto.id from desarrollarproyecto JOIN proyecto on proyecto.id = desarrollarproyecto.id_proyecto WHERE proyecto.id = ".$id." GROUP BY desarrollarproyecto.id_proyecto");

        while($inscritos = mysqli_fetch_array($datos)){
            $idpro = $inscritos['id'];
            $estInscritos = $inscritos['total'];
            $numIntegrante = $inscritos['integrantes'];
    
        }
  
        if($numIntegrante == $estInscritos){
            $proyecto->setDisponibilidad($ocupado);
        } 
        
        Yii:: $app->session->setFlash('success','Proyecto inscrito con éxito');
        return $this->render('../proyecto/viewinscripcion', [
            'model' => Proyecto::findOne($model->id_proyecto),
        ]);

    }


    /**
     * Creates a new Desarrollarproyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    //inscripción automatica de proyecto propuesto por estudiante
    public function actionCreate2($id)
    {
       
        //$proyectoInsc = Proyecto::find()->where(['id' => $id])->one();
        $proyectoInsc = Proyecto::findOne(['id' => $id]);

        //si el estado del proyecto no es aprobado, no permite inscribirlo
        if($proyectoInsc->estado != 1 ){

            Yii:: $app->session->setFlash('error','Proyecto no disponible');
            return $this->redirect(['proyecto/indexestudiante']);
        }

        //si la disponibilidad del proyecto no es 1, no permite inscribirlo
        if($proyectoInsc->disponibilidad != 1 ){

            Yii:: $app->session->setFlash('error','Proyecto no disponible');
            return $this->redirect(['proyecto/indexestudiante']);
        }

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
       // -------------------------------------------------------------

        $estudiante = Estudiante::findOne(['id_usuario'=>$proyectoInsc->id_autor]);
        $proyecto = Proyecto::find()->where(['id' => $id])->one();
        $proyectoInscritos= Desarrollarproyecto::find()->where(['id_estudiante' => $estudiante->id])->one();
        $msg = null;
        
        //si el estudiante ya inscribió un proyecto, lo redirige a la vista del proyecto inscrito
        if($proyectoInscritos != null){
            Yii:: $app->session->setFlash('error','El estudiante ya cuenta con un proyecto insrito.');  
            return $this->render('../proyecto/viewinscripcion2', [
                'model' => $proyecto->findOne($id),
                'msg'=> "Esto ya fue inscrito",
            ]);
        }

        $proyectoIns= Desarrollarproyecto::find()->where(['id_proyecto' => $id])->one();

        //si el proyecto ya fue inscrito consulta por cupos disponibles
        if($proyectoIns != null){

            $datospro = $conn->query("SELECT COUNT(*) as total, desarrollarproyecto.id_proyecto, proyecto.num_integrantes as integrantes, proyecto.id from desarrollarproyecto JOIN proyecto on proyecto.id = desarrollarproyecto.id_proyecto WHERE proyecto.id = ".$id." GROUP BY desarrollarproyecto.id_proyecto");

            while($proyectoss = mysqli_fetch_array($datospro)){
                $idpro = $proyectoss['id'];
                $inscritos = $proyectoss['total'];
                $integrant = $proyectoss['integrantes'];
            }

            //si los cupos del proyecto ya están ocupados, lanza un mensaje de error
            if($integrant == $inscritos){
                Yii:: $app->session->setFlash('error','Proyecto no disponible');  
                return $this->redirect(['proyecto/indexestudiante']);                  
            } 
        }

            //si quedan cupos del proyecto disponibles, permite inscribirlo
            //if($integrant > $inscritos){
        $model = new Desarrollarproyecto();
        
        $model->id_estudiante = $estudiante->id;
        $model->id_proyecto=$id;
        $model->save();
        $ocupado = 2;

        //luego de inscribir el proyecto revisa si estan los cupos ocupados, si es así cambia la disponibilidad del proyecto a "ocupado (2)"
        $datos = $conn->query("SELECT COUNT(*) as total, desarrollarproyecto.id_proyecto, proyecto.num_integrantes as integrantes, proyecto.id from desarrollarproyecto JOIN proyecto on proyecto.id = desarrollarproyecto.id_proyecto WHERE proyecto.id = ".$id." GROUP BY desarrollarproyecto.id_proyecto");

        while($inscritos = mysqli_fetch_array($datos)){
            $idpro = $inscritos['id'];
            $estInscritos = $inscritos['total'];
            $numIntegrante = $inscritos['integrantes'];
    
        }
  
        if($numIntegrante == $estInscritos){
            $proyecto->setDisponibilidad($ocupado);
        } 
        

        Yii:: $app->session->setFlash('success','El proyecto '.'"'.$proyecto->nombre.'"'.' se aprobó con éxito');
        return $this->redirect(['proyecto/view', 'id' => $id]);

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

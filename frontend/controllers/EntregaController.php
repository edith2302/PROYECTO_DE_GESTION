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
use app\models\Desarrollarproyecto;
use app\models\Estudiante;
use app\models\Proyecto;
use app\models\Evaluar;
use yii2mod\alert\Alert;
use yii\data\SqlDataProvider;
use app\models\Hito;
use app\models\Evaluador;
use app\models\User;
use app\models\Profesoricinf;
use app\models\Profesorguia;

use app\models\Usuario;

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


    /**
     * Lists all Entrega models.
     *
     * @return string
     */
    public function actionIndex2()
    {
        $searchModel = new EntregaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index2', [
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

    //vista que muestra el botón de evaluar
    public function actionView($id)
    {
        //validación evaluador
       /* $entrega = Entrega::findOne(['id'=>$id]);
        $proyecto = Proyecto::findOne(['id'=>$entrega->id_proyecto]);
        $hito = Hito::findOne(['id'=>$entrega->id_hito]);
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $user = User::findOne(['id_usuarioo'=>$usuario]);
        $profguia = Profesoricinf::findOne(['id'=>$proyecto->id_profe_guia]);

        $evaluador = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>$user->role]);
        $evaluacion = Evaluar::findOne(['id_entrega'=>$id, 'id_usuario'=>$usuario]);

        $comision = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>4]);
        $profe_guia = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>5]);

        $modelhito = new SqlDataProvider([
            'sql' => 'select * from entrega 
            where id_hito = ' .$id,
        ]);

        //si no existe una evaluación del usuario a la entrega seleccionada, pasa
        if($evaluacion==null){ //(1)

            //si el rol del usuario logueado está autorizado para evaluar, le aparece la opción evaluar
            if($evaluador!=null){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelhito' => $modelhito,
                ]);

            }

            //si el rol autorizado para evaluar es la comisión (4), entonces revisa que el rol del usuario logueado sea profesor ICINF(3)
            if($comision !=null){
                if($user->role == 3){
                    return $this->render('view', [
                        'model' => $this->findModel($id),
                        'modelhito' => $modelhito,
                    ]);
                }
            }


            //si el rol autorizado para evaluar es el profe guía, entonces pregunta si el id del usuario logueado es el mismo del profe ICINF asignado como profe guia 
            if($profe_guia != null){
                if($profguia->id_usuario == $usuario){
                    return $this->render('view', [
                        'model' => $this->findModel($id),
                        'modelhito' => $modelhito,
                    ]);
                }
            } 
        }//termina if(1)*/
        $model = Entrega::findOne(['id'=>$id]);
        $proyecto = Proyecto::findOne(['id' => $model['id_proyecto']]);
        $desarrollap = Desarrollarproyecto::find()->where(['id_proyecto' => $proyecto->id])->one();
        $estudiante = Estudiante::find()->where(['id' => $desarrollap->id_estudiante])->one();
        $usuario = Usuario::find()->where(['id_usuario' => $estudiante->id_usuario])->one();

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

        $count = $conn->query("SELECT COUNT(*) as total from desarrollarproyecto WHERE desarrollarproyecto.id_proyecto = ".$proyecto->id."  GROUP BY desarrollarproyecto.id_proyecto");

        while($cantidad = mysqli_fetch_array($count )){
            $total = $cantidad['total'];
        } 
        //-------------------------------------------------------------------
        //si hay dos incritos, entonces muestra una vista con ambos nombres
        if($total == 2){
            return $this->redirect(['view3', 'id' => $id]);
        }

        return $this->redirect(['view2', 'id' => $id]);
                
    }

    public function actionView2($id)
    {
        $entrega = Entrega::findOne(['id'=>$id]);
        
        $modelnota = new SqlDataProvider([
            //'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios, evaluar.nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios, AVG(nota) as nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            
        ]);

        $modelcomentarios = new SqlDataProvider([
            'sql' => 'SELECT evaluar.comentarios FROM `evaluar` WHERE evaluar.id_entrega = '.$entrega->id,
        ]);

        //SELECT AVG(nota), evaluar.comentarios from evaluar WHERE evaluar.id_entrega=12 GROUP BY evaluar.id_entrega
        return $this->render('view2', [
            //'model' => $this->findModel($id),
            'model' => $entrega,
            'modelnota' => $modelnota,
            'modelcomentarios' => $modelcomentarios,
            
        ]);
    }

    public function actionView3($id)
    {
        $entrega = Entrega::findOne(['id'=>$id]);
        
        $modelnota = new SqlDataProvider([
            //'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios, evaluar.nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios, AVG(nota) as nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            
        ]);

        $modelcomentarios = new SqlDataProvider([
            'sql' => 'SELECT evaluar.comentarios FROM `evaluar` WHERE evaluar.id_entrega = '.$entrega->id,
        ]);

        //SELECT AVG(nota), evaluar.comentarios from evaluar WHERE evaluar.id_entrega=12 GROUP BY evaluar.id_entrega
        return $this->render('view3', [
            //'model' => $this->findModel($id),
            'model' => $entrega,
            'modelnota' => $modelnota,
            'modelcomentarios' => $modelcomentarios,
            
        ]);
    }

    /**
     * Creates a new Entrega model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $horaActual = date('H_i_s');
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $estudiante = Estudiante::findOne(['id_usuario'=>$usuario]);
        $desarrollar = Desarrollarproyecto::findOne(['id_estudiante'=>$estudiante]);

        $entrega = Entrega::findOne(['id_hito'=>$id, 'id_proyecto'=>$desarrollar->id_proyecto]);

        $hitoo = Hito::findOne(['id'=>$id]);
        $fechaActual2 = date('Y-m-d');
        $horaActual2  = date('H:i:s');


        if($entrega == null){
            //si no existe una entrega del mismo hito y proyecto, permite crearla, pero primero verifica que esté dentro del plazo

            if($hitoo->fecha_limite < $fechaActual2){
                Yii:: $app->session->setFlash('error','Entrega fuera de plazo');
                return $this->redirect(['hito/view2', 'id' => $id] );
            }
            if($hitoo->fecha_limite == $fechaActual2){
                if($hitoo->hora_limite > $horaActual2){
                    Yii:: $app->session->setFlash('error','Entrega fuera de plazo');
                    return $this->redirect(['hito/view2', 'id' => $id] );
                }
            }
            

            $model = new Entrega();
            $model->fecha_entrega = date('Y-m-d');
            $model->hora_entrega = date('H:i:s');
            $model->id_proyecto = $desarrollar->id_proyecto;
            $model->id_hito = $id;

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
    
                Yii:: $app->session->setFlash('success','Entrega realizada con éxito');
                return $this->redirect(['view2', 'id' => $model->id]);
            }
            return $this->render('create', [
                'model' => $model,
            ]);

        }
        Yii:: $app->session->setFlash('success','¡Ya existe una entrega para el hito seleccionado!');
        return $this->redirect(['view2', 'id' => $entrega->id] );  
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
            return $this->redirect(['view2', 'id' => $model->id]);
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

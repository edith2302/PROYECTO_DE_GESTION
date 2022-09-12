<?php

namespace frontend\controllers;

use app\models\Proyecto;
use app\models\Estudiante;
use app\models\Desarrollarproyecto;
use app\models\Profesoricinf;
use app\models\Profesorguia;
use app\models\Usuario;
use app\models\ProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2mod\alert\Alert;
use Yii;
use yii\filters\AccessControl;
use app\models\User;
use yii\data\SqlDataProvider;
use kartik\mpdf\Pdf;

/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index', 'create','view','indexprofesor','viewasignado'],
                'rules' => [
                    [//eliminar este usuario al finalizar el proyecto
                        //El profesor asignatura tiene permisos sobre las siguientes acciones
                        'actions' =>['logout','index', 'create','view','indexprofesor','viewasignado','asignarpofguia','viewprofesor','view2','_form','index2','_indexpdf1','indexpdfinicial','asignarpofguia','create2','indexpropuestas','viewmodificar','viewmodificar2','viewmodificar3','viewmodificar4','viewocupado','viewocupado2',],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserProfesorAsignatura(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        //El Estudiante tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'indexestudiante', 'viewentregaestudiante', 'viewentregar','viewestudiante', 'create','indexdisponibles','viewmiproyecto','viewinscripcion2','viewinscripcion','indexpropuestas'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserEstudiante(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        //El profesor ICINF tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'create','view','index', 'indexprofesor','viewprofesor','indexpropuestas','indexprofesor'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserProfesorICINF(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'create','view', 'index','indexprofeguia','indexpropuestas','viewprofeguia','viewentregapg' ],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserProfesorGuia(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                ]
            ]
        ];
    

    }

    /**
     * Lists all Proyecto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexestudiante()
    {
        //$searchModel = new ProyectoSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        /*$dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('indexestudiante', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        $modelproyectos = new SqlDataProvider([
            
           //'sql' => "SELECT * FROM proyecto WHERE proyecto.disponibilidad = 1 ",

           //Sólo muestra los proyectos disponibles y con estado aprobado(1)
           'sql' =>"SELECT * FROM proyecto WHERE proyecto.disponibilidad = 1 AND proyecto.estado = 1",

           //'sql' => "SELECT proyecto.id, proyecto.nombre, proyecto.descripcion, proyecto.num_integrantes, proyecto.tipo, proyecto.area, proyecto.estado, proyecto.disponibilidad, proyecto.id_profe_guia, proyecto.id_autor, desarrollarproyecto.id_estudiante, COUNT(*) as total FROM proyecto JOIN desarrollarproyecto ON proyecto.id = desarrollarproyecto.id_proyecto GROUP BY proyecto.id  HAVING COUNT(*) <= proyecto.num_integrantes",
            
        ]);

        //return print_r( $modelproyectos);

        return $this->render('indexestudiante', [
           // 'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
            'modelproyectos' => $modelproyectos,
        ]);

    }

    public function actionIndexpropuestas()
    {
        $logueado = Yii::$app->user->identity->id_usuarioo;
        $modelproyectos = new SqlDataProvider([
            
           'sql' => "SELECT * FROM proyecto WHERE proyecto.id_autor = ".$logueado,
 
        ]);

        return $this->render('indexpropuestas', [
            'modelproyectos' => $modelproyectos,
        ]);

    }


    public function actionIndexprofesor()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('indexprofesor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexprofeguia()
    {   //en proyecto, el id del profe guia corresponde al id del profesor ICINF
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $profeguia = Profesoricinf::findOne(['id_usuario'=>$usuario]);

        $modelproyectos = new SqlDataProvider([
            
            'sql' => "SELECT * FROM proyecto WHERE proyecto.id_profe_guia = ".$profeguia->id,
 
        ]);

        return $this->render('indexprofeguia', [
            'modelproyectos' => $modelproyectos,
        ]);

    }



        
    public function actionViewprofeguia($id)
    {
        $modelp = new SqlDataProvider([
            'sql' => "SELECT * FROM hito",
        ]);
        

        return $this->render('viewprofeguia', [
            'model' => $this->findModel($id),
            'modelp' => $modelp,
        ]);
    }




    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /*$proyecto = Proyecto::find()->where(['id' => $id])->one();
        $proyectoDesarro = Desarrollarproyecto::find()->where(['id_proyecto' => $id])->one();
        
        if($proyectoDesarro != null){
            return $this->render('viewocupado', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/

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

        $count = $conn->query("SELECT COUNT(*) as total from desarrollarproyecto WHERE desarrollarproyecto.id_proyecto = ".$id."  GROUP BY desarrollarproyecto.id_proyecto");

        while($cantidad = mysqli_fetch_array($count )){
            $total = $cantidad['total'];
        } 
        //-------------------------------------------------------------------

        //si hay dos incritos, entonces muestra una vista con ambos nombres
        if($total == 2){
            //return $this->redirect(['viewocupado2', 'id' => $id]);
            return $this->render('viewocupado2', [
                'model' => $this->findModel($id),
            ]);
        }

        //si hay un incrito, entonces muestra una vista con el nombre del inscrito
        if($total == 1){
            // return $this->redirect(['viewocupado2', 'id' => $id]);
            return $this->render('viewocupado', [
                'model' => $this->findModel($id),
            ]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmodificar($id)
    {
        $proyecto = Proyecto::findOne(['id'=>$id]);

        //si no tiene profe guia y su estado es diferente de null pasa
        if(($proyecto->id_profe_guia == null) && ($proyecto->estado != 3 /*null*/)){
            return $this->render('viewmodificar2', [
                'model' => $this->findModel($id),
            ]);
        }

        //si ya tiene profe guia y su estado es null pasa
        if(($proyecto->id_profe_guia != null) && ($proyecto->estado == 3 /*null*/)){
            return $this->render('viewmodificar3', [
                'model' => $this->findModel($id),
            ]);
        }

        //si ya tiene profe guia y su estado es diferente de null pasa
        if(($proyecto->id_profe_guia != null) && ($proyecto->estado != 3 /*null*/)){
            return $this->render('viewmodificar4', [
                'model' => $this->findModel($id),
            ]);
        }

        return $this->render('viewmodificar', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmodificar2($id)
    {
        return $this->render('viewmodificar2', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmodificar3($id)
    {
        return $this->render('viewmodificar3', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmodificar4($id)
    {
        return $this->render('viewmodificar4', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewocupado($id)
    {
        return $this->render('viewocupado', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewocupado2($id)
    {
        return $this->render('viewocupado2', [
            'model' => $this->findModel($id),
        ]);
    }


     /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    //pasa el id del usuario logueado
    public function actionViewmiproyecto ($id)
    {   
        $estudiante = Estudiante::find()->where(['id_usuario' => $id])->one();

        $modeloDesarrollap = Desarrollarproyecto::find()->where(['id_estudiante' => $estudiante->id])->one();

        if($modeloDesarrollap != null){
            $proyecto = Proyecto::find()->where(['id' => $modeloDesarrollap->id_proyecto])->one();

            return $this->render('viewmiproyecto', [
                'model' => $this->findModel($proyecto->id),
            ]);

        }else{
            echo "Sin inscripcion";
        }
       
        
    }


    public function actionViewestudiante($id)
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
                'msg'=> null,
            ]);
        }
        return $this->render('viewestudiante', [
            'model' => $this->findModel($id),
            'msg'=>null,
        ]);
    }
    public function actionViewprofesor($id)
    {
        return $this->render('viewprofesor', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewestudianteproyinscrito($id)
    {
        return $this->render('viewestudianteproyinscrito', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionViewasignado($id)
    {
        return $this->render('viewasignado', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionView2($id)
    {
        return $this->render('view2', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewinscripcion($id)
    {
        $proyecto = Proyecto::findOne($id);
        //$proyecto->setDisponibilidad(2);

        return $this->render('viewinscripcion', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Proyecto();
        $model->id_autor = Yii::$app->user->identity->id_usuarioo;

        if ($this->request->isPost) {
            if ($model->load(Yii:: $app->request->post()) && $model->save()) {

                Yii:: $app->session->setFlash('success','La propuesta de proyecto ha sido agragada con éxito');
                return $this->redirect(['view2', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionCreate2($id)
    {

        $model = Proyecto::findOne($id);
       // $profeicinf = Profesoricinf::findOne($model->id_profe_guia);
        //$usuario = Usuario::findOne($profeicinf->id_usuario);
        //$modelpg = new Profesorguia();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $guia = Proyecto::findOne($id);
            $guia -> id_profe_guia = $model->id_profe_guia;
            if($guia->save()){
                
                $profeicinf = Profesoricinf::findOne($guia -> id_profe_guia);
                $usuario = Usuario::findOne($profeicinf->id_usuario);

                $profeg = Profesorguia::findOne(['id_usuario'=>$usuario->id_usuario]);

                if($profeg != null){
                    $modelpg = new Profesorguia();
                    $modelpg->id_usuario = $usuario->id_usuario;
                    $modelpg->save();
                }
                Yii:: $app->session->setFlash('success','Profesor asignado con éxito');
                return $this->redirect(['viewasignado', 'id' => $model->id]);
            }
           
        }

        return $this->render('create2', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAprobar($id)
    {
        $model = $this->findModel($id);
        $model->estado = 1;
        $model->save();

        $estudi = Estudiante::findOne(['id_usuario'=>$model->id_autor]);

        //si el autor es un estudiante, entonces aprueba el proyecto y se inscribe automáticamente 
        if($estudi != null){
            return $this->redirect(['desarrollarproyecto/create2', 'id' => $id]);
        }

        Yii:: $app->session->setFlash('success','El proyecto '.'"'.$model->nombre.'"'.' se aprobó con éxito');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionRechazar($id)
    {
        $model = $this->findModel($id);

        $proyectoInscritoo = Desarrollarproyecto::findOne(['id_proyecto'=> $id]);
        
        //si el proyecto está inscrito, no puede rechazarlo
        if($proyectoInscritoo != null){
            Yii:: $app->session->setFlash('error','No fue posible rechazar el proyecto '.'"'.$model->nombre.'"'.', porque ya fue inscrito. ');
            return $this->redirect(['view', 'id' => $id]);
        }

        $model->estado = 2;
        $model->save();

        //Creamos el mensaje que será enviado a la cuenta de correo del usuario
     $subject = "Proyecto rechazado";
     $body = "<p>Estimado estudiante te informamos que tu propuesta ".$model->nombre ."ha sido rechazado";
     $usuario = Usuario::findOne(['id_usuario'=>$model->autor]);
     //$email = $usuario->email;
     $email= 'edith.parra1601@alumnos.ubiobio.cl';
     //Enviamos el correo
     Yii::$app->mailer->compose()
     ->setTo($email)
     ->setFrom([Yii::$app->params["Notificacion"] => Yii::$app->params["title"]])
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     
        
        Yii:: $app->session->setFlash('success','El proyecto '.'"'.$model->nombre.'"'.' se rechazó con éxito');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionCambiarestado($id)
    {
        $proyectoInscritoo = Desarrollarproyecto::findOne(['id_proyecto'=> $id]);
        $model = $this->findModel($id);
        
        //si el proyecto está inscrito, no puede rechazarlo
        if($proyectoInscritoo != null){
            Yii:: $app->session->setFlash('error','No fue posible cambiar el estado del proyecto '.'"'.$model->nombre.'"'.', porque ya fue inscrito. ');
            return $this->redirect(['view', 'id' => $id]);
        }
        
        
        if($model->estado == 1){
            //return "pasó 3";
            $model->estado = 2;
            //return "pasó 4";
            $model->save();
            Yii:: $app->session->setFlash('success','El proyecto '.'"'.$model->nombre.'"'.' se rechazó con éxito');

        }else{ 

            if($model->estado == 2){
                //return "pasó 1";
                $model->estado = 1;
                $model->save();
                Yii:: $app->session->setFlash('success','El proyecto '.'"'.$model->nombre.'"'.' se aprobó con éxito');
            }
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    
    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $proyectoInscritoo = Desarrollarproyecto::findOne(['id_proyecto'=> $id]);
        $model = $this->findModel($id);

        //si el proyecto está inscrito, no puede modificarlo
        if($proyectoInscritoo != null){
            Yii:: $app->session->setFlash('error','El proyecto '.'"'.$model->nombre.'"'.' no se puede modificar, porque ya fue inscrito. ');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii:: $app->session->setFlash('success','Proyecto actualizado con éxito. ');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $proyectoInscritoo = Desarrollarproyecto::findOne(['id_proyecto'=> $id]);
        $model = $this->findModel($id);
        
        //si el proyecto está inscrito, no puede eliminarlo
        if($proyectoInscritoo != null){
            Yii:: $app->session->setFlash('error','No fue posible eliminar el proyecto '.'"'.$model->nombre.'"'.', porque ya fue inscrito. ');

            return $this->redirect(['index']);
        }

        $this->findModel($id)->delete();

        Yii:: $app->session->setFlash('success','Proyecto eliminado con éxito.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyecto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    

    //reporte pdf

    public function actionExportPdf1() {

        
        //$searchModel = new ProyectoSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        // get your HTML raw content without any layouts or scripts
        //$content = $this->renderPartial('_indexpdf1',['dataProvider' => $dataProvider,]);
             $titulo="LISTA DE PROPUESTAS DE PROYECTOS";
             $fecha=date("d-m-y");

             $losproyectos= Proyecto::find()->all();
        
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_indexpdf1',[
            'titulo'=>$titulo,
            'fecha'=>$fecha,
            'titulo'=>$titulo,
            'proyectos'=>$losproyectos,
        
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => 'table.blueTable{

                border:1px solid #1C6EA4;
                background-color: #EEEEEE;
                width: 100%;
                text-align: left;
                border-collapse: collapse;
            }
            
            table.blueTable td, table.blueTable th{
            
                border: 1px solid #AAAAAA;
                padding: 3px 2px;
            }
            
            table.blueTable tbody td{
            
             font-size: 10px;
            }
            
            table.blueTable tr:nth-child(even){
            
            background: #D0E4F5;
             }
            
            
             table.blueTable thead{
            
              background: #1C6EA4;
              background: -moz-linear-gradient(top,#5592bb 0%, #327cad 66%, #1C6EA4 100%);
              background: -webkit-linear-gradient(top,#5592bb 0%, #327cad 66%, #1C6EA4 100%);
              background: linear-gradient(top bottom,#5592bb 0%, #327cad 66%, #1C6EA4 100%);
              border-bottom:  2px solid #444444;
             }
            
             table.blueTable thead th{
            
               font-size: 15px;
               font-weight: bold;
               color: #FFFFFF;
               border-left: 2px solid #D0E4F5;
            }
            
            table.blueTable thead th:first-child{
               border-left: none;
            }
            table.blueTable tfoot{
            
               font-size: 14px;
               font-weight: bold;
               color: #FFFFFF;
                background: #D0E4F5;
                background: -moz-linear-gradient(top,#dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
              background: -webkit-linear-gradient(top,#dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
              background: linear-gradient(top bottom,#dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
              border-bottom:  2px solid #444444;
            }
            table.blueTable tfoot td{
              font-size: 14px;
            }
            
            table.blueTable tfoot .links{
              text-align: right;
            }
            
            table.blueTable tfoot .links a{
              display: inline-block;
              background: #1C6EA4;
              color: #FFFFFF;
              padding: 2px 8px;
              border-radius: 5px;
            }', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Lista de propuestas'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Lista de propuestas'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    


   
}

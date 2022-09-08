<?php

namespace frontend\controllers;

use app\models\Hito;
use app\models\HitoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii2mod\alert\Alert;
use yii\data\SqlDataProvider;
use app\models\ProfesorAsignatura;
use app\models\Proyecto;
use app\models\Desarrollarproyecto;
use app\models\Estudiante;
use app\models\Entrega;
use app\models\Profesorguia;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Event;

use app\models\Evaluador;
use app\models\Rubrica;
use app\models\Model;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Evaluar;
use app\models\Profesoricinf;
use app\models\Usuario;
use kartik\mpdf\Pdf;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PHPExcel_Style_Border;

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
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index', 'update','view'],
                'rules' => [
                    [//eliminar este usuario al finalizar el proyecto
                        //El profesor asignatura tiene permisos sobre las siguientes acciones
                        'actions' => ['logout','index', 'update','view'],
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
                        'actions' => ['logout', 'indexestudiante', 'viewentregaestudiante', 'viewentregar','viewestudiante', 'create'],
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
                        'actions' => ['logout', 'index','view'],
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
                        'actions' => ['logout', 'view', 'index' ],
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

    public function actionIndexestudiante()
    {
        $searchModel = new HitoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('indexestudiante', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexprofeguia()
    {
        $searchModel = new HitoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('indexprofeguia', [
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
        $modelhito = new SqlDataProvider([
            'sql' => "select * from entrega 
            where id_hito = ' $id'",
        ]);

        //-------------------------validación evaluador--------------------------------------

        $hito = Hito::findOne(['id'=>$id]);
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $user = User::findOne(['id_usuarioo'=>$usuario]);

        $evaluador = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>$user->role]);
        //$evaluacion = Evaluar::findOne(['id_entrega'=>$id, 'id_usuario'=>$usuario]);

        $comision = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>4]);
        $profe_guia = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>5]);
        $profe_asignatura = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>1]);

        $modelhito = new SqlDataProvider([
            'sql' => 'select * from entrega 
            where id_hito = ' .$id,
        ]);


            //si el rol del usuario logueado es (1) profe asignatura y esta autorizado para evaluar, pasa
            if($profe_asignatura != null){
                if($user->role == 1){
                    return $this->render('viewpev', [
                        'model' => $this->findModel($id),
                        'modelhito' => $modelhito,
                    ]);
    
                }
            }


            //si el rol del usuario logueado está autorizado para evaluar, le aparece la opción evaluar
            if($evaluador!=null){
                return $this->render('viewev', [
                    'model' => $this->findModel($id),
                    'modelhito' => $modelhito,
                ]);

            }

            //si el rol autorizado para evaluar es la comisión (4), entonces revisa que el rol del usuario logueado sea profesor ICINF(3)
            if($comision !=null){
                if($user->role == 3){
                    return $this->render('viewev', [
                        'model' => $this->findModel($id),
                        'modelhito' => $modelhito,
                    ]);
                }
            }


            //si el rol autorizado para evaluar es el profe guía, entonces pregunta si el id del usuario logueado es el mismo del profe ICINF asignado como profe guia 

            //$profguia = Profesoricinf::findOne(['id'=>$proyecto->id_profe_guia]);
            if($profe_guia != null){
                return $this->redirect(['viewevprofeg', 'id' => $id]);
                /*if($profguia->id_usuario == $usuario){
                    return $this->render('viewev', [
                        'model' => $this->findModel($id),
                        'modelhito' => $modelhito,
                    ]);
                }*/
            } 
        
        
        //---------------------------fin validación--------------------------------------
        $rolUser = $user->role;
        if($rolUser == 1){
            return $this->render('viewpa', [
                'model' => $this->findModel($id),
                'modelhito' => $modelhito,
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelhito' => $modelhito,
        ]);
    
    }


    public function actionViewentregapg($id, $idp)
    {  //id: id hito     idp: id proyeto
        $modelentrega = new SqlDataProvider([
            'sql' => "select * from entrega where id_hito = ".$id." and id_proyecto= ".$idp,
            //'sql' => "select * from entrega where id_hito = 1 and id_proyecto= 1",
            
        ]);
        //return print_r( $modelhito);
        return $this->render('viewentregapg', [
            'model' => $this->findModel($id),
            'modelentrega' => $modelentrega,
        ]);
    
    }


      /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewpa($id)
    { //muestra las entregras, el profe las puede eliminar
        $modelhito = new SqlDataProvider([
            'sql' => "select * from entrega 
            where id_hito = ' $id'",
        ]);
        //return print_r( $modelhito);
        return $this->render('viewpa', [
            'model' => $this->findModel($id),
            'modelhito' => $modelhito,
        ]);
    
    }

     /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewpev($id)
    { //muestra las entregras, las que se pueden evaluar y eliminar
        $modelhito = new SqlDataProvider([
            'sql' => "select * from entrega 
            where id_hito = ' $id'",
        ]);
        //return print_r( $modelhito);
        return $this->render('viewpev', [
            'model' => $this->findModel($id),
            'modelhito' => $modelhito,
        ]);
    
    }

     /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewev($id)
    { //muestra las entregras, las que se pueden evaluar
        $modelhito = new SqlDataProvider([
            'sql' => "select * from entrega 
            where id_hito = ' $id'",
        ]);
        //return print_r( $modelhito);
        return $this->render('viewev', [
            'model' => $this->findModel($id),
            'modelhito' => $modelhito,
        ]);
    
    }

    /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmodificar($id)
    {
        return $this->render('viewmodificar', [
            'model' => $this->findModel($id),
        ]);
    
    }

    /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView2($id)
    {
        return $this->render('view2', [
            'model' => $this->findModel($id),
        ]);
    
    }

    /**
     * Displays a single Hito model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewentregar($id)
    {
        return $this->render('viewentregar', [
            'model' => $this->findModel($id),
        ]);   
    }

    public function actionViewentregaestudiante($id)
    {

        $modelhito = new SqlDataProvider([
            'sql' => 'SELECT * FROM entrega where id_hito in (select hito.id as id
            from hito join entrega on entrega.id_hito = hito.id
            join desarrollarproyecto on entrega.id_proyecto=desarrollarproyecto.id_proyecto
            join estudiante on desarrollarproyecto.id_estudiante = estudiante.id
            where estudiante.id_usuario =  ' . Yii::$app->user->identity->id_usuarioo.'
            and hito.id='.$id.')',
        ]);
        //return print_r( $modelhito);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelhito' => $modelhito,
        ]);
    
    }

    
    public function actionViewprofeg($id)
    {   //$id : el id corresponde al hito
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $profeguia = Profesorguia::findOne(['id_usuario'=>$usuario]);
        //$estudiante = Estudiante::findOne(['id_usuario'=>$usuario]);
        //$desarrollar = Desarrollarproyecto::findOne(['id_estudiante'=>$estudiante]);
        $proyecto = Proyecto::findOne(['id_profe_guia'=>$profeguia->id]);

        $entrega = Entrega::findOne(['id_proyecto'=>$proyecto->id, 'id_hito'=>$id]);

        $modelentregahito = new SqlDataProvider([
            'sql' => 'SELECT * FROM `entrega`  WHERE entrega.id_proyecto ='.$proyecto->id.' and entrega.id_hito='.$id, 
        ]);

        $modelnota = new SqlDataProvider([
            'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios as coment_ev, evaluar.nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            
        ]);

        //---------------validación evaluador-------------------
        $hito = Hito::findOne(['id'=>$id]);
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $user = User::findOne(['id_usuarioo'=>$usuario]);

        $evaluador = Evaluador::findOne(['id_hito'=>$hito->id, 'rol'=>5]);
        
        //si el profe guia esta seleccionar para evaluar, aparece la opción en la entrega
        if($evaluador != null){
            return $this->render('viewprofegev', [
                'model' => $this->findModel($id),
                'modelentregahito' => $modelentregahito,
                //'modelnota' => $modelnota,
            ]);
        }

        //-------------------------------------------------------
        return $this->render('viewprofeg', [
            'model' => $this->findModel($id),
            'modelentregahito' => $modelentregahito,
            //'modelnota' => $modelnota,
        ]);
        
    }

    public function actionViewprofegev($id)
    {   //$id : el id corresponde al hito
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $profeguia = Profesorguia::findOne(['id_usuario'=>$usuario]);
        //$estudiante = Estudiante::findOne(['id_usuario'=>$usuario]);
        //$desarrollar = Desarrollarproyecto::findOne(['id_estudiante'=>$estudiante]);
        $proyecto = Proyecto::findOne(['id_profe_guia'=>$profeguia->id]);

        $entrega = Entrega::findOne(['id_proyecto'=>$proyecto->id, 'id_hito'=>$id]);

        $modelentregahito = new SqlDataProvider([
            'sql' => 'SELECT * FROM `entrega`  WHERE entrega.id_proyecto ='.$proyecto->id.' and entrega.id_hito='.$id, 
        ]);

        $modelnota = new SqlDataProvider([
            'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios as coment_ev, evaluar.nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            
        ]);

        return $this->render('viewprofegev', [
            'model' => $this->findModel($id),
            'modelentregahito' => $modelentregahito,
            //'modelnota' => $modelnota,
        ]);
        
    }

    public function actionViewevprofeg($id)
    {   //$id : el id corresponde al hito
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $profeguia = Profesorguia::findOne(['id_usuario'=>$usuario]);
        $proyecto = Proyecto::findOne(['id_profe_guia'=>$profeguia->id]);
        $entrega = Entrega::findOne(['id_proyecto'=>$proyecto->id, 'id_hito'=>$id]);

        $modelentregahito = new SqlDataProvider([
            'sql' => 'SELECT * FROM `entrega`  WHERE entrega.id_proyecto ='.$proyecto->id.' and entrega.id_hito='.$id, 
        ]);

        $modelnota = new SqlDataProvider([
            'sql' => 'SELECT evaluar.id as idevaluar, evaluar.comentarios as coment_ev, evaluar.nota, evaluar.id_entrega, evaluar.id_usuario FROM evaluar WHERE  evaluar.id_entrega ='.$entrega->id,
            
        ]);

        return $this->render('viewprofeg', [
            'model' => $this->findModel($id),
            'modelentregahito' => $modelentregahito,
        ]);
        
    }



    public function actionViewestudiante($id)
    {   //$id : el id corresponde al hito
        $hito = Hito::findOne(['id'=>$id]);
        $horaActual = date('H:i:s');
        $fechaActual = date('Y-m-d');
        //return "hora ac: ".$horaActual." - hora lim: ".$hito->hora_limite." ...... fe ac: ".$fechaActual." - fech lim: ".$hito->fecha_limite;
        
        //return "hora ac: ".$horaActual." - hora habi: ".$hito->hora_habilitacion." ...... fe ac: ".$fechaActual." - fech habi: ".$hito->fecha_habilitacion;

        $usuario = Yii::$app->user->identity->id_usuarioo;
        $estudiante = Estudiante::findOne(['id_usuario'=>$usuario]);
        $desarrollar = Desarrollarproyecto::findOne(['id_estudiante'=>$estudiante]);
        $proyecto = Proyecto::findOne(['id'=>$desarrollar->id_proyecto]);

        $entrega = Entrega::findOne(['id_proyecto'=>$proyecto->id, 'id_hito'=>$id]);

        $modelentregahito = new SqlDataProvider([
            'sql' => 'SELECT * FROM `entrega`  WHERE entrega.id_proyecto ='.$proyecto->id.' and entrega.id_hito='.$id,            
        ]);

        if( $entrega == null){
            //return "pasó 1";
            //----------------------Validación plazo entrega del hito---------------------------

            if($hito->fecha_habilitacion > $fechaActual){
                //return "pasó 2";
                return $this->render('view2', [
                    'model' => $this->findModel($id),
                ]);
            }else{
                if($hito->fecha_habilitacion == $fechaActual){ 
                    //return $hito->fecha_habilitacion ." = ". $fechaActual;
                    //return "pasó 3";
                    if($hito->hora_habilitacion > $horaActual){
                      //return "pasó 4";
                        return $this->render('view2', [
                            'model' => $this->findModel($id),
                        ]);
                    }
                }
            }
            
            
            if($hito->fecha_limite < $fechaActual){
                return $this->render('view2', [
                    'model' => $this->findModel($id),
                ]);
            }else{
                if($hito->fecha_limite == $fechaActual){
                    if($hito->hora_limite > $horaActual){
                        return $this->render('view2', [
                            'model' => $this->findModel($id),
                        ]);
                    }
                }
            }
            //-----------------------------------------------------------------------------------

            
            return $this->render('viewentregar', [
                'model' => $this->findModel($id),
            ]);
            
        }else{

            return $this->render('viewestudiante', [
                'model' => $this->findModel($id),
                'modelentregahito' => $modelentregahito,
            ]);
        }

    }

    

    /**
     * Creates a new Hito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate2()
    {
        $model = new Hito();
        $logueado= Yii::$app->user->identity->id_usuarioo;

        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();

        $model->id_profe_asignatura= $profesor->id;
        //$model->id_profe_asignatura = Yii::app()->user->getId();

        if ($this->request->isPost) {
            if ($model->load(Yii:: $app->request->post()) && $model->save()) {

                return $this->redirect(['event/create', 'id' => $model->id]);

                Yii:: $app->session->setFlash('success','El hito ha sido creado con éxito');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create2', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Hito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        /*$model = new Hito();
        $logueado= Yii::$app->user->identity->id_usuarioo;

        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();

        $model->id_profe_asignatura= $profesor->id;

        if ($this->request->isPost) {
            if ($model->load(Yii:: $app->request->post()) && $model->save()) {

                return $this->redirect(['event/create', 'id' => $model->id]);

                Yii:: $app->session->setFlash('success','El hito ha sido creado con éxito');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create2', [
            'model' => $model,
        ]);*/


        
        //$modelRubrica = $this->findModel($id);
        $modelHito = new Hito();
        $logueado= Yii::$app->user->identity->id_usuarioo;

        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();

        $modelHito->id_profe_asignatura= $profesor->id;

        
        
        //------------------------------------------------------------
        
        $modelsEvaluador = [new Evaluador];

        if ($modelHito->load(Yii::$app->request->post())) {

            $modelsEvaluador = Model::createMultiple(Evaluador::classname());
            Model::loadMultiple($modelsEvaluador, Yii::$app->request->post());

            // validate all models
            $valid = $modelHito->validate();
            $valid = Model::validateMultiple($modelsEvaluador) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelHito->save(false)) {
                        foreach ($modelsEvaluador as $modelEvaluador) {
                            $modelEvaluador->id_hito = $modelHito->id;
                            if (! ($flag = $modelEvaluador->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['event/create', 'id' => $modelHito->id]);

                        //Yii:: $app->session->setFlash('success','El hito ha sido creado con éxito');
                        //return $this->redirect(['view', 'id' => $modelHito->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelHito' => $modelHito,
            'modelsEvaluador' => (empty($modelsEvaluador)) ? [new Evaluador] : $modelsEvaluador
        ]);
        //------------------------------------------------------------
    }



    /**
     * Creates a new Hito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate3($id)
    {
        $modelHito = $this->findModel($id);
        $modelsEvaluador = [new Evaluador];
        

        if ($modelHito->load(Yii::$app->request->post(),'')) {

            $modelsEvaluador = Model::createMultiple(Evaluador::classname());
            Model::loadMultiple($modelsEvaluador, Yii::$app->request->post());

            // validate all models
            $valid = $modelHito->validate();
            $valid = Model::validateMultiple($modelsEvaluador) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelHito->save(false)) {
                        foreach ($modelsEvaluador as $modelEvaluador) {
                            $modelEvaluador->id_rubrica = $modelHito->id;
                            if (! ($flag = $modelEvaluador->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        Yii:: $app->session->setFlash('success','¡Evaluadores asignados con éxito!');
                        return $this->redirect(['view', 'id' => $modelHito->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        
        return $this->render('create3', [
            'modelHito' => $modelHito,
            'modelsEvaluador' => (empty($modelsEvaluador)) ? [new Item] : $modelsEvaluador
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
        /*$model = $this->findModel($id);
        $evento = Event::findOne(['id_hito'=>$id]);

        if (Yii:: $app->request->isPost && $model->load($this->request->post()) && $model->save()) {

            
            return $this->redirect(['event/update', 'id' => $evento->id, 'idh'=>$model->id]);
            /*Yii:: $app->session->setFlash('success','El hito se ha modificado con éxito');
            return $this->redirect(['view', 'id' => $model->id]);*/
        /*}

        return $this->render('update', [
            'model' => $model,
        ]);*/

        $modelHito = $this->findModel($id);
        $evento = Event::findOne(['id_hito'=>$id]);

        $modelsEvaluador =  $modelHito->evaluadores;
        
        if ($modelHito->load(Yii::$app->request->post())) {
            
            $oldIDs = ArrayHelper::map($modelsEvaluador, 'id', 'id');
            $modelsEvaluador = Model::createMultiple(Evaluador::classname(), $modelsEvaluador);
            
            Model::loadMultiple($modelsEvaluador, Yii::$app->request->post());
            
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEvaluador, 'id', 'id')));
           
            // validate all models
            $valid = $modelHito->validate();

            $valid = Model::validateMultiple($modelsEvaluador) && $valid;

            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelHito->save(false)) {
                      
                        if (!empty($deletedIDs)) {
                           
                           Evaluador::deleteAll(['id' => $deletedIDs]);
                        }
                        
                        foreach ($modelsEvaluador as $modelEvaluador) {
                           
                            $modelEvaluador->id_hito = $modelHito->id;
  
                            if (! ($flag = $modelEvaluador->save(false))) {

                                $transaction->rollBack();
                                break;
                            }
                            unset($modelEvaluador);
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        
                        return $this->redirect(['event/update', 'id' => $evento->id, 'idh'=>$modelHito->id]);
                        
                        /*Yii:: $app->session->setFlash('success','El hito se ha modificado con éxito');
                        return $this->redirect(['view', 'id' => $modelHito->id]);*/
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelHito' => $modelHito,
            'modelsEvaluador' => (empty($modelsEvaluador)) ? [new Evaluador] : $modelsEvaluador
        ]);
    }

    /**
     * Updates an existing Hito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate2($id)
    {
        /*$model = $this->findModel($id);
        $evento = Event::findOne(['id_hito'=>$id]);

        if (Yii:: $app->request->isPost && $model->load($this->request->post()) && $model->save()) {

            
            return $this->redirect(['event/update', 'id' => $evento->id, 'idh'=>$model->id]);
            /*Yii:: $app->session->setFlash('success','El hito se ha modificado con éxito');
            return $this->redirect(['view', 'id' => $model->id]);*/
        /*}

        return $this->render('update', [
            'model' => $model,
        ]);*/
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
       /* $this->findModel($id)->delete();

        return $this->redirect(['index']);*/

        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Hito eliminado con éxito');
        }

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

    //reporte pdf

    public function actionExportPdf1() {

        $searchModel = new HitoSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);
    
             $titulo="LISTA DE HITOS DE ANTEPROYECTO DE TÍTULO";
             $fecha=date("d-m-y");

             $loshitos= Hito::find()->all();
        
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_indexpdf1',[
            'titulo'=>$titulo,
            'fecha'=>$fecha,
            'titulo'=>$titulo,
            'hitos'=>$loshitos,
        
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
            'options' => ['title' => 'Actividades'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Actividades'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }


    public function actionExportExcel1()
    {
          //-----------------conexion bdd----------------------
          $bd_name = "yii2advanced";
          $bd_table = "hito";
          $bd_location = "localhost";
          $bd_user = "root";
          $bd_pass = "";
  
          // conectarse a la bd
          $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
          if (mysqli_connect_errno()) {
              die("Connection failed: " . mysqli_connect_error());
          }
  
          $loshitos = $conn->query("SELECT * FROM hito");
        //$loshitos= Hito::find()->all();

        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle("Lista de hitos");

        $hojaActiva->getColumnDimension('B')->setWidth(5);
        $hojaActiva->setCellValue('B2', 'N°');
        $hojaActiva->getColumnDimension('C')->setWidth(30);
        $hojaActiva->setCellValue('C2', 'Nombre hito');
        $hojaActiva->getColumnDimension('D')->setWidth(30);
        $hojaActiva->setCellValue('D2', 'Fecha habilitación');
        $hojaActiva->getColumnDimension('E')->setWidth(30);
        $hojaActiva->setCellValue('E2', 'Fecha limite');
        $hojaActiva->getColumnDimension('F')->setWidth(15);
        $hojaActiva->setCellValue('F2', 'Porcentaje nota');

       

        $num = 0;
        $fila = 3;
        while ($hitos = mysqli_fetch_array($loshitos)) {
            $num = $num + 1;

            $hojaActiva->setCellValue('B' . $fila, $num);
            $hojaActiva->setCellValue('C' . $fila, $hitos['nombre']);
            $hojaActiva->setCellValue('D' . $fila, $hitos['fecha_habilitacion']." / ".$hitos['hora_habilitacion']." hrs" );
            $hojaActiva->setCellValue('E' . $fila, $hitos['fecha_limite']."  / ".$hitos['hora_limite']." hrs");
            $hojaActiva->setCellValue('F' . $fila, $hitos['porcentaje_nota']." %");

            $fila++;
        }

        $fila--;
        //-------------Set Borde Negro----------------------
        $hojaActiva->getStyle("B2:F$fila")
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $hojaActiva->getStyle("B2:F$fila")
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        //-----------------------------------

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Lista de hitos.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        ob_clean();
        $writer->save('php://output');
        exit;

    }

}

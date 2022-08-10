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
        //return print_r( $modelhito);
        return $this->render('view', [
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

        return $this->render('viewprofeg', [
            'model' => $this->findModel($id),
            'modelentregahito' => $modelentregahito,
            //'modelnota' => $modelnota,
        ]);
        
    }



    public function actionViewestudiante($id)
    {   //$id : el id corresponde al hito
        $hito = Hito::findOne(['id'=>$id]);
        $horaActual = date('H:i:s');
        $fechaActual = date('Y-m-d');

        $usuario = Yii::$app->user->identity->id_usuarioo;
        $estudiante = Estudiante::findOne(['id_usuario'=>$usuario]);
        $desarrollar = Desarrollarproyecto::findOne(['id_estudiante'=>$estudiante]);
        $proyecto = Proyecto::findOne(['id'=>$desarrollar->id_proyecto]);

        $entrega = Entrega::findOne(['id_proyecto'=>$proyecto->id, 'id_hito'=>$id]);

        $modelentregahito = new SqlDataProvider([
            'sql' => 'SELECT * FROM `entrega`  WHERE entrega.id_proyecto ='.$proyecto->id.' and entrega.id_hito='.$id,            
        ]);

        if( $entrega == null){

            //----------------------Validación plazo entrega del hito---------------------------

            if($hito->fecha_habilitacion > $fechaActual){
                return $this->render('view2', [
                    'model' => $this->findModel($id),
                ]);
            }else{
                if($hito->fecha_habilitacion = $fechaActual){ 
                    if($hito->hora_habilitacion > $horaActual){
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
                if($hito->fecha_limite = $fechaActual){
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

        return $this->render('create', [
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
                        return $this->redirect(['view', 'id' => $modelHito->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create2', [
            'modelHito' => $modelHito,
            'modelsEvaluador' => (empty($modelsEvaluador)) ? [new Evaluador] : $modelsEvaluador
        ]);
        //------------------------------------------------------------
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
                        return $this->redirect(['view', 'id' => $modelHito->id]);
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
}

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
                'only' => ['logout','index', 'create','view','indexprofesor','viewasignado','asignarpofguia','viewprofesor'],
                'rules' => [
                    [//eliminar este usuario al finalizar el proyecto
                        //El profesor asignatura tiene permisos sobre las siguientes acciones
                        'actions' => ['logout','index', 'create','view','indexprofesor','viewasignado','asignarpofguia','viewprofesor'],
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
                        'actions' => ['logout', 'create','view','index'],
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
                        'actions' => ['logout', 'create','view', 'index' ],
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
            
           'sql' => "SELECT * FROM proyecto WHERE proyecto.disponibilidad = 1 ",

           //'sql' => "SELECT proyecto.id, proyecto.nombre, proyecto.descripcion, proyecto.num_integrantes, proyecto.tipo, proyecto.area, proyecto.estado, proyecto.disponibilidad, proyecto.id_profe_guia, proyecto.id_autor, desarrollarproyecto.id_estudiante, COUNT(*) as total FROM proyecto JOIN desarrollarproyecto ON proyecto.id = desarrollarproyecto.id_proyecto GROUP BY proyecto.id  HAVING COUNT(*) <= proyecto.num_integrantes",
            
        ]);

        //return print_r( $modelproyectos);

        return $this->render('indexestudiante', [
           // 'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
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

    /**
     * Displays a single Proyecto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $proyecto = Proyecto::find()->where(['id' => $id])->one();
        $proyectoDesarro = Desarrollarproyecto::find()->where(['id_proyecto' => $id])->one();
        
        if($proyectoDesarro != null){
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
    public function actionViewocupado($id)
    {
        return $this->render('viewocupado', [
            'model' => $this->findModel($id),
        ]);
    }

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
                $modelpg = new Profesorguia();
                $modelpg->id_usuario = $usuario->id_usuario;
                $modelpg->save();
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

        Yii:: $app->session->setFlash('success','El proyecto se aprobó con éxito');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionRechazar($id)
    {
        $model = $this->findModel($id);
        $model->estado = 2;
        $model->save();
        
        Yii:: $app->session->setFlash('error','El proyecto se rechazó con éxito');
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
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
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
        $this->findModel($id)->delete();

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
}

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
            //'sql' => "select * from proyecto where proyecto.id not in(select id_proyecto rom desarrollarproyecto)",
            
            'sql' => "SELECT * FROM proyecto where proyecto.id not in(SELECT id_proyecto FROM desarrollarproyecto)",
            
            
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
        if($proyecto->disponibilidad == 2){
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

<?php

namespace frontend\controllers;

use app\models\Rubrica;
use app\models\RubricaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Item;
use app\models\Model;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Profesorasignatura;
//use app\base\Model;
use yii\data\SqlDataProvider;
use app\models\Entrega;
use app\models\Hito;
use frontend\controllers\Exception;
use Yii;

use app\models\Evaluar;

/**
 * RubricaController implements the CRUD actions for Rubrica model.
 */
class RubricaController extends Controller
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
     * Lists all Rubrica models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RubricaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rubrica model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        //$items = $model->items;
        //$items = Item::find()->where(['id_rubrica' => $id]);
        $items = new SqlDataProvider([
            'sql' => "select * from item where id_rubrica = '$id' ",
           
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $items,

        ]);

    
    }

     /**
     * Displays a single Rubrica model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmodificar($id)
    {
        $model = $this->findModel($id);
        $items = new SqlDataProvider([
            'sql' => "select * from item where id_rubrica = '$id' ",
           
        ]);

        return $this->render('viewmodificar', [
            'model' => $model,
            'dataProvider' => $items,

        ]);

    
    }

    /**
     * Displays a single Rubrica model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewevaluacion($idr,$ide)
    {
        $model = $this->findModel($idr);
        $modelentrega = Entrega::find()->where(['id' => $ide])->one(); 
        //return $modelentrega['id_hito'];
        //return $modelentrega->id;

        $items = new SqlDataProvider([
            'sql' => "select * from item where id_rubrica = '$idr' ",
           
        ]);

        $datos = new SqlDataProvider([
            'sql' => "select id,puntaje, descripcion,SUM(puntaje_obtenido) as puntajeobtenido, SUM(puntaje) as puntajeideal, SUM(puntaje_obtenido)*7/SUM(puntaje) as nota from  item where item.id_rubrica = '$idr'",
           
        ]);

        return $this->render('viewevaluacion', [
            'model' => $model,
            'modelentrega' =>$modelentrega,
            'dataProvider' => $items,
            'dataProvider2' => $datos,

        ]);

    
    }

    /**
     * Displays a single Rubrica model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewevaluacionenviada($idr,$idv)
    {
        $model = $this->findModel($idr);
        //$modelentrega = Entrega::find()->where(['id' => $ide])->one(); 
         //return $modelentrega['id_hito'];
         //return $modelentrega->id;
 
        $items = new SqlDataProvider([
            'sql' => "select * from item where id_rubrica = '$idr' ",
            
        ]);
 
        $datos = new SqlDataProvider([
             'sql' => "select id,puntaje, descripcion,SUM(puntaje_obtenido) as puntajeobtenido, SUM(puntaje) as puntajeideal, SUM(puntaje_obtenido)*7/SUM(puntaje) as nota from  item where item.id_rubrica = '$idr'",
            
        ]);
 
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
        $limpiaritem = $conn->query("UPDATE item SET item.puntaje_obtenido = NULL WHERE item.id_rubrica = ".$idr);
        $limpiarcomen = $conn->query("UPDATE rubrica SET rubrica.observaciones = NULL WHERE rubrica.id =".$idr);

        /*return $this->render('viewevaluacionenviada', [
            'model' => $model,
             //'modelentrega' =>$modelentrega,
            'dataProvider' => $items,
            'dataProvider2' => $datos,
 
        ]);*/
        
        return $this->redirect(['evaluar/view', 'id' =>$idv] );
    
 
        //return;
    }

    public function actionObtenerNota($id){
        $model = $this->findModel($id);
        //$items = $model->items;
       // $items = Item::find()->where(['id_rubrica' => $id]);
        $items = new SqlDataProvider([
            'sql' => "select * from item where item.id_rubrica = '$id'",
           
        ]);
        /*$puntajeideal = new SqlDataProvider([
            'sql' => "select SUM(puntaje) from item where item.id_rubrica = '$id'",
           
        ]);

        $puntajeobtenido = new SqlDataProvider([
            'sql' => "select SUM(puntaje_obtenido) from item where item.id_rubrica = '$id'",
           
        ]);*/

        $datos = new SqlDataProvider([
            'sql' => "select id,puntaje, descripcion,SUM(puntaje_obtenido) as puntajeobtenido, SUM(puntaje) as puntajeideal, SUM(puntaje_obtenido)*7/SUM(puntaje) as nota from  item where item.id_rubrica = '$id'",
           
        ]);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' =>  $items,
            'dataProvider2' => $datos,

        ]);


    }

    public function actionCreate2()
    {
        /*
        'modelRubrica' => $modelRubrica,
        'modelsItem'=>$modelsItem,
        */
        $modelRubrica = new Rubrica();
        $logueado= Yii::$app->user->identity->id_usuarioo;

        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();

        $modelRubrica->id_profe_asignatura= $profesor->id;

        
        $modelsItem = [new Item];

        if ($modelRubrica->load(Yii::$app->request->post())) {

            $modelsItem = Model::createMultiple(Item::classname());
            Model::loadMultiple($modelsItem, Yii::$app->request->post());

            // validate all models
            $valid = $modelRubrica->validate();
            $valid = Model::validateMultiple($modelsItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelRubrica->save(false)) {
                        foreach ($modelsItem as $modelItem) {
                            $modelItem->id_rubrica = $modelRubrica->id;
                            if (! ($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        
                        Yii:: $app->session->setFlash('success','La Rúbrica ha sido creado con éxito');
                        return $this->redirect(['view', 'id' => $modelRubrica->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create2', [
            'modelRubrica' => $modelRubrica,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
        ]);
        
    }



    /**
     * Creates a new Rubrica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $modelRubrica = $this->findModel($id);
        $modelsItem = [new Item];
        

        if ($modelRubrica->load(Yii::$app->request->post(),'')) {

            $modelsItem = Model::createMultiple(Item::classname());
            Model::loadMultiple($modelsItem, Yii::$app->request->post());

            // validate all models
            $valid = $modelRubrica->validate();
            $valid = Model::validateMultiple($modelsItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelRubrica->save(false)) {
                        foreach ($modelsItem as $modelItem) {
                            $modelItem->id_rubrica = $modelRubrica->id;
                            if (! ($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelRubrica->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        
        return $this->render('create', [
            'modelRubrica' => $modelRubrica,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
        ]);



       /* $this->layout = 'vacio'; 
        $model = $this->findModel($id);
        
        $modelsItem = [new Item];

        if ($this->request->isPost) {
            if ($model->load(Yii:: $app->request->post()) && $model->save()) {

                $modelsItem = Model::createMultiple(Item::classname());
                Model::loadMultiple($modelsItem, Yii::$app->request->post());
        
                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsItem) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();

                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsItem as $modelItem) {
                                $modelItem->id_rubrica = $model->id;
                                if (! ($flag = $modelItem->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }

                }else{
                    return $this->render('create', [
                        'model' => $model,
                        
                    ]);
                }
            }
        }   
        

        return $this->render('create', [
            'model' => $model,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
        ]);*/
    
    }

    public function actionCreate1(){

        $model = new Rubrica();
        $logueado= Yii::$app->user->identity->id_usuarioo;

        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();

        $model->id_profe_asignatura= $profesor->id;
       
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii:: $app->session->setFlash('success','La rúbrica ha sido creada con éxito');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create1', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Rubrica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate2($id)
    {
        $modelRubrica = $this->findModel($id);
        $modelsItem =  $modelRubrica->items;
        

        if ($modelRubrica->load(Yii::$app->request->post(),'')) {

            $oldIDs = ArrayHelper::map($modelsItem, 'id', 'id');
            $modelsItem = Model::createMultiple(Item::classname(), $modelsItem);
            Model::loadMultiple($modelsItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItem, 'id', 'id')));

            // validate all models
            $valid = $modelRubrica->validate();
            $valid = Model::validateMultiple($modelsItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelRubrica->save(false)) {
                        if (!empty($deletedIDs)) {
                            Item::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsItem as $modelItem) {
                            $modelItem->id_rubrica = $modelRubrica->id;
                            if (! ($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelRubrica->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update2', [
            'modelRubrica' => $modelRubrica,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
        ]);

    }
    
    /**
     * Updates an existing Rubrica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelRubrica = $this->findModel($id);
        $modelsItem =  $modelRubrica->items;
        
        //return "pasó aquí 1";
        if ($modelRubrica->load(Yii::$app->request->post())) {
            //return print_r($modelRubrica);
            $oldIDs = ArrayHelper::map($modelsItem, 'id', 'id');
            $modelsItem = Model::createMultiple(Item::classname(), $modelsItem);
            //return "pasó aquí 2";
            Model::loadMultiple($modelsItem, Yii::$app->request->post());
            //return "pasó aquí 3";
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItem, 'id', 'id')));
            //return print_r($oldIDs);
            // validate all models
            $valid = $modelRubrica->validate();
            //return $valid; 
            $valid = Model::validateMultiple($modelsItem) && $valid;
             //return print_r ($modelsItem);
            //return "pasó aquí 4";
            if ($valid) {
                //return "pasó aquí 5";
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelRubrica->save(false)) {
                        //return "pasó aquí 6";
                        if (!empty($deletedIDs)) {
                           // return "pasó aquí 7";
                            Item::deleteAll(['id' => $deletedIDs]);
                        }
                        //return "pasó aquí 8";
                        foreach ($modelsItem as $modelItem) {
                           // return "pasó aquí 41";
                            $modelItem->id_rubrica = $modelRubrica->id;
                           // $modelItem->id=null;
                           // return "pasó aquí 9";
                            if (! ($flag = $modelItem->save(false))) {

                                $transaction->rollBack();
                                 //return "pasó aquí 10";
                                break;
                            }
                            unset($modelItem);
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelRubrica->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelRubrica' => $modelRubrica,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
        ]);
      
    }

     /**
     * Updates an existing Rubrica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEvaluar(/*$idr,*/$ide)
    {
        $usuario = Yii::$app->user->identity->id_usuarioo;
        $evaluacion = Evaluar::findOne(['id_entrega'=>$ide, 'id_usuario'=>$usuario]);

        if($evaluacion != null){
            Yii:: $app->session->setFlash('success','Ya calificó ésta entrega');
            return $this->redirect(['evaluar/view', 'id' =>$evaluacion->id] );
        }
        //$rubrica = Rubrica::find()->where(['id' => $hito->id_rubrica])->one(); 
        $modelentrega = Entrega::find()->where(['id' => $ide])->one(); 
        //return $modelentrega['id_hito'];
        //return $modelentrega->id_hito;
        $idt = $modelentrega->id_hito;
        $modelhito = Hito::find()->where(['id' => $idt])->one(); ;
        $idr = $modelhito->id_rubrica;
        $modelRubrica = $this->findModel($idr);
        $modelsItem =  $modelRubrica->items;
        

        if ($modelRubrica->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsItem, 'id', 'id');
            $modelsItem = Model::createMultiple(Item::classname(), $modelsItem);
            Model::loadMultiple($modelsItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItem, 'id', 'id')));

            // validate all models
            $valid = $modelRubrica->validate();
            $valid = Model::validateMultiple($modelsItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    foreach ($modelsItem as $modelItem) {
                        if($modelItem->puntaje_obtenido > $modelItem->puntaje){
                            return $this->render('evaluar', [
                                'modelentrega' =>$modelentrega,
                                'modelRubrica' => $modelRubrica,
                                'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem,
                                'msg' => "El puntaje asignado debe ser menor o igual al puntaje de ítem."
                            ]);
                            
                        }
                        $modelItem->id_rubrica = $modelRubrica->id;
                        if (! ($flag = $modelItem->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    if ($flag = $modelRubrica->save(false)) {
                        if (!empty($deletedIDs)) {
                            Item::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsItem as $modelItem) {
                            $modelItem->id_rubrica = $modelRubrica->id;
                            if (! ($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['viewevaluacion', 'idr' => $modelRubrica->id,'ide' => $modelentrega->id ] );
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('evaluar', [
            'modelentrega' =>$modelentrega,
            'modelRubrica' => $modelRubrica,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem,
            'msg' => null
        ]);


    }





    /**
     * Deletes an existing Rubrica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Rúbrica eliminada con éxito');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rubrica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rubrica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubrica::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

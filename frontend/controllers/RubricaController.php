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



use frontend\controllers\Exception;

use Yii;
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
    public function actionViewevaluacion($id)
    {
        $model = $this->findModel($id);

        $items = new SqlDataProvider([
            'sql' => "select * from item where id_rubrica = '$id' ",
           
        ]);

        $datos = new SqlDataProvider([
            'sql' => "select id,puntaje, descripcion,SUM(puntaje_obtenido) as puntajeobtenido, SUM(puntaje) as puntajeideal, SUM(puntaje_obtenido)*7/SUM(puntaje) as nota from  item where item.id_rubrica = '$id'",
           
        ]);

        return $this->render('viewevaluacion', [
            'model' => $model,
            'dataProvider' => $items,
            'dataProvider2' => $datos,

        ]);

    
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

    /**
     * Creates a new Rubrica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        //$modelRubrica = new Rubrica;
        $modelRubrica = $this->findModel($id);
        
        $modelsItem = [new Item];
        
        //return 'paso aqui';

        if ($modelRubrica->load(Yii::$app->request->post(),'')) {
            //print_r('hola');

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
    







       /* //$modelsItem = $model->items;
        $modelsItem = [new Item];
       // $modelsItem = Item::find()->where(['id_rubrica' => $id]);
        
       if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsItem, 'id', 'id');
            $modelsItem = Model::createMultiple(Item::classname(), $modelsItem);
            Model::loadMultiple($modelsItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItem, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            Item::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsItem as $modelItem) {
                            $modelItem->id_rubrica = $modelItem->id;
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
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
        ]);*/
        //$modelsItem = [new Item];
        
        
        
        
        /*$model = $this->findModel($id);
        

        if ( Yii:: $app->request->isPost && $model->load($this->request->post()) && $model->save()) {

            Yii:: $app->session->setFlash('success','La  rúbrica ha sido modificada con exito');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);*/

    }

     /**
     * Updates an existing Rubrica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEvaluar($id)
    {
        $modelRubrica = $this->findModel($id);
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
                        return $this->redirect(['viewevaluacion', 'id' => $modelRubrica->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('evaluar', [
            'modelRubrica' => $modelRubrica,
            'modelsItem' => (empty($modelsItem)) ? [new Item] : $modelsItem
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
        $this->findModel($id)->delete();

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

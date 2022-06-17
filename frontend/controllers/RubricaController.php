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
        $items = Item::find()->where(['id_rubrica' => $id]);
        return $this->render('view', [
            'model' => $model,
            'modelsItem' => $items,

        ]);

    
    }

    /**
     * Creates a new Rubrica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = 'vacio'; 
        $model = new Rubrica();

        $modelsItem = [new Item];

        $logueado= Yii::$app->user->identity->id_usuarioo;
        
        //return $logueado;
        $profesor= ProfesorAsignatura::find()->where(['id_usuario' => $logueado])->one();

        //return $profesor->id;
        $model->id_profe_asignatura= $profesor->id;
       // $modelsItem = [new Item];


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
          /*Yii:: $app->session->setFlash('success','La rúbrica ha sido creada con exito');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    
                ]);
            }
           /* else {
               $model->loadDefaultValues();
        }*/

        return $this->render('create', [
            'model' => $model,
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
        $modelsItem = [new Item];
        $model = $this->findModel($id);
        

        if ( Yii:: $app->request->isPost && $model->load($this->request->post()) && $model->save()) {

            Yii:: $app->session->setFlash('success','La  rúbrica ha sido modificada con exito');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

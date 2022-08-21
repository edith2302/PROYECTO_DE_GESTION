<?php

namespace frontend\controllers;

use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use kartik\mpdf\Pdf;
use Yii;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex2()
    {
        $searchModel = new UsuarioSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        $model = new SqlDataProvider([
            'sql' => "SELECT * FROM usuario WHERE usuario.id_usuario IN (SELECT id_usuarioo FROM user WHERE user.role = 2)" ,
        ]);

        /*return $this->render('entregashito', [
            'dataProvider' => $model,
        ]);*/

        //$dataProvider ='select * from user where role = 2' ;
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $model,
            //'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex3()
    {
        $searchModel = new UsuarioSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        $model = new SqlDataProvider([
            'sql' =>"SELECT usuario.id_usuario, usuario.nombre, usuario.apellido,usuario.rut, profesoricinf.area, user.email FROM usuario JOIN profesoricinf on usuario.id_usuario = profesoricinf.id_usuario JOIN user on user.id_usuarioo=usuario.id_usuario WHERE user.role = 3" ,
        ]);

        /*return $this->render('entregashito', [
            'dataProvider' => $model,
        ]);*/

        //$dataProvider ='select * from user where role = 2' ;
        return $this->render('index3', [
            'searchModel' => $searchModel,
            'dataProvider' => $model,
            //'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Usuario model.
     * @param int $id_usuario Id Usuario
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_usuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_usuario),
        ]);
    }

     /**
     * Displays a single Usuario model.
     * @param int $id_usuario Id Usuario
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewmiperfil($id_usuario)
    {
        return $this->render('viewmiperfil', [
            'model' => $this->findModel($id_usuario),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Usuario();
//return 'paso aqui';
        if ($this->request->isPost) {
           // return 'paso aqui';
           //return print_r($model);
            if ($model->load($this->request->post()) && $model->save()) {
                //return 'paso aqui';
                return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_usuario Id Usuario
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_usuario)
    {
        $model = $this->findModel($id_usuario);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_usuario Id Usuario
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_usuario)
    {
        $this->findModel($id_usuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_usuario Id Usuario
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario)
    {
        if (($model = Usuario::findOne(['id_usuario' => $id_usuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
 //reporte pdf

      public function actionExportPdf1() {

        $searchModel = new UsuarioSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        $model = new SqlDataProvider([
            'sql' => "SELECT * FROM usuario WHERE usuario.id_usuario IN (SELECT id_usuarioo FROM user WHERE user.role = 2)" ,
        ]);
       

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_indexpdf1',['dataProvider' => $model,]);
        
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
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Listado de Estudiantes de Anteproyecto de título'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionExportPdf2() {
        $searchModel = new UsuarioSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        $model = new SqlDataProvider([
            'sql' =>"SELECT usuario.id_usuario, usuario.nombre, usuario.apellido,usuario.rut, profesoricinf.area, user.email FROM usuario JOIN profesoricinf on usuario.id_usuario = profesoricinf.id_usuario JOIN user on user.id_usuarioo=usuario.id_usuario WHERE user.role = 3" ,
        ]);

        
        //$dataProvider = $searchModel->search($this->request->queryParams);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_indexpdf2',['dataProvider' => $model,]);
        
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
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Listado de Profesores de Ingeniería Civil Informática'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    /*public function actionExportExcel2()
    {
        $searchModel = new Usuariosearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // Initalize the TBS instance
        $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
        // Change with Your template kaka
		$template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/ms-excel.xlsx';
        $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
        //$OpenTBS->VarRef['modelName']= "Mahasiswa";				
        $data = [];
        $no=1;
        foreach($dataProvider->getModels() as $estudiante){
            $data[] = [
                'no'=>$no++,
                'nombre'=>$estudiante->nombre,
                'rut'=>$estudiante->rut,
                'email'=>$estudiante->email,
                'telefono'=>$estudiante->telefono,
            ];
        }
        
        $data2[0] = [
                'no'=>'X',
                'nombre'=>'Y',
                'rut'=>'Z',
            ];
        $data2[1] = [
                'no'=>'X',
                'nombre'=>'Y',
                'rut'=>'Z',
            ];
        $OpenTBS->MergeBlock('data', $data);
        $OpenTBS->MergeBlock('data2', $data2);
        // Output the result as a file on the server. You can change output file
        $OpenTBS->Show(OPENTBS_DOWNLOAD, 'export.xlsx'); // Also merges all [onshow] automatic fields.			
        exit;
    } */

    /*public function actionIndex4()
    {
        $searchModel = new UsuarioSearch();
        //$dataProvider = $searchModel->search($this->request->queryParams);

        $model = new SqlDataProvider([
            'sql' => "SELECT * FROM usuario WHERE usuario.id_usuario IN (SELECT id_usuarioo FROM user WHERE user.role = 2)" ,
        ]);
        $content=$this->renderPartial("excel",array("model"=>Usuario::model()->findAll()),true);
        Yii::app()->request->sendFile("test.xls",$content);

        $estudiantes=Usuario::model()->findAll();
        $this->render("index",array("estudiantes"=>$estudiantes));
    }*/



}

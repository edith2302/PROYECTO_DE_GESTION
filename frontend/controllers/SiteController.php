<?php

namespace frontend\controllers;

use app\models\Usuario;
use common\util\RESTService;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\FormUpload;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Response;


use app\models\FormRegister;
//use app\models\Users;
use app\models\User;
//use common\models\User;
//use app\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionUser(){
        return $this->render("user");
    }

   public function actionAdmin(){

        return $this->render("admin");
    }

    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 /*public function actionConfirm()
 {
    $table = new User;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los parámetros get
        $id = Html::encode($_GET["id"]);
        $authKey = $_GET["authKey"];
    
        if ((int) $id)
        {
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("id=:id", [":id" => $id])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
 
            //Si el registro existe
            if ($model->count() == 1)
            {
                $activar = User::findOne($id);
                $activar->activate = 1;
                if ($activar->update())
                {
                    echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
             }
            else //Si no existe redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
        else //Si id no es un número entero redireccionamos a login
        {
            return $this->redirect(["site/login"]);
        }
    }
 }*/
 
 public function actionRegister()
 {
  //Creamos la instancia con el model de validación
  $model = new FormRegister;
   
  //Mostrará un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validación mediante ajax
    if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
    }
   
  //Validación cuando el formulario es enviado vía post
  //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
  //También previene por si el usuario tiene desactivado javascript y la
  //validación mediante ajax no puede ser llevada a cabo
    if ($model->load(Yii::$app->request->post()))
    {
        if($model->validate())
        {
            //Preparamos la consulta para guardar el usuario
            $table = new User;
            $table->username = $model->username;
            $table->email = $model->email;
            //Encriptamos el password
            $table->password = crypt($model->password, Yii::$app->params["salt"]);
            //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
            //clave será utilizada para activar el usuario
            $table->authKey = $this->randKey("abcdef0123456789", 200);
            //Creamos un token de acceso único para el usuario
            $table->accessToken = $this->randKey("abcdef0123456789", 200);
            
            //Si el registro es guardado correctamente
            if ($table->insert())
            {
            //Nueva consulta para obtener el id del usuario
            //Para confirmar al usuario se requiere su id y su authKey
            $user = $table->find()->where(["email" => $model->email])->one();
            $id = urlencode($user->id);
            $authKey = urlencode($user->authKey);
            
            $subject = "Confirmar registro";
            $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
            $body .= "<a href='http://yii.local/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
            
            //Enviamos el correo
            Yii::$app->mailer->compose()
            ->setTo($user->email)
            ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
            ->setSubject($subject)
            ->setHtmlBody($body)
            ->send();
            
            $model->username = null;
            $model->email = null;
            $model->password = null;
            //$model->password_repeat = null;
            
            $msg = "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
            //return print_r($table);
            }
            else
            {
            $msg = "Ha ocurrido un error al llevar a cabo tu registro";
            }
            
        }
        else
        {
            $model->getErrors();
        }
    }
    return $this->render("register", ["model" => $model, "msg" => $msg]);
 }
    public function actionUpload()
    {
     
        $model = new FormUpload;
        $msg = null;
     
        if ($model->load(Yii::$app->request->post())){
            $model->file = UploadedFile::getInstances($model, 'file');
   
            if ($model->file && $model->validate()) {
                foreach ($model->file as $file) {
                    $file->saveAs('archivos/' . $file->baseName . '.' . $file->extension);
                    $msg = "<p><strong class='label label-info'>Entrega realizada con éxito</strong></p>";
                }
            }
        }
        return $this->render("upload", ["model" => $model, "msg" => $msg]);
    }






    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'user', 'admin'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'admin'],
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
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                       'actions' => ['logout', 'user'],
                       //Esta propiedad establece que tiene permisos
                       'allow' => true,
                       //Usuarios autenticados, el signo ? es para invitados
                       'roles' => ['@'],
                       //Este método nos permite crear un filtro sobre la identidad del usuario
                       //y así establecer si tiene permisos o no
                       'matchCallback' => function ($rule, $action) {
                          //Llamada al método que comprueba si es un usuario simple
                          return User::isUserProfesorAsignatura(Yii::$app->user->identity->id);
                      },
                   ],


                   [
                    //Los usuarios simples tienen permisos sobre las siguientes acciones
                    'actions' => ['logout', 'user'],
                    //Esta propiedad establece que tiene permisos
                    'allow' => true,
                    //Usuarios autenticados, el signo ? es para invitados
                    'roles' => ['@'],
                    //Este método nos permite crear un filtro sobre la identidad del usuario
                    //y así establecer si tiene permisos o no
                    'matchCallback' => function ($rule, $action) {
                       //Llamada al método que comprueba si es un usuario simple
                       return User::isUserEstudiante(Yii::$app->user->identity->id);
                   },
                ],

                [
                    //Los usuarios simples tienen permisos sobre las siguientes acciones
                    'actions' => ['logout', 'user'],
                    //Esta propiedad establece que tiene permisos
                    'allow' => true,
                    //Usuarios autenticados, el signo ? es para invitados
                    'roles' => ['@'],
                    //Este método nos permite crear un filtro sobre la identidad del usuario
                    //y así establecer si tiene permisos o no
                    'matchCallback' => function ($rule, $action) {
                       //Llamada al método que comprueba si es un usuario simple
                       return User::isUserProfesorICINF(Yii::$app->user->identity->id);
                   },
                ],

                [
                    //Los usuarios simples tienen permisos sobre las siguientes acciones
                    'actions' => ['logout', 'user'],
                    //Esta propiedad establece que tiene permisos
                    'allow' => true,
                    //Usuarios autenticados, el signo ? es para invitados
                    'roles' => ['@'],
                    //Este método nos permite crear un filtro sobre la identidad del usuario
                    //y así establecer si tiene permisos o no
                    'matchCallback' => function ($rule, $action) {
                       //Llamada al método que comprueba si es un usuario simple
                       return User::isUserComision(Yii::$app->user->identity->id);
                   },
                ],

                [
                    //Los usuarios simples tienen permisos sobre las siguientes acciones
                    'actions' => ['logout', 'user'],
                    //Esta propiedad establece que tiene permisos
                    'allow' => true,
                    //Usuarios autenticados, el signo ? es para invitados
                    'roles' => ['@'],
                    //Este método nos permite crear un filtro sobre la identidad del usuario
                    //y así establecer si tiene permisos o no
                    'matchCallback' => function ($rule, $action) {
                       //Llamada al método que comprueba si es un usuario simple
                       return User::isUserProfesorGuia(Yii::$app->user->identity->id);
                   },
                ],


                [
                    //Los usuarios simples tienen permisos sobre las siguientes acciones
                    'actions' => ['logout', 'user'],
                    //Esta propiedad establece que tiene permisos
                    'allow' => true,
                    //Usuarios autenticados, el signo ? es para invitados
                    'roles' => ['@'],
                    //Este método nos permite crear un filtro sobre la identidad del usuario
                    //y así establecer si tiene permisos o no
                    'matchCallback' => function ($rule, $action) {
                       //Llamada al método que comprueba si es un usuario simple
                       return User::isUserJefaturaCarrera(Yii::$app->user->identity->id);
                   },
                ],
                ],
            ],
     //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
     //sólo se puede acceder a través del método post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /*public function actionConsultasApi()
    {
        $calculoIntegral = RESTService::obtieneAsignaturaPorCodigo("2401752");

        $todos_los_usuarios = Usuario::find()->all();
        return $this->render('consultas-api',
        [
            'todosLosUsuarios'=>$todos_los_usuarios,
            'obtieneAsignaturaPorCodigo'=>$calculoIntegral
        ]);
    }*/

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
   
            if (User::isUserAdmin(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/admin"]);
            }
            else
            {
                return $this->redirect(["site/user"]);
            }
        }
            
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            if (User::isUserAdmin(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/admin"]);
            }
            else
            {
                return $this->redirect(["site/user"]);
            }
            
        } else {
            return $this->render('login', [
            'model' => $model,]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        /*$model = new LoginForm();


        return $this->render('login', [
            //'model' => $model,
        ]);*/
    
        //return $this->redirect("site/login");
        return $this->redirect("index.php?r=site%2Flogin");
      
        //return $this->redirect('site/login');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Gracias por registrarse. Por favor revise su bandeja de entrada para el correo electrónico de verificación.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su correo electrónico para obtener más instrucciones.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Lo sentimos, no podemos restablecer la contraseña para la dirección de correo electrónico proporcionada.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}

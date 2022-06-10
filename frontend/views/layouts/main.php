<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Adjunto;
use common\models\AuthItem;
use common\models\AuthItemChild;
use common\models\TextoAyuda;
use common\models\Usuario;
use common\util\Utilidades;

use yii\bootstrap4\Modal;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
AppAsset::register($this);
$common_path = dirname(__FILE__,2);


$this->beginPage() ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name) ?></title>
    <script type="text/javascript">
        //Manera correcta
        var url_current = "<?php echo Url::current()?>";
        //Manera incorrecta que utiliza ActiveForm
        var url_to = "<?php echo Url::to()?>";
    </script>
    <?php $this->head() ?>
</head>
<body class="is-preload">
<?php $this->beginBody(); ?>
<script type="application/javascript">
    var ruta_actual = "<?php echo Yii::$app->controller->id.'/'.Yii::$app->controller->action->id; ?>";
    var ruta_ajax_texto = "<?php echo Url::to(['texto-ayuda/createajax']); ?>";
    var ruta_ajax_texto_obtener = "<?php echo Url::to(['texto-ayuda/obtenerajax']); ?>";
    var ruta_ajax_texto_eliminar = "<?php echo Url::to(['texto-ayuda/deleteajax']); ?>";

</script>
<!-- Modal Formulario Texto de Ayuda -->
<?php

Modal::begin([
    'title' => 'Agregar texto de ayuda',
    'id'=> 'modal-ayuda',
    'closeButton'=>[
        'onclick'=>"cerrarModalAyuda()"
    ]
    //'toggleButton' => ['label' => 'click me'],
]);
?>
<span id="config-ayuda"></span>
<label for="texto-ayuda"></label>
<textarea id="texto-ayuda" ></textarea>
<br>
<span id="botones-ayuda" style="float: right">
    <button onclick="cerrarModalAyuda()">Cancelar</button>
    <button id="eliminar-ayuda" style="display: none">Eliminar</button>
    <button id="guardar-ayuda">Guardar</button>
</span>

<?php
Modal::end();
?>
<!-- Fin Modal Formulario Texto de Ayuda -->

<!-- Imagen de carga -->
<div class="overlay" id="loader">
    <div class="spinner-border text-light" style="width: 7rem; height: 7rem;border-width: 10px" role="status">
    </div>
</div>
<!-- Fin imagen de carga -->

<!-- Snackbar -->
<div id="snackbar" style="z-index: 1000"></div>
<!-- Fin snackbar -->

<!-- Flash y snackbar -->
<?php if (Yii::$app->session->hasFlash('success')):
    $flash = Yii::$app->session->getFlash('success');
    $flash = str_replace('\'','"',$flash);
    $flash = str_replace(array("\r", "\n"), '', $flash);
    ?>
    <script type="application/javascript">
        showSnackbar('<?php echo $flash;?>','success');
    </script>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')):
    $flash = Yii::$app->session->getFlash('error');
    $flash = str_replace('\'','"',$flash);
    $flash = str_replace(array("\r", "\n"), '', $flash);
    ?>
    <script type="application/javascript">

        showSnackbar('<?php echo $flash;?>','error');
    </script>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('info')):
    $flash = Yii::$app->session->getFlash('info');
    $flash = str_replace('\'','"',$flash);
    $flash = str_replace(array("\r", "\n"), '', $flash);
    ?>
    <script type="application/javascript">
        showSnackbar('<?php echo $flash;?>','info');
    </script>
<?php endif; ?>
<!-- Fin flash y snackbar -->

<!-- Wrapper -->
<div id="wrapper">
    <!-- Main -->
    <div id="main">
        <header id="header" class="headerburdeo">
            <div class="logo">
                <img src='images/logo_sae.png' alt='Volver a ICI'>
            </div>
            <div class="logo2">
                <?= Html::a(Yii::$app->name, Url::to(['site/index'])) ?>
            </div>

            <div class="icons">
                <?php if(!Yii::$app->user->isGuest):
                    echo Html::a('',['usuario/mi-perfil'],[
                        'class'=>'icon fa-user-circle',
                        'title'=>'Mi perfil',
                        'style'=>'float:left; font-size:56px; top:-7px'
                    ])
                    ?>

                <?php endif;?>
                <div>

                    <?php if(!Yii::$app->user->isGuest):
                        $nombreUsuario = preg_split('/\s+/', Yii::$app->user->identity->username, -1, PREG_SPLIT_NO_EMPTY);
                        ?>
                        <p>
                        <h3>Hola <?= ucfirst(strtolower($nombreUsuario[0])) ?></h3>
                        </p>
                        <p>
                            <?= Html::a('Salir', Url::to(['/site/logout']),[
                                'title'=>'Cerrar sesión',
                                'data-method'=>'POST',
                            ]) ?>
                        </p>
                    <?php else:?>
                    <p>
                        <?= Html::a('Entrar', Url::to(['/site/login']),[
                            'title'=>'Iniciar Sesión',
                        ]) ?>
                    </p>
                </div>
            <?php endif;?>
            </div>
        </header>

        <crumb class="rastro">
            <a href="<?=Url::to(['site/index'])?>" class="icon fa-home" title="Ir al inicio">
                <span class="label">Inicio</span>
            </a>
            <!--<a href="#" class="icon fa-chevron-left"><span class="label">Atrás</span>
            </a>-->
            <?php

            echo Breadcrumbs::widget([
                'tag' => 'span',
                'options'=>['class'=>''],
                'itemTemplate' => '<span>{link} » </span>',
                'activeItemTemplate' => '<span> {link}</span>',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'homeLink' => [
                    'label' => Yii::t('yii', 'Inicio'),
                    'url' => Url::to(['site/index']),
                ],
            ])

            ?>
        </crumb>

        <div class="inner">
            <?= $content ?>
        </div>
    </div>
    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner">
            <!-- Menu -->
            <nav id="menu">
                <header class="major">
                    <h2 id="sistema_name">Sistema de Administración de Escuelas</h2>
                </header>
                <ul class="sidebar-items">
                    <li>
                        <?= Html::a(' Inicio',Url::to(['site/index']),['class'=>'icon fa-home']) ?>
                    </li>

                    <?php if (Yii::$app->user->isGuest):?>
                        <li>
                            <?= Html::a(' Iniciar Sesión',Url::to(['site/login']),['class'=>'icon fa-sign-in']) ?>
                        </li>
                        <li>
                            <?= Html::a(' Registrarse',Url::to(['site/signup']),['class'=>'icon fa-sign-up']) ?>
                        </li>
                    <?php else: ?>
                        <li>
                            <span  class="opener"><span class="icon fa-user"> Ejemplo API</span></span>
                            <ul id="ejemplo-api">
                                <li>
                                    <?= Html::a('Consultas API', Url::to(['/site/consultas-api'])) ?>
                                </li>
                            </ul>
                        </li>
                    <li>
                        <span  class="opener"><span class="icon fa-user"> Cuenta</span></span>
                        <ul id="cuenta">
                            <li>
                                <?= Html::a('Mi Perfil', Url::to(['/usuario/mi-perfil'])) ?>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <span  class="opener"><span class="icon fa-hand-o-up"> Inscripción Actividades</span></span>
                        <ul id="incripciones">

                            <li>
                                <?= Html::a('Inscribir Actividad', Url::to(['/inscripcion/index'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Mis Actividades', Url::to(['/inscripcion/mis-inscripciones'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Nueva Actividad', Url::to(['/inscripcion/create'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Gestionar', Url::to(['/inscripcion/admin'])) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span  class="opener"><span class="icon fa-plus"> Preinscripción Asignaturas</span></span>
                        <ul id="preinscripcion">
                            <li>
                                <?= Html::a('Asignaturas locales', Url::to(['/ramo-local/index'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Preinscribir Asignatura', Url::to(['/preinscripcion/index'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Mis Preinscripciones', Url::to(['/preinscripcion/mis-preinscripciones'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Nueva Preinscripción', Url::to(['/preinscripcion/create'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Gestionar', Url::to(['/preinscripcion/admin'])) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span  class="opener">
                            <span class="icon fa-comments">
                                Foro
                            </span>
                        </span>
                        <ul id="foro-tema">

                            <li>
                                <?= Html::a('Categorías de temas', Url::to(['/foro-categoria/index'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Establecer orden de categorías', Url::to(['/foro-categoria/sort'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Nuevo Tema', Url::to(['/foro-tema/create'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Todos los Temas', Url::to(['/foro-tema/index'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Mis Temas', Url::to(['/foro-tema/mis-temas'])) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span  class="opener"><span class="icon fa-check"> Solicitudes</span></span>
                        <ul id="solicitud">

                            <li>
                                <?= Html::a('Nueva Solicitud', Url::to(['/solicitud/create'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Mis Solicitudes', Url::to(['/solicitud/index'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Gestionar', Url::to(['/solicitud/admin'])) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span class="opener"><span class="icon fa-calendar-o"> Periodos</span></span>
                        <ul id="periodos">
                            <li>
                                <?= Html::a('¿Qué es un periodo?', Url::to(['/periodo/informacion'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Ver Periodos', Url::to(['/periodo/index'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Nuevo Periodo', Url::to(['/periodo/create'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Gestionar', Url::to(['/periodo/admin'])) ?>
                            </li>

                        </ul>
                    </li>


                    <li>
                        <span class="opener"><span class="icon fa-envelope-open-o"> Email</span></span>
                        <ul id="periodos">
                            <li>
                                <?= Html::a('Historial de enviados', Url::to(['/email/index'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Enviar email', Url::to(['/email/enviar'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Enviar email masivo', Url::to(['/email/enviar-masivo'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Personalizar Firma', Url::to(['/email/firma'])) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="opener"><span class="icon fa-id-card-o"> Cargos</span></span>
                        <ul id="periodos">
                            <li>
                                <?= Html::a('Ver Cargos', Url::to(['/cargos/index'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Nuevo Cargo', Url::to(['/cargos/create'])) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span class="opener"><span class="icon fa-info"> Información del Sitio</span></span>
                        <ul id="periodos">
                            <li>
                                <?= Html::a('Página de Información', Url::to(['/informacion-sitio/index'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Nueva Información', Url::to(['/informacion-sitio/create'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Administrar Información', Url::to(['/informacion-sitio/admin'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Cambiar Orden', Url::to(['/informacion-sitio/sort'])) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span class="opener"><span class="icon fa-users"> Usuarios y Roles</span></span>
                        <ul id="usuarios-roles">
                            <li>
                                <?= Html::a('Administrar Usuarios', Url::to(['/usuario/index'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Importar Usuario', Url::to(['/usuario/importar-ubb'])) ?>
                            </li>
                            <!--
                            <li>
                                <?= Html::a('Administrar Roles', Url::to(['/rol/index'])) ?>
                            </li>

                            <li>
                                <?= Html::a('Cambiar de Rol', Url::to(['/rol/cambio-rol'])) ?>
                            </li>
                            -->
                        </ul>
                    </li>

                    <li>
                        <span class="opener"><span class="icon fa-list-alt"> Mantenedores </span></span>
                        <ul id="administracion">
                            <li>
                                <?= Html::a('Mantenedor de Documentos', Url::to(['/documento/admin'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Mantenedor de Noticias', Url::to(['/noticia/admin'])) ?>
                            </li>
                            <li>
                                <?= Html::a('Parámetros generales', Url::to(['/parametros-generales/index'])) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="opener"><span class="icon fa-play"> Videos Ayuda</span></span>
                        <ul id="videos-ayuda">
                            <li>
                                <?= Html::a('Todos los videos', Url::to(['/video-ayuda/index'])) ?>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <?= Html::a(' Documentos', Url::to(['/documento/index']),['class'=>'icon fa-download']) ?>
                    </li>
                    <li>
                        <?= Html::a(' Noticias', Url::to(['/noticia/index']),['class'=>'icon fa-newspaper-o']) ?>
                    </li>
                    <?php endif; ?>

                    <?php if (!Yii::$app->user->isGuest):?>
                        <li>
                            <?= \yii\bootstrap4\Html::a(' Cerrar Sesión', Url::to(['/site/logout']),[
                                'class'=>['icon', 'icon fa-times'],
                                'title'=>'Cerrar sesión',
                                'data-method'=>'POST',
                            ]) ?>
                        </li>
                    <?php endif ?>

                </ul>
            </nav>
            <!-- Seccion -->
            <!-- Seccion -->
            <section>
                <header class="major">
                    <h2>Contacto administrador</h2>
                </header>
                <!--<p>hohoho ho hohoho ho ho</p>-->
                <ul class="contact">
                    <li class="fa-envelope-o">
                        <?=Yii::$app->params['adminEmail']?>
                    </li>
                </ul>
            </section>
            <div class="footer" id="foot">
                <img src="images/logo_ubb.png" width="235" height="70" alt="UBB">
                <p class="copyright">Sistema de Administración de Escuelas</p>
                <p class="copyright" title="Desarrollado por DDCTI y UDSW">Desarrollado por DDCTI y UDSW </p>
            </div>
        </div>

    </div>
</div>
<!-- Scripts -->

<?php
Modal::begin([
    'title' => '<h4 style="margin: 0">Confirmar acción</h4>',
    'id'=>'dataConfirmModal',
    'size'=>'modal-md modal-dialog-centered',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss'=>'modal'
    ]
]);
?>

<div id="texto-confirmacion">¿Confirma esta acción?</div>
<br>

<?php
echo Html::a('Confirmar','javascrip:void(0)',[
    'id'=>'dataConfirmATag',
    'class'=>'button primary',
    'style'=>'float:right'
]);

echo Html::button('Confirmar',[
    'id'=>'dataConfirmButtonTag',
    'class'=>'button primary',
    'style'=>'float:right'
]);

echo Html::button('Cancelar', [
    'id'=>'dataCancel',
    'data-dismiss'=>"modal",
    'aria-hidden'=>true,
    'style'=>'float:right'
]);


Modal::end();

?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
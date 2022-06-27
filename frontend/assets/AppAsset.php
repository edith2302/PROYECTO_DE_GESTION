<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/color_celeste.css',
        'css/selectize.css',
        'css/from_yii.css',
        'css/datepicker.css',
        'css/tooltips.css',
        'css/extras_modulo_carrera.css',
        //Sólo para los íconos de calendarios de los plugins "Kartik" se necesita FA 5+
        'css/fontawesome-free-5.3.1-web/css/all.css',
        // 'css/bootstrap-3.3.7-dist/css/bootstrap.css',
        //La versión 4.7 debe ir después de la 5.3.1
        'css/font-awesome-4.7.0/css/font-awesome.css',
        'css/snackbar.css',
        'css/main.css', /*---------PROBLEMA----------*/
        //'css/site.css',
    ];
    public $js = [
        'js/loader_util.js',
        ['js/jquery.min.js', 'position'=>View::POS_HEAD],
        /*No usar snackbar.js ya que usa jquery, y jquery al final del body, mientras que snackbar.js se requiere utilizar y cargar en el head del body, por lo que necesita
        Jquery pero al momento de ser llamado jquery aún no es cargado
        ['js/snackbar.js', 'position'=>View::POS_HEAD], */
        ['js/snackbar_purejs.js', 'position'=>View::POS_HEAD],
        'js/confirm-personalizado.js',
        'js/alert-personalizado.js',
        'js/otras-funciones-utiles.js',
        'js/fix-forms.js',
        'js/selectize.js',
        'js/multifile/jquery.MultiFile.js',
        'js/browser.min.js',
        'js/breakpoints.min.js',
        'js/util.js',
        'js/main.js',
        'js/rut-validator.js',

        'js/yii-override.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'yii\web\YiiAsset',
        'app\assets\SweetAlertAsset',
    ];
    //Forzar actualizacion de js, css, etc con archivos nuevos

    public $publishOptions = [
        'forceCopy' => true,
    ];
}

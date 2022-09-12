<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'America/Santiago',
    'charset' => 'UTF-8',
    'language'=>'es',

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'formatter' => [

            'dateFormat' => 'dd-MM-yyyy',

            'datetimeFormat' => 'php:d.m.Y H:i:s',

            'decimalSeparator' => ',',

            'thousandSeparator' => '.',

            'currencyCode' => 'ES',

        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',  // ej. smtp.mandrillapp.com o smtp.gmail.com, smtp.tchile.com
                'username' => 'girleyn.molina1501@alumnos.ubiobio.cl',//sistema-web@ternuble.cl
                'password' => 'clave',//
                'port' => '587', // El puerto 25 es un puerto común también
                'encryption' => 'tls', // Es usado también a menudo, revise la configuración del servidor
            ],
        ],

        
    ],
];
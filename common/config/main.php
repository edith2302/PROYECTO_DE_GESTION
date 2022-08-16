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
    ],
];
<?php
namespace common\util;

class Utilidades{

    public static function saludo(){
        echo "Hola!";
        exit;
    }

    public static function beautifulVarDumpArray($array, $exit){
        echo "<pre>";
        var_dump($array);
        echo "</pre>";
        if ($exit === true){
            exit;
        }
    }
}

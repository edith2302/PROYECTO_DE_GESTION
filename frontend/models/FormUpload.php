<?php
 
namespace app\models;
use yii\base\model;
 
class FormUpload extends model{
  
    public $file;
     
    public function rules()
    {
        return [
            ['file', 'file', 
   'skipOnEmpty' => false,
   'uploadRequired' => 'No has seleccionado ningún archivo', //Error
   'maxSize' => 2048*2048*1, //1 MB
   'tooBig' => 'El tamaño máximo permitido es 2MB', //Error
   'minSize' => 10, //10 Bytes
   'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
   'extensions' => 'pdf, txt, doc, rar, png, jpg, docx',
   'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
   'maxFiles' => 4,
   'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
   ],
        ]; 
    } 
 
 public function attributeLabels()
 {
  return [
   'file' => 'Seleccionar archivos:',
  ];
 }
}

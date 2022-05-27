<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Rolusuario[] $rolusuarios
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Rolusuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolusuarios()
    {
        return $this->hasMany(Rolusuario::className(), ['id_rol' => 'id']);
    }
}

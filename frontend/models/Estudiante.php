<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property Cursoestudiante[] $cursoestudiantes
 * @property Desarrollarproyecto[] $desarrollarproyectos
 * @property Usuario $usuario
 */
class Estudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * Gets query for [[Cursoestudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoestudiantes()
    {
        return $this->hasMany(Cursoestudiante::className(), ['id_estudiante' => 'id']);
    }

    /**
     * Gets query for [[Desarrollarproyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDesarrollarproyectos()
    {
        return $this->hasMany(Desarrollarproyecto::className(), ['id_estudiante' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }
}

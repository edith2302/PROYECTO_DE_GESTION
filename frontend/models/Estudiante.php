<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property CursoEstudiante[] $cursoEstudiantes
 * @property DesarrollarProyecto[] $desarrollarProyectos
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
            [['id', 'id_usuario'], 'required'],
            [['id', 'id_usuario'], 'integer'],
            [['id'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
     * Gets query for [[CursoEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoEstudiantes()
    {
        return $this->hasMany(CursoEstudiante::className(), ['id_estudiante' => 'id']);
    }

    /**
     * Gets query for [[DesarrollarProyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDesarrollarProyectos()
    {
        return $this->hasMany(DesarrollarProyecto::className(), ['id_estudiante' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
}

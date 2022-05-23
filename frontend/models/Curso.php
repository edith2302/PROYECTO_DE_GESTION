<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property int $id
 * @property string $nombre
 * @property int $año
 * @property int $semestre
 * @property int $id_admin
 *
 * @property Administrador $administrador
 * @property CursoEstudiante[] $cursoEstudiantes
 * @property GestionarCurso[] $gestionarCursos
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'año', 'semestre', 'id_admin'], 'required'],
            [['año', 'semestre', 'id_admin'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
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
            'año' => 'Año',
            'semestre' => 'Semestre',
            'id_admin' => 'Id Admin',
        ];
    }

    /**
     * Gets query for [[Administrador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrador()
    {
        return $this->hasOne(Administrador::className(), ['id' => 'id_admin']);
    }

    /**
     * Gets query for [[CursoEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoEstudiantes()
    {
        return $this->hasMany(CursoEstudiante::className(), ['id_curso' => 'id']);
    }

    /**
     * Gets query for [[GestionarCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestionarCursos()
    {
        return $this->hasMany(GestionarCurso::className(), ['id_curso' => 'id']);
    }
}

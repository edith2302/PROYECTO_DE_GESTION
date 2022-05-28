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
 * @property int $id_administrador
 *
 * @property Administrador $administrador
 * @property Cursoestudiante[] $cursoestudiantes
 * @property Gestionarcurso[] $gestionarcursos
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
            [['nombre', 'año', 'semestre', 'id_administrador'], 'required'],
            [['año', 'semestre', 'id_administrador'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_administrador'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['id_administrador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código curso',
            'nombre' => 'Nombre',
            'año' => 'Año',
            'semestre' => 'Semestre',
            'id_administrador' => 'Código Administrador',
        ];
    }

    /**
     * Gets query for [[Administrador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrador()
    {
        return $this->hasOne(Administrador::className(), ['id' => 'id_administrador']);
    }

    /**
     * Gets query for [[Cursoestudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoestudiantes()
    {
        return $this->hasMany(Cursoestudiante::className(), ['id_curso' => 'id']);
    }

    /**
     * Gets query for [[Gestionarcursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestionarcursos()
    {
        return $this->hasMany(Gestionarcurso::className(), ['id_curso' => 'id']);
    }
}

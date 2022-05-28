<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursoestudiante".
 *
 * @property int $id
 * @property int $id_curso
 * @property int $id_estudiante
 *
 * @property Curso $curso
 * @property Estudiante $estudiante
 */
class Cursoestudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursoestudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_curso', 'id_estudiante'], 'required'],
            [['id_curso', 'id_estudiante'], 'integer'],
            [['id_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['id_curso' => 'id']],
            [['id_estudiante'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['id_estudiante' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código lista de estudiantes',
            'id_curso' => 'Código curso',
            'id_estudiante' => 'Código estudiante',
        ];
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'id_curso']);
    }

    /**
     * Gets query for [[Estudiante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiante()
    {
        return $this->hasOne(Estudiante::className(), ['id' => 'id_estudiante']);
    }
}

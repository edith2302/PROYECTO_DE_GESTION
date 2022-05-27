<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gestionarcurso".
 *
 * @property int $id
 * @property int $id_curso
 * @property int $id_profesor
 *
 * @property Curso $curso
 * @property Profesorasignatura $profesor
 */
class Gestionarcurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestionarcurso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_curso', 'id_profesor'], 'required'],
            [['id_curso', 'id_profesor'], 'integer'],
            [['id_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['id_curso' => 'id']],
            [['id_profesor'], 'exist', 'skipOnError' => true, 'targetClass' => Profesorasignatura::className(), 'targetAttribute' => ['id_profesor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_curso' => 'Id Curso',
            'id_profesor' => 'Id Profesor',
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
     * Gets query for [[Profesor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesor()
    {
        return $this->hasOne(Profesorasignatura::className(), ['id' => 'id_profesor']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gestionar_curso".
 *
 * @property int $id
 * @property int $id_curso
 * @property int $id_profesor
 *
 * @property Curso $curso
 * @property ProfesorAsignatura $profesor
 */
class GestionarCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestionar_curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_curso', 'id_profesor'], 'required'],
            [['id', 'id_curso', 'id_profesor'], 'integer'],
            [['id'], 'unique'],
            [['id_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['id_curso' => 'id']],
            [['id_profesor'], 'exist', 'skipOnError' => true, 'targetClass' => ProfesorAsignatura::className(), 'targetAttribute' => ['id_profesor' => 'id']],
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
        return $this->hasOne(ProfesorAsignatura::className(), ['id' => 'id_profesor']);
    }
}

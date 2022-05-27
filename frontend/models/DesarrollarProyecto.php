<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "desarrollarproyecto".
 *
 * @property int $id
 * @property int $id_proyecto
 * @property int $id_estudiante
 *
 * @property Estudiante $estudiante
 */
class Desarrollarproyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desarrollarproyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'id_estudiante'], 'required'],
            [['id_proyecto', 'id_estudiante'], 'integer'],
            [['id_estudiante'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['id_estudiante' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'id_estudiante' => 'Id Estudiante',
        ];
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

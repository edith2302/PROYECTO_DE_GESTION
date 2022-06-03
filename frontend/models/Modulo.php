<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property int $id
 * @property string $archivo
 * @property string $descripcion
 * @property int $id_profesor
 *
 * @property Profesorasignatura $profesor
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archivo', 'descripcion', 'id_profesor'], 'required'],
            [['id_profesor'], 'integer'],
            [['archivo'], 'string', 'max' => 500],
            [['descripcion'], 'string', 'max' => 2000],
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
            'archivo' => 'Archivo',
            'descripcion' => 'Descripcion',
            'id_profesor' => 'Id Profesor',
        ];
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

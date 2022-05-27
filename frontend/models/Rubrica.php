<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rubrica".
 *
 * @property int $id
 * @property int $descripción
 * @property int $escala
 * @property int $id_profe_asignatura
 *
 * @property Hito[] $hitos
 * @property Profesorasignatura $profeAsignatura
 */
class Rubrica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rubrica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripción', 'escala', 'id_profe_asignatura'], 'required'],
            [['descripción', 'escala', 'id_profe_asignatura'], 'integer'],
            [['id_profe_asignatura'], 'exist', 'skipOnError' => true, 'targetClass' => Profesorasignatura::className(), 'targetAttribute' => ['id_profe_asignatura' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripción' => 'Descripción',
            'escala' => 'Escala',
            'id_profe_asignatura' => 'Id Profe Asignatura',
        ];
    }

    /**
     * Gets query for [[Hitos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHitos()
    {
        return $this->hasMany(Hito::className(), ['id_rubrica' => 'id']);
    }

    /**
     * Gets query for [[ProfeAsignatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfeAsignatura()
    {
        return $this->hasOne(Profesorasignatura::className(), ['id' => 'id_profe_asignatura']);
    }
}

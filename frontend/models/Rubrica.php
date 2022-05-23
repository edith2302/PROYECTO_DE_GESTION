<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rubrica".
 *
 * @property int $id
 * @property string $descripción
 * @property int $escala
 * @property int $id_profe_asignatura
 *
 * @property Hito[] $hitos
 * @property ProfesorAsignatura $profeAsignatura
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
            [['id', 'descripción', 'escala', 'id_profe_asignatura'], 'required'],
            [['id', 'escala', 'id_profe_asignatura'], 'integer'],
            [['descripción'], 'string', 'max' => 300],
            [['id'], 'unique'],
            [['id_profe_asignatura'], 'exist', 'skipOnError' => true, 'targetClass' => ProfesorAsignatura::className(), 'targetAttribute' => ['id_profe_asignatura' => 'id']],
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
        return $this->hasOne(ProfesorAsignatura::className(), ['id' => 'id_profe_asignatura']);
    }
}

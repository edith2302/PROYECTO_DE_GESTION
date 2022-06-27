<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rubrica".
 *
 * @property int $id
 * @property int $descripcion
 * @property int $escala
 * @property int $id_profe_asignatura
 *
 * @property Hito[] $hitos
 * @property Item[] $items
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
            [['nombre','descripcion', 'escala', 'id_profe_asignatura'], 'required'],
            [['escala', 'id_profe_asignatura'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 1000],
            [['id_profe_asignatura'], 'exist', 'skipOnError' => true, 'targetClass' => Profesorasignatura::className(), 'targetAttribute' => ['id_profe_asignatura' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código rúbrica',
            'nombre' => 'Nombre rúbrica',
            'descripcion' => 'Descripción',
            'escala' => 'Escala',
            'id_profe_asignatura' => 'Código profesor asignatura',
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
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id_rubrica' => 'id']);
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

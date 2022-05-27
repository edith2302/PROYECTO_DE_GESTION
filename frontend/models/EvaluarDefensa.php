<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluardefensa".
 *
 * @property int $id
 * @property int $id_comision
 * @property int $id_defensa
 * @property int $nota
 * @property string $comentarios
 *
 * @property Comisionevaluadora $comision
 * @property Defensaproyecto $defensa
 */
class Evaluardefensa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluardefensa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_comision', 'id_defensa', 'nota', 'comentarios'], 'required'],
            [['id_comision', 'id_defensa', 'nota'], 'integer'],
            [['comentarios'], 'string', 'max' => 2000],
            [['id_comision'], 'exist', 'skipOnError' => true, 'targetClass' => Comisionevaluadora::className(), 'targetAttribute' => ['id_comision' => 'id']],
            [['id_defensa'], 'exist', 'skipOnError' => true, 'targetClass' => Defensaproyecto::className(), 'targetAttribute' => ['id_defensa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_comision' => 'Id Comision',
            'id_defensa' => 'Id Defensa',
            'nota' => 'Nota',
            'comentarios' => 'Comentarios',
        ];
    }

    /**
     * Gets query for [[Comision]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComision()
    {
        return $this->hasOne(Comisionevaluadora::className(), ['id' => 'id_comision']);
    }

    /**
     * Gets query for [[Defensa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefensa()
    {
        return $this->hasOne(Defensaproyecto::className(), ['id' => 'id_defensa']);
    }
}

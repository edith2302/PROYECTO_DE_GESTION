<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluar_defensa".
 *
 * @property int $id
 * @property int $id_comision
 * @property int $id_defensa
 * @property int $nota
 * @property string $comentarios
 *
 * @property ComisionEvaluadora $comision
 * @property DefensaProyecto $defensa
 */
class EvaluarDefensa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluar_defensa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_comision', 'id_defensa', 'nota', 'comentarios'], 'required'],
            [['id', 'id_comision', 'id_defensa', 'nota'], 'integer'],
            [['comentarios'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['id_comision'], 'exist', 'skipOnError' => true, 'targetClass' => ComisionEvaluadora::className(), 'targetAttribute' => ['id_comision' => 'id']],
            [['id_defensa'], 'exist', 'skipOnError' => true, 'targetClass' => DefensaProyecto::className(), 'targetAttribute' => ['id_defensa' => 'id']],
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
        return $this->hasOne(ComisionEvaluadora::className(), ['id' => 'id_comision']);
    }

    /**
     * Gets query for [[Defensa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefensa()
    {
        return $this->hasOne(DefensaProyecto::className(), ['id' => 'id_defensa']);
    }
}

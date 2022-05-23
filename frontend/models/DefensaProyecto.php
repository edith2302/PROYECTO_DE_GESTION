<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "defensa_proyecto".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha
 * @property int $id_proyecto
 *
 * @property EvaluarDefensa[] $evaluarDefensas
 * @property Proyecto $proyecto
 */
class DefensaProyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'defensa_proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha', 'id_proyecto'], 'required'],
            [['fecha'], 'safe'],
            [['id_proyecto'], 'integer'],
            [['nombre'], 'string', 'max' => 300],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'fecha' => 'Fecha',
            'id_proyecto' => 'Id Proyecto',
        ];
    }

    /**
     * Gets query for [[EvaluarDefensas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluarDefensas()
    {
        return $this->hasMany(EvaluarDefensa::className(), ['id_defensa' => 'id']);
    }

    /**
     * Gets query for [[Proyecto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }
}

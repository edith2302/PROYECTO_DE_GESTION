<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "defensaproyecto".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha
 * @property int $id_proyecto
 *
 * @property Evaluardefensa[] $evaluardefensas
 * @property Proyecto $proyecto
 */
class Defensaproyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'defensaproyecto';
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
            [['nombre'], 'string', 'max' => 100],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código defensa',
            'nombre' => 'Nombre presentación',
            'fecha' => 'Fecha presentación',
            'id_proyecto' => 'Código del proyecto',
        ];
    }

    /**
     * Gets query for [[Evaluardefensas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluardefensas()
    {
        return $this->hasMany(Evaluardefensa::className(), ['id_defensa' => 'id']);
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

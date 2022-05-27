<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega".
 *
 * @property int $id
 * @property string $evidencia
 * @property string $fecha_entrega
 * @property string $hora_entrega
 * @property string $comentarios
 * @property int $id_proyecto
 * @property int $id_hito
 *
 * @property Hito $hito
 * @property Proyecto $proyecto
 */
class Entrega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entrega';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evidencia', 'fecha_entrega', 'hora_entrega', 'comentarios', 'id_proyecto', 'id_hito'], 'required'],
            [['fecha_entrega', 'hora_entrega'], 'safe'],
            [['id_proyecto', 'id_hito'], 'integer'],
            [['evidencia'], 'string', 'max' => 300],
            [['comentarios'], 'string', 'max' => 1000],
            [['id_hito'], 'exist', 'skipOnError' => true, 'targetClass' => Hito::className(), 'targetAttribute' => ['id_hito' => 'id']],
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
            'evidencia' => 'Evidencia',
            'fecha_entrega' => 'Fecha Entrega',
            'hora_entrega' => 'Hora Entrega',
            'comentarios' => 'Comentarios',
            'id_proyecto' => 'Id Proyecto',
            'id_hito' => 'Id Hito',
        ];
    }

    /**
     * Gets query for [[Hito]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHito()
    {
        return $this->hasOne(Hito::className(), ['id' => 'id_hito']);
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $evidencia
 * @property string $fecha_entrega
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
            [['nombre', 'descripcion', 'evidencia', 'fecha_entrega', 'id_proyecto', 'id_hito'], 'required'],
            [['fecha_entrega'], 'safe'],
            [['id_proyecto', 'id_hito'], 'integer'],
            [['nombre', 'descripcion', 'evidencia'], 'string', 'max' => 300],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_hito'], 'exist', 'skipOnError' => true, 'targetClass' => Hito::className(), 'targetAttribute' => ['id_hito' => 'id']],
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
            'descripcion' => 'Descripcion',
            'evidencia' => 'Evidencia',
            'fecha_entrega' => 'Fecha Entrega',
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

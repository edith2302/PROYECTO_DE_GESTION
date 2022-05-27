<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hito".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_habilitacion
 * @property string $hora_habilitacion
 * @property string $fecha_limite
 * @property string $hora_limite
 * @property int $tipo_hito
 * @property int $porcentaje_nota
 * @property int $id_rubrica
 * @property int $id_profe_asignatura
 *
 * @property Entrega[] $entregas
 * @property Profesorasignatura $profeAsignatura
 * @property Rubrica $rubrica
 */
class Hito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'fecha_habilitacion', 'hora_habilitacion', 'fecha_limite', 'hora_limite', 'tipo_hito', 'porcentaje_nota', 'id_rubrica', 'id_profe_asignatura'], 'required'],
            [['fecha_habilitacion', 'hora_habilitacion', 'fecha_limite', 'hora_limite'], 'safe'],
            [['tipo_hito', 'porcentaje_nota', 'id_rubrica', 'id_profe_asignatura'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 2000],
            [['id_rubrica'], 'exist', 'skipOnError' => true, 'targetClass' => Rubrica::className(), 'targetAttribute' => ['id_rubrica' => 'id']],
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
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'fecha_habilitacion' => 'Fecha Habilitacion',
            'hora_habilitacion' => 'Hora Habilitacion',
            'fecha_limite' => 'Fecha Limite',
            'hora_limite' => 'Hora Limite',
            'tipo_hito' => 'Tipo Hito',
            'porcentaje_nota' => 'Porcentaje Nota',
            'id_rubrica' => 'Id Rubrica',
            'id_profe_asignatura' => 'Id Profe Asignatura',
        ];
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['id_hito' => 'id']);
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

    /**
     * Gets query for [[Rubrica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRubrica()
    {
        return $this->hasOne(Rubrica::className(), ['id' => 'id_rubrica']);
    }
}

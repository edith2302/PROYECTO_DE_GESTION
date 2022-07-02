<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $num_integrantes
 * @property int $tipo
 * @property int $area
 * @property int|null $estado
 * @property int $disponibilidad
 * @property int|null $id_profe_guia
 * @property int $id_autor
 *
 * @property Usuario $autor
 * @property Defensaproyecto[] $defensaproyectos
 * @property Entrega[] $entregas
 * @property Evaluarproyecto[] $evaluarproyectos
 * 
 * @property Profesoricinf $profeIcinf
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'num_integrantes', 'tipo', 'area', 'disponibilidad', 'id_autor'], 'required'],
            [['num_integrantes', 'tipo', 'area', 'estado', 'disponibilidad', 'id_profe_guia', 'id_autor'], 'integer'],
            [['nombre'], 'string', 'max' => 300],
            [['descripcion'], 'string', 'max' => 2000],
            [['id_profe_guia'], 'exist', 'skipOnError' => true, 'targetClass' => ProfesorIcinf::className(), 'targetAttribute' => ['id_profe_guia' => 'id']],
            [['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_autor' => 'id_usuario']],
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
            'descripcion' => 'Descripción',
            'num_integrantes' => 'Número integrantes',
            'tipo' => 'Tipo',
            'area' => 'Área',
            'estado' => 'Estado',
            'disponibilidad' => 'Disponibilidad',
            'id_profe_guia' => 'Profesor Guia',
            'id_autor' => 'Autor',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_autor']);
    }

    /**
     * Gets query for [[Defensaproyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefensaproyectos()
    {
        return $this->hasMany(Defensaproyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['id_proyecto' => 'id']);
    }

    /**
     * Gets query for [[Evaluarproyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluarproyectos()
    {
        return $this->hasMany(Evaluarproyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * Gets query for [[ProfeGuia]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getProfeGuia()
    {
        return $this->hasOne(Profesorguia::className(), ['id' => 'id_profe_guia']);
    }*/


    /**
     * Gets query for [[ProfeIcinf]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfeIcinf()
    {
        return $this->hasOne(Profesoricinf::className(), ['id' => 'id_profe_guia']);
    }
}

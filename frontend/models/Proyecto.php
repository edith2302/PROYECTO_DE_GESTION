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
 * @property string $tipo
 * @property string $area
 * @property string $estado
 * @property string $disponibilidad
 * @property int|null $id_profe_guia
 * @property int $id_autor
 *
 * @property Usuario $autor
 * @property DefensaProyecto[] $defensaProyectos
 * @property DesarrollarProyecto[] $desarrollarProyectos
 * @property Entrega[] $entregas
 * @property EvaluarProyecto[] $evaluarProyectos
 * @property ProfesorGuia $profeGuia
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
            [['id', 'nombre', 'descripcion', 'num_integrantes', 'tipo', 'area', 'estado', 'disponibilidad', 'id_autor'], 'required'],
            [['id', 'num_integrantes', 'id_profe_guia', 'id_autor'], 'integer'],
            ['num_integrantes', 'compare', 'compareValue' => 2, 'operator' => '<='],
            ['num_integrantes', 'compare', 'compareValue' => 0, 'operator' => '>'],
            [['nombre', 'tipo', 'area', 'estado'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 300],
            [['disponibilidad'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['id_profe_guia'], 'exist', 'skipOnError' => true, 'targetClass' => ProfesorGuia::className(), 'targetAttribute' => ['id_profe_guia' => 'id']],
            [['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_autor' => 'id']],
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
            'num_integrantes' => 'Num Integrantes',
            'tipo' => 'Tipo',
            'area' => 'Area',
            'estado' => 'Estado',
            'disponibilidad' => 'Disponibilidad',
            'id_profe_guia' => 'Id Profe Guia',
            'id_autor' => 'Id Autor',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_autor']);
    }

    /**
     * Gets query for [[DefensaProyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefensaProyectos()
    {
        return $this->hasMany(DefensaProyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * Gets query for [[DesarrollarProyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDesarrollarProyectos()
    {
        return $this->hasMany(DesarrollarProyecto::className(), ['id_proyecto' => 'id']);
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
     * Gets query for [[EvaluarProyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluarProyectos()
    {
        return $this->hasMany(EvaluarProyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * Gets query for [[ProfeGuia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfeGuia()
    {
        return $this->hasOne(ProfesorGuia::className(), ['id' => 'id_profe_guia']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluar_proyecto".
 *
 * @property int $id
 * @property int $id_prof_icinf
 * @property int $id_proyecto
 * @property int $nota
 * @property string $comentarios
 *
 * @property ProfesorIcinf $profIcinf
 * @property Proyecto $proyecto
 */
class EvaluarProyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluar_proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_prof_icinf', 'id_proyecto', 'nota', 'comentarios'], 'required'],
            [['id', 'id_prof_icinf', 'id_proyecto', 'nota'], 'integer'],
            [['comentarios'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['id_prof_icinf'], 'exist', 'skipOnError' => true, 'targetClass' => ProfesorIcinf::className(), 'targetAttribute' => ['id_prof_icinf' => 'id']],
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
            'id_prof_icinf' => 'Id Prof Icinf',
            'id_proyecto' => 'Id Proyecto',
            'nota' => 'Nota',
            'comentarios' => 'Comentarios',
        ];
    }

    /**
     * Gets query for [[ProfIcinf]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfIcinf()
    {
        return $this->hasOne(ProfesorIcinf::className(), ['id' => 'id_prof_icinf']);
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

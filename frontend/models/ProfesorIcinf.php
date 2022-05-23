<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesor_icinf".
 *
 * @property int $id
 * @property string $area
 * @property int $id_usuario
 *
 * @property EvaluarProyecto[] $evaluarProyectos
 * @property Usuario $usuario
 */
class ProfesorIcinf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_icinf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'area', 'id_usuario'], 'required'],
            [['id', 'id_usuario'], 'integer'],
            [['area'], 'string', 'max' => 300],
            [['id'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Area',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * Gets query for [[EvaluarProyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluarProyectos()
    {
        return $this->hasMany(EvaluarProyecto::className(), ['id_prof_icinf' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
}

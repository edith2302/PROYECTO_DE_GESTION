<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesoricinf".
 *
 * @property int $id
 * @property string $area
 * @property int $id_usuario
 *
 * @property Evaluarproyecto[] $evaluarproyectos
 * @property Usuario $usuario
 */
class Profesoricinf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesoricinf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area', 'id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['area'], 'string', 'max' => 300],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
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
     * Gets query for [[Evaluarproyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluarproyectos()
    {
        return $this->hasMany(Evaluarproyecto::className(), ['id_prof_icinf' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }
}

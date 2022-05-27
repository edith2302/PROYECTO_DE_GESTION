<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comisionevaluadora".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property Evaluardefensa[] $evaluardefensas
 * @property Usuario $usuario
 */
class Comisionevaluadora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comisionevaluadora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
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
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * Gets query for [[Evaluardefensas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluardefensas()
    {
        return $this->hasMany(Evaluardefensa::className(), ['id_comision' => 'id']);
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

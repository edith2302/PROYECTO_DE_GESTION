<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jefaturacarrera".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property Usuario $usuario
 */
class Jefaturacarrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jefaturacarrera';
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
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }
}

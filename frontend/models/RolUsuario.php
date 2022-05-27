<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rolusuario".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_rol
 *
 * @property Rol $rol
 * @property User $user
 */
class Rolusuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rolusuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_rol'], 'required'],
            [['id_user', 'id_rol'], 'integer'],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['id_rol' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_rol' => 'Id Rol',
        ];
    }

    /**
     * Gets query for [[Rol]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'id_rol']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}

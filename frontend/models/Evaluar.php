<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluar".
 *
 * @property int $id
 * @property string $comentarios
 * @property int $nota
 * @property int $id_hito
 * @property int $id_usuario
 *
 * @property Hito $hito
 * @property Usuario $usuario
 */
class Evaluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comentarios', 'nota', 'id_hito', 'id_usuario'], 'required'],
            [['nota', 'id_hito', 'id_usuario'], 'integer'],
            [['comentarios'], 'string', 'max' => 10000],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
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
            'comentarios' => 'Comentarios',
            'nota' => 'Nota',
            'id_hito' => 'Id Hito',
            'id_usuario' => 'Id Usuario',
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
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }
}

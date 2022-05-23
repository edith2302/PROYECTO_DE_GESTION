<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comision_evaluadora".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property EvaluarDefensa[] $evaluarDefensas
 * @property Usuario $usuario
 */
class ComisionEvaluadora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comision_evaluadora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
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
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * Gets query for [[EvaluarDefensas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluarDefensas()
    {
        return $this->hasMany(EvaluarDefensa::className(), ['id_comision' => 'id']);
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

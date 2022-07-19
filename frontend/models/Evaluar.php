<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluar".
 *
 * @property int $id
 * @property int $puntaje_ideal
 * @property int $puntaje_obtenido
 * @property string $comentarios
 * @property float  $nota
 * @property int $id_entrega
 * @property int $id_usuario
 *
 * @property Entrega $entrega
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
            [['puntaje_ideal','puntaje_obtenido','comentarios', 'nota', 'id_entrega', 'id_usuario'], 'required'],
            [[ 'puntaje_ideal','puntaje_obtenido','id_entrega', 'id_usuario'], 'integer'],
            [['nota'], 'number'],
            [['comentarios'], 'string', 'max' => 10000],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_entrega'], 'exist', 'skipOnError' => true, 'targetClass' => Entrega::className(), 'targetAttribute' => ['id_entrega' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'puntaje_ideal'=> 'Puntaje ideal',
            'puntaje_obtenido'=> 'Puntaje obtenido',
            'comentarios' => 'Comentarios',
            'nota' => 'Nota',
            'id_entrega' => 'Id Entrega',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * Gets query for [[Entrega]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntrega()
    {
        return $this->hasOne(Entrega::className(), ['id' => 'id_entrega']);
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

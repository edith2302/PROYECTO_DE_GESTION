<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluadorf".
 *
 * @property int $id
 * @property int $id_entrega
 * @property int $id_profesor
 *
 * @property Entrega $entrega
 * @property Profesoricinf $profesor
 */
class Evaluadorf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluadorf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[/*'id_entrega',*/ 'id_profesor'], 'required'],
            [['id_entrega', 'id_profesor'], 'integer'],
            [['id_entrega'], 'exist', 'skipOnError' => true, 'targetClass' => Entrega::className(), 'targetAttribute' => ['id_entrega' => 'id']],
            [['id_profesor'], 'exist', 'skipOnError' => true, 'targetClass' => Profesoricinf::className(), 'targetAttribute' => ['id_profesor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_entrega' => 'Id Entrega',
            'id_profesor' => 'Id Profesor',
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
     * Gets query for [[Profesor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesor()
    {
        return $this->hasOne(Profesoricinf::className(), ['id' => 'id_profesor']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluador".
 *
 * @property int $id
 * @property int $id_hito
 * @property int $rol
 *
 * @property Hito $hito
 */
class Evaluador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[/*'id_hito',*/ 'rol'], 'required'],
            [['id_hito', 'rol'], 'integer'],
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
            'id_hito' => 'Id Hito',
            'rol' => 'Rol',
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
}

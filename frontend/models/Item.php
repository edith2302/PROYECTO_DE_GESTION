<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $puntaje
 * @property int $id_rubrica
 *
 * @property Rubrica $rubrica
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        [['descripcion', 'puntaje'/*, 'id_rubrica'*/], 'required'],
            [['puntaje', 'id_rubrica'], 'integer'],
            [['descripcion'], 'string', 'max' => 1000],
            [['id_rubrica'], 'exist', 'skipOnError' => true, 'targetClass' => Rubrica::className(), 'targetAttribute' => ['id_rubrica' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'puntaje' => 'Puntaje',
            'id_rubrica' => 'Id Rubrica',
        ];
    }

    /**
     * Gets query for [[Rubrica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRubrica()
    {
        return $this->hasOne(Rubrica::className(), ['id' => 'id_rubrica']);
    }
}

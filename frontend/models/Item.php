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
 * @property int $puntaje_obtenido
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
        [['descripcion', 'puntaje', 'id_rubrica'], 'required'],
            [['puntaje', 'id_rubrica','puntaje_obtenido'], 'integer'],
            [['descripcion'], 'string', 'max' => 1000],
            ['puntaje_obtenido', 'compare', 'compareValue' => 'puntaje', 'operator' => '<='],
            ['puntaje_obtenido', 'compare', 'compareValue' => 0, 'operator' => '>'],
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
            'descripcion' => 'Descripción',
            'puntaje' => 'Puntaje máximo',
            'puntaje_obtenido' => 'Puntaje obtenido',
            'id_rubrica' => 'Rubrica',
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

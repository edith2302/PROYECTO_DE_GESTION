<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $created_date
 * @property string $end
 * @property int $id_hito
 *
 * @property Hito $hito
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'created_date', /*'end',*/'id_hito'], 'required'],
        [['created_date'/*, 'end'*/], 'safe'],
            [['id_hito'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['description'], 'string', 'max' => 1000],
            [['id_hito'], 'exist', 'skipOnError' => true, 'targetClass' => Hito::className(), 'targetAttribute' => ['id_hito' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'title' => 'Nombre',
            'description' => 'Descripción',
            'created_date' => 'Fecha',
            //'end' => 'Hora',
            'id_hito' => 'Código hito',
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

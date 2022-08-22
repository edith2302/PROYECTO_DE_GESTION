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
        [['descripcion', 'puntaje'/*, 'id_rubrica'*/], 'required'],
            [['puntaje', 'id_rubrica','puntaje_obtenido'], 'integer'],
            [['descripcion'], 'string', 'max' => 1000],
            
            //[['puntaje_obtenido', 'puntaje'],'puntajelimite'],
            //['puntaje_obtenido', 'puntajelimite2'],
            ['puntaje_obtenido', 'compare', 'compareValue' => 0, 'operator' => '>'],
            ['puntaje_obtenido', 'compare', 'compareAttribute' => 'puntaje', 'operator' => '<='],

            [['id_rubrica'], 'exist', 'skipOnError' => true, 'targetClass' => Rubrica::className(), 'targetAttribute' => ['id_rubrica' => 'id']],
        ];
    }

    public function puntajelimite2($model, $attribute)
    {
        $puntajeMax = $model->puntaje;
        $puntajeAsign = $attribute;

        if ($puntajeAsign > $puntajeMax) {
            $this->addError($attribute, "El puntaje asignado no puede superar el puntaje del ítem");
        }
    }

    public function puntajelimite($attribute)
    {
        $puntajeMax = $this->puntaje;
        $puntajeAsign = $this->puntaje_obtenido;

        if ($puntajeAsign > $puntajeMax) {
            $this->addError($attribute, "El puntaje asignado no puede superar el puntaje del ítem");
        }
    }
    /*
         public function rules()
    {
        return [
            [['inicio', 'fin'], 'required'],
            [['inicio', 'fin'], 'date', 'format' => 'dd-MM-yyyy'],
            [['inicio', 'fin'], 'rango'],
            ['fin', 'compare', 'compareAttribute' => 'inicio', 'operator' => '>'],
        ];
    }

    public function rango($attribute)
    {
        $date1 = $this->inicio;
        $date2 = $this->fin;
        $years = $date1->diff($date2)->format('%y');

        if ($years != 0) {
            $this->addError($attribute, "Seleccione un rango inferior a 12 meses");
        }
    }

    */

    

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

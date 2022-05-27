<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesorasignatura".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property Gestionarcurso[] $gestionarcursos
 * @property Hito[] $hitos
 * @property Rubrica[] $rubricas
 * @property Usuario $usuario
 */
class Profesorasignatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesorasignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
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
     * Gets query for [[Gestionarcursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestionarcursos()
    {
        return $this->hasMany(Gestionarcurso::className(), ['id_profesor' => 'id']);
    }

    /**
     * Gets query for [[Hitos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHitos()
    {
        return $this->hasMany(Hito::className(), ['id_profe_asignatura' => 'id']);
    }

    /**
     * Gets query for [[Rubricas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRubricas()
    {
        return $this->hasMany(Rubrica::className(), ['id_profe_asignatura' => 'id']);
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

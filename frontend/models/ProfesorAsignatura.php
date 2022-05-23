<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesor_asignatura".
 *
 * @property int $id
 * @property int $id_usuario
 *
 * @property GestionarCurso[] $gestionarCursos
 * @property Hito[] $hitos
 * @property Rubrica[] $rubricas
 * @property Usuario $usuario
 */
class ProfesorAsignatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_asignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario'], 'required'],
            [['id', 'id_usuario'], 'integer'],
            [['id'], 'unique'],
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
     * Gets query for [[GestionarCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestionarCursos()
    {
        return $this->hasMany(GestionarCurso::className(), ['id_profesor' => 'id']);
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
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
}

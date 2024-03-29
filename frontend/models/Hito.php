<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hito".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_habilitacion
 * @property string $hora_habilitacion
 * @property string $fecha_limite
 * @property string $hora_limite
 * @property int $tipo_hito
 * @property int $porcentaje_nota
 * @property int $id_rubrica
 * @property int $id_profe_asignatura
 *
 * @property Entrega[] $entregas
 * @property Evaluador[] $evaluadores
 * @property Profesorasignatura $profeAsignatura
 * @property Rubrica $rubrica
 */
class Hito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'fecha_habilitacion', 'hora_habilitacion', 'fecha_limite', 'hora_limite', 'tipo_hito', 'porcentaje_nota', 'id_rubrica', 'id_profe_asignatura'], 'required'],
            [['fecha_habilitacion', 'hora_habilitacion', 'fecha_limite', 'hora_limite'], 'safe'],
            
            ['fecha_limite', 'compare', 'compareAttribute' => 'fecha_habilitacion', 'operator' => '>='],
            
            [['tipo_hito', 'porcentaje_nota', 'id_rubrica', 'id_profe_asignatura'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 2000],

            ['porcentaje_nota', 'porcentajeTotal'],

            [['id_rubrica'], 'exist', 'skipOnError' => true, 'targetClass' => Rubrica::className(), 'targetAttribute' => ['id_rubrica' => 'id']],
            [['id_profe_asignatura'], 'exist', 'skipOnError' => true, 'targetClass' => Profesorasignatura::className(), 'targetAttribute' => ['id_profe_asignatura' => 'id']],
        ];
    }

    public function porcentajeTotal($attribute, $params)
    {
        //-----------------conexion bdd----------------------
        $bd_name = "yii2advanced";
        $bd_table = "item";
        $bd_location = "localhost";
        $bd_user = "root";
        $bd_pass = "";

        // conectarse a la bd
        $conn = mysqli_connect($bd_location, $bd_user, $bd_pass, $bd_name);
        if(mysqli_connect_errno()){
            die("Connection failed: ".mysqli_connect_error());
        }
        $datos = $conn->query("SELECT SUM(hito.porcentaje_nota) as total FROM hito");

        while($porcentaje = mysqli_fetch_array($datos )){
            $porcentaje_total = $porcentaje['total'];
        } 
        //-------------------------------------------------------------------
        $nuevoPorc = $this->$attribute;
        $suma = $porcentaje_total + $nuevoPorc;

        if($suma > 100){
            $this->addError($attribute, "El porcentaje total supera el 100% ");
            return false;
        }else{
            return true;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código hito',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'fecha_habilitacion' => 'Fecha Habilitación',
            'hora_habilitacion' => 'Hora Habilitación',
            'fecha_limite' => 'Fecha Límite',
            'hora_limite' => 'Hora Límite',
            'tipo_hito' => 'Tipo Hito',
            'porcentaje_nota' => 'Porcentaje Nota',
            'id_rubrica' => 'Rúbrica',
            'id_profe_asignatura' => 'Profesor asignatura',
        ];
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['id_hito' => 'id']);
    }

    /**
     * Gets query for [[ProfeAsignatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfeAsignatura()
    {
        return $this->hasOne(Profesorasignatura::className(), ['id' => 'id_profe_asignatura']);
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

    /**
     * Gets query for [[Evaluadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluadores()
    {
        return $this->hasMany(Evaluador::className(), ['id_hito' => 'id']);
    }
}

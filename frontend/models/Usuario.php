<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id_usuario
 * @property string|null $telefono
 * @property string|null $telefono_alternativo
 * @property string $nombre
 * @property string $username
 * @property string $dv
 * @property string $password
 * @property string|null $apellido
 * @property string|null $email
 * @property string|null $email_alternativo
 * @property int $plan
 * @property string|null $direccion
 * @property int|null $habilitado_adt
 * @property int|null $habilitado_practica
 * @property int|null $habilitado_ici
 *
 * @property Adjunto[] $adjuntos
 * @property AdjuntosResolucionSolicitud[] $adjuntosResolucionSolicituds
 * @property AlumnoInscripcion[] $alumnoInscripcions
 * @property AlumnoPreinscripcion[] $alumnoPreinscripcions
 * @property Documento[] $documentos
 * @property EmailFirma $emailFirma
 * @property ForoRespuestaComentario[] $foroRespuestaComentarios
 * @property ForoTemaRespuesta[] $foroTemaRespuestas
 * @property ForoTemaUltimaVisita[] $foroTemaUltimaVisitas
 * @property ForoTema[] $foroTemas
 * @property Inscripcion[] $inscripcions
 * @property Inscripcion[] $inscripcions0
 * @property Noticia[] $noticias
 * @property Preinscripcion[] $preinscripcions
 * @property Solicitud[] $solicituds
 * @property ForoTema[] $temas
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'username', 'dv', 'password', 'plan'], 'required'],
            [['plan', 'habilitado_adt', 'habilitado_practica', 'habilitado_ici'], 'integer'],
            [['telefono', 'telefono_alternativo', 'username', 'password', 'apellido', 'email', 'email_alternativo'], 'string', 'max' => 200],
            [['nombre'], 'string', 'max' => 300],
            [['dv'], 'string', 'max' => 1],
            [['direccion'], 'string', 'max' => 2000],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'telefono' => 'Telefono',
            'telefono_alternativo' => 'Telefono Alternativo',
            'nombre' => 'Nombre',
            'username' => 'Username',
            'dv' => 'Dv',
            'password' => 'Password',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'email_alternativo' => 'Email Alternativo',
            'plan' => 'Plan',
            'direccion' => 'Direccion',
            'habilitado_adt' => 'Habilitado Adt',
            'habilitado_practica' => 'Habilitado Practica',
            'habilitado_ici' => 'Habilitado Ici',
        ];
    }

    /**
     * Gets query for [[Adjuntos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdjuntos()
    {
        return $this->hasMany(Adjunto::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[AdjuntosResolucionSolicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdjuntosResolucionSolicituds()
    {
        return $this->hasMany(AdjuntosResolucionSolicitud::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[AlumnoInscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnoInscripcions()
    {
        return $this->hasMany(AlumnoInscripcion::className(), ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[AlumnoPreinscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnoPreinscripcions()
    {
        return $this->hasMany(AlumnoPreinscripcion::className(), ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[EmailFirma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailFirma()
    {
        return $this->hasOne(EmailFirma::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoRespuestaComentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForoRespuestaComentarios()
    {
        return $this->hasMany(ForoRespuestaComentario::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoTemaRespuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForoTemaRespuestas()
    {
        return $this->hasMany(ForoTemaRespuesta::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoTemaUltimaVisitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForoTemaUltimaVisitas()
    {
        return $this->hasMany(ForoTemaUltimaVisita::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoTemas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForoTemas()
    {
        return $this->hasMany(ForoTema::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Inscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscripcions()
    {
        return $this->hasMany(Inscripcion::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[Inscripcions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscripcions0()
    {
        return $this->hasMany(Inscripcion::className(), ['id_inscripcion' => 'id_inscripcion'])->viaTable('alumno_inscripcion', ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[Preinscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreinscripcions()
    {
        return $this->hasMany(Preinscripcion::className(), ['id_preinscripcion' => 'id_preinscripcion'])->viaTable('alumno_preinscripcion', ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Solicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicituds()
    {
        return $this->hasMany(Solicitud::className(), ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Temas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemas()
    {
        return $this->hasMany(ForoTema::className(), ['id_tema' => 'id_tema'])->viaTable('foro_tema_ultima_visita', ['id_usuario' => 'id_usuario']);
    }
}

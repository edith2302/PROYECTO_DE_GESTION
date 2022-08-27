<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id_usuario
 * @property string $rut
 * @property string|null $telefono
 * @property string|null $telefono_alternativo
 * @property string $nombre
 * @property string $username
 * @property string $dv
 * @property string $password
 * @property string|null $apellido
 * @property string|null $email
 * @property string|null $email_alternativo
 * @property int|null  $plan
 * @property string|null $direccion
 * @property int|null $habilitado_adt
 * @property int|null $habilitado_practica
 * @property int|null $habilitado_ici
 *
 * @property Adjunto[] $adjuntos
 * @property AdjuntosResolucionSolicitud[] $adjuntosResolucionSolicituds
 * @property Administrador[] $administradors
 * @property AlumnoInscripcion[] $alumnoInscripcions
 * @property AlumnoPreinscripcion[] $alumnoPreinscripcions
 * @property Comisionevaluadora[] $comisionevaluadoras
 * @property Documento[] $documentos
 * @property EmailFirma $emailFirma
 * @property Estudiante[] $estudiantes
 * @property ForoRespuestaComentario[] $foroRespuestaComentarios
 * @property ForoTemaRespuesta[] $foroTemaRespuestas
 * @property ForoTemaUltimaVisita[] $foroTemaUltimaVisitas
 * @property ForoTema[] $foroTemas
 * @property Inscripcion[] $inscripcions
 * @property Inscripcion[] $inscripcions0
 * @property Jefaturacarrera[] $jefaturacarreras
 * @property Noticia[] $noticias
 * @property Preinscripcion[] $preinscripcions
 * @property Profesorasignatura[] $profesorasignaturas
 * @property Profesorguia[] $profesorguias
 * @property Profesoricinf[] $profesoricinfs
 * @property Proyecto[] $proyectos
 * @property Solicitud[] $solicituds
 * @property ForoTema[] $temas
 */
class Usuario extends \yii\db\ActiveRecord{
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
        [['rut', 'nombre', 'username', 'dv', 'password', /*'plan'*/], 'required'],
            [['plan', 'habilitado_adt', 'habilitado_practica', 'habilitado_ici'], 'integer'],
            [['rut'], 'string', 'max' => 20],
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
            'id_usuario' => 'Código Usuario',
            'rut' => 'Rut',
            'telefono' => 'Teléfono',
            'telefono_alternativo' => 'Teléfono Alternativo',
            'nombre' => 'Nombre',
            'username' => 'Username',
            'dv' => 'Dv',
            'password' => 'Contraseña',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'email_alternativo' => 'Email Alternativo',
            'plan' => 'Plan',
            'direccion' => 'Dirección',
            'habilitado_adt' => 'Habilitado Adt',
            'habilitado_practica' => 'Habilitado Practica',
            'habilitado_ici' => 'Habilitado Ici',
        ];
    }

    public function formatoRut($model) { 

        $formatRut = $model->rut;

        if (strpos($formatRut, '-') !== false ) {

            $splittedRut = explode('-', $formatRut);
            $number = number_format($splittedRut[0], 0, ',', '.');
            $verifier = strtoupper($splittedRut[1]);
            //return $number . '-' . $verifier;
            $model->rut = $number . '-' . $verifier;
            $model->save();
        }
        
        $model->rut = number_format($formatRut, 0, ',', '.');
        $model->save();
        //return number_format($formatRut, 0, ',', '.');
    
    }


    public function getFormattedRut() {

        $unformattedRut = $this->rut;

        if (strpos($unformattedRut, '-') !== false ) {

            $splittedRut = explode('-', $unformattedRut);

            $number = number_format($splittedRut[0], 0, ',', '.');

            $verifier = strtoupper($splittedRut[1]);

            return $number . '-' . $verifier;

        }

        //return number_format($unformattedRut, 0, ',', '.');
        

        $this->rut = number_format($unformattedRut, 0, ',', '.');
        $this->save();

    }

    /**
     * Gets query for [[Adjuntos]].
     *
     * @return \yii\db\ActiveQuery
     */
   /* public function getAdjuntos()
    {
        return $this->hasMany(Adjunto::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[AdjuntosResolucionSolicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
   /* public function getAdjuntosResolucionSolicituds()
    {
        return $this->hasMany(AdjuntosResolucionSolicitud::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[Administradors]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getAdministradors()
    {
        return $this->hasMany(Administrador::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[AlumnoInscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getAlumnoInscripcions()
    {
        return $this->hasMany(AlumnoInscripcion::className(), ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[AlumnoPreinscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getAlumnoPreinscripcions()
    {
        return $this->hasMany(AlumnoPreinscripcion::className(), ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Comisionevaluadoras]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getComisionevaluadoras()
    {
        return $this->hasMany(Comisionevaluadora::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[EmailFirma]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getEmailFirma()
    {
        return $this->hasOne(EmailFirma::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Estudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getEstudiantes()
    {
        return $this->hasMany(Estudiante::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoRespuestaComentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getForoRespuestaComentarios()
    {
        return $this->hasMany(ForoRespuestaComentario::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoTemaRespuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getForoTemaRespuestas()
    {
        return $this->hasMany(ForoTemaRespuesta::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoTemaUltimaVisitas]].
     *
     * @return \yii\db\ActiveQuery
     */
   /* public function getForoTemaUltimaVisitas()
    {
        return $this->hasMany(ForoTemaUltimaVisita::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ForoTemas]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getForoTemas()
    {
        return $this->hasMany(ForoTema::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Inscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getInscripcions()
    {
        return $this->hasMany(Inscripcion::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[Inscripcions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getInscripcions0()
    {
        return $this->hasMany(Inscripcion::className(), ['id_inscripcion' => 'id_inscripcion'])->viaTable('alumno_inscripcion', ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Jefaturacarreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getJefaturacarreras()
    {
        return $this->hasMany(Jefaturacarrera::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['creador' => 'id_usuario']);
    }

    /**
     * Gets query for [[Preinscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getPreinscripcions()
    {
        return $this->hasMany(Preinscripcion::className(), ['id_preinscripcion' => 'id_preinscripcion'])->viaTable('alumno_preinscripcion', ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Profesorasignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getProfesorasignaturas()
    {
        return $this->hasMany(Profesorasignatura::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Profesorguias]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getProfesorguias()
    {
        return $this->hasMany(Profesorguia::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Profesoricinfs]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getProfesoricinfs()
    {
        return $this->hasMany(Profesoricinf::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['id_autor' => 'id_usuario']);
    }

    /**
     * Gets query for [[Solicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getSolicituds()
    {
        return $this->hasMany(Solicitud::className(), ['id_alumno' => 'id_usuario']);
    }

    /**
     * Gets query for [[Temas]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getTemas()
    {
        return $this->hasMany(ForoTema::className(), ['id_tema' => 'id_tema'])->viaTable('foro_tema_ultima_visita', ['id_usuario' => 'id_usuario']);
    }*/
}
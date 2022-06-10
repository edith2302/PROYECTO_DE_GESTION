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
 * @property int $plan
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
            [['rut', 'nombre', 'username', 'dv', 'password', 'plan'], 'required'],
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
            'id_usuario' => 'Id Usuario',
            'rut' => 'Rut',
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


    

}
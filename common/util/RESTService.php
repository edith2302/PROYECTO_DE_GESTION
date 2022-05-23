<?php
namespace common\util;

class RESTService{

    public static function obtieneAsignaturaPorCodigo($codigo_asignatura){
        /*
        Estructura:
         array(5) {
          ["nombre"]=>
          string(17) "CÁLCULO INTEGRAL"
          ["creditos"]=>
          string(1) "6"
          ["horas_teoricas"]=>
          string(1) "4"
          ["horas_practicas"]=>
          string(1) "2"
          ["horas_laboratorio"]=>
          string(1) "0"
        }
        */
        return [
            'nombre'=>"CÁLCULO INTEGRAL",
            'creditos' =>'6',
            'horas_teoricas'=>'4',
            'horas_practicas'=>'2',
            'horas_laboratorio'=>'0'
        ];
    }

    public static function obtieneCarreras(){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(74) {
          [0]=>
          array(5) {
            ["codigo_carrera"]=>
            string(4) "2810"
            ["codigo_carrera_bd"]=>
            string(5) "28100"
            ["nombre_carrera"]=>
            string(16) "CONTADOR AUDITOR"
            ["sede"]=>
            string(8) "Chillán"
            ["jornada"]=>
            string(10) "Vespertino"
          }
          [1]=>
          array(5) {
            ["codigo_carrera"]=>
            string(4) "2816"
            ["codigo_carrera_bd"]=>
            string(5) "28160"
            ["nombre_carrera"]=>
            string(47) "PEDAGOGÍA ENSEÑANZA MEDIA EN ARTES PLÁSTICAS"
            ["sede"]=>
            string(8) "Chillán"
            ["jornada"]=>
            string(10) "Vespertino"
          }
          [2]=> etc ...
        }


        */
        return [

        ];
    }

    public static function obtieneInformacionCarrera($codigo_carrera){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(5) {
          ["codigo_carrera"]=>
          string(4) "2957"
          ["codigo_carrera_bd"]=>
          string(5) "29570"
          ["nombre_carrera"]=>
          string(33) "INGENIERÍA CIVIL EN INFORMÁTICA"
          ["sede"]=>
          string(8) "Chillán"
          ["jornada"]=>
          string(6) "Diurno"
        }

        */
        return [];
    }

    public static function obtieneMallaDeLaCarrera($codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(60) {
          [0]=>
          array(2) {
            ["codigo_asignaturas"]=>
            string(6) "240172"
            ["semestre"]=>
            string(1) "1"
          }
          [1]=>
          array(2) {
            ["codigo_asignaturas"]=>
            string(6) "310137"
            ["semestre"]=>
            string(1) "1"
          }
          [2]=>
          array(2) {
            ["codigo_asignaturas"]=>
            string(6) "326799"
            ["semestre"]=>
            string(1) "1"
          }
          [3]=>etc...
        }
        */
        return [];
    }

    public static function obtienePlanesCarrera($codigo_carrera){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(2) {
          [0]=>
          array(2) {
            ["numero_plan"]=>
            string(1) "0"
            ["jornada"]=>
            string(6) "Diurno"
          }
          [1]=>
          array(2) {
            ["numero_plan"]=>
            string(1) "1"
            ["jornada"]=>
            string(6) "Diurno"
          }
        }
        */
        return [];
    }

    public static function obtieneRequisitosAsignatura($codigo_asignatura, $codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(3) {
          [0]=>
          array(1) {
            ["codigo_asignaturas_requisito"]=>
            string(6) "240173"
          }
          [1]=> etc...
        }
        */
        return [];
    }

    public static function obtieneTodosLosElectivosYFormaciones($codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(778) {
          [0]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "326867"
            ["codigo_generico"]=>
            string(7) "3267992"
            ["tipo"]=>
            string(18) "FORMACION INTEGRAL"
          }
          [1]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "326867"
            ["codigo_generico"]=>
            string(7) "3267992"
            ["tipo"]=>
            string(18) "FORMACION INTEGRAL"
          }
          [2]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "634537"
            ["codigo_generico"]=>
            string(7) "6341912"
            ["tipo"]=>
            string(18) "ELECTIVA"
          }
          [3]=>etc...
        }

        */
        return [];
    }

    public static function obtieneTodasLasFormacionesIntegrales($codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(778) {
          [0]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "326867"
            ["codigo_generico"]=>
            string(7) "3267992"
            ["tipo"]=>
            string(18) "FORMACION INTEGRAL"
          }
          [1]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "326867"
            ["codigo_generico"]=>
            string(7) "3267992"
            ["tipo"]=>
            string(18) "FORMACION INTEGRAL"
          }
          [2]=>etc...
        }

        */
        return [];
    }

    public static function obtieneTodosLosElectivos($codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(778) {
          [0]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "123123"
            ["codigo_generico"]=>
            string(7) "1231232"
            ["tipo"]=>
            string(18) "ELECTIVA"
          }
          [1]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "444555"
            ["codigo_generico"]=>
            string(7) "4445552"
            ["tipo"]=>
            string(18) "ELECTIVA"
          }
          [2]=>
          array(3) {
            ["codigo_electivo"]=>
            string(6) "665665"
            ["codigo_generico"]=>
            string(7) "6656652"
            ["tipo"]=>
            string(18) "ELECTIVA"
          }
          [3]=>etc...
        }

        */
        return [];
    }

    public static function obtieneRolYCorreos($rut){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        //Si tiene 2 roles o más
        array(4) {
          ["tipo_usuario"]=>
          string(22) "Alumno, docente planta"
          ["nombre"]=>
          string(25) "JUAN JUAN PEREZ PEREZ"
          ["email"]=>
          string(17) "123123@intranet" //email invalido si fue alumno hace años y su email fue dado de baja
          ["correos_usuario"]=>
          string(121) "[{"tipo_usuario":"Alumno","correo":"12551754@intranet"},{"tipo_usuario":"docente planta","correo":"correodocente@ubiobiobiobio.com"}]" //JSON Array con todos los emails que ha tenido, útil en caso de que tenga más de un rol
        }

        //Si tiene un solo rol
         array(4) {
          ["tipo_usuario"]=>
          string(22) "Alumno"
          ["nombre"]=>
          string(25) "ANDRES ANDRES MORENO MORENO"
          ["email"]=>
          string(17) "andres.andres.moreno.moreno.1991@alumnos.ubiobio.cl" //email validp
          ["correos_usuario"]=>
          string(121) "[{"tipo_usuario":"Alumno","correo":"andres.andres.moreno.moreno.1991@alumnos.ubiobio.cl"}]"
        }

        */
        return [];
    }

    public static function obtieneInformacionUsuario($rut){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:

        array(8) {
          ["email"]=>
          string(19) "josejosejose@ubiobio.cl"
          ["telefono"]=>
          string(6) "483945"
          ["celular"]=>
          string(0) "988887777"
          ["fecha_nacimiento"]=>
          string(23) "1999-11-15 00:00:00.000"
          ["reparticion"]=>
          string(8) "205304"
          ["nombre_reparticion"]=>
          string(74) "DEPARTAMENTO DE CIENCIAS DE LA COMPUTACION Y TECNOLOGIA DE LA INFORMACION."
          ["sede"]=>
          string(8) "Chillán"
          ["nombre_completo"]=>
          string(25) "JOSE JOSE JOSE MORENO"
        }
        */
        return [];
    }

    public static function obtieneProfesoresPorCodigoCarrera($anio,$semestre,$codigo_carrera){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(26) {
          [0]=>
          array(6) {
            ["rut"]=>
            string(7) "9888444"
            ["nombre_completo"]=>
            string(23) "MARIA MARIA MARIA MARIA"
            ["email"]=>
            string(17) "mariamariamiamaria@ubiobio.cl"
            ["departamento_codigo"]=>
            string(8) "333444555"
            ["departamento"]=>
            string(32) "DEPARTAMENTO DE CIENCIAS BASICAS"
            ["tipo_contrato"]=>
            string(12) "CONTRATO_UBB"
          }
          [1]=>
          array(6) {
            ["rut"]=>
            string(7) "8884443"
            ["nombre_completo"]=>
            string(35) "EDUARDO EDUARDO EDUARDO EDUARDO"
            ["email"]=>
            string(17) "edu.edu.edu.edu@ubiobio.cl"
            ["departamento_codigo"]=>
            string(8) "9483949554"
            ["departamento"]=>
            string(26) "DEPARTAMENTO DE MATEMATICA"
            ["tipo_contrato"]=>
            string(12) "CONVENIO_UBB"
          }
          [2]=> ETC ...
        }


        */
        return [];
    }

    public static function obtieneEstudiantesDeUnaAsignatura($codigo_asignatura, $anio, $semestre){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:

        Posibles situaciones_academicas =
             * TITULADO
             * RENUNCIA
             * PERDIDA CARRERA
             * NULL
             * REGULAR
             * SUSPENSIÓN DE ESTUDIOS
             * NO VIGENTE

        array(55) {
          [0]=>
          array(6) {
            ["rut_estudiantes"]=>
            string(8) "19000001"
            ["nombre_completo"]=>
            string(35) "MAURICIO MAURICIO MAURICIO MAURICIO"
            ["plan_carrera"]=>
            string(1) "1"
            ["anio_ingreso"]=>
            string(4) "2017"
            ["email"]=>
            string(27) "mauricio.11111111@alumnos.ubiobio.cl"
            ["situacion_academica"]=>
            string(15) "PERDIDA CARRERA"
          }
          [1]=>
          array(6) {
            ["rut_estudiantes"]=>
            string(8) "19000002"
            ["nombre_completo"]=>
            string(29) "PATRICIO PATRICIO PATRICIO PATRICIO"
            ["plan_carrera"]=>
            string(1) "1"
            ["anio_ingreso"]=>
            string(4) "2015"
            ["email"]=>
            string(36) "patricio.111111111@alumnos.ubiobio.cl"
            ["situacion_academica"]=>
            string(7) "REGULAR"
          }
          [2]=> etc...
        */
        return [];
    }

    public static function obtieneEstudiantesPorCodigoCarrera($codigo_carrera){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:

        array(1248) {
          [0]=>
          array(8) {
            ["rut"]=>
            string(8) "19000003"
            ["nombre_completo"]=>
            string(30) "PAMELA PAMELA PAMELA PAMELA"
            ["plan_carrera"]=>
            string(1) "0"
            ["anio_ingreso"]=>
            string(4) "2006"
            ["periodo_ingreso"]=>
            string(1) "1"
            ["email"]=>
            string(17) "PAMELA111111@intranet"
            ["situacion_academica"]=>
            string(0) ""
            ["ultima_Carrera"]=>
            string(1) "0"
          }
          [1]=>
          array(8) {
            ["rut"]=>
            string(8) "19000004"
            ["nombre_completo"]=>
            string(41) "NICOLÁS NICOLÁS NICOLÁS NICOLÁS"
            ["plan_carrera"]=>
            string(1) "0"
            ["anio_ingreso"]=>
            string(4) "2020"
            ["periodo_ingreso"]=>
            string(1) "1"
            ["email"]=>
            string(17) "NICOLas11111@intranet"
            ["situacion_academica"]=>
            string(15) "REGULAR"
            ["ultima_Carrera"]=>
            string(1) "1"
          }
          [2]=>etc...
        }
        */
        return [];
    }

    public static function obtieneEstudiantesRenunciaDeCarrera($codigo_carrera, $plan, $anio){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(9) {
          [0]=>
          array(1) {
            ["rut_estudiantes"]=>
            string(8) "180000001"
          }
          [1]=>
          array(1) {
            ["rut_estudiantes"]=>
            string(8) "180000002"
          }
          [2]=>
          array(1) {
            ["rut_estudiantes"]=>
            string(8) "180000003"
          }
          [3]=>etc...
        }

        */
        return [];
    }

    public static function obtieneEstudiantesRetiroTemporal($codigo_carrera, $plan, $anio){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(12) {
          [0]=>
          array(1) {
            ["rut_estudiantes"]=>
            string(8) "180000001"
          }
          [1]=>
          array(1) {
            ["rut_estudiantes"]=>
            string(8) "180000002"
          }
          [2]=>
          array(1) {
            ["rut_estudiantes"]=>
            string(8) "180000003"
          }
          [3]=>etc...
        }


        */
        return [];
    }

    public static function obtieneInformacionAcademicaDelEstudiante($rut, $codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(5) {
          ["promedio_acumulado"]=>
          string(4) "5.62"
          ["creditos_aprobados_acumulados"]=>
          string(3) "293"
          ["creditos_por_cursar"]=>
          string(1) "7"
          ["cantidad_solicitudes_bajo_credito"]=>
          string(1) "2"
          ["cantidad_solicitudes_asignatura_reprobada"]=>
          string(1) "1"
        }

        */
        return [];
    }

    public static function obtieneInformacionEstudiante($rut){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(10) {
          ["email"]=>
          string(37) "armando.armando1999@alumnos.ubiobio.cl"
          ["telefono"]=>
          string(12) "+56988884444"
          ["fecha_nacimiento"]=>
          string(23) "1996-05-07 00:00:00.000"
          ["codigo_carrera"]=>
          string(4) "2957"
          ["codigo_carrera_bd"]=>
          string(5) "29570"
          ["plan_carrera"]=>
          string(1) "1"
          ["situacion_academica"]=>
          string(8) "REGULAR"
          ["agno_ingreso"]=>
          string(4) "2016"
          ["foto_binary"]=>
          string(159838) "IMAGEN EN BASE64"
          ["nombre_completo"]=>
          string(29) "ARMANDO ARMANDO ARMANDO ARMANDO"
        }

        */
        return [];
    }

    public static function obtieneLasAsignaturasCursadasDelEstudiante($rut, $codigo_carrera, $plan){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)
        Estados:
        APROBADA
        RECONOCIDA
        REPROBADA
        NCR

        Estructura:
        array(63) {
          [0]=>
          array(8) {
            ["anio"]=>
            string(4) "2015"
            ["periodo"]=>
            string(1) "1"
            ["creditos"]=>
            string(1) "3"
            ["codigo_asignatura"]=>
            string(6) "326996"
            ["nombre_asignatura"]=>
            string(64) "PROGRAMA TUTORES: PROCESO DE ADAPTACIÓN A LA VIDA UNIVERSITARIA"
            ["calificacion"]=>
            string(4) "6.20"
            ["estado"]=>
            string(8) "APROBADA"
            ["codigo_asignatura_malla"]=>
            string(7) "3267992"
          }
          [1]=>
          array(8) {
            ["anio"]=>
            string(4) "2015"
            ["periodo"]=>
            string(1) "1"
            ["creditos"]=>
            string(1) "4"
            ["codigo_asignatura"]=>
            string(6) "310137"
            ["nombre_asignatura"]=>
            string(28) "COMUNICACIÓN ORAL Y ESCRITA"
            ["calificacion"]=>
            string(4) "2.1"
            ["estado"]=>
            string(8) "REPROBADA"
            ["codigo_asignatura_malla"]=>
            string(7) "3101372"
          }
          [2]=> ETC ...
        }

        */
        return [];
    }

    public static function obtieneLasAsignaturasInscritasDelEstudiante($rut, $anio, $semestre){
        /*
        Si se necesita esta consulta para su proyecto, implementarla según su estructura al igual que el método de ejemplo obtieneAsignaturaPorCodigo($codigo_asignatura)

        Estructura:
        array(5) {
          [0]=>
          array(2) {
            ["codigo_asignatura"]=>
            string(6) "240178"
            ["codigo_asignatura_malla"]=>
            string(7) "2401782"
          }
          [1]=>
          array(2) {
            ["codigo_asignatura"]=>
            string(6) "240179"
            ["codigo_asignatura_malla"]=>
            string(7) "2401792"
          }
          [2]=>ETC...
        }

        */
        return [];
    }
}

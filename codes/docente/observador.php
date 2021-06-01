<?php

class observador
    {
    function buscar_grado($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT are_grado_sede.id_grado_sede, s.numero,area.nombre as nombre ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_jornada_sede,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.numero, grado.nombre as grado,curso.nombre as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN jornada_sede on grado_sede.id_jornada_sede=jornada_sede.ID_JS INNER JOIN sede on sede.ID_SEDE=jornada_sede.ID_SEDE INNER JOIN jornada on jornada.ID_JORNADA=jornada_sede.ID_JORNADA)as s on s.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id__docente=$id GROUP BY s.id ";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    function categoria(){
    	
        include "../../../codes/rector/conexion.php";
    	
    	$cat="SELECT * FROM `observacion_categotia`";
		$cat1=$conexion->prepare($cat);
		$cat1->execute(array());
		return $ca=$cat1->fetchAll();
    }
    function compromiso(){
    	
        include "../../../codes/rector/conexion.php";
    	$cat="SELECT * FROM `observador_compromiso`";
		$cat1=$conexion->prepare($cat);
		$cat1->execute(array());
		return$ca=$cat1->fetchAll();
    }
    function consultar_opbservacion_individual_descarga($id){
        
        include "../../../codes/rector/conexion.php";
        $cat="SELECT observador_compromiso.texto, administradores.NOMBRE,administradores.APELLIDO, observacion_categotia.nombre as nom_t,observacion_tipo.nombre as nom_c,observacion.area, docente.nombre,docente.apellido,observacion.descripcion,observacion.fecha FROM observacion LEFT JOIN observador_compromiso on observador_compromiso.id=observacion.compromiso LEFT JOIN administradores on administradores.ID_ADMIN=observacion.id_admin LEFT JOIN docente on docente.id_docente=observacion.id_docente LEFT JOIN observacion_tipo on observacion.id_observacion_tipo=observacion_tipo.id LEFT JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria WHERE observacion.id_alumno=2214";
        $cat1=$conexion->prepare($cat);
        $cat1->execute(array());
        return$ca=$cat1->fetchAll();
    }
    function consutar_estudiante_acudiente($id){
        
        include "../../../codes/rector/conexion.php";
        $cat="SELECT alumnos.foto,alumnos.numero_documento as num_alumno,alumnos.tipo_documento as tipo_alumno,alumnos.barrio as b,alumnos.direccion as d,alumnos.telefono as t,alumnos.vive, acudiente.nombre,acudiente.apellido,acudiente.num_documento,acudiente.tipo_documento,acudiente.celular,acudiente.direccion,acudiente.celular,acudiente.barrio,alumno_acudiente.parentesco FROM alumnos LEFT JOIN alumno_acudiente on alumno_acudiente.id_alumnos=alumnos.id_alumnos LEFT JOIN acudiente on alumno_acudiente.id_acudiente=acudiente.id_acudiente WHERE alumnos.id_alumnos=$id";
        $cat1=$conexion->prepare($cat);
        $cat1->execute(array()); 
        $conexion="NULL";
        return $var2=$cat1->fetchAll(); 
          
    }
    function consutar_observacion($id){
        
        include "../../../codes/rector/conexion.php";
        $ano=date("Y");
        $cat="    SELECT observacion.periodo, observacion.id_alumno, observador_compromiso.texto as compromiso, observacion_categotia.nombre as categoria,observacion_tipo.nombre as tipo,observacion.area, docente.nombre,docente.apellido,observacion.descripcion,observacion.fecha FROM observacion LEFT JOIN observador_compromiso on observador_compromiso.id=observacion.compromiso LEFT JOIN docente on docente.id_docente=observacion.id_docente LEFT JOIN observacion_tipo on observacion.id_observacion_tipo=observacion_tipo.id LEFT JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria WHERE observacion.id_alumno=$id and  observacion.ano=$ano ";
        $cat1=$conexion->prepare($cat);
        $cat1->execute(array());
        $conexion="NULL";
        return $var2=$cat1->fetchAll(); 
          
    }
    function consutar_observacion_acumulado($id){
        
        include "../../../codes/rector/conexion.php";
        $cat="    SELECT observacion.id, observacion.periodo,  observador_compromiso.texto as compromiso, observacion_categotia.nombre as categoria,observacion_tipo.nombre as tipo,observacion.area, docente.nombre,docente.apellido,observacion.descripcion,observacion.fecha,observacion.ano,sede.NOMBRE as sede,jornada.NOMBRE as jornada ,grado.nombre as grado , curso.numero as curso FROM observacion LEFT JOIN observador_compromiso on observador_compromiso.id=observacion.compromiso LEFT JOIN docente on docente.id_docente=observacion.id_docente LEFT JOIN observacion_tipo on observacion.id_observacion_tipo=observacion_tipo.id LEFT JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria LEFT JOIN grado on grado.id_grado=observacion.id_grado LEFT join curso on curso.id_curso=observacion.id_curso LEFT JOIN jornada_sede on jornada_sede.ID_JS=observacion.id_jornada_sede LEFT JOIN sede on sede.ID_SEDE=jornada_sede.ID_SEDE LEFT join jornada on jornada.ID_JORNADA=jornada_sede.ID_JORNADA WHERE observacion.id_alumno=$id ";
        $cat1=$conexion->prepare($cat);
        $cat1->execute(array());
        $conexion="NULL";
        return $var2=$cat1->fetchAll(); 
          
    }
    function consutar_observacion_ano($id,$ano){
        
        include "../../../codes/rector/conexion.php";
        $cat="    SELECT observacion.periodo, observacion.id_alumno, observador_compromiso.texto as compromiso, observacion_categotia.nombre as categoria,observacion_tipo.nombre as tipo,observacion.area, docente.nombre,docente.apellido,observacion.descripcion,observacion.fecha FROM observacion LEFT JOIN observador_compromiso on observador_compromiso.id=observacion.compromiso LEFT JOIN docente on docente.id_docente=observacion.id_docente LEFT JOIN observacion_tipo on observacion.id_observacion_tipo=observacion_tipo.id LEFT JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria WHERE observacion.id_alumno=$id and observacion.ano=$ano ";
        $cat1=$conexion->prepare($cat);
        $cat1->execute(array());
        $conexion="NULL";
        return $var2=$cat1->fetchAll(); 
          
    }
    function remision(){
        
        include "../../../codes/rector/conexion.php";
        $cat="SELECT remision.texto_remision,  administradores.NOMBRE,administradores.APELLIDO,administradores.FOTO,jornada.nombre as jornada, remision.id_remision, observacion.id, sede.NOMBRE as sede,curso.numero as curso,grado.nombre as grado,  observacion_categotia.nombre as categoria,observacion_tipo.nombre as tipo, alumnos.nombre as nom,alumnos.apellido as ape ,alumnos.foto as fo,alumnos.genero as gen,docente.nombre,docente.apellido,docente.genero,docente.foto,observacion.area,observacion.fecha,observacion.descripcion,observacion.periodo,observador_compromiso.texto as compromiso,remision.estado,remision.orientacion,remision.accion,remision.matricula_condicional from remision   LEFT join observacion on remision.id_observacion=observacion.id left join observador_compromiso on observacion.compromiso=observador_compromiso.id left join alumnos on  observacion.id_alumno=alumnos.id_alumnos left join docente on docente.id_docente=observacion.id_docente LEFT join observacion_tipo on observacion_tipo.id=observacion.id_observacion_tipo left JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria LEFT JOIN jornada_sede on observacion.id_jornada_sede=jornada_sede.ID_JS LEFT JOIN jornada on jornada.ID_JORNADA=jornada_sede.ID_JORNADA LEFT JOIN sede on sede.ID_SEDE=jornada_sede.ID_SEDE LEFT JOIN grado on grado.id_grado=observacion.id_grado LEFT join curso on curso.id_curso=observacion.id_curso LEFT JOIN administradores on administradores.ID_ADMIN=observacion.id_admin";
        $cat1=$conexion->prepare($cat);
        $cat1->execute(array());
        $conexion="NULL";
        return $var2=$cat1->fetchAll(); 
          
    }
}
?>
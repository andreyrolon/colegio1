<?php

class chat
    {
        function acudiente(){
            include "../../../codes/rector/conexion.php";
            
            $sql="SELECT acudiente.* ,alumno_acudiente.parentesco from acudiente,alumno_acudiente WHERE alumno_acudiente.id_alumnos=".$_SESSION['Id_Doc']."  and alumno_acudiente.id_acudiente=acudiente.id_acudiente";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }

           function consultar_mensaje_reenviado($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT mailbox.fecha,mailbox.asunto,docente.nombre ,docente.apellido,docente.foto ,administradores.NOMBRE,administradores.APELLIDO,administradores.FOTO,alumnos.nombre,alumnos.apellido,alumnos.foto,mailbox.mensaje,mailbox.archivo ,mailbox.tabla_de from mailbox LEFT JOIN mailbox_person on mailbox_person.id_mailbox=mailbox.id LEFT JOIN docente on docente.id_docente=mailbox.de LEFT JOIN administradores on administradores.ID_ADMIN=mailbox.de LEFT JOIN alumnos on alumnos.id_alumnos=mailbox.de WHERE mailbox.id=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }

    
        function formatearFecha($fecha){
    return date('g:i a', strtotime($fecha));
    }
    function actualizar_estado_mensaje($id){
        include "../../../codes/rector/conexion.php";
        $sql="UPDATE `mailbox_person` SET `visto` = '1' WHERE `mailbox_person`.`id` =$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }

    function mensajes_recividos($id_u,$id){
        include "../../../codes/rector/conexion.php";
          $sql=" 

         SELECT  mailbox.de,mailbox.tabla_de, mailbox.fecha, mailbox_person.reenvio,mailbox_person.id,mailbox.asunto,docente.nombre ,docente.apellido,docente.foto  ,administradores.NOMBRE,administradores.APELLIDO,administradores.FOTO, mailbox.mensaje,mailbox.archivo,mailbox.id as ides ,mailbox_person.visto ,mailbox.dirigido ,alumnos.nombre,alumnos.apellido,alumnos.foto from mailbox LEFT JOIN mailbox_person on mailbox_person.id_mailbox=mailbox.id LEFT JOIN alumnos on alumnos.id_alumnos=mailbox.de LEFT JOIN docente on docente.id_docente=mailbox.de LEFT JOIN administradores on administradores.ID_ADMIN=mailbox.de    WHERE mailbox_person.para=$id_u     and mailbox_person.id=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
     function mensajes(){
        include "../../../codes/rector/conexion.php";
        
        $var="SELECT mailbox.fecha, mailbox_person.id,mailbox.asunto,docente.nombre ,docente.foto ,administradores.NOMBRE,administradores.FOTO , mailbox.tabla_de from mailbox LEFT JOIN mailbox_person on mailbox_person.id_mailbox=mailbox.id LEFT JOIN docente on docente.id_docente=mailbox.de LEFT JOIN administradores on administradores.ID_ADMIN=mailbox.de WHERE mailbox_person.para='".$_SESSION['Id_Doc']."' and mailbox_person.visto=0 and mailbox_person.tabla_para=6 order by mailbox.id";
        $var1=$conexion->prepare($var);
        $var1->execute(array());
        $ew=$var1->rowCount();
        $var2=$var1->fetchAll(); 
        return array($ew,$var2);
    }
    
    function perfil_($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT nombre,apellido,genero ,foto FROM alumnos WHERE alumnos.id_alumnos=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }

    function notas($id,$p){ 

        if (preg_match ("/^[0-9]+$/", $id) and preg_match ("/^[0-9]+$/", $p)) {  
            include "../../../codes/rector/conexion.php";
            $sql="SELECT area.codigo,area.area, materia_por_periodo.id_materia_por_periodo, area.nombre FROM materia_por_periodo,area WHERE materia_por_periodo.id_informe_academico=$id   and area.id_area=materia_por_periodo.id_area  and materia_por_periodo.periodo=$p ";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
    }

    function notas_t($id,$p){ 
        include "../../../codes/rector/conexion.php";
        if (preg_match ("/^[0-9]+$/", $id) and preg_match ("/^[0-9]+$/", $p)) {  
            $sql="SELECT competencias.id_competencias,competencias.nombre FROM tecnologia,competencias WHERE tecnologia.id_informe_academico=$id and   tecnologia.id_competrencia=competencias.id_competencias and competencias.id_periodo=$p ";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
    }
    function guias(){

        include "../../../codes/rector/conexion.php";
        $j=$_SESSION['ID_JORNADA'];
        $c=$_SESSION['id_curso'];
        $g=$_SESSION['id_grado'];

        $sql="SELECT guias.nombre,guias.guia,guias.fecha_registro,guias.fecha_presentacion,guias.id_periodo,area.nombre as area from area ,guias   WHERE guias.id_grado=$g  and guias.id_curso=$c  and guias.id_jornada_sede=$j and guias.id_area=area.id_area  order by  guias.id_guias desc ";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        return $con2=$sql1->fetchAll();
    }

    function nivelacion($p){
        include '../../../codes/rector/conexion.php';
        $id=$_SESSION['id_informe_academico'];
       

        $sql="SELECT materia_por_periodo.recuperacion,materia_por_periodo.trabajo,materia_por_periodo.sustentacion, area.codigo,area.area, area.id_area, area.nombre,materia_por_periodo.nota FROM materia_por_periodo,area WHERE materia_por_periodo.id_informe_academico=$id and materia_por_periodo.periodo=$p and area.id_area=materia_por_periodo.id_area HAVING materia_por_periodo.nota<6";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        return $con2=$sql1->fetchAll();
    }
    function nivelacion2($p){
        include '../../../codes/rector/conexion.php';
        $id=$_SESSION['id_informe_academico'];
       

        $sql="SELECT tecnologia.id_competrencia,tecnologia.nota,tecnologia.recuperacion,tecnologia.trabajo,tecnologia.sustentacion,competencias.nombre from competencias,tecnologia WHERE tecnologia.id_informe_academico=$id   and tecnologia.id_periodo=$p   and  tecnologia.id_competrencia=competencias.id_competencias  HAVING tecnologia.nota<6.5";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        return $con2=$sql1->fetchAll();
    }

    function horario(){
        

        include '../../../codes/rector/conexion.php';
        $id=$_SESSION['id_informe_academico'];

        $sql="SELECT area.nombre, area.area,area.id_area,area.area,area.codigo from area ,materia_por_periodo WHERE materia_por_periodo.id_informe_academico=$id and materia_por_periodo.periodo=1 and materia_por_periodo.id_area=area.id_area";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        return $con2=$sql1->fetchAll();

    }


    function horario_t(){
        

        include '../../../codes/rector/conexion.php';
        $id=$_SESSION['id_informe_academico'];
        $numero=$_SESSION['numero'];

        $sql="SELECT competencias.nombre,horario_competencias.hora_inicio,horario_competencias.hora_fin,horario_competencias.dia from horario_competencias,competencias,tecnologia WHERE tecnologia.id_informe_academico=$id and tecnologia.id_competrencia=competencias.id_competencias and competencias.id_periodo=$numero and horario_competencias.id_competencias= competencias.id_competencias
";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        return $con2=$sql1->fetchAll();

    }

    function horario2($d,$h){
        

        include '../../../codes/rector/conexion.php';
        $id_curso=$_SESSION['id_curso'];
        $id_grado=$_SESSION['id_grado'];
        $id_jornada_sede=$_SESSION['id_jornada_sede'];

        $sql="SELECT horario.dias,horario.hora,horario.hora_inicio,area.nombre,area.id_area  FROM horario,are_grado_sede,grado_sede,area WHERE grado_sede.id_grado=$id_grado   and grado_sede.id_jornada_sede=$id_jornada_sede   and   grado_sede.id_curso=$id_curso    and  grado_sede.id=are_grado_sede.id_grado_sede   and are_grado_sede.id_area_grado_sede=horario.id_area_grado_sede  and horario.dias=$d   and horario.hora=$h and are_grado_sede.id_area=area.id_area ";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $con2=$sql1->fetchAll();

        foreach ($con2 as $key ) {
            ?>
            <nav   style="   border-radius: 4px; padding-left: 10px;padding-right: 10px;margin-bottom: 5px "  id="we<?php echo$key['id_area'] ?>"><?php echo $key['nombre'] ;  ?></nav> <?php
        }

    }
 }
?>
<?php

class chat
    {
        
    function actualizar_estado_mensaje($id){
        include "../../../codes/rector/conexion.php";
        $sql="UPDATE `mailbox_person` SET `visto` = '1' WHERE `mailbox_person`.`id` =$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }
    
    function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
    }
    
    function send($id,$para,$asunto,$mensaje,$file){
        include "../../../codes/rector/conexion.php";
        if($file['files']['name']==""){
            foreach($para as $para1){
                $sql="INSERT INTO `mailbox`(`id`, `de`, `para`, `asunto`, `mensaje`, `archivo`, `numero`,`trash`) VALUES ('',$id,$para1,'$asunto','$mensaje','',1,0)";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
        }else{
            $ruta='../../../img/'.$file['files']['name'];
            move_uploaded_file($file['files']['tmp_name'],$ruta);
            foreach($para as $para1){
                $sql="INSERT INTO `mailbox`(`id`, `de`, `para`, `asunto`, `mensaje`, `archivo`, `numero`,`trash`) VALUES ('',$id,$para,'$asunto','$mensaje','$ruta',1,0)";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
        }
    }

       
    function cursos($id){
        include "../../../codes/rector/conexion.php";
        $sql=" SELECT g.curso,g.numero,g.id_grado,g.id_curso,g.id_sede,g.id_jornada, g.id,are_grado_sede.id__docente,g.id_sede,g.id_jornada,g.sede,g.jornada from are_grado_sede INNER JOIN (SELECT grado.numero,curso.numero as curso, sede.NOMBRE as sede,jornada.NOMBRE as jornada,grado_sede.* from curso,grado,grado_sede,sede,jornada WHERE sede.ID_SEDE=grado_sede.id_sede and jornada.ID_JORNADA=grado_sede.id_jornada AND grado.id_grado=grado_sede.id_grado AND grado_sede.id_curso=curso.id_curso)as g on g.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id__docente=$id GROUP by g.id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll(); 
        return $sql2;
    }
    function mensajes($id){
        include "../../../codes/rector/conexion.php";
      
        $var="SELECT mailbox.fecha, mailbox_person.id,mailbox.asunto,docente.nombre ,docente.foto  ,administradores.NOMBRE,administradores.FOTO,alumnos.nombre,alumnos.foto , mailbox.tabla_de from mailbox LEFT JOIN mailbox_person on mailbox_person.id_mailbox=mailbox.id LEFT JOIN docente on docente.id_docente=mailbox.de LEFT JOIN administradores on administradores.ID_ADMIN=mailbox.de LEFT JOIN alumnos on alumnos.id_alumnos=mailbox.de WHERE mailbox_person.para='$id' and mailbox_person.visto=0   and mailbox_person.tabla_para=1 order by id desc";
        $var1=$conexion->prepare($var);
        $var1->execute(array());
        $var2=$var1->fetchAll();
        $ew=$var1->rowCount();
        return array($ew,$var2);
    }

    function consultar_mensaje_reenviado($id ){
        include "../../../codes/rector/conexion.php"; 

        
         $sql="SELECT mailbox.fecha,mailbox.asunto ,mailbox.mensaje,mailbox.archivo ,mailbox.dirigido from mailbox WHERE mailbox.id=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
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
    
    function update_numero($id){
        include "../../../codes/rector/conexion.php";
        $sql="UPDATE `mailbox` SET `numero`=0 WHERE id=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }
    
    function consultar_mensajes_enviados($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT docente.nombre, docente.apellido, mailbox.* FROM mailbox INNER JOIN docente ON docente.id_docente=mailbox.para WHERE mailbox.de=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    function mostrar_mensaje_docente($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT docente.nombre, docente.apellido   
         FROM mailbox_person,docente WHERE docente.id_docente=mailbox_person.para and mailbox_person.id_mailbox ='$id'";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    
     function mostra_admin_mensaje($id)
    {    
        include "../../../codes/rector/conexion.php";
        $consultar_nivel="SELECT administradores.NOMBRE,administradores.APELLIDO FROM mailbox_person,administradores WHERE administradores.ID_ADMIN=mailbox_person.para and mailbox_person.id_mailbox ='$id'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        return $registro=$consultar_nivel1->fetchAll();

    } 
     function mostra_alumno_mensaje($id)
    {    
        include "../../../codes/rector/conexion.php";
        $consultar_nivel="SELECT alumnos.nombre,alumnos.apellido FROM mailbox_person,alumnos WHERE alumnos.id_alumnos=mailbox_person.para and mailbox_person.id_mailbox ='$id'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        return $registro=$consultar_nivel1->fetchAll();

    } 
    function mensajes_enviados($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT mailbox.dirigido,mailbox.todos, mailbox.asunto,mailbox.mensaje,mailbox.fecha,mailbox.archivo ,grado.nombre as grado,curso.numero, q.jornada,q.sede from mailbox LEFT JOIN grado on grado.id_grado=mailbox.id_grado LEFT JOIN curso on curso.id_curso=mailbox.id_curso LEFT JOIN (SELECT sede.NOMBRE as sede ,jornada.NOMBRE as jornada,jornada_sede.ID_JS from jornada_sede,sede,jornada WHERE sede.ID_SEDE=jornada_sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA)as q on q.ID_JS=mailbox.id_jornada_sede WHERE mailbox.id=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    
    function mail_papelera($id){
        include "../../../codes/rector/conexion.php";
        $sql="UPDATE `mailbox` SET `trash`=1 WHERE mailbox.id=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }
    
    function consultar_mensajes_papelera($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT docente.nombre, docente.apellido, mailbox.* FROM mailbox INNER JOIN docente ON docente.id_docente=mailbox.de WHERE mailbox.para=$id AND trash=1";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    
    function mensajes_papelera($id_u,$id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT docente.nombre, docente.apellido, mailbox.* FROM mailbox INNER JOIN docente ON docente.id_docente=mailbox.para WHERE mailbox.para=$id_u AND mailbox.id=$id AND mailbox.trash=1";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }

    
    function perfil_($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT NOMBRE,APELLIDO,ROL,GENERO,FOTO FROM administradores WHERE ID_ADMIN=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    function perfil_2($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT * FROM administradores WHERE ID_ADMIN=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    
    function form6($id,$file){
        include "../../../codes/rector/conexion.php";
        $ruta='../../../img/'.$file['file']['name'];
        move_uploaded_file($file['file']['tmp_name'],$ruta);
        $sql="UPDATE `docente` SET `foto`='$ruta' WHERE docente.id_docente=$id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
}
    
    }

?>

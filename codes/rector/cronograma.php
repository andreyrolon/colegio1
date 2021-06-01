<?php 
    /**
     * 
     */
    class cronograma
    {
       function mostrar_sede($va){
            include "../../codes/conexion.php";
            $sql="SELECT sede.NOMBRE as sede, jornada.NOMBRE as jornada, jornada_sede.ID_JS FROM jornada_sede INNER JOIN sede ON sede.ID_SEDE=jornada_sede.ID_SEDE INNER JOIN jornada ON jornada.ID_JORNADA=jornada_sede.ID_JORNADA".$va;
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
            
        }
        
        
        function consultar_crono($v){
            include "../../codes/conexion.php";
            $sql="SELECT docente.nombre, docente.apellido, cronograma_de_actividades.* FROM `cronograma_de_actividades` INNER JOIN docente ON docente.id_docente=cronograma_de_actividades.responsable".$v;
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql3=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            return array($sql3,$sql2);
            
        }
        
        function nueva_actividad($nom,$periodo,$fecha,$descrip,$responsable,$observaciones,$imagen){
            include "../../codes/conexion.php";
            $ruta='../../actividades/'.$imagen['imagen']['name'];
            move_uploaded_file($imagen['imagen']['tmp_name'],$ruta);
            
            $sql="INSERT INTO `cronograma_de_actividades`(`id`, `nombre_actividad`, `periodo`, `fecha`, `descripcion_actividad`, `responsable`, `observaciones`, `imagen`) VALUES ('','$nom','$periodo','$fecha','$descrip','$responsable','$observaciones','$ruta')";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            
        }
        
    }
?>

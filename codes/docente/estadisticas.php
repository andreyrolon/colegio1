<?php 
 

class  estadisticas
{
    function grado($id_docente)
    {
        include "../../../codes/rector/conexion.php";
        $sql = "SELECT grado.nombre,grado.id_grado,grado_sede.titular  FROM grado_sede,grado,are_grado_sede 
        WHERE grado_sede.id_grado=grado.id_grado AND grado_sede.id=are_grado_sede.id_grado_sede AND are_grado_sede.id__docente='$id_docente' GROUP BY grado.id_grado";
        $sql1 = $conexion->prepare($sql);
        $sql1->execute(array());
        $sql2 = $sql1->fetchAll();
        return $sql2;
    }
    
    function jornada_sede($id){
        include "../../../codes/rector/conexion.php";
          $sql=" SELECT  jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE AS jornada from jornada,sede,jornada_sede,grado_sede,are_grado_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and grado_sede.id=are_grado_sede.id_grado_sede AND are_grado_sede.id__docente='$id' and jornada_sede.inhabilitar=0   and  sede.inhabilitar=0   GROUP by jornada_sede.ID_JS";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll(); 

        
        return $sql2;

    }
    
    
}

 

?>

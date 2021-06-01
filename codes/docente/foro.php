<?php

class foro
    {
    function tipo(){
        include "../../../codes/rector/conexion.php";
        $sql="  SELECT nombre,id_tipo_calificaciones FROM `tipo_calificaiones`";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    function curso($id){
        include "../../../codes/rector/conexion.php";
        $sql=" 
       SELECT grado.nombre as grado,curso.numero AS curso, grado_sede.id from grado,curso,are_grado_sede,grado_sede WHERE grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso AND grado_sede.id=are_grado_sede.id_grado_sede AND are_grado_sede.id__docente='$id' GROUP BY grado_sede.id
";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    function jornada_sede($id,$var){
        include "../../../codes/rector/conexion.php";
        $sql=" SELECT  jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE AS jornada from jornada,sede,jornada_sede,grado_sede,are_grado_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and grado_sede.id=are_grado_sede.id_grado_sede AND are_grado_sede.id__docente='$id' and jornada_sede.inhabilitar=0   and  sede.inhabilitar=0   GROUP by jornada_sede.ID_JS";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll(); 
        $array='';
        foreach ($sql2 as $key) {
            $array.=",'".$key['ID_JS']."'";
        }

        $not=substr($array, 1);
        $no='';
        if ($not!='') {
            $no=' jornada_sede.ID_JS not in('.$not.') and ';
        }
        $p=$_SESSION['numero'];
        $sqla="SELECT grado_sede.id, jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE AS jornada from jornada,sede,jornada_sede,grado_sede,competencias,tecnica_grado_sede WHERE $no jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and jornada_sede.inhabilitar=0 and sede.inhabilitar=0 and tecnica_grado_sede.id_grado_sede=grado_sede.id and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_docente=$id and competencias.id_periodo=$p  GROUP by jornada_sede.ID_JS";
        $sqla1=$conexion->prepare($sqla);
        $sqla1->execute(array());
        $sqla2=$sqla1->fetchAll(); 

        $sql=" SELECT tipo_calificaiones.id_tipo_calificaciones from tipo_calificaiones WHERE tipo_calificaiones.nombre='$var'";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 
        foreach ($sql1 as $key  ) {
           $devol=$key['id_tipo_calificaciones'];
        }
        
        return array($sql2, $devol,$sqla2);

    }
    
    
}

?>



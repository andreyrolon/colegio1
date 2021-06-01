<?php

class horario
    {
    
     function horario_docente($id){
        include "../../../codes/rector/conexion.php";
         $sql="SELECT area.id_area, area.nombre, are_grado_sede.id__docente, grado.numero as grado, curso.nombre as curso, curso.numero, horario.hora, horario.dias FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN horario ON horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede INNER JOIN grado_sede on are_grado_sede.id_grado_sede=grado_sede.id INNER JOIN grado ON grado_sede.id_grado=grado.id_grado INNER JOIN curso ON grado_sede.id_curso=curso.id_curso WHERE are_grado_sede.id__docente=$id  ORDER BY horario.hora, horario.dias ASC";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    
    function sede($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT sede.NOMBRE FROM `are_grado_sede` INNER JOIN grado_sede ON are_grado_sede.id_grado_sede=grado_sede.id INNER JOIN sede ON grado_sede.id_sede=sede.ID_SEDE WHERE are_grado_sede.id__docente=$id GROUP BY are_grado_sede.id__docente";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
}

?>
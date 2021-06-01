 

<?php

class select
    {
    function buscar_grado($id){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT q.sede,q.jornada,q.id_jornada_sede , q.curso,q.grado,q.id_curso,q.id_grado,q.numero,q.id from ( SELECT sede.NOMBRE as sede, jornada.NOMBRE as jornada,grado.nombre as grado, curso.numero as curso,grado_sede.id_jornada_sede,grado.id_grado,curso.id_curso,grado.numero,grado_sede.id  from grado,jornada,jornada_sede,sede,grado_sede,curso WHERE grado.id_grado=grado_sede.id_grado AND grado_sede.id_curso=curso.id_curso and grado_sede.id_jornada_sede=jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA GROUP by grado_sede.id)as q WHERE q.id IN (SELECT are_grado_sede.id_grado_sede FROM are_grado_sede WHERE are_grado_sede.id__docente='$id' GROUP by are_grado_sede.id_grado_sede) or q.id in(SELECT tecnica_grado_sede.id_grado_sede from competencias,tecnica_grado_sede WHERE competencias.id_docente='$id' and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede GROUP by tecnica_grado_sede.id_grado_sede) GROUP by q.id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
}
?>
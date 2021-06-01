<?php

class logro
    {


        function curso($g,$c,$j){
            include '../../../codes/rector/conexion.php';
                 
               $cat="SELECT sede.NOMBRE as s,jornada.NOMBRE as j, grado.numero as g,curso.numero as c FROM curso,jornada,sede,grado,jornada_sede WHERE grado.id_grado=$g and curso.id_curso=$c and jornada_sede.ID_JS=$j AND jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA";
            $cat1=$conexion->prepare($cat);
            $cat1->execute(array()); 
            return   ($cat1);  
        }

    }
?>
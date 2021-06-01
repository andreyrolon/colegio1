<?php

class carga
    {


        function competencias($id){
            include '../../../codes/rector/conexion.php';
                 
                $cat="SELECT competencias.codigo,competencias.id_periodo,grado_sede.id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso,competencias.id_periodo,competencias.id_competencias as id_competrencia,competencias.nombre as competencia,grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada, sede.NOMBRE as sede from competencias,grado_sede,tecnica_grado_sede,grado,curso,jornada_sede,jornada,sede WHERE sede.ID_SEDE=jornada_sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and grado_sede.id_jornada_sede=jornada_sede.ID_JS and grado_sede.id_grado=grado.id_grado and grado_sede.id_curso=curso.id_curso and grado_sede.id=tecnica_grado_sede.id_grado_sede and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_docente=$id GROUP by competencias.id_competencias";
            $cat1=$conexion->prepare($cat);
            $cat1->execute(array());
            $count=$cat1->rowCount();
            $ca=$cat1->fetchAll();
            $t=array($ca,$count);  
            return   ($t);  
        }
        function tabla($id){
            include "../../../codes/rector/conexion.php";
             $cat="SELECT s.id_jornada_sede,area.codigo,area.area,area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(
            SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.id,grado_sede.id_curso,grado_sede.id_grado, grado_sede.id_jornada_sede from grado_sede ,grado,curso,sede,jornada_sede, jornada where   grado.id_grado=grado_sede.id_grado      and curso.id_curso=grado_sede.id_curso     and sede.ID_SEDE=jornada_sede.id_sede  and jornada.ID_JORNADA=jornada_sede.id_jornada and grado_sede.id_jornada_sede=jornada_sede.ID_JS)as s on s.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id__docente=$id
";
            $cat1=$conexion->prepare($cat);
            $cat1->execute(array());
            $count=$cat1->rowCount();
            $ca=$cat1->fetchAll();
            return $ca;
        }

            function periodo_docente($id,$p){
            include "../../../codes/rector/conexion.php";
             $cat=" SELECT activo_nota FROM `docente_habilitado` WHERE   id_docente=$id and id_periodo=$p";
            $cat1=$conexion->prepare($cat);
            $cat1->execute(array());
            $count=$cat1->rowCount();
            $ca=$cat1->fetchAll();
            return $ca;
        }
        function periodo(){
            include "../../../codes/rector/conexion.php";
           $cat="SELECT numero,activar_periodo,fecha_inicio,fecha_fin FROM periodo   ORDER BY periodo.numero";
            $cat1=$conexion->prepare($cat);
            $cat1->execute(array()); 
            return $cat1;
        }
        function periodow(){
            include "../../../codes/rector/conexion.php";
           $cat="SELECT numero FROM periodo   WHERE periodo.activar_recuperacion=1  ORDER BY periodo.numero";
            $cat1=$conexion->prepare($cat);
            $cat1->execute(array()); 
            $con2=$cat1->fetchAll();
            return $con2;
        }
    
       
    
    function n_est($id_g,$id_c,$id_jornada_sede,$id){
            include "../../../codes/rector/conexion.php";
                $ano=date('Y');
                 $con3="SELECT COUNT(informeacademico.id_informe_academico)as d FROM `informeacademico` WHERE informeacademico.id_grado='$id_g' AND informeacademico.id_curso='$id_c' AND informeacademico.id_jornada_sede='$id_jornada_sede' and informeacademico.ano=$ano  ";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }
  
    
    function n_est2($id_g,$id_c,$id_jornada_sede,$numero,$id_competrencia){
            include "../../../codes/rector/conexion.php";
                $ano=date('Y');
                   $con3="SELECT COUNT(informeacademico.id_informe_academico)as d FROM informeacademico,tecnologia,competencias WHERE informeacademico.id_grado='$id_g' AND informeacademico.id_curso='$id_c' AND informeacademico.id_jornada_sede='$id_jornada_sede' and informeacademico.ano=$ano and tecnologia.id_informe_academico=informeacademico.id_informe_academico and competencias.id_competencias=tecnologia.id_competrencia and tecnologia.id_competrencia=$id_competrencia and competencias.id_periodo=$numero
 ";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }
    function n_est3($id_g,$id_c,$id_s_j,$ia,$p){
            include "../../../codes/rector/conexion.php";
                $ano=date('Y');
                $con3="SELECT COUNT(informeacademico.id_informe_academico)as d from informeacademico,materia_por_periodo  WHERE informeacademico.ano='$ano' and informeacademico.id_curso='$id_c'  and   informeacademico.id_grado='$id_g' and informeacademico.id_jornada_sede='$id_s_j'  and  informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and materia_por_periodo.id_area='$ia'  and materia_por_periodo.periodo='$p'  and materia_por_periodo.nota<(SELECT escala_academica.desde from escala_academica WHERE escala_academica.mini=1 )";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }
    function n_est31($id_g,$id_c,$id_s_j,$ia,$p){
            include "../../../codes/rector/conexion.php";
                $ano=date('Y');
                $con3="SELECT COUNT(informeacademico.id_informe_academico)as d from informeacademico,materia_por_periodo  WHERE informeacademico.ano='$ano' and informeacademico.id_curso='$id_c'  and   informeacademico.id_grado='$id_g' and informeacademico.id_jornada_sede='$id_s_j'  and  informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and materia_por_periodo.id_area='$ia'  and materia_por_periodo.periodo='$p'  and materia_por_periodo.recuperacion>(SELECT escala_academica.desde from escala_academica WHERE escala_academica.mini=1 )";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }
    function n_est4($id_g,$id_c,$id_s_j,$ia,$p){
            include "../../../codes/rector/conexion.php";
                $ano=date('Y');
                 $con3="SELECT count(q.id_informe_academico)as dd  from (SELECT tecnologia.nota,tecnologia.recuperacion, informeacademico.id_informe_academico from informeacademico,tecnologia WHERE informeacademico.ano='$ano'  and informeacademico.id_grado='$id_g'  and  informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_s_j'    and informeacademico.id_informe_academico=tecnologia.id_informe_academico and  tecnologia.id_periodo='$p')as q WHERE q.nota<(SELECT escala_tecnica.desde from escala_tecnica WHERE escala_tecnica.mini=1 )   ";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }
    function n_est41($id_g,$id_c,$id_s_j,$ia,$p){
            include "../../../codes/rector/conexion.php";
                $ano=date('Y');
                $con3="SELECT count(q.id_informe_academico)as dd  from (SELECT tecnologia.nota,tecnologia.recuperacion, informeacademico.id_informe_academico from informeacademico,tecnologia WHERE informeacademico.ano='$ano'  and informeacademico.id_grado='$id_g'  and  informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_s_j'    and informeacademico.id_informe_academico=tecnologia.id_informe_academico and  tecnologia.id_periodo='$p')as q WHERE q.recuperacion>(SELECT escala_tecnica.desde from escala_tecnica WHERE escala_tecnica.mini=1 )   ";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }
    
    function tipo_calificaciones(){
            include "../../../codes/rector/conexion.php";
                $con3="SELECT * FROM `tipo_calificaiones`";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }

    
    /*function input_nota($id_al,$id_p,$tip_n){
            include "../../../codes/rector/conexion.php";
                $con3="SELECT materia_por_paso.* FROM materias INNER JOIN materia_por_periodo on materia_por_periodo.id_materia=materias.id_materias INNER JOIN materia_por_paso ON materia_por_paso.id_materia_por_periodo=materia_por_periodo.id_materia_por_periodo INNER JOIN alumnos ON alumnos.id_alumnos=materia_por_paso.id_alumno WHERE materia_por_paso.id_alumno='$id_al' AND materia_por_paso.id_tipo='$tip_n' AND materia_por_periodo.periodo='$id_p'";
                $con1=$conexion->prepare($con3);
                $con1->execute(array());
                $count=$con1->rowCount();
                $con2=$con1->fetchAll();
                return $con2;
            
        }*/
}

?>
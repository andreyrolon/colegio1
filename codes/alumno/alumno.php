<?php 
    
    class alumno
    {
        function alumno_ver($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT * FROM alumnos $va";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
        function ver(){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT alumnos.nombre,alumnos.apellido,alumnos.id_alumnos from alumnos
";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
        function curso($id){ 
            include "../../../codes/rector/conexion.php";
            $con3="SELECT area.id_area,area.nombre,area.codigo,area.area FROM area,materia_por_periodo WHERE materia_por_periodo.periodo=1 and materia_por_periodo.id_informe_academico=$id AND materia_por_periodo.id_area=area.id_area";
            $con3=$conexion->prepare($con3);
            $con3->execute(array()); 
            $con4=$con3->fetchAll();


            $con2="SELECT competencias.nombre,competencias.id_competencias,competencias.id_periodo from informeacademico,tecnologia,competencias WHERE informeacademico.id_informe_academico=tecnologia.id_informe_academico and competencias.id_competencias=tecnologia.id_competrencia and informeacademico.id_informe_academico=$id";
            $con2=$conexion->prepare($con2);
            $con2->execute(array()); 
            $con5=$con2->fetchAll();
            $con1=array($con5,$con4);

            return $con1;
        }
    }
?>
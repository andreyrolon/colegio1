<?PHP
    class horario{
        
        function asignar_titular($titu,$id){
            include "conexion.php";
             $sql="UPDATE `grado_sede` SET `titular`=$titu WHERE id=$id";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());

        }
        
        //FUNCION PARA CONSULTAR LAS ASIGNATURAS DEL GRADO SEDE
        function consultar_areas_grado($id){
            include "conexion.php";
               $sql="SELECT q.area,q.codigo,q.nombre,q.id_area_grado_sede,q.id_grado,intensidad_horaria.hora ,intensidad_horaria.id ,COUNT(horario.id_area_grado_sede)as s from ( SELECT grado_sede.id_grado, area.nombre,area.codigo,area.area, are_grado_sede.id_area_grado_sede FROM area , are_grado_sede,grado_sede WHERE grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id_area=area.id_area and are_grado_sede.id_grado_sede='$id' GROUP BY area.id_area) as q LEFT JOIN intensidad_horaria on intensidad_horaria.area=q.nombre and intensidad_horaria.grado=q.id_grado LEFT join horario on horario.id_area_grado_sede=q.id_area_grado_sede WHERE q.area not in('1') or q.codigo in('01') GROUP by q.id_area_grado_sede

";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $count=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            return array($count,$sql2); 
        }
        function consultar_horario_dinamico($id,$dia,$hora){
            include "conexion.php";
               $sql="SELECT  area.nombre,are_grado_sede.id_area_grado_sede, horario.dias,horario.hora from horario,grado_sede,are_grado_sede,area WHERE grado_sede.id='$id' and grado_sede.id=are_grado_sede.id_grado_sede  and horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede   and horario.dias='$dia'  and horario.hora='$hora' and are_grado_sede.id_area=area.id_area
 ";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $count=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            return array($count,$sql2);
        }
        
        //FUNCION PARA CONSULTAR LAS ASIGNATURAS DEL GRADO SEDE HORARIO
        function consultar_areas_grado_horario($id){
            include "conexion.php";
            $sql="SELECT area.*, are_grado_sede.id__docente, horario.* FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN horario ON horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede WHERE are_grado_sede.id_grado_sede=$id";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $count=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            return array($count,$sql2);

        }
        
        //CONSULTA NOMBRE DE LA SEDE Y DEL CURSO
        function consultar_sede_grados($e){
            include "conexion.php";
          
              $sql="SELECT grado.nombre as grado, curso.nombre, curso.numero, grado_sede.id_jornada_sede, grado_sede.id, sede.NOMBRE AS sede, jornada.NOMBRE as jornada FROM grado,curso,sede,jornada,jornada_sede,grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado_sede.id_jornada_sede=jornada_sede.ID_JS and grado_sede.id_curso=curso.id_curso and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA and  
$e  ";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        
        function   consultar_titular_($e){
            include "conexion.php";
             $sql="SELECT grado_sede.titular FROM grado_sede WHERE grado_sede.id=$e";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        
        function consultar_titular($e){
            include "conexion.php";
             $sql="SELECT grado_sede.titular, docente.nombre, docente.apellido FROM `grado_sede` INNER JOIN docente ON docente.id_docente=grado_sede.titular WHERE id=$e";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $dtyt=$sql1->rowCount();
            $sql2=$sql1->fetchAll(); 
            return $array = array($sql2,$dtyt);

        }
        
        function consultar_docentes_asignatura($e){
            include "conexion.php";
              $sql="SELECT docente.nombre, docente.apellido, docente.id_docente FROM are_grado_sede INNER JOIN docente ON docente.id_docente=are_grado_sede.id__docente WHERE are_grado_sede.id_grado_sede=$e GROUP by docente.id_docente";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        
        function guardar_horario($lunes,$martes,$miercoles,$jueves,$viernes){
            include "conexion.php";
            $con_l=0; $con_m=0; $con_mi=0; $con_j=0; $con_v=0; 
            foreach($lunes as $lu){
                $con_l++;
                $sql="INSERT INTO `horario`(`id_horario`, `id_area_grado_sede`, `hora`, `dias`) VALUES ('','$lu','$con_l','Lunes')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($martes as $ma){
                $con_m++;
                $sql="INSERT INTO `horario`(`id_horario`, `id_area_grado_sede`, `hora`, `dias`) VALUES ('','$ma','$con_m','Martes')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($miercoles as $mi){
                $con_mi++;
                $sql="INSERT INTO `horario`(`id_horario`, `id_area_grado_sede`, `hora`, `dias`) VALUES ('','$mi','$con_mi','Miercoles')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($jueves as $ju){
                $con_j++;
                $sql="INSERT INTO `horario`(`id_horario`, `id_area_grado_sede`, `hora`, `dias`) VALUES ('','$ju','$con_j','Jueves')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($viernes as $vi){
                $con_v++;
                $sql="INSERT INTO `horario`(`id_horario`, `id_area_grado_sede`, `hora`, `dias`) VALUES ('','$vi','$con_v','Viernes')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
        }
        
        function update_horario($lunes,$martes,$miercoles,$jueves,$viernes){
            include "conexion.php";
            $con_l=0; $con_m=0; $con_mi=0; $con_j=0; $con_v=0; 
            foreach($lunes as $lu){
                $con_l++;
                list($a,$b)=explode("-",$lu);
                $sql="UPDATE `horario` SET `id_area_grado_sede`=$b WHERE id_horario=$a";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($martes as $ma){
                $con_m++;
                list($a,$b)=explode("-",$ma);
                $sql="UPDATE `horario` SET `id_area_grado_sede`=$b WHERE id_horario=$a";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($miercoles as $mi){
                $con_mi++;
                list($a,$b)=explode("-",$mi);
                $sql="UPDATE `horario` SET `id_area_grado_sede`=$b WHERE id_horario=$a";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($jueves as $ju){
                $con_j++;
                list($a,$b)=explode("-",$ju);
                $sql="UPDATE `horario` SET `id_area_grado_sede`=$b WHERE id_horario=$a";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
            foreach($viernes as $vi){
                $con_v++;
                list($a,$b)=explode("-",$vi);
                $sql="UPDATE `horario` SET `id_area_grado_sede`=$b WHERE id_horario=$a";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
            }
        }
        
        //FUNCION PARA CONSULTAR LAS ASIGNATURAS DEL GRADO SEDE
        function consultar_areas_grado_horario_registrado($id){
            include "conexion.php";
            $sql="SELECT area.*, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area WHERE are_grado_sede.id_grado_sede=$id GROUP BY area.id_area";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $count=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            return array($count,$sql2);

        }
        
        
    }
?>
